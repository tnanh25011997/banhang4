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
    public function getDoanhThu(){
    	$thongke=DB::table("bills")->select(DB::raw("MONTH(created_at) as Thang")  ,DB::raw("(SUM(total)) as Tong"))->groupBy(DB::raw("MONTH(created_at)"))->where('tinhtrang',1)->whereYear('created_at', '2020')->get();
    	
    	$seller = DB::table("products")->join('bill_detail','products.id','=','bill_detail.id_product')->select(DB::raw("products.id"), DB::raw("products.name"),DB::raw("products.unit_price"), DB::raw("products.promotion_price"),DB::raw("products.slug"),DB::raw("SUM(quantity) AS soluong"))->groupBy(DB::raw("products.id"), DB::raw("products.name"),DB::raw("products.unit_price"), DB::raw("products.promotion_price"),DB::raw("products.slug"))->orderByRaw('SUM(quantity) DESC')->get();
    	return view('admin.statistic.danhsach',compact('thongke','seller'));
    }
}
