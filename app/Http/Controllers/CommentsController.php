<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\Product;
use App\CustomerRegister;

class CommentsController extends Controller
{
    public function getDanhSach()
    {
    	$comments = Comments::where('status',0)->get();
    	return view('admin.Comments.danhsach',compact('comments'));
    }
    public function getXacNhan($id)
    {
    	$idxacnhan = Comments::find($id);
        $idxacnhan->status = 1;
        $idxacnhan->save();

        $product = Product::find($idxacnhan->id_product);
        $comments = $comments = Comments::where('id_product',$product->id)->where('status',1)->get();
        $sum = 0;
        $index = 0;
        foreach ($comments as $comment) {
            $sum = $sum + $comment->star;
            $index = $index + 1;
        }
        $ave = round($sum/$index);

        $product->rate = $ave;
        $product->save();
        
        return redirect('admin/Comments/danhsach')->with('thongbao','Xác Nhận Comment Thành Công');
    }
    public function getXoa($id)
    {
    	$idxacnhan = Comments::find($id);
        $idxacnhan->delete();
        return redirect('admin/Comments/danhsach')->with('thongbao','Xoa Comment Thành Công');
    }
    public function getDanhSachNhanKhuyenMai()
    {
        $customer = CustomerRegister::where('status',0)->get();
        return view('admin.Comments.danhsachnhankhuyenmai',compact('customer'));
    }
    public function getXacNhanKhuyenMai($id)
    {
        $idxacnhan = CustomerRegister::find($id);
        $idxacnhan->status = 1;
        $idxacnhan->save();
        return redirect('admin/Comments/danhsachnhankhuyenmai')->with('thongbao','Xác Nhận Thành Công');
    }
}
