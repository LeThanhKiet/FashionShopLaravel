<?php

namespace App\Http\Controllers\Client;

use App\Http\Services\CartService;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{

    public function index()
    {

        $carts = Session::get('carts');
        $products = DB::table('products')->inRandomOrder()->limit(8)->get();
        $sliders = DB::table('sliders')->get();
        return view('client.index', [
            'title' => 'Shop Quần Áo',
            'products' => $products,
            'carts' => $carts,
            'sliders' => $sliders,
        ]);
    }
    public function getProductByFilter($request) {
        $products = DB::table('products')->Paginate(6);
        if (isset($request->start_price))
        {
            $start_price = $request->input('start_price') * 1000;
            $end_price = $request->input('end_price') * 1000;
            $products = DB::table('products')
                ->where('price', '>', $start_price)
                ->where('price','<', $end_price)
                ->paginate(6);
        }
        else{
            if (isset($_GET['sort_by'])) {
                if ($_GET['sort_by'] == 'asc') {
                    $products = DB::table('products')
                        ->orderBy('price')
                        ->paginate(6);

                }
                if ($_GET['sort_by'] == 'desc') {
                    $products = DB::table('products')
                        ->orderByDesc('price')
                        ->paginate(6);
                }
                if ($_GET['sort_by'] == 'popularity') {
                    $products = DB::table('products')
                        ->orderBy('price')
                        ->paginate(6);
                }
                if ($_GET['sort_by'] == 'newest') {
                    $products = DB::table('products')
                        ->orderBy('price')
                        ->paginate(6);
                }
            }
        }
        return $products;
    }
    public function shop(Request $request)
    {
        $products = DB::table('products')->Paginate(6);
        $products = $this->getProductByFilter($request);
        $carts = Session::get('carts');
        $categories = DB::table('categories')->get();
        return view('client.home', [
            'title' => 'Shop Quần Áo',
            'name' => 'Sản phẩm',
            'products' => $products,
            'categories' => $categories,
            'carts' => $carts,
        ]);
    }

    public function category(Request $request, $id = '', $slug = '')
    {
        $products = DB::table('products')
            ->where('id_category', $id)
            ->paginate(6);
        if (isset($request->start_price))
        {
            $start_price = $request->input('start_price') * 1000;
            $end_price = $request->input('end_price') * 1000;
            $products = DB::table('products')
                ->where('id_category', $id)
                ->where('price', '>', $start_price)
                ->where('price','<', $end_price)
                ->paginate(6);
        }
        else{
            if (isset($_GET['sort_by'])) {
                if ($_GET['sort_by'] == 'asc') {
                    $products = DB::table('products')
                        ->where('id_category', $id)
                        ->orderBy('price')
                        ->paginate(6);
                }
                if ($_GET['sort_by'] == 'desc') {
                    $products = DB::table('products')
                        ->where('id_category', $id)
                        ->orderByDesc('price')
                        ->paginate(6);
                }
                if ($_GET['sort_by'] == 'popularity') {
                    $products = DB::table('products')
                        ->where('id_category', $id)
                        ->orderBy('price')
                        ->paginate(6);
                }
                if ($_GET['sort_by'] == 'newest') {
                    $products = DB::table('products')
                        ->where('id_category', $id)
                        ->orderBy('price')
                        ->paginate(6);
                }
            }


        }

        $carts = Session::get('carts');
        $cart_product = CartService::getProduct();
        $categories = DB::table('categories')->get();
        return view('client.home', [
            'title' => 'Danh mục sản phẩm',
            'name' => 'Danh mục sản phẩm',
            'products' => $products,
            'carts' => $carts,
            'cart_products' => $cart_product,
            'categories' => $categories,
        ]);

    }
    public function search(Request $request){
        if (!empty($request->keyword))
        {
            Session::put('keyword', $request->keyword);
            $keyword = Session::get('keyword');
            $products = DB::table('products')->where('name', 'like', '%'.$keyword.'%')->paginate(6);
            $this->getProductByFilter($request);
        }
        else {
            $keyword = Session::get('keyword');
            $products = DB::table('products')->where('name', 'like', '%'.$keyword.'%')->paginate(6);
            $this->getProductByFilter($request);
        }
        $carts = Session::get('carts');
        $cart_product = CartService::getProduct();
        $categories = DB::table('categories')->get();
        return view('client.home', [
            'title' => 'Danh mục sản phẩm',
            'name' => 'Danh mục sản phẩm',
            'products' => $products,
            'carts' => $carts,
            'cart_products' => $cart_product,
            'categories' => $categories,
        ]);
    }
    public function autocompleteSearch(Request $request)
    {
        $query = $request->get('query');
        $products = Product:: where('name', 'like', '%'.$query.'%')
            ->get()
            ->map(function ($item) {
                return (array) $item;
            })
            ->all();
        return response()->json($products);
    }
}
