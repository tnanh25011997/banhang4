<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    public function getDanhSach()
    {
    	$slide = Slide::All();
    	return view('admin.Slide.danhsach',compact('slide'));
    	
    }
    public function getXoa($id)
    {
    	$slide = Slide::find($id);
    	$slide->delete();
    	return redirect('admin/Slide/danhsach')->with('thongbao','Xóa Slide Thành Công');
    }
    public function getThem()
    {
    	return view('admin.Slide.them');
    }
    public function postThem(Request $req)
    {
    	$this->validate($req,
    		[
    			
    			'hinhanh'=>'required'
    		],
    		[
 
    			'hinhanh.required'=>'Bạn Chưa Chọn Ảnh Slide'
    		]);
    	$slide = new Slide;
    	if($req->hasFile('hinhanh'))
    	{

    		$file = $req->file('hinhanh');
    		$name = $file->getClientOriginalName();
    		$hinh = str_random(4)."_".$name;
    		while (file_exists("source/images/".$hinh)) {
    		    $hinh = str_random(4)."_".$name;
    		}
    		$file->move("source/images",$hinh);
    		$slide->image= $hinh;
    	}
    	else{
    		$product->image="";
    	}
    	$slide->save();
    	return redirect('admin/Slide/them')->with('thongbao','Thêm Slide Thành Công');
    }
    public function getSua($id)
    {
    	$slide = Slide::find($id);
    	return view('admin.Slide.sua',compact('slide'));
    }
    public function postSua(Request $req,$id)
    {
    	$this->validate($req,
    		[
    			
    			'hinhanh'=>'required'
    		],
    		[
 
    			'hinhanh.required'=>'Bạn Chưa Chọn Ảnh Slide'
    		]);
    	$slide = Slide::find($id);
    	if($req->hasFile('hinhanh'))
    	{

    		$file = $req->file('hinhanh');
    		$name = $file->getClientOriginalName();
    		$hinh = str_random(4)."_".$name;
    		while (file_exists("source/images/".$hinh)) {
    		    $hinh = str_random(4)."_".$name;
    		}
    		unlink("source/images/".$slide->image);
    		$file->move("source/images",$hinh);
    		$slide->image= $hinh;
    	}
    	else{
    		
    	}
    	$slide->save();
    	return redirect('admin/Slide/sua/'.$id)->with('thongbao','Sửa Slide Thành Công');
    }
    
}
