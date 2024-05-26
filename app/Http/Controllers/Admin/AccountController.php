<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Models\ImportBill;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class AccountController extends Controller
{
    //Khách hàng
    public function customer()
    {
        $data = DB::table('users')->where('role', 3)->get();
        return view('admin.account.customer', [
            'title' => 'Danh sách khách hàng',
            'data' => $data,
        ]);
    }
    public static function listCustomer($data)
    {

        $html = '';
        foreach ($data as $key => $item) {
            $html .= '
            <tr onclick="location.href=\'chitiet/' . $item->id . '\';">
                   <th>' . $item->name . '</th>
                   <th>' . $item->email . ' </th>
                   <th>' . $item->phone . '</th>
                   <th>' . $item->created_at . '</th>
            </tr>
            ';
            // unset($loaisp[$key]);
        }
        return $html;
    }

    //Nhân viên
    public function admin()
    {
        $data = DB::table('users')->where('role', 2)->get();
        return view('admin.account.admin', [
            'title' => 'Danh sách nhân viên',
            'data' => $data
        ]);
    }

    public static function listAdmin($data)
    {
        $id = Auth::user()->id;
        $kind = DB::table('users')->where('id', $id)->first();
        $html = '';
        if ($kind->role == 1) {
            foreach ($data as $key => $item) {
                $html .= '
                        <tr>
                               <th>' . $item->username . ' </th>
                               <th>' . $item->name . ' </th>
                               <th>' . $item->created_at . '</th>
                               <th>
                               <a href="/admin/account/edit/' . $item->id . '"> <i class="fas fa-edit"></i> </a>
                               <a href="#" onclick="removeRow(' . $item->id . ', \'/admin/account/delete\')"> <i class="far fa-trash-alt"></i></a>
                               </th>
                        </tr>
                        ';
            }
        } else foreach ($data as $key => $item) {
            $html .= '
                        <tr>
                               <th>' . $item->username . ' </th>
                               <th>' . $item->name . ' </th>
                               <th>' . $item->created_at . '</th>
                        </tr>
                        ';
        }
        return $html;
    }

    //Nhà cung cấp ====================================================
    public function supplier()
    {
        $data = DB::table('suppliers')->get();
        return view('admin.account.supplier', [
            'title' => 'Danh sách nhà cung cấp',
            'data' => $data
        ]);
    }

    public static function listSupplier($data)
    {

        $html = '';
        foreach ($data as $key => $item) {
            $html .= '
            <tr >
                   <th onclick="location.href=\'supplierDetail/' . $item->id . '\';">' . $item->name . '</th>
                   <th>' . $item->description . '</th>
                   <th>
                        <a  href="/admin/account/editSupplier/' . $item->id . '">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a  href="#"
                            onclick="removeRow(' . $item->id . ', \'/admin/account/deleteSupplier\')">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </th>
            </tr>
            ';
            // unset($loaisp[$key]);
        }
        return $html;
    }

    public function supplierDetail($id)
    {
        $data = DB::table('import_bill')
            ->where('id_supplier', $id)->get();
        return view('admin.account.supplier_detail', [
            'title' => 'Chi tiết nhà cung cấp',
            'data' => $data
        ]);
    }

    public static function listSupplierDetail($data)
    {
        $html = '';
        foreach ($data as $key => $item) {
            $html .= '
            <tr>
                   <th>' . $item->id . '</th>
                   <th>' . $item->total_money . '</th>
                   <th>' . $item->created_at . '</th>

            </tr>
            ';
            // unset($loaisp[$key]);
        }
        return $html;
    }

    public function createSupplier() {
        return view('admin.account.supplier_add', [
            'title' => 'Thêm nhà cung cấp',
        ]);
    }

    public function storeSupplier(Request $request) {
        try {
            Supplier::create([
                'name' => (string)$request->input('name'),
                'description' => (string)$request->input('description'),
            ]);
            Session::flash('success', 'Thành công');
        } catch (\Exception $exception) {
            Session::flash('error', $exception->getMessage());
        }
        return redirect('admin/account/supplier');
    }

    public function editSupplier($id)
    {
        $supplier = DB::table('suppliers')->where('id', $id)->first();
        return view('admin.account.supplier_edit', [
            'title' => 'Sửa nhà cung cấp',
            'supplier' => $supplier,
        ]);
    }

    public function updateSupplier(Request $request, $id)
    {
        DB::table('suppliers')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        Session::flash('success', 'Cập nhập thành công');
        return redirect('admin/account/supplier');
    }

    public function deleteSupplier(Request $request)
    {
        $data = Supplier::where('id', $request->input('id'))->first();

        $result = false;
        if ($data) {
            $result = Supplier::where('id', $request->input('id'))->delete();
        }
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công'
            ]);
        }
        return response()->json([
            'error' => true
        ]);
    }

    public function add()
    {
        return view('admin.account.add', [
            'title' => 'Tạo tài khoản',
        ]);
    }

    public function store(AccountRequest $request)
    {
        $id = Auth::user()->id;
        $kind = DB::table('users')->where('id', $id)->first();
        $pass = Hash::make($request->pass_account);
        if ($kind->role == 1) {
            DB::table('users')->insert([
                'username' => $request->name_account,
                'password' => $pass,
                'name' => $request->name,
                'role' => 2,
            ]);
            Session::flash('success', 'Thêm mới thành công');
        } else {
            Session::flash('error', 'Không đủ quyền admin');
        }
        return redirect()->back();
    }

    public function edit(Request $request)
    {
        $user = DB::table('users')->where('id', $request->id)->first();
        return view('admin.account.edit', [
            'title' => 'Sửa tài khoản',
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $username = $request->username;
        $name = $request->name;
        $password = $request->password;
        if (isset($password)) {
            $password = Hash::make($request->password);
            DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'username' => $username,
                    'name' => $name,
                    'password' => $password,
                ]);
            Session::flash('success', 'Cập nhật tài khoản thành công');
        } else {
            DB::table('users')
                ->where('id', $request->id)
                ->update([
                    'username' => $username,
                    'name' => $name,
                ]);
            Session::flash('success', 'Cập nhật tài khoản thành công');
        }
        return redirect()->route('adminaccount');
    }

    public function delete(Request $request)
    {
        $data = User::where('id', $request->input('id'))->first();
        $result = false;
        if ($data) {
            $result = User::where('id', $request->input('id'))->delete();
        }
        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa tài khoản thành công'
            ]);
        }
        return response()->json([
            'error' => true
        ]);

    }
}
