<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\ProductType;
use App\Brand;

class ProductController extends Controller
{
    public function getDanhSach()
    {
    	$product = Product::orderby('created_at','desc')->get();
    	return view('admin.Product.danhsach',['product'=>$product]);
    }
    public function getXoa($id)
    {
    	$product = Product::find($id);
    	$product->delete();
    	return redirect('admin/Product/danhsach')->with('thongbao','Xóa Thành Công');
    }
    public function getThem()
    {
    	$producttype = ProductType::all();
        $brand = Brand::all();
    	return view('admin.Product.them',['producttype'=>$producttype,'brand'=>$brand]);
    }
    public function postThem(Request $req)
    {
    	$this->validate($req,
    		[
    			'loaisp'=>'required',
                'thuonghieu'=>'required',
    			'ten'=>'required|unique:products,name',
    			'mota'=>'required',
    			'giagoc'=>'required',
    			'hinhanh'=>'required'
    		],
    		[
    			'loaisp.required'=>'Bạn Chưa Chọn Loại Sản Phẩm',
                'thuonghieu.required'=>'Bạn Chưa Chọn Thương Hiệu',
    			'ten.required'=>'Bạn Chưa Nhập Tên Sản Phẩm',
    			'ten.unique'=>'Tên Sản Phẩm đã tồn tại',
    			'mota.required'=>'Bạn Chưa Nhập Mô Tả Sản Phẩm',
    			'giagoc.required'=>'Bạn Chưa Nhập Giá Gốc Sản Phẩm',			
    			'hinhanh.required'=>'Bạn Chưa Chọn Ảnh Sản Phẩm'
    		]);
    	$product = new Product;
    	$product->name = $req->ten;
    	$product->id_type = $req->loaisp;
        $product->id_brand = $req->thuonghieu;
    	$product->description = $req->mota;
    	$product->unit_price = $req->giagoc;
        if($req->giakhuyenmai == null || $req->giakhuyenmai == 0 || $req->giakhuyenmai >  $req->giagoc){
            $product->promotion_price = $product->unit_price;
        }
        else{
            $product->promotion_price = $req->giakhuyenmai;
        }
    	
        $product->unit = $req->unit;
    	if($req->hasFile('hinhanh'))
    	{

    		$file = $req->file('hinhanh'); //lay file hinhanh
    		$name = $file->getClientOriginalName(); // lay cai ten cua file hinhanh
    		$hinh = str_random(4)."_".$name;
    		while (file_exists("source/images/".$hinh)) {
    		    $hinh = str_random(4)."_".$name;
    		}
    		$file->move("source/images",$hinh);
    		$product->image= $hinh;
    	}
    	else{
    		$product->image="";
    	}
        //slug
        $str = $req->ten;
        // $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", "a", $str);
        // $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", "e", $str);
        // $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", "i", $str);
        // $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", "o", $str);
        // $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", "u", $str);
        // $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", "y", $str);
        // $str = preg_replace("/(đ)/", "d", $str);
        // $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", "A", $str);
        // $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", "E", $str);
        // $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", "I", $str);
        // $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", "O", $str);
        // $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", "U", $str);
        // $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", "Y", $str);
        // $str = preg_replace("/(Đ)/", "D", $str);
        // $str = preg_replace("/( )/","-",$str);
        // $str = strtolower($str);
        $slug = Str::slug($str, '-');
        $product->slug = $slug;
        
        //sale
        if($product->promotion_price == $product->unit_price){
            $product->sale = 0.00;
        }else{
            $product->sale = 100-(($req->giakhuyenmai/$req->giagoc)*100);
        }

    	$product->save();
    	return redirect('admin/Product/them')->with('thongbao','Thêm Sản Phẩm Thành Công');
    }
    public function getSua($id)
    {
        $product = Product::find($id);
        $producttype = ProductType::all();
        $brand = Brand::all();
        return view('admin.Product.sua',['product'=>$product,'producttype'=>$producttype,'brand'=>$brand]);
    }
    public function postSua(Request $req,$id)
    {
        $product = Product::find($id);
        $req->ten = trim(preg_replace('/\s+/',' ', $req->ten));
        $this->validate($req,
            [
                'loaisp'=>'required',
                'thuonghieu'=>'required',
                'ten'=>'required',
                'giagoc'=>'required'
                // 'hinhanh'=>'required'
            ],
            [
                'loaisp.required'=>'Bạn Chưa Chọn Loại Sản Phẩm',
                'thuonghieu.required'=>'Bạn Chưa Chọn Thương Hiệu',
                'ten.required'=>'Bạn Chưa Nhập Tên Sản Phẩm',
                'giagoc.required'=>'Bạn Chưa Nhập Giá Gốc Sản Phẩm'
                // 'hinhanh.required'=>'Bạn Chưa Chọn Ảnh Sản Phẩm'
            ]);
        $product->name = $req->ten;
        $product->id_type = $req->loaisp;
        $product->id_brand = $req->thuonghieu;
        $product->description = $req->mota;
        $product->unit_price = $req->giagoc;
        if($req->giakhuyenmai == null || $req->giakhuyenmai == 0 || $req->giakhuyenmai >  $req->giagoc){
            $product->promotion_price = $product->unit_price;
        }
        else{
            $product->promotion_price = $req->giakhuyenmai;
        }
        $product->unit = $req->unit;
        if($req->hasFile('hinhanh'))
        {

            $file = $req->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while (file_exists("source/images/".$hinh)) {
                $hinh = str_random(4)."_".$name;
            }
            unlink("source/images/".$product->image);
            $file->move("source/images",$hinh);
            $product->image= $hinh;
            
        }
        else{
            
        }

        //slug
        $str = $req->ten;
        $slug = Str::slug($str, '-');
        $product->slug = $slug;

        //sale
        if($product->promotion_price == $product->unit_price){
            $product->sale = 0.00;
        }else{
            $product->sale = 100-(($req->giakhuyenmai/$req->giagoc)*100);
        }
        $product->save();
        return redirect('admin/Product/sua/'.$id)->with('thongbao','Sửa Sản Phẩm Thành Công');

    }
    
}
