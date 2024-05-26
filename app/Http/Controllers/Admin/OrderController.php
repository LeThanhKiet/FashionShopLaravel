<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\User;
use Aws\QLDB\QLDBClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index()
    {
        $orders =
            DB::table('orders')
            ->where('kind', 1)
            ->get();
        return view('admin.order.order', [
            'title' => 'Đơn hàng',
            'orders' => $orders,
        ]);
    }

    public static function list($data)
    {
        $html = '';
        foreach ($data as $key => $item) {
            $user = DB::table("users")->where("id", $item->id_customer)->first();
            $userName = $user ? $user->name : 'Unknown User';
            $html .= '
        <tr onclick="location.href=\'order/detail/' . $item->id . '\';">
               <th>' . $item->id . '</th>
               <th>' . $userName . '</th>
               <th>' . number_format($item->total_money) . '</th>
               <th>' . $item->created_at . '</th>
        </tr>
        ';
            // unset($loaisp[$key]);
        }
        return $html;
    }
    public function show($id)
    {
        $order = DB::table('orders')
            ->where('id', $id)
            ->where('kind', 1)
            ->first();
        $orderDetail = DB::table('orders_details')
            ->where('id_order', $id)
            ->get();
        return view('admin.order.order_detail', [
            'title' => 'Chi tiết đơn hàng',
            'order' => $order,
            'orderDetails' => $orderDetail,
        ]);
    }

    public function detailUpdate($id)
    {
        $staff = Auth::getUser()->id;
        Order::where('id', $id)->update([
                'kind' => 2,
                'id_saler' => $staff
            ]);
        session()->flash('success', 'Thành công');
        return redirect()->route('order.dashboard');
    }
    public function detailUpdateCancel($id)
    {
        $staff = Auth::getUser()->id;
        Order::where('id', $id)->update([
                'kind' => 4,
                'id_saler' => $staff,
            ]);
        //Lấy ra chi tiết hóa đơn
        $orderDetails = OrderDetail::where('id_order', $id)->get();
        foreach($orderDetails as $orderDetail)
        {
            //Lấy ra số lượng mẫu mã
            $product = DB::table('product_models')->where('id', $orderDetail->id_model)->first();
            //Cộng số lượng sản phẩm trong chi tiết hóa đơn
            $qty = $product->quantity + $orderDetail->quantity;
            //Lưu lại trong sản phẩm
            DB::table('product_models')->where('id', $orderDetail->id_model)->update(['quantity'=> $qty]);

        }

        return redirect()->route('order.dashboard');
    }


    public function ship()
    {
        $orders = DB::table('orders')
            ->where('kind', 2)
            ->get();
        return view('admin.order.order_ship', [
            'title' => 'Vận đơn',
            'orders' => $orders,
        ]);
    }
    public function shipUpdate($id)
    {
        DB::table('orders')
            ->where('id', $id)
            ->update([
                'kind' => 3
            ]);
        $orderDetails = OrderDetail::where('id_order', $id)->get();
        foreach($orderDetails as $orderDetail)
        {
            //Lưu chi tiết sản phẩm

            $productDetail = DB::table('product_details')
                ->where('id_models', $orderDetail->id_model)
                ->first();
            $ord = 0;
            //Check tồn tại chi tiết sản phẩm, nếu đã tồn tại thì lấy ra số lượng sản phẩm
            if ($productDetail != null) {
                $ord = $productDetail->order;
            }
            $ord += $orderDetail->quantity;
            //Có số lượng của sản phẩm, lưu thông tin vào trong bảng
            DB::table('product_details')->insert([
                'id_models' => $orderDetail->id_model,
                'order' => $ord,
                'price' => $orderDetail->price,
                'id_order_detail' => $orderDetail->id,
            ]);
        }
        return redirect()->route('ship');
    }

    public function shipCancel($id)
    {
        $orderDetails = OrderDetail::where('id_order', $id)->get();
        foreach($orderDetails as $orderDetail)
        {
            //Lấy ra số lượng mẫu mã
            $product = DB::table('product_models')->where('id', $orderDetail->id_model)->first();
            //Cộng số lượng sản phẩm trong chi tiết hóa đơn
            $qty = $product->quantity + $orderDetail->quantity;
            //Lưu lại trong sản phẩm
            DB::table('product_models')->where('id', $orderDetail->id_model)->update(['quantity'=> $qty]);

        }
        Order::where('id', $id)
            ->update([
                'kind' => 4
            ]);

        return redirect()->route('order.dashboard');
    }
    public function bill()
    {
        $orders = DB::table('orders')
            ->where('kind', 3)
            ->get();
        return view('admin.order.order_bill', [
            'title' => 'Hóa đơn bán',
            'orders' => $orders,
        ]);
    }

    public function cancel()
    {
        $orders = DB::table('orders')
            ->where('kind', 4)
            ->get();
        return view('admin.order.order_cancel', [
            'title' => 'Đơn hủy',
            'orders' => $orders,
        ]);
    }

}
