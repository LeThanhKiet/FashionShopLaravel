<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImportBillRequest;
use App\Http\Requests\ImportDetailRequest;
use App\Models\ImportDetail;
use App\Models\ProductDetail;
use App\Models\ImportBill;
use App\Models\Product;
use App\Models\ProductModel;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ImportProductController extends Controller
{
    public function index()
    {

        return view('admin.import.import', [
            'title' => 'Hóa đơn nhập',
            'data' => ImportBill::all()
        ]);
    }

    public static function name($id)
    {
        try {
            return User::where('id', $id)->first()->name;
        } catch (\Exception $ex) {

        }

        return "";
    }


    public function add()
    {
        $products = DB::table('products')->get();
        return view('admin.import.import_add', [
            'title' => 'Nhập hàng',
            'nhanvien' => Auth::getUser(),
            'ncc' => Supplier::get(),
            'products' => $products,
        ]);
    }

    public function store(ImportBillRequest $request)
    {
        try {
            DB::beginTransaction();
            //Tổng tiền hóa đơn nhập
            $totalMoney = 0;
            for ($i = 0; $i < count($request->productModel); $i++)
                $totalMoney += $request->quantity[$i] * $request->price[$i];
            //Chuẩn bị dữ liệu hóa đơn nhập để insert vào data
            $data = [
                'id_staff' => $request->id_staff,
                'id_supplier' => $request->id_supplier,
                'total_money' => $totalMoney,
            ];
            $importBill = ImportBill::query()->create($data);

            //Chuẩn bị dữ liệu insert vào chi tiết hóa đơn nhập
            $dataDetail = [];
            for ($i = 0; $i < count($request->productModel); $i++) {
                //Lấy ra id theo tên mặt hàng
                $id_model_product = DB::table('product_models')->where('name', $request->productModel[$i])->first()->id;
                $dataDetail[] = [
                    'id_import' => $importBill->id,
                    'id_model' => $id_model_product,
                    'quantity' => $request->quantity[$i],
                    'price' => $request->price[$i],
                ];
            }
            DB::table('import_details')->insert($dataDetail);

            //Tăng số lượng trong bảng mẫu mã sản phẩm
            $importDetails = ImportDetail::where('id_import', $importBill->id)->get();

            foreach ($importDetails as $key => $importDetail) {
                //Lấy ra số lượng của mẫu mã
                $productModel = DB::table('product_models')
                    ->where('id', $importDetail->id_model)
                    ->first();
                $quantity = $productModel->quantity;
                $quantity += $importDetail->quantity;

                DB::table('product_models')
                    ->where('id', $importDetail->id_model)
                    ->limit(1)
                    ->update(['quantity' => $quantity]);

                //Lưu thông tin chi tiết sản phẩm
                $import = 0;
                $productDetail = DB::table('product_details')
                    ->where('id_models', $importDetail->id_model)
                    ->first();
                //Nếu tồn tại chi tiết sản phẩm rồi ta tăng số lượng sản phẩm nhập trong chi tiết sản phẩm
                if ($productDetail != null) {
                    $import = $productDetail->import;
                }
                $import += $importDetail->quantity;
                //Có số lượng nhập của sản phẩm, lưu thông tin vào trong bảng
                DB::table('product_details')->insert([
                    'id_models' => $importDetail->id_model,
                    'import' => $import,
                    'price' => $importDetail->price,
                    'id_import_detail' => $importDetail->id,
                ]);

            }
            DB::commit();
            Session::flash('success', 'Nhập hàng thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Session::flash('error', 'Nhập hàng lỗi');
        }
        return redirect()->route('product');
    }


    public static function list($data)
    {
        $html = '';
        foreach ($data as $key => $item) {
            $html .= '
            <tr onclick="location.href=\'import/detail/' . $item->id . '\';">
                   <th>' . $item->id . '</th>
             <th>' . optional(DB::table("users")->where("id", $item->id_staff)->first())->name .' </th>
<th>' . optional(DB::table("suppliers")->where("id", $item->id_supplier)->first())->name  . '</th>
                   <th>' . $item->total_money . '</th>
                   <th>' . $item->created_at . '</th>
            </tr>
            ';
            // unset($loaisp[$key]);
        }
        return $html;
    }


    public function chitiet(ImportBill $hoadonnhap)
    {
        return view('admin.import.import_detail', [
            'title' => 'Chi tiết hóa đơn nhập',
            'hoadon' => $hoadonnhap,
            'data' => ImportDetail::where('id_import', $hoadonnhap->id)->get()
        ]);
    }
}
