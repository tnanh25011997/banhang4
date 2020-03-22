<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Brand;
use App\Product;


class BrandController extends Controller
{
    public function getDanhSach()
    {
    	$brand = Brand::all();
    	return view('admin.Brand.danhsach',['brand'=>$brand]);
    }
    public function getThem()
    {
    	return view('admin.Brand.them');
    }
    public function postThem(Request $req)
    {

    	$this->validate($req,
    		[
    			'ten'=>'required|unique:brand,name',
    			'xuatxu'=>'required'
    		],
    		[
    			'ten.required'=>'Bạn Chưa Nhập Tên Thương Hiệu',
    			'ten.unique'=>'Tên Thương Hiệu đã tồn tại',
    			'xuatxu.required'=>'Bạn Chưa Nhập Xuất Xứ'
    		]);
    	$brand = new Brand;
    	$brand->name = $req->ten;
        $str = $req->ten;
        $slug = Str::slug($str, '-');
        $brand->slug = $slug;
    	$brand->origin = $req->xuatxu;
    	$brand->save();
    	return redirect('admin/Brand/them')->with('thongbao','Thêm Thành Công');
    }
    public function getSua($id)
    {
    	$brand = Brand::find($id);
    	return view('admin.Brand.sua',['brand'=>$brand]);
    }
    public function postSua(Request $req,$id)
    {
    	$brand = Brand::find($id);
    	$this->validate($req,
    		[
    			'ten'=>'required',
    			'xuatxu'=>'required'
    		],
    		[
    			'ten.required'=>'Bạn Chưa Nhập Tên Thương Hiệu',
    			'xuatxu.required'=>'Bạn Chưa Nhập Xuất Xứ'
    		]);
    	$brand->name = $req->ten;
        $str = $req->ten;
        $slug = Str::slug($str, '-');
        $brand->slug = $slug;
    	$brand->origin = $req->xuatxu;
    	$brand->save();
    	return redirect('admin/Brand/sua/'.$brand->id)->with('thongbao','Sửa Thành Công');
    }
    public function getXoa($id)
    {
    	$brand = Brand::find($id);
        $product = Product::where('id_brand',$id)->get();
        if(sizeof($product)!=0){
            return redirect('admin/Brand/danhsach')->with('thongbaoerr','Không thể xóa Brand đang có sản phẩm');
        }
        else{
            $brand->delete();
            return redirect('admin/Brand/danhsach')->with('thongbao','Xóa Thành Công');
        }
    }
}
