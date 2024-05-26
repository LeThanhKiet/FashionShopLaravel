<?php
namespace App\Http\Services;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function create($request)
    {
        $qty = (int)$request->input('quantity');
        $product_model_id = (int)$request->input('product_model_id');
        $product_model = DB::table('product_models')->where('id',$product_model_id)->first();

        if ($qty <= 0 || $product_model_id <= 0 ) {
            Session::flash('error', 'Số lượng hoặc Sản phẩm không chính xác');
            return false;
        }
        if ($product_model->quantity < $request->input('quantity'))
        {
            Session::flash('error', 'Sản phẩm đã hết hàng');
            return false;
        }

        $carts = Session::get('carts');
        if (is_null($carts)) {
            Session::put('carts', [
                $product_model_id => $qty,
            ]);
            Session::flash('success', 'Thêm sản phẩm thành công!');
            return true;
        }

        $exists = Arr::exists($carts, $product_model_id);
        if ($exists) {
            $carts[$product_model_id] = $carts[$product_model_id] + $qty;
            Session::put('carts', $carts);
            Session::flash('success', 'Thêm sản phẩm thành công!');
            return true;
        }

        $carts[$product_model_id] = $qty;
        Session::flash('success', 'Thêm sản phẩm thành công!');
        Session::put('carts', $carts);

        return true;
    }

    public static function getProduct()
    {
        $carts = Session::get('carts');
        if (is_null($carts)) return [];

        $productId = array_keys($carts);
        return ProductModel::select('id', 'name', 'price', 'id_product', 'image')
            ->whereIn('id', $productId)
            ->get();
    }

    public function update($request)
    {
        Session::put('carts', $request->input('product_quantity'));

        return true;
    }

    public function remove($id)
    {
        $carts = Session::get('carts');
        unset($carts[$id]);

        Session::put('carts', $carts);
        return true;
    }

    public function addCart($request)
    {
        $total_money = $request->input('total');
        $note = $request->input('note');

        try {
            DB::beginTransaction();

            $carts = Session::get('carts');

            if (is_null($carts))
                return false;

            $existEmail = false;
            $customer = User::create([
                'name' => $request->input('customer_name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'email' => $request->input('email'),
                'role' => 3,
            ]);

            //Lưu hóa đơn bán
            $orderBill = Order::create([
                'id_customer' => Auth::id(),
                'total_money' => $total_money,
                'note' => $note,
                'kind' => 1,
            ]);
            //Lưu chi tiết hóa đơn
            $this->infoOrderDetail($orderBill->id, $carts);

            //Lấy ra chi tiết hóa đơn
            $orderDetails = OrderDetail::where('id_order', $orderBill->id)->get();

            foreach($orderDetails as $orderDetail)
            {
                //Lấy ra số lượng mẫu mã
                $product = DB::table('product_models')->where('id', $orderDetail->id_model)->first();
                //Trừ số lượng sản phẩm
                $qty = $product->quantity - $orderDetail->quantity;
                //Lưu lại trong sản phẩm
                DB::table('product_models')->where('id', $orderDetail->id_model)->update(['quantity'=> $qty]);

            }

            DB::commit();
            Session::flash('success', 'Đặt Hàng Thành Công ');

            #Queue
            //SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2));

            Session::forget('carts');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Đặt Hàng Lỗi, Vui lòng thử lại sau');
            return false;
        }

        return true;
    }

    public function infoOrderDetail($order_id, $carts)
    {
        $productId = array_keys($carts);
        $products = ProductModel::select('id', 'name', 'price', 'image', 'quantity')
            ->whereIn('id', $productId)
            ->get();

        $data = [];
        foreach ($products as $product) {
            $data[] = [
                'id_order' => $order_id,
                'id_model' => $product->id,
                'quantity' => $carts[$product->id],
                'price' => $product->price
            ];
        }
        return OrderDetail::insert($data);
    }

    public function getCustomer()
    {
        return User::orderByDesc('id')->paginate(15);
    }

    public function getProductForCart($customer)
    {
        return $customer->carts()->with(['product' => function ($query) {
            $query->select('id', 'name', 'thumb');
        }])->get();
    }
}
