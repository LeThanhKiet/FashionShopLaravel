<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\ListOfValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Symfony\Component\Mime\Message;

class ProductController extends Controller
{

    public function get()
    {

        return Product::all();
    }

    public function index()
    {
        return view('admin.product.product', [
            'title' => 'Danh sách sản phẩm',
            'data' => $this->get(),
        ]);
    }


    public function add()
    {
        return view('admin.product.product_add', [
            'title' => 'Thêm sản phẩm',
            'loaisp' => Category::all(),
        ]);
    }


    public function store(ProductRequest $request)
    {
        //tạo bằng model
        try {
            Product::create([
                'name' => (string)$request->input('name'),
                'id_category' => (int)$request->input('id_category'),
                'description' => (string)$request->input('description'),
                'image' => (string)$request->input('image'),
                'price' => $request->input('price'),
            ]);
            Session::flash('success', 'Thành công');
        } catch (\Exception $exception) {
            Session::flash('error', 'Thêm sản phẩm lỗi!');
        }
        //tạo bằng db
        /*DB::table('loaisp')->insert([
            'ten' => 'kayla@example.com'
        ]);*/
        return redirect()->route('product');
    }

    public static function category($id)
    {
        try {
            return Category::where('id', $id)->first()->name;
        } catch (\Exception $ex) {

        }

        return "";
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.product.product_detail', [
            'title' => 'Chi tiết sản phẩm',
            'product' => $product,
            'data' => ProductModel::where('id_product', $id)->get(),
        ]);
    }

    public function detailUpdate(Product $product, Request $request, $id)
    {
        $models = DB::table('product_models')->where('id_product', $id)->select('color', 'size')->get();
        $color = $request->color;
        $size = $request->size;
        $name = ($request->name) . ' (' . $color . ' - ' . $size . ')';
        $message = '';
        //Add
        if ($request->add == 'add')
        {
            if (!empty($models)) {
                foreach ($models as $model) {
                    if ($model->color == $color && $model->size == $size) {
                        $message = 'Thêm sản phẩm lỗi, đã tồn tại sản phẩm này.';
                    }
                }
            }
            if ($message == '') {
                try {
                    ProductModel::query()
                        ->insert([
                            'name' => $name,
                            'size' => $size,
                            'color' => $color,
                            'quantity' => 0,
                            'id_product' => $id,
                            'price' => $request->price,
                            'image' => $request->image,
                        ]);
                    Session::flash('success', 'Cập nhật mẫu mã thành công');
                    $product = Product::findOrFail($id);
                    $product->quantity = $request->totalQuantity;
                    $product->save();
                    return redirect()->route('detail', ['id' => $id]);
                } catch (\Exception $exception) {
                    Session::flash('error', $exception->getMessage());
                }
            }
            else {
                Session::flash('error', $message);
                return redirect()->route('detail', ['id' => $id]);
            }
        }
        //Edit
        if ($request->edit == 'edit') {
            foreach ($models as $model) {
                if ($model->color == $color && $model->size == $size) {
                    try {
                        ProductModel::query()
                            ->where('color', $model->color)
                            ->where('size', $model->size)
                            ->update([
                                'price' => $request->price,
                                'image' => $request->image,
                            ]);
                        Session::flash('success', 'Cập nhật mẫu mã thành công');
                        $product = Product::findOrFail($id);
                        $product->quantity = $request->totalQuantity;
                        $product->save();
                        return redirect()->route('detail', ['id' => $id]);
                    } catch (\Exception $exception) {
                        Session::flash('error', $exception->getMessage());
                    }
                }
                else $message = 'Không thể cập nhập sản phẩm, không tìm thấy sản phẩm';
            }
            if ($message != '') {
                Session::flash('error', $message);
                return redirect()->route('detail', ['id' => $id]);
            }
        }
        return redirect()->route('detail', ['id' => $id]);
    }

    public function detailDelete(Request $request, $id) {

        $id_product = ProductModel::query()->where('id', $id)->first()->id_product;
        try {
            DB::beginTransaction();
            ProductModel::where('id', $id)->delete();
            DB::commit();
            Session::flash('success', 'Xóa mẫu mã thành công');
            return redirect()->route('detail', ['id' => $id_product]);
        }
        catch (\Exception $exception){
            Session::flash('error', 'Xóa mẫu mã lỗi, đã tồn tại hóa đơn chứa mẫu mã');
            return redirect()->route('detail', ['id' => $id_product]);
        }
    }

    public static function list($data)
    {
        $html = '';
        foreach ($data as $item) {
            $html .= '
            <tr>
                    <th><img src="' . $item->image . '"  style="width:50%;height:50%;"></th>
                   <th id = "th-name-product" onclick="location.href=\'product/detail/' . $item->id . '\';" >' . $item->name . '</th>
                   <th>' . Category::getCategoryName($item->id_category)->name . '</th>
                   <th>' . ProductModel::getAllQuantity($item->id) . '</th>
                   <th>' . ProductModel::getAllModel($item->id) . '</th>
                   <th>' . Product::getPrice($item->id) . '</th>
                   <th>
                        <a  href="/admin/goods/product/edit/' . $item->id . '">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a  href="#"
                            onclick="removeRow(' . $item->id . ', \'/admin/goods/product/delete\')">
                            <i class="far fa-trash-alt"></i>
                        </a>

                   </th>
            </tr>
            ';
            // unset($loaisp[$key]);
        }
        return $html;
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);

        return view('admin.product.product_edit', [
            'title' => 'Chỉnh sửa sản phẩm',
            'categories' => Category::all(),
            'product' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required|unique:products,name,{$id},id",
            'image' => "required",
        ]);

        $product = Product::findOrFail($id);
        $product->name = (string)$request->input('name');
        $product->id_category = (int)$request->input('id_category');
        $product->image = (string)$request->input('image');
        $product->price = (float)$request->input('price');
        $product->description = (string)$request->input('description');

        $product->save();

        return redirect('admin/goods/product');
    }

    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            Product::where('id', $id)->delete();
            DB::commit();
            Session::flash('success', 'Xóa sản phẩm thành công');
            return redirect()->route('product');
        }
        catch (\Exception $exception){
            Session::flash('error', 'Xóa sản phẩm lỗi, đã tồn tại hóa đơn sản phẩm');
            return redirect()->route('product');
        }
    }

}
