<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Brand;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\News;
use App\PromotionRegister;
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
        $new_product = Product::where('status','!=',3)->orderby('created_at','desc')->paginate(4);
        $sale_product = Product::where('sale','<>',0)->where('status','!=',3)->orderby('created_at','desc')->take(4)->get();
        $myphamnu = ProductType::where('description','1')->get();
        $myphamnam = ProductType::where('description','0')->get();
        $sanpham_nam = Product::where('unit','nam')->where('status','!=',3)->orderby('created_at','desc')->paginate(6);
        $sanpham_nu = Product::where('unit','nu')->where('status','!=',3)->orderby('created_at','desc')->paginate(6);
    	return view('page.trangchu',compact('slide','new_product','sale_product','myphamnu','myphamnam','sanpham_nam','sanpham_nu'));
    }
    public function getChiTiet($id)
    {
        $ct = Product::where('slug',$id)->first();
        if($ct == null){
            return view('page.errors');
        }
        else{
            $idsp = $ct->id;
            $sale_product2 = Product::where('sale','<>',0)->orderby('created_at','desc')->take(4)->get();
            $comments = Comments::where('id_product',$idsp)->where('status',1)->orderby('created_at','desc')->paginate(5);
            return view('page.chitiet_sanpham',compact('ct','sale_product2','comments'));
        }
        
    }


    /*PAGE Tĩnh*/
    public function getGioiThieu()
    {
        $sale_product = Product::where('sale','<>',0)->where('status','!=',3)->orderby('created_at','desc')->take(4)->get();
        return view('page.gioithieu',compact('sale_product'));  
    }
    public function getChinhSachBaoMat()
    {
        $sale_product = Product::where('sale','<>',0)->where('status','!=',3)->orderby('created_at','desc')->take(4)->get();
        return view('page.chinhsachbaomat',compact('sale_product'));  
    }
    public function getHuongDanMuaHang()
    {
        $sale_product = Product::where('sale','<>',0)->where('status','!=',3)->orderby('created_at','desc')->take(4)->get();
        return view('page.huongdanmuahang',compact('sale_product'));  
    }
    public function getTaiKhoanGiaoDich()
    {
        $sale_product = Product::where('sale','<>',0)->where('status','!=',3)->orderby('created_at','desc')->take(4)->get();
        return view('page.taikhoangiaodich',compact('sale_product'));  
    }
    public function getGiaoHangVaDoiTra()
    {
        $sale_product = Product::where('sale','<>',0)->where('status','!=',3)->orderby('created_at','desc')->take(4)->get();
        return view('page.giaohangvadoitra',compact('sale_product'));  
    }



    public function getTinTuc()
    {
        $sale_product = Product::where('sale','<>',0)->where('status','!=',3)->orderby('created_at','desc')->take(4)->get();
        $tin = News::orderby('created_at','desc')->paginate(3);    
        return view('page.tintuc',['tin'=>$tin,'sale_product'=>$sale_product]);
    }
    public function getChiTietTinTuc($id)
    {
        $sale_product = Product::where('sale','<>',0)->where('status','!=',3)->orderby('created_at','desc')->take(4)->get();
        $tin = News::where('id',$id)->first();
        if($tin == null){
            return view('page.errors');
        }
        else{
            return view('page.chitiet_tintuc',compact('tin','sale_product'));
        }  
        
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

    public function getSanPham(Request $request)
    {
        //$sanpham = Product::orderby('id','asc')->paginate(9);
        $sanpham = Product::where('sale','<',100)->where('status','!=',3);
        $danhmuc = ProductType::orderBy('description','desc')->orderby('description','desc')->get();
        $brand = Brand::where('name','!=','None')->get();   
        if($request->price){
            $price = $request->price;
            switch ($price) {
                case 1:
                    $sanpham->where('promotion_price','<',200000);
                    break;
                case 2:
                    $sanpham->whereBetween('promotion_price',[200000,400000]);
                    break;
                case 3:
                    $sanpham->whereBetween('promotion_price',[400000,600000]);
                    break;
                case 4:
                    $sanpham->whereBetween('promotion_price',[600000,800000]);
                    break;
                case 5:
                    $sanpham->whereBetween('promotion_price',[800000,1000000]);
                    break;
                case 6:
                    $sanpham->where('promotion_price','>',1000000);
                    break;
                default:
                    break;
            }
        }
        if($request->orderby){
            $orderby = $request->orderby;
            switch ($orderby) {
                case 'created-descending':
                    $sanpham->orderby('created_at','desc');
                    break;
                case 'created-ascending':
                    $sanpham->orderby('created_at','asc');
                    break;
                case 'price-ascending':
                    $sanpham->orderby('promotion_price','asc')->orderby('unit_price','asc');
                    break;
                case 'price-descending':
                    $sanpham->orderby('promotion_price','desc')->orderby('unit_price','desc');
                    break;
                case 'name-ascending':
                    $sanpham->orderby('name','asc');
                    break;
                case 'name-descending':
                    $sanpham->orderby('name','desc');
                    break;
                default:
                    $sanpham->orderby('id','asc');
                    break;
            }
        }
        $sanpham = $sanpham->paginate(9)->appends(request()->except('page'));
        return view('page.sanpham',compact('sanpham','danhmuc','brand'));
    }
    public function getTheoLoai($slug, Request $request)
    {
        $tenloai = ProductType::where('slug',$slug)->first();
        if($tenloai == null){
            return view('page.errors');
        }
        else{

            $loai_sanpham = Product::where('id_type',$tenloai->id)->where('status','!=',3);;
            $danhmuc = ProductType::orderBy('description','desc')->orderby('description','desc')->get();
            $brand = Brand::where('name','!=','None')->get();
            if($request->price){
                $price = $request->price;
                switch ($price) {
                    case 1:
                        $loai_sanpham->where('promotion_price','<',200000);
                        break;
                    case 2:
                        $loai_sanpham->whereBetween('promotion_price',[200000,400000]);
                        break;
                    case 3:
                        $loai_sanpham->whereBetween('promotion_price',[400000,600000]);
                        break;
                    case 4:
                        $loai_sanpham->whereBetween('promotion_price',[600000,800000]);
                        break;
                    case 5:
                        $loai_sanpham->whereBetween('promotion_price',[800000,1000000]);
                        break;
                    case 6:
                        $loai_sanpham->where('promotion_price','>',1000000);
                        break;
                    default:
                        break;
                }
            }
            if($request->orderby){
                $orderby = $request->orderby;
                switch ($orderby) {
                    case 'created-descending':
                        $loai_sanpham->orderby('created_at','desc');
                        break;
                    case 'created-ascending':
                        $loai_sanpham->orderby('created_at','asc');
                        break;
                    case 'price-ascending':
                        $loai_sanpham->orderby('promotion_price','asc')->orderby('unit_price','asc');
                        break;
                    case 'price-descending':
                        $loai_sanpham->orderby('promotion_price','desc')->orderby('unit_price','desc');
                        break;
                    case 'name-ascending':
                        $loai_sanpham->orderby('name','asc');
                        break;
                    case 'name-descending':
                        $loai_sanpham->orderby('name','desc');
                        break;
                    default:
                        $loai_sanpham->orderby('id','asc');
                        break;
                }
            }
            $loai_sanpham = $loai_sanpham->paginate(9)->appends(request()->except('page'));
            return view('page.sanphamtheoloai',compact('loai_sanpham','tenloai','danhmuc','brand'));
        }
    }

    public function getThuongHieu($slug, Request $request)
    {
        $thuonghieu = Brand::where('slug',$slug)->first();
        if($thuonghieu == null){
            return view('page.errors');
        }
        else{
            $sanpham = Product::where('id_brand',$thuonghieu->id)->where('status','!=',3);
            $danhmuc = ProductType::orderBy('description','desc')->orderby('description','desc')->get();
            $brand = Brand::where('name','!=','None')->get();  
        
            if($request->orderby){
                $orderby = $request->orderby;
                switch ($orderby) {
                    case 'created-descending':
                        $sanpham->orderby('created_at','desc');
                        break;
                    case 'created-ascending':
                        $sanpham->orderby('created_at','asc');
                        break;
                    case 'price-ascending':
                        $sanpham->orderby('promotion_price','asc')->orderby('unit_price','asc');
                        break;
                    case 'price-descending':
                        $sanpham->orderby('promotion_price','desc')->orderby('unit_price','desc');
                        break;
                    case 'name-ascending':
                        $sanpham->orderby('name','asc');
                        break;
                    case 'name-descending':
                        $sanpham->orderby('name','desc');
                        break;
                    default:
                        $sanpham->orderby('id','asc');
                        break;
                }
            }
            if($request->price){
                $price = $request->price;
                switch ($price) {
                    case 1:
                        $sanpham->where('promotion_price','<',200000);
                        break;
                    case 2:
                        $sanpham->whereBetween('promotion_price',[200000,400000]);
                        break;
                    case 3:
                        $sanpham->whereBetween('promotion_price',[400000,600000]);
                        break;
                    case 4:
                        $sanpham->whereBetween('promotion_price',[600000,800000]);
                        break;
                    case 5:
                        $sanpham->whereBetween('promotion_price',[800000,1000000]);
                        break;
                    case 6:
                        $sanpham->where('promotion_price','>',1000000);
                        break;
                    default:
                        break;
                }
            }
            $sanpham = $sanpham->paginate(9)->appends(request()->except('page'));
            return view('page.sanphamtheothuonghieu',compact('sanpham','thuonghieu','danhmuc','brand'));
        }
       
    }
    
    public function getSearch(Request $req)
    {
        $product = DB::table("products")->join('brand','products.id_brand','=','brand.id')->select(DB::raw("products.id"), DB::raw("products.name"), DB::raw("products.image"),DB::raw("products.status"),DB::raw("products.rate"),DB::raw("products.sale"),DB::raw("products.promotion_price"),DB::raw("products.unit_price"),DB::raw("products.slug"))->where('products.name','like','%'.$req->key.'%')->where('products.status','!=',3)->orWhere('products.unit_price',$req->key)->orWhere('brand.name','like','%'.$req->key.'%')->orderby('products.created_at','desc')->get();
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
        $promotionRegister = new PromotionRegister;
        $promotionRegister->email = $req->txtemailkhuyenmai;
        $promotionRegister->phone = $req->txtsdtkhuyenmai;
        $promotionRegister->save();
        return redirect()->back()->with('thongbao','Đăng Ký Nhận Thông Tin Thành Công');
    }
}
