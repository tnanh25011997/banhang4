<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\News;
use App\CustomerRegister;
use App\Comments;
use App\Brand;
use Illuminate\Support\Facades\DB;

use Hash;
use App\nguoidung;
use Illuminate\Support\Facades\Auth;

use Mail;
use App\Mail\ShoppingMail;
use Carbon\Carbon;

class APIController extends Controller
{
    public function getAPIPrice($slug){
        $sanpham = Product::where('slug',$slug)->first();
        return response()->json($sanpham);
        
    }
    public function getNewestProduct(){
        $sanpham = Product::orderby('created_at','desc')->first();
        return response()->json($sanpham);
    }
    public function getSaleProduct(){
        $sale_product = Product::where('sale','<>',0)->orderby('sale','desc')->first();
        return response()->json($sale_product);
    }
    public function getBestSeller(){
        $best_seller = DB::table("products")->join('bill_detail','products.id','=','bill_detail.id_product')->select(DB::raw("products.id"), DB::raw("products.name"),DB::raw("products.unit_price"), DB::raw("products.promotion_price"),DB::raw("products.slug"),DB::raw("SUM(quantity) AS soluong"))->groupBy(DB::raw("products.id"), DB::raw("products.name"),DB::raw("products.unit_price"), DB::raw("products.promotion_price"),DB::raw("products.slug"))->orderByRaw('SUM(quantity) DESC')->first();
        return response()->json($best_seller);
    }
    //tôi muốn mua 1 loại son môi có giá khoảng 200 ngàn
    public function getListCategory($slug){
        $list = DB::table("products")->join('type_products','products.id_type','=','type_products.id')->select(DB::raw("products.name"),DB::raw("products.unit_price"),DB::raw("products.promotion_price"),DB::raw("products.slug"))->where('type_products.slug',$slug)->orderBy("products.promotion_price","desc")->get();
        return response()->json($list);
    }

    //loại son môi nào rẻ nhất
    public function getCheapestUnitPriceProductInCategory($slug){
        $list = DB::table("products")->join('type_products','products.id_type','=','type_products.id')->select(DB::raw("products.name"),DB::raw("products.unit_price"),DB::raw("products.promotion_price"),DB::raw("products.slug"))->where('type_products.slug',$slug)->orderBy("products.unit_price","ASC")->first();
        return response()->json($list);
    }
    public function getCheapestPromotionPriceProductInCategory($slug){
        $list = DB::table("products")->join('type_products','products.id_type','=','type_products.id')->select(DB::raw("products.name"),DB::raw("products.unit_price"),DB::raw("products.promotion_price"),DB::raw("products.slug"))->where('type_products.slug',$slug)->orderBy("products.promotion_price","ASC")->first();
        return response()->json($list);
    }

    //shop có loại son môi nào
    public function getListProductOfCategory($slug){
        $category = ProductType::where('slug',$slug)->first();
        $sanpham = Product::where('id_type',$category->id)->orderby('created_at','desc')->take(3)->get();
        return response()->json($sanpham);
    }
    //các sản phẩm của thương hiệu [menly](cust_brand)
    public function getListProductOfBrand($slug){
        $brand = Brand::where('slug',$slug)->first();
        $sanpham = Product::where('id_brand',$brand->id)->orderby('created_at','desc')->take(3)->get();
        return response()->json($sanpham);
    }

    //các loại son môi đang khuyến mãi
     public function getPromotionProductInCategory($slug){
        $category = ProductType::where('slug',$slug)->first();
        $sanpham = Product::where('id_type',$category->id)->where('sale','!=',0)->orderby('created_at','desc')->take(3)->get();
        return response()->json($sanpham);
    }
    public function getBestSellerInCategory($slug){
        $best_seller = DB::table("products")->leftJoin('bill_detail','products.id','=','bill_detail.id_product')->join('type_products','products.id_type','=','type_products.id')->select(DB::raw("products.id"), DB::raw("products.name"),DB::raw("products.unit_price"), DB::raw("products.promotion_price"),DB::raw("products.slug"),DB::raw("SUM(quantity) AS soluong"))->groupBy(DB::raw("products.id"), DB::raw("products.name"),DB::raw("products.unit_price"), DB::raw("products.promotion_price"),DB::raw("products.slug"))->orderByRaw('SUM(quantity) DESC')->where('type_products.slug',$slug)->first();
        return response()->json($best_seller);
    }
}
