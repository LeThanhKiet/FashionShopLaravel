<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;
use function Sodium\add;

class MainController extends Controller
{
    public function index()
    {

        //Doanh thu tháng
        $orders_in_month = DB::table('orders_in_month')->get();
        $total_in_month = 0;
        if ($orders_in_month[0]->total_money_of_month != null)
            $total_in_month = $orders_in_month[0]->total_money_of_month;
        //Doanh thu năm
        $orders_in_year = DB::table('orders_in_year')->get();
        $total_in_year = 0;
        if ($orders_in_year[0]->total_money_of_year != null)
            $total_in_year = $orders_in_year[0]->total_money_of_year;

        //Đơn đặt chưa xử lý
        $dondat = DB::table('orders')->where('kind', 1)->count();
        //Đơn hàng đang vận chuyển
        $vandon = DB::table('orders')->where('kind', 2)->count();


        //Doanh thu theo từng tháng trong năm
        $total_each_month = [];
        for ($month = 1; $month <= 12; $month++) {
            $total_each_month[] = DB::table('year_chart')->where("month", $month)->sum("total_of_month");
        }
        //Tổng hàng nhập theo từng tháng trong năm
        $total_each_month_import = [];
        for ($month = 1; $month <= 12; $month++) {
            $total_each_month_import[] = DB::table('year_chart_import')->where("month", $month)->sum("total_of_month");
        }

        //Thống kê các loại đơn hàng trong tháng
        //Số đơn hàng 1-Đơn đặt 2-Vận đơn 3-Hóa đơn 4-Đơn hủy
        $loaidonhang = [];
        for ($x = 1; $x <= 4; $x++) {
            $loaidonhang[] = DB::table('month_chart')->where("kind", $x)->count();
        }


        return view('admin.dashboard', [
            'title' => 'Trang chủ',
            'total_in_month'=> $total_in_month,
            'total_in_year'=> $total_in_year,
            'dondat'=> $dondat,
            'vandon'=> $vandon,
            'loaidonhang'=>$loaidonhang,
            'total_each_month'=>$total_each_month,
            'total_each_month_import'=>$total_each_month_import,
        ]);
    }
}
