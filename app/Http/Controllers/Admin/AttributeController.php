<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListOfValue;
use DebugBar\DataFormatter\DebugBarVarDumper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AttributeController extends Controller
{
    public function index()
    {

        $colors = ListOfValue::color();
        $sizes = ListOfValue::size();
        return view('admin.attribute.list', [
            'title' => 'Thuộc tính sản phẩm',
            'colors' => $colors,
            'sizes' => $sizes,
        ]);
    }

    public function create()
    {
        return view('admin.attribute.add', [
            'title' => 'Thêm thuộc tính mới',
        ]);
    }

    public function store(Request $request)
    {
        if ($request->id_list == 3) {
            $colors = DB::table('list_of_values')->where('id_list', 3)->get();
            $id_element = count($colors) + 1;
            DB::table('list_of_values')->insert([
                'id_list' => 3,
                'id_element' => $id_element,
                'name_list' => 'Màu sắc',
                'name_element' => $request->name_element,
            ]);
            Session::flash('success', 'Thành công');
            return view('admin.attribute.add', [
                'title' => 'Thêm thuộc tính mới',
            ]);
        } else if ($request->id_list == 4) {
            $sizes = DB::table('list_of_values')->where('id_list', 4)->get();
            $id_element = count($sizes) + 1;
            DB::table('list_of_values')->insert([
                'id_list' => 4,
                'id_element' => $id_element,
                'name_list' => 'Kích thước',
                'name_element' => $request->name_element,
            ]);
            Session::flash('success', 'Thành công');
            return view('admin.attribute.add', [
                'title' => 'Thêm thuộc tính mới',
            ]);
        } else {
            Session::flash('error', 'Thêm mới lỗi');
            return redirect()->route('attribute');
        }
    }

    public function edit(Request $request)
    {
        return view('admin.attribute.edit', [
            'title' => 'Sửa thuộc tính',
            'id_list' => $request->list,
            'id_element' => $request->value,
        ]);
    }

    public function update(Request $request)
    {
        $id_list = $request->list;
        $id_element = $request->value;

        DB::table('list_of_values')
            ->where('id_list', $id_list)
            ->where('id_element', $id_element)
            ->update(['name_element' => $request->name_element]);
        Session::flash('success', 'Cập nhật thành công');
        return redirect()->route('attribute');
    }
    public function delete(Request $request)
    {
        $id_list = $request->list;
        $id_element = $request->value;
        DB::table('list_of_values')
            ->where('id_list', $id_list)
            ->where('id_element', $id_element)
            ->delete();
        Session::flash('success', 'Xóa thành công');
        return redirect()->route('attribute');
    }
}
