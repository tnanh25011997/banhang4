<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\Product;
use App\PromotionRegister;

class CommentsController extends Controller
{
    public function getDanhSach()
    {
    	$comments = Comments::where('status',0)->get();
    	return view('admin.Comments.danhsach',compact('comments'));
    }
    public function getDanhSachComment()
    {
        $comments = Comments::where('status',1)->get();
        return view('admin.Comments.danhsachcomments',compact('comments'));
    }
    public function getXacNhan($id)
    {
    	$idxacnhan = Comments::find($id);
        $idxacnhan->status = 1;
        $idxacnhan->save();

        $product = Product::find($idxacnhan->id_product);
        $comments = Comments::where('id_product',$product->id)->where('status',1)->get();
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
    	$comment = Comments::find($id);
        $comment->delete();
        return redirect('admin/Comments/danhsach')->with('thongbao','Xoa Comment Thành Công');
    }
    public function getDanhSachNhanKhuyenMai()
    {
        $customer = PromotionRegister::where('status',0)->get();
        return view('admin.Comments.danhsachnhankhuyenmai',compact('customer'));
    }
    public function getXacNhanKhuyenMai($id)
    {
        $promotion = PromotionRegister::find($id);
        $promotion->status = 1;
        $promotion->save();
        return redirect('admin/Comments/danhsachnhankhuyenmai')->with('thongbao','Xác Nhận Thành Công');
    }
    public function getXoaComment($id)
    {
        $cm = Comments::find($id);
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
        return redirect('admin/Comments/danh-sach-comments')->with('thongbao','Xoa Comment Thành Công');
    }
}
