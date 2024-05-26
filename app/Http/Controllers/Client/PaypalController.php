<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Http\Services\CartService;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductDetail;
use App\Models\ProductModel;
use App\Models\User;
use Aws\Ssm\SsmClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{

    public function createTransaction()
    {

        return view('client.checkout');
    }


    public function processTransaction(Request $request)
    {
        if (empty(Session::get('carts')))
        {
            Session::flash('error','Giỏ hàng trống!');
            return redirect()->back();
        }
        if ($request->name_1 == 1 && $request->email_1 == 1
        && $request->phone_1 == 1 && $request->address_1 == 1) {
            Session::flash('error','Vui lòng điền đầy đủ thông tin!');
            return redirect()->back();
        }

        // Validate số lượng hàng trong kho
        $carts = Session::get('carts');
        $productId = array_keys(Session::get('carts'));
        $products = ProductModel::select('id', 'name', 'price', 'image', 'quantity')
            ->whereIn('id', $productId)
            ->get();
        foreach ($products as $product) {
            $qty = $product->quantity - $carts[$product->id];
            if ($qty < 0) {
                Session::flash('error', 'Sản phẩm '. $product->name . ' đã hết hàng!');
                return redirect()->back();
            }
        }
        if (!empty(Session::get('info'))) Session::forget('info');

        Session::put('info', [
            'name' => $request->name_1,
            'email' => $request->email_1,
            'phone' => $request->phone_1,
            'address' => $request->address_1,
            'note' => $request->note_1,
            'role' => 3,
        ]);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => Session::get('total_usd')
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('checkout')
                ->with('error', 'Có lỗi đã xảy ra.');

        } else {
            return redirect()
                ->route('checkout')
                ->with('error', $response['message'] ?? 'Có lỗi đã xảy ra.');
        }
    }

    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $total_money = Session::get('total_usd');
            //$note = $request->input('note');
            try {
                DB::beginTransaction();

                $carts = Session::get('carts');

                if (is_null($carts))
                    return false;

                $customer = User::create(Session::get('info'));

                $orderBill = Order::create([
                    'id_customer' => $customer->id,
                    'total_money' => Session::get('total'),
                    'note' => '',
                    'kind' => 1,
                ]);


                $productId = array_keys($carts);
                $products = ProductModel::select('id', 'name', 'price', 'image', 'quantity')
                    ->whereIn('id', $productId)
                    ->get();

                $data = [];
                foreach ($products as $product) {
                    $data[] = [
                        'id_order' => $orderBill->id,
                        'id_model' => $product->id,
                        'quantity' => $carts[$product->id],
                        'price' => $product->price,
                    ];
                }
                OrderDetail::insert($data);

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

                    //Lưu chi tiết sản phẩm
                    $order = 0;
                    $productDetails = ProductDetail::where('id_models', $orderDetail->id_model)
                        ->orderBydesc('import')->limit(1)
                        ->get();

                    if ($productDetails != null)
                        foreach ($productDetails as $productDetail)
                            $order = $productDetail->order;

                    for ($i = 0; $i < $orderDetail->quantity; $i++) {
                        $order += 1;
                        DB::table('product_details')->insert([
                            'id_models' => $orderDetail->id_model,
                            'order' => $order,
                            'price' => $orderDetail->price,
                            'id_order_detail' => $orderDetail->id,
                        ]);
                    }
                }
                DB::commit();
                Session::flash('success', 'Đặt Hàng Thành Công ');


                Session::forget('total_usd');
                Session::forget('total');
                Session::forget('carts');
                Session::forget('info');
            } catch (\Exception $err) {
                DB::rollBack();
                return redirect()
                    ->route('checkout')
                    ->with('error', $response['message'] ?? 'Có lỗi đã xảy ra.');
            }
            return redirect()
                ->route('checkout')
                ->with('success', 'Thanh toán thành công.');
        } else {
            return redirect()
                ->route('checkout')
                ->with('error', $response['message'] ?? 'Có lỗi đã xảy ra.');
        }
    }

    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('checkout')
            ->with('error', $response['message'] ?? 'Bạn đã hủy phiên giao dịch.');
    }
}
