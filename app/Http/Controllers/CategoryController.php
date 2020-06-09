<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\ProductType;

class CategoryController extends Controller
{
    public function getDanhSach()
    {
    	$category = Category::all();
    	return view('admin.Category.danhsach',['category'=>$category]);
    }
    public function getThem()
    {
    	return view('admin.Category.them');
    }
    public function postThem(Request $req)
    {

    	$this->validate($req,
    		[
    			'ten'=>'required|unique:category,name'
    		],
    		[
    			'ten.required'=>'Bạn Chưa Nhập Tên Danh Mục',
    			'ten.unique'=>'Tên Danh Mục Đã Tồn Tại'
    		]);
    	$category = new Category;
    	$category->name = $req->ten;

    	if($req->loai=='Nam'){
    		$category->gender = 1;
    	}
    	else{
    		$category->gender = 0;
    	}
    	$category->save();
    	return redirect('admin/Category/them')->with('thongbao','Thêm Thành Công');
    }
    public function getSua($id)
    {
    	$category = Category::find($id);
    	return view('admin.Category.sua',['category'=>$category]);
    }
    public function postSua(Request $req,$id)
    {
    	$category = Category::find($id);
    	$this->validate($req,
    		[
    			'ten'=>'required'
    		],
    		[
    			'ten.required'=>'Bạn Chưa Nhập Tên Loại Sản Phẩm'
    		]);
    	$category->name = $req->ten;
    	if($req->loai=='Nam'){
    		$category->gender = 1;
    	}
    	else{
    		$category->gender = 0;
    	}
    	$product_type = ProductType::where('id_category',$id)->get();
    	foreach ($product_type as $key => $value) {
    		if($req->loai=='Nam'){
    			$value->gender = 1;
	    	}
	    	else{
	    		$value->gender = 0;
	    	}
	    	$value->save();
    	}
    	$category->save();
    	return redirect('admin/Category/sua/'.$category->id)->with('thongbao','Sửa Thành Công');
    

    }
    public function getXoa($id)
    {
    	$category = Category::find($id);
        $product_type = ProductType::where('id_category',$id)->get();
        if(sizeof($product_type)!=0){
            return redirect('admin/Category/danhsach')->with('thongbaoerr','Không thể xóa danh mục có loại sản phẩm');
        }
        else{
            $category->delete();
            return redirect('admin/Category/danhsach')->with('thongbao','Xóa Thành Công');
        }
    }
}
