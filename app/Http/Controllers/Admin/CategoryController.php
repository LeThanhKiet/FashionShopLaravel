<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\exactly;


class CategoryController extends Controller
{

    public function get()
    {
        return Category::all();
    }


    public function index()
    {

        return view('admin.category.category', [
            'title' => 'loại sản phẩm',
            'loaisp' => $this->get()
        ]);
    }


    public function add()
    {
        return view('admin.category.category_add', [
            'title' => 'Thêm loại sản phẩm',
            'loaisp' => $this->get()
        ]);
    }


    public function store(CategoryRequest $request)
    {
        try {
            Category::create([
                'name' => (string)$request->input('name'),
            ]);
            Session::flash('success', 'Thêm loại sản phẩm mới thành công');
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
        }
        return redirect()->back();
    }

    public static function name($id)
    {
        try {
            return Category::where('id', $id)->first()->ten;
        } catch (\Exception $ex) {

        }

        return "";
    }


    public function edit(Category $loaisp)
    {
        //dd($loaisp);
        return view('admin.category.category_edit', [
            'title' => 'Chỉnh sửa loại sản phẩm',
            'loaisps' => $this->get(),
            'loaisp' => $loaisp
        ]);
    }

    public function update(Category $loaisp, CategoryRequest $request)
    {
        $loaisp->name = (string)$request->input('name');
        $loaisp->save();
        return redirect('admin/goods/category');
    }

    public function delete(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            Category::where('id', $id)->delete();
            DB::commit();
            Session::flash('success', 'Xóa danh mục thành công');
            return redirect()->route('category');
        }
        catch (\Exception $exception){
            Session::flash('error', 'Xóa danh mục lỗi, danh mục đang tồn tại sản phẩm');
            return redirect()->route('category');
        }
    }


}
