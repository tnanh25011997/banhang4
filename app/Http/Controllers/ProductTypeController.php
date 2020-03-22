<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\ProductType;
use App\Product;

class ProductTypeController extends Controller
{
    public function getDanhSach()
    {
    	$producttype = ProductType::all();
    	return view('admin.ProductType.danhsach',['producttype'=>$producttype]);
    }
    public function getThem()
    {
    	return view('admin.ProductType.them');
    }
    public function postThem(Request $req)
    {

    	$this->validate($req,
    		[
    			'ten'=>'required|unique:type_products,name'
    		],
    		[
    			'ten.required'=>'Bạn Chưa Nhập Tên Loại Sản Phẩm',
    			'ten.unique'=>'Tên Loại Sản Phẩm đã tồn tại'
    		]);
    	$producttype = new ProductType;
    	$producttype->name = $req->ten;
        $str = $req->ten;
        $slug = Str::slug($str, '-');
        $producttype->slug = $slug;
    	if($req->loai=='Nam'){
    		$producttype->description = "0";
    	}
    	else{
    		$producttype->description = "1";
    	}
    	$producttype->save();
    	return redirect('admin/ProductType/them')->with('thongbao','Thêm Thành Công');
    }
    public function getSua($id)
    {
    	$producttype = ProductType::find($id);
    	return view('admin.ProductType.Sua',['producttype'=>$producttype]);
    }
    public function postSua(Request $req,$id)
    {
    	$producttype = ProductType::find($id);
    	$this->validate($req,
    		[
    			'ten'=>'required'
    		],
    		[
    			'ten.required'=>'Bạn Chưa Nhập Tên Loại Sản Phẩm'
    		]);
    	$producttype->name = $req->ten;
        $str = $req->ten;
        $slug = Str::slug($str, '-');
        $producttype->slug = $slug;
    	if($req->loai=='Nam'){
    		$producttype->description = "0";
    	}
    	else{
    		$producttype->description = "1";
    	}
    	$producttype->save();
    	return redirect('admin/ProductType/sua/'.$producttype->id)->with('thongbao','Sửa Thành Công');
    

    }
    public function getXoa($id)
    {
    	$producttype = ProductType::find($id);
        $product = Product::where('id_type',$id)->get();
        if(sizeof($product)!=0){
            return redirect('admin/ProductType/danhsach')->with('thongbaoerr','Không thể xóa Loại sản phẩm có sản phẩm');
        }
        else{
            $producttype->delete();
            return redirect('admin/ProductType/danhsach')->with('thongbao','Xóa Thành Công');
        }
    }
}
