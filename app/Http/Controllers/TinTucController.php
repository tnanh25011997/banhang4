<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
class TinTucController extends Controller
{
    public function getDanhSach()
    {
    	$tintuc = News::all();
    	return view('admin.tintuc.danhsach',compact('tintuc'));
    }
    public function getThem()
    {
    	return view('admin.tintuc.them');
    }
    public function postThem(Request $req)
    {
    	$this->validate($req,
    		[
    			'tieude'=>'required',
    			'highlight'=>'required',
    			'noidung'=>'required',
    			'hinhanh'=>'required'
    		],
    		[
    			'tieude.required'=>'Vui lòng nhập tiêu đề tin tức',
    			'highlight.required'=>'Vui lòng nhập Highlight tin tức',
    			'noidung.required'=>'Vui lòng nhập nội dung tin tức',
    			'hinhanh.required'=>'Vui thêm ảnh tin tức'
    		]);
    	$tin = new News;
    	$tin->title = $req->tieude;
    	$tin->highlight = $req->highlight;
    	$tin->content = $req->noidung;
    	if($req->hasFile('hinhanh'))
    	{

    		$file = $req->file('hinhanh');
    		$name = $file->getClientOriginalName();
    		$hinh = str_random(4)."_".$name;
    		while (file_exists("source/images/".$hinh)) {
    		    $hinh = str_random(4)."_".$name;
    		}
    		$file->move("source/images",$hinh);
    		$tin->image= $hinh;

    	}
    	else{
    		$tin->image="";
    	}
    	$tin->save();
    	return redirect('admin/tintuc/them')->with('thongbao','Thêm Tin Tức Thành Công');
    }
    public function getXoa($id)
    {
    	$tin = News::find($id);
    	$tin->delete();
    	return redirect('admin/tintuc/danhsach')->with('thongbao','Xóa Tin Tức Thành Công');

    }

    public function getSua($id)
    {
    	$tin = News::find($id);
    	return view('admin.tintuc.sua',compact('tin'));
    }
    public function postSua(Request $req, $id)
    {
    	$this->validate($req,
    		[
    			'tieude'=>'required',
    			'highlight'=>'required',
    			'noidung'=>'required'
    			
    		],
    		[
    			'tieude.required'=>'Vui lòng nhập tiêu đề tin tức',
    			'highlight.required'=>'Vui lòng nhập Highlight tin tức',
    			'noidung.required'=>'Vui lòng nhập nội dung tin tức'
    			
    		]);
    	$tin = News::find($id);
    	$tin->title = $req->tieude;
    	$tin->highlight = $req->highlight;
    	$tin->content = $req->noidung;
    	if($req->hasFile('hinhanh'))
        {

            $file = $req->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("source/images/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            unlink("source/images/".$tin->image);
            $file->move("source/images",$hinh);
            $tin->image= $hinh;
            
        }
        else{
            
        }
        $tin->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sửa Tin Tức Thành Công');

    }
}
