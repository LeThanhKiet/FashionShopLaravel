<?php

namespace App\Http\Controllers\Client;

use App\Helpers\cartHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductModel;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Services\CartService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
        $this->middleware('auth');
    }

//    public function index(Request $request)
//    {
//        $result = $this->cartService->create($request);
//        if ($result === false) {
//            return redirect()->back();
//        }
//
//        return redirect('/carts');
//    }
    public function hehe(Request $request)
    {
        $result = $this->cartService->create($request);
        if ($result === false) {
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function show()
    {
        $products = $this->cartService->getProduct();
        return view('client.cart.list', [
            'title' => 'Giỏ Hàng',
            'name' => 'Giỏ hàng',
            'productModels' => $products,
            'carts' => Session::get('carts'),
        ]);
    }

    public function update(Request $request)
    {
        $this->cartService->update($request);

        return redirect('/carts');
    }


    public function remove($id = 0)
    {
        $this->cartService->remove($id);

        return redirect('/carts');
    }

    public function checkout()
    {
        $cart_product = CartService::getProduct();
        return view('client.checkout', [
            'title' => 'Thanh toán',
            'name' => 'Thanh toán',
            'cart_products' => $cart_product,
            'carts' => Session::get('carts'),
        ]);
    }

    public function addCart(CheckoutRequest $request)
    {
        if (empty(Session::get('carts'))) {
            Session::flash('error', 'Giỏ hàng trống!');
            return redirect()->back();
        }

        $carts = Session::get('carts');
        $productId = array_keys(Session::get('carts'));
        $products = ProductModel::select('id', 'name', 'price', 'image', 'quantity')
            ->whereIn('id', $productId)
            ->get();
        foreach ($products as $product) {
            $qty = $product->quantity - $carts[$product->id];
            if ($qty < 0) {
                Session::flash('error', 'Sản phẩm ' . $product->name . ' đã hết hàng!');
                return redirect()->back();
            }
        }

        $this->validate($request, [
            'customer_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $this->cartService->addCart($request);

        return redirect()->back();
    }


    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo_payment(Request $request)
    {
        $total_money = $request->totalMoney;
        $note = $request->note_1;
            $carts = Session::get('carts');
            $existEmail = false;
            $customer = User::create([
                'name' => $request->name_1,
                'phone' => $request->phone_1,
                'address' => $request->address_1,
                'email' => $request->email_1,
                'role' => 3,
            ]);

            $order = Order::create([
                'id_customer' => Auth::id(),
                'total_money' => $total_money,
                'note' => $request->note_1,
                'kind' => 1,
            ]);


            $carts = Session::get('carts');
        $this->cartService->infoOrderDetail($order->id, $carts);
            $validated = $request->validate([
                'name_1' => 'required',
                'email_1' => 'required|email',
                'phone_1' => 'required|numeric',
                'address_1' => 'required',
                'note_1' => 'nullable',
            ]);
            $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
            $partnerCode = 'MOMOBKUN20180529';
            $accessKey = 'klm05TvNBzhg7h7j';
            $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
            $orderInfo = "Thanh toán qua MoMo";
            $amount = $request->totalMoney;
            $orderId = time() . "";
            $redirectUrl = "http://127.0.0.1:8000";
            $ipnUrl = "http://127.0.0.1:8000/checkout";
            $extraData = "";
            $requestId = time() . "";
            $requestType = "payWithATM";
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $secretKey);
            $data = array('partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = $this->execPostRequest($endpoint, json_encode($data));

            $jsonResult = json_decode($result, true);  // decode json

            if (isset($jsonResult['message']) && $jsonResult['message'] == "Thành công.") {

                $orderId = session('order_id');
                $order = Order::find($orderId);
                if ($order) {
                    $order->payment_status = 'paid';
                    $order->save();
                }
            }

            Session::forget('carts');

            return redirect($jsonResult['payUrl']);

        }

    public function order()
    {
        $userId = Auth::id();
        $orders = DB::table('orders')
            ->where('id_customer', $userId)
            ->join('users', 'orders.id_customer', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name')
            ->get();

        return view('client.order', [
            'title' => 'Đơn hàng',
            'name' => 'Đơn hàng',
            'orders' => $orders,
        ]);
    }
}
