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
use App\Province;
use App\District;
use App\Ward;
use Illuminate\Support\Facades\DB;

use Hash;
use App\nguoidung;
use Illuminate\Support\Facades\Auth;

use Mail;
use App\Mail\ShoppingMail;
use Carbon\Carbon;

class PageController extends Controller
{
    
    public function getIndex()
    {
        $slide = Slide::all();
        $new_product = Product::orderby('created_at','desc')->paginate(4);
        $sale_product = Product::where('promotion_price','<>',0)->orderby('created_at','desc')->take(4)->get();
        $myphamnu = ProductType::where('description','1')->get();
        $myphamnam = ProductType::where('description','0')->get();
        $sanpham_nam = Product::where('unit','nam')->orderby('created_at','desc')->paginate(6);
        $sanpham_nu = Product::where('unit','nu')->orderby('created_at','desc')->paginate(6);
    	return view('page.trangchu',compact('slide','new_product','sale_product','myphamnu','myphamnam','sanpham_nam','sanpham_nu'));
    }
    public function getLoaiSanPham()
    {
        $sanpham = Product::orderby('created_at','desc')->paginate(8);
    	return view('page.loaisanpham',compact('sanpham'));
    }
    public function getChiTiet($id)
    {
        $ct = Product::where('slug',$id)->first();
        if($ct == null){
            return "Không tìm thấy trang, Bạn bấm lại nha";
        }
        else{
            $idsp = $ct->id;
            $sale_product2 = Product::where('promotion_price','<>',0)->orderby('created_at','desc')->take(4)->get();
            $comments = Comments::where('id_product',$idsp)->where('status',1)->orderby('created_at','desc')->paginate(5);
            return view('page.chitiet_sanpham',compact('ct','sale_product2','comments'));
        }
        
    }
    public function getGioiThieu()
    {
        $sale_product = Product::where('promotion_price','<>',0)->orderby('created_at','desc')->take(4)->get();
        return view('page.gioithieu',compact('sale_product'));  
    }
    public function getTinTuc()
    {
        $sale_product = Product::where('promotion_price','<>',0)->orderby('created_at','desc')->take(4)->get();
        $tin = News::orderby('created_at','desc')->paginate(3);
        return view('page.tintuc',['tin'=>$tin,'sale_product'=>$sale_product]);
    }
    public function getChiTietTinTuc($id)
    {
        $sale_product = Product::where('promotion_price','<>',0)->orderby('created_at','desc')->take(4)->get();
        $tin = News::where('id',$id)->first();    
        return view('page.chitiet_tintuc',compact('tin','sale_product'));
    }
    public function getDangKy()
    {
        $province = Province::all();
    	return view('page.dangky',compact('province'));
    }
    public function getDangNhap()
    {
        if(Auth::check()){
            return redirect('home');
        }
        else{
            return view('page.dangnhap');
        }
    	
    }
    public function getGioHang()
    {
        return view('page.giohang');
    }
    public function getThanhToan()
    {
        $province = Province::all();
        return view('page.thanhtoan',compact('province'));
    }
    public function getHoanTat()
    {
        return view('page.hoantat');
    }
    public function getTheoLoai($id)
    {
        $tenloai = ProductType::where('id',$id)->first();
        if($tenloai == null){
            return "Không tìm thấy trang, Bạn bấm lại nha";
        }
        else{
            $loai_sanpham = Product::where('id_type',$id)->get();
            return view('page.sanphamtheoloai',compact('loai_sanpham','tenloai'));
        }
       
    }
    
    public function getSearch(Request $req)
    {
        $product = DB::table("products")->join('brand','products.id_brand','=','brand.id')->select(DB::raw("products.id"), DB::raw("products.name"), DB::raw("products.image"),DB::raw("products.name"),DB::raw("products.promotion_price"),DB::raw("products.unit_price"),DB::raw("products.slug"))->where('products.name','like','%'.$req->key.'%')->orWhere('products.unit_price',$req->key)->orWhere('brand.name','like','%'.$req->key.'%')->orderby('products.created_at','desc')->get();
        return view('page.search',compact('product'));
        // $product = Product::where('name','like','%'.$req->key.'%')->orWhere('unit_price',$req->key)->get();
        // return view('page.search',compact('product'));
    }
    
    public function postDangKyKhuyenMai(Request $req)
    {
        $this->validate($req,
            [
                'txtemailkhuyenmai'=>'required',
                'txtsdtkhuyenmai'=>'required',
                'txtsdtkhuyenmai'=>'digits:10'
                
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'txtsdtkhuyenmai.required'=>'Vui lòng nhập số điện thoại',
                'txtsdtkhuyenmai.digits'=>'Số điện thoại phải là chuỗi số 10 ký tự'
                
            ]);
        $customerRegister = new CustomerRegister;
        $customerRegister->email = $req->txtemailkhuyenmai;
        $customerRegister->phone = $req->txtsdtkhuyenmai;
        $customerRegister->save();
        return redirect()->back()->with('thongbao','Đăng Ký Nhận Thông Tin Thành Công');
    }

    
    

}
