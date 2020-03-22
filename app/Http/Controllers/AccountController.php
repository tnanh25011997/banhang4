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
use Illuminate\Support\Facades\DB;

use Hash;
use App\nguoidung;
use Illuminate\Support\Facades\Auth;

use Mail;
use App\Mail\ShoppingMail;
use Carbon\Carbon;

class AccountController extends Controller
{
    //dang ky
    public function postDangKy(Request $req)
    {
        
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=>'required|same:password',
                'sdt'=>'required',
                'diachi'=>'required'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Nhập không đúng định dạng email',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu phải bé hơn 20 ký tự',
                're_password.required'=>'Phải nhập trường mật khẩu',
                're_password.same'=>'Mật khẩu phải giống nhau',
                'fullname.required'=>'Vui lòng nhập tên của bạn',
                'sdt.required'=>'Vui lòng nhập SĐT',
                'diachi.required'=>'Vui lòng nhập địa chỉ'
            ]);
        $user = new nguoidung;
        $user->email = $req->email;
        $user->full_name = $req->fullname;
        $user->password = Hash::make($req->password);
        $user->phone = $req->sdt;
        $user->address = $req->diachi;
        $user->save();
        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }
    public function postDangNhap(Request $req)
    {
         $this->validate($req,
            [
                'email'=>'required',
                'password'=>'required|min:6|max:20'
                
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu phải bé hơn 20 ký tự'
                
            ]);
        $credentials = array('email'=>$req->email,'password'=>$req->password);
        
        if(Auth::attempt($credentials))
        {
           return redirect('home');
        }
        else
        {
            return redirect()->back()->with('thongbao','Đăng Nhập Không Thành Công');
        }

    }

    public function postDangXuat()
    {
        Auth::logout();
        return redirect()->route('trang-chu'); //ten trang-chu la tên ở as
    }
    public function getChinhSua($id)
    {
        if(Auth::user()->id == $id){
            $taikhoan = nguoidung::find($id);
            return view('page.chinhsuathongtin',compact('taikhoan'));
        }else{
            return 'not allowed to see';
        }
        
    }
    public function postChinhSua(Request $req, $id)
    {
        $this->validate($req,
            [
                'ten'=>'required',
                'sdt'=>'required',
                'diachi'=>'required'       
            ],
            [
                'ten.required'=>'Bạn Chưa Nhập Họ Tên',
                'sdt.required'=>'Bạn Chưa Nhập SĐT',
                'diachi.required'=>'Bạn Chưa Nhập Địa Chỉ'    
            ]);
        $user= nguoidung::find($id);
        $user->full_name= $req->ten;
        $user->phone= $req->sdt;
        $user->address= $req->diachi;
        if($req->changePassword =="on")
        {
            if (!(Hash::check($req->get('old_password'), $user->password))) {
            
                return redirect()->back()->with("error","Mật Khẩu Cũ Chưa Đúng");
            }
            $this->validate($req,
            [
                'old_password'=>'required',
                'password'=>'required|min:6',
                're_password'=>'required|same:password'
               
                
            ],
            [
                'old_password.required'=>'Chưa Nhập Mật Khẩu Cũ',
                'password.required'=>'Chưa Nhập Mật Khẩu',
                'password.min'=>'Mật Khẩu Phải ít nhất 6 ký tự',
                're_password.required'=>'Bạn Chưa Nhập Lại Mật Khẩu',
                're_password.same'=>'Mật Khẩu Không Trùng Khớp'
                
            ]);

            $user->password= Hash::make($req->password);
        }


        $user->save();
        return redirect('tai-khoan/chinhsuathongtin/'.$id)->with('thongbao','Sửa Thông Tin Thành Công');
    }

    public function postSendComment(Request $req)
    {
        $this->validate($req,
            [       
                'noidung'=>'required',
                'inputProductRating'=>'required'
            ],
            [
               
                'noidung.required'=>'Bạn Chưa Nhập Nội Dung Nhận Xét',
                'inputProductRating.required'=>'Bạn Chưa Vote Sao Cho Nhận Xét'
                
            ]);
        $comment = new Comments;
        $comment->id_product = $req->id_product;
        $comment->id_user = $req->id_user;
        $comment->content = $req->noidung;
        $comment->star = $req->inputProductRating;
        $comment->status = 0;
        $comment->save();
        return redirect()->back()->with('thongbao','Nhận Xét Sản Phẩm Thành Công, Chúng tôi sẽ duyệt trong thời gian sớm nhất');;
    }

    //LỊCH SỬ MUA HÀNG

    public function getLichSuMuaHangBill($id)
    {
        if(Auth::user()->id == $id){
            $bill = Bill::where('id_user',$id)->get();
            return view('page.lichsumuahang_bill',compact('bill'));
        }
        else{
            return 'not allowed to see';
        }
       
    }
    public function getLichSuMuaHangBillDetail($id)
    {
        $bill = Bill::find($id);
        if(Auth::user()->id == $bill->id_user){
            $billDetail = BillDetail::where('id_bill',$id)->get();
            return view('page.lichsumuahang_billdetail',compact('billDetail','bill'));
        }
        else{
            return 'not allowed to see';
        }
       
    }

    //QUÊN MẬT KHẨU

    public function getQuenMatKhau()
    {
        return view('page.quenmatkhau');
    }
    public function postQuenMatKhau(Request $request)
    {
        $email = $request->email;
        $checkUser = nguoidung::where('email',$email)->first();
        if(!$checkUser){
            return redirect()->back()->with('error','Email không tồn tại');
        }
        $code = bcrypt(md5(time().$email));
        $checkUser->code = $code;
        $checkUser->time_code = Carbon::now();
        $checkUser->save();

        $url = route('passwordreset',['code'=>$checkUser->code,'email'=>$email]);
        $data = ['route'=>$url];


        Mail::send('mail.quenmatkhau', $data, function($message) use ($checkUser){
            $message->to($checkUser->email, 'Visitor')->subject('Lấy lại mật khẩu');
        });

        return redirect()->back()->with('thongbao','Link lấy lại mật khẩu đã được gửi vào email của bạn');
    }
    public function getResetPassword()
    {
        return view('page.quenmatkhau_reset');
    }
    public function postResetPassword(Request $request)
    {
        $code = $request->code;
        $email = $request->emailUser;
        $checkUser = nguoidung::where([
            'code' => $code,
            'email' => $email
        ])->first();
        if(!$checkUser){
            return redirect()->back()->with('error','Link xác nhận tài khoản không tồn tại');
        }
         $this->validate($request,
            [
                'password'=>'required|min:6|max:20',
                're_password'=>'required|same:password'
            ],
            [
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu phải bé hơn 20 ký tự',
                're_password.required'=>'Phải nhập trường mật khẩu',
                're_password.same'=>'Mật khẩu phải giống nhau'
            ]);
        $checkUser->password = Hash::make($request->password);
        $checkUser->save();
        return redirect()->back()->with('thongbao','Đổi mật khẩu thành công!');
    }

}
