<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{

    public function index($id = '', $slug = '')
    {

        $product = DB::table('products')->where('id', $id)->first();
        $product_models = DB::table('product_models')->where('id_product', $id)->orderBy('color', 'desc')->get();
        $product_models_color = DB::table('product_models')->where('id_product', $id)->distinct('color')->get();
        $colors = ProductController::getColor($id);
        $sizes = ProductController::getSize($id);
        $carts = Session::get('carts');
        $cart_product = CartService::getProduct();
        $categories = DB::table('categories')->get();
        return view('client.product.detail', [
            'title' => 'Chi tiết sản phẩm',
            'name' => 'Chi tiết sản phẩm',
            'product' => $product,
            'product_models' => $product_models,
            'product_models_color' => $product_models_color,
            'colors' => $colors,
            'sizes' => $sizes,
            'carts' => $carts,
            'cart_products' => $cart_product,

        ]);
    }

    public function reload(Request $request, $id = '', $slug = '')
    {
        dd($request->price_filter);
        $id_model = $request->productModel;
        $product = DB::table('products')->where('id', $id)->first();
        $product_models = DB::table('product_models')->where('id_product', $id)->orderBy('color', 'desc') ->get();
        $colors = $this->getColor($id);
        $sizes = $this->getSize($id);
        $categories = DB::table('categories')->get();
        return view('client.product.detail', [
            'title' => 'Chi tiết sản phẩm',
            'name' => 'Chi tiết sản phẩm',
            'product' => $product,
            'id_model' => $id_model,
            'product_models' => $product_models,
            'colors' => $colors,
            'sizes' => $sizes,
            'categories' => $categories,
        ]);
    }
    public function getColor($id)
    {
        $colors = DB::table('product_models')
            ->where('id_product', $id)
            ->distinct('color')
            ->select('color')
            ->get();
        return $colors;
    }
    public function getSize($id)
    {
        $colors = DB::table('product_models')
            ->where('id_product', $id)
            ->distinct('size')
            ->select('size')
            ->get();
        return $colors;
    }
}
