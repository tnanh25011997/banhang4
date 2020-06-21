<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\BillDetail;
use App\Customer;
use App\Comments;
use App\Product;
use App\nguoidung;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function getDoanhThu(Request $request){
        $year = 2020;
        if($request->selectyear){
            $year = $request->selectyear;
        }
        $month = date('m');
        $current_month = date('m');
        if($request->selectmonth){
            $month = $request->selectmonth;
        }
        $thongke=DB::table("bills")->select(DB::raw("MONTH(created_at) as Thang")  ,DB::raw("(SUM(total)) as Tong"))->groupBy(DB::raw("MONTH(created_at)"))->where('tinhtrang',1)->whereYear('created_at', $year)->get();
        
        $seller = DB::table("products")->join('bill_detail','products.id','=','bill_detail.id_product')->join('bills','bills.id','=','bill_detail.id_bill')->select(DB::raw("products.id"), DB::raw("products.name"),DB::raw("products.unit_price"), DB::raw("products.promotion_price"),DB::raw("products.slug"),DB::raw("SUM(bill_detail.quantity) AS soluong"))->where('bills.tinhtrang',1)->groupBy(DB::raw("products.id"), DB::raw("products.name"),DB::raw("products.unit_price"), DB::raw("products.promotion_price"),DB::raw("products.slug"))->orderByRaw('SUM(bill_detail.quantity) DESC')->whereYear('bill_detail.created_at', 2020)->whereMonth('bill_detail.created_at', $month)->get();
        
        $seller_top = DB::table("products")->join('bill_detail','products.id','=','bill_detail.id_product')->join('bills','bills.id','=','bill_detail.id_bill')->select(DB::raw("products.id"), DB::raw("products.name"),DB::raw("products.unit_price"), DB::raw("products.promotion_price"),DB::raw("products.slug"),DB::raw("SUM(bill_detail.quantity) AS soluong"))->where('bills.tinhtrang',1)->groupBy(DB::raw("products.id"), DB::raw("products.name"),DB::raw("products.unit_price"), DB::raw("products.promotion_price"),DB::raw("products.slug"))->orderByRaw('SUM(bill_detail.quantity) DESC')->whereYear('bill_detail.created_at', 2020)->whereMonth('bill_detail.created_at', $month)->take(5)->get();
        $sum = 0;
        $sum_top = 0;
        foreach ($seller as $sell) {
            $sum += $sell->soluong;
        }
        foreach ($seller_top as $sell_top) {
            $sum_top += $sell_top->soluong;
        }
        $others = $sum - $sum_top;
        //dd($sum_top);
        return view('admin.statistic.danhsach',compact('thongke','seller','seller_top','others','current_month'));
    }
}
