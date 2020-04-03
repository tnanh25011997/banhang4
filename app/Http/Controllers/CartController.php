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

class CartController extends Controller
{
    public function getGioHangId(Request $req,$id)
    {
        $product  = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;// kiem tra co session cart chua
        $cart = new Cart($oldCart); //gan vao gio hang cu de chung gio hang ban dau
        $cart->add($product,$id); // them gio hang
        $req->session()->put('cart',$cart); // dung req de put vao trong session
        //return view('page.giohang');
        return redirect()->back()->with('messagecart', 'IT WORKS!');
    }
    public function gioHangIdDetail(Request $request)
    {
        $id = $request->idsp;
        $qty = $request->soluong;
        $product  = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;// kiem tra co session cart chua
        $cart = new Cart($oldCart); //gan vao gio hang cu de chung gio hang ban dau
        $cart->addInDetail($product,$id,$qty); // them gio hang
        $request->session()->put('cart',$cart); // dung req de put vao trong session
        return redirect()->back()->with('messagecart', 'IT WORKS!');
    }
    public function updateGioHangId(Request $request)
    {
        $id = $request->idsp;
        $qty = $request->soluong;
        $product  = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart); //để chung vào giỏ hàng ban đầu
        $cart->update($product,$id,$qty); //thêm vào giỏ hàng
        if(count($cart->items)>0)
        {
            $request->session()->put('cart',$cart); // dùng req để put card vào trong session
        }
        else
        {
            Session::forget('cart');
        }
        
        return redirect()->back();
    }
    
    public function xoaGio($id)
    {
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0) //kiem tra so luong mat hang trong cart
        {
            Session::put('cart',$cart); 
        }
        else
        {
            Session::forget('cart');// neu ko co thi xoa session
        }
        return redirect()->back();

    }
    //func thanh toan vao csdl
    public function postCheckout(Request $req)
    {
        $cart = Session::get('cart');

        
        $customer = new Customer;
        if(Auth::check()){
            $customer->name = Auth::user()->full_name;
            $customer->email = Auth::user()->email;
            $customer->phone_number = Auth::user()->phone;
            $customer->address = Auth::user()->address;
            $this->validate($req,
            [
                'payment'=>'required',
            ],
            [
                'payment.required'=>'Vui lòng chọn phương thức thanh toán. ',
            ]);
        }
        else{
            $this->validate($req,
            [
                'email'=>'required|email',
                'ten'=>'required',
                'sdt'=>'required',
                'sdt'=>'digits:10',
                'diachi'=>'required',
                'payment'=>'required',
                'province'=>'required',
                'district'=>'required',
                'ward'=>'required'
            ],
            [
                'email.required'=>'Vui lòng nhập email. ',
                'email.email'=>'Nhập không đúng định dạng email. ',
                'ten.required'=>'Vui lòng nhập Tên. ',
                'sdt.required'=>'Vui lòng nhập SDT. ',
                'sdt.digits'=>'SĐT phải là chuỗi số 10 ký tự.',
                'diachi.required'=>'Vui lòng nhập địa chỉ. ',
                'payment.required'=>'Vui lòng chọn phương thức thanh toán. ',
                'province.required'=>'Vui lòng Chọn Tỉnh Thành. ',
                'district.required'=>'Vui lòng Chọn Quận Huyện. ',
                'ward.required'=>'Vui lòng Chọn Xã Phường. '
            ]);
            $customer->name = $req->ten; 
            $customer->email = $req->email;
            $customer->phone_number = $req->sdt;
            //adress
            $province = Province::find($req->province);
            $district = District::find($req->district);
            $ward = Ward::find($req->ward);
            $address = $req->diachi.", ".$ward->name.", ".$district->name.", ".$province->name;
            $customer->address = $address;
        } 
        $customer->save();

        //khi lưu customer rồi mới lưu vào bill

        $bill = new Bill;
        $bill->id_customer = $customer->id; // lấy từ cái trên
        $bill->date_order = date('Y-m-d');
        if($cart->totalPrice<500000){
            $bill->total = $cart->totalPrice+30000; //tiền ship
        }
        else{
            $bill->total = $cart->totalPrice;
        }
        
        $bill->payment = $req->payment; 
        if(Auth::check()){
            $bill->id_user = Auth::user()->id;
        }
        $bill->save();


       
        $orderdetails = []; //tao mang de luu vao mail
        //vì 1 cart có thể có nhiều sản phẩm trong 1 giỏ hàng
        //foreach từng items vì items là 1 mảng
        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key; //dd để xem
            $bill_detail->quantity = $value['qty'];//dd để xem
            $bill_detail->unit_price = $value['price']/$value['qty'];
            $bill_detail->save();
            array_push($orderdetails, $value);
           
        }
        
        
        //Mail::to($bill->customer->email)->send(new ShoppingMail($bill,$orderdetails));
        session::forget('cart');
        return view('page.hoantat');
    }
}
