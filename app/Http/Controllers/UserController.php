<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\nguoidung;
use App\Comments;
use App\Product;
use Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getDanhSach()
    {
    	$user = nguoidung::all();

    	return view('admin.nguoidung.danhsach',['user'=>$user]);
    }
    public function getThem()
    {
    	return view('admin.nguoidung.them');
    }
    public function postThem(Request $req)
    {
    	$this->validate($req,
    		[
    			'ten'=>'required',
    			'email'=>'required|email|unique:users,email',
    			'password'=>'required|min:6',
    			're_password'=>'required|same:password',
    			'sdt'=>'required',
    			'diachi'=>'required',
    			'phanquyen'=>'required'
    			
    		],
    		[
    			'ten.required'=>'Bạn Chưa Nhập Họ Tên',
    			'email.required'=>'Bạn Chưa Nhập Email',
    			'email.email'=>'Bạn Nhập Chưa Đúng Định Dạng Email',
    			'email.unique'=>'Email đã tồn tại',
    			'password.required'=>'Chưa Nhập Mật Khẩu',
    			'password.min'=>'Mật Khẩu Phải ít nhất 6 ký tự',
    			're_password.required'=>'Bạn Chưa Nhập Lại Mật Khẩu',
    			're_password.same'=>'Mật Khẩu Không Trùng Khớp',
    			'sdt.required'=>'Bạn Chưa Nhập SĐT',
    			'diachi.required'=>'Bạn Chưa Nhập Địa Chỉ',
    			'phanquyen.required'=>'Bạn Chưa Chọn Phân Quyền'
    		]);
    	$user = new nguoidung;
    	$user->full_name= $req->ten;
    	$user->email= $req->email;
    	$user->password= Hash::make($req->password);
    	$user->level= $req->phanquyen;
    	$user->phone= $req->sdt;
    	$user->address= $req->diachi;
    	$user->save();
    	return redirect('admin/nguoidung/them')->with('thongbao','Thêm User Thành Công');
    }
    public function getSua($id)
    {
    	$user = nguoidung::find($id);
    	return view('admin.nguoidung.sua',['user'=>$user]);
    }
    public function postSua(Request $req,$id)
    {
    	$this->validate($req,
    		[
    			'ten'=>'required',
    			'sdt'=>'required',
    			'diachi'=>'required',
    			'phanquyen'=>'required'
    			
    		],
    		[
    			'ten.required'=>'Bạn Chưa Nhập Họ Tên',
    			'sdt.required'=>'Bạn Chưa Nhập SĐT',
    			'diachi.required'=>'Bạn Chưa Nhập Địa Chỉ',
    			'phanquyen.required'=>'Bạn Chưa Chọn Phân Quyền'
    		]);
    	$user= nguoidung::find($id);
    	$user->full_name= $req->ten;
    	$user->level= $req->phanquyen;
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
                'old_password.required'=>'Bạn Chưa Nhập Mật Khẩu Cũ',
                'password.required'=>'Bạn Chưa Nhập Mật Khẩu',
                'password.min'=>'Mật Khẩu Phải ít nhất 6 ký tự',
                're_password.required'=>'Bạn Chưa Nhập Lại Mật Khẩu',
                're_password.same'=>'Mật Khẩu Không Trùng Khớp'
                
            ]);

            $user->password= Hash::make($req->password);
        }


    	$user->save();
    	return redirect('admin/nguoidung/sua/'.$id)->with('thongbao','Sửa User Thành Công');

    }

    public function getXoa($id)
    {
    	$user = nguoidung::find($id);
        //tìm tất cả những comment người này đã comments
        $comments = Comments::where('id_user',$id)->get();
        foreach ($comments as $cm) {
            // xóa cmt đó
            $cm->delete();
            // tìm sản phẩm ứng với cmt đó
            $product = Product::find($cm->id_product);
            // tìm tất cả comment của sản phẩm đó
            $com = Comments::where('id_product',$product->id)->where('status',1)->get();
            // đánh giá lại rate cho sp đó
            if(sizeof($com)==0){
                $product->rate = 0;
            }
            else{
                $sum = 0;
                $index = 0;
                foreach ($com as $c) {
                    $sum = $sum + $c->star;
                    $index = $index + 1;
                }
                $ave = round($sum/$index);
                $product->rate = $ave;
            }
            $product->save();
        }
    	$user->delete();
    	return redirect('admin/nguoidung/danhsach')->with('thongbao','Xóa User Thành Công');
    }
    public function getDangNhapAdmin()
    {
        if(Auth::check() && Auth::user()->level==1){
            return redirect('admin/Bill/danhsach');
        }
        else{
            return view('admin.login');
        }
    	
    }
    public function postDangNhapAdmin(Request $req)
    {
    	$this->validate($req,
    		[
    			'email'=>'required',
    			'password'=>'required|min:6'
    			
    		],
    		[
    			'email.required'=>'Bạn Chưa Nhập Email',
    			'password.required'=>'Bạn Chưa Nhập Mật Khẩu',
    			'password.min'=>'Mật Khẩu Phải Ít Nhất 6 Ký Tự',

    		]);
    	$credentials = array('email'=>$req->email,'password'=>$req->password);
        
        if(Auth::attempt($credentials))
        {
           return redirect('admin/Bill/danhsach');
        }
        else
        {
            return redirect()->back()->with(['thongbao'=>'Đăng Nhập Không Thành Công']);
        }

    }
    public function getDangXuatAdmin()
    {
    	Auth::logout();
    	return redirect('admin/dangnhap');
    }

}
