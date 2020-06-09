<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\ProductType;
use App\Brand;
use App\Slug;
use App\Color;
use App\Category;

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
        $category = Category::all();
        $producttype = ProductType::all();
        $brand = Brand::all();
        $color = Color::all();
        return view('admin.Product.them',['producttype'=>$producttype,'brand'=>$brand,'color'=>$color,'category'=>$category]);
    }
    public function postThem(Request $req)
    {
        $giakm = $req->giakhuyenmai;
        $giagoc = $req->giagoc;
        if($giakm>$giagoc){
            return redirect()->back()->with('error','Giá Khuyến Mãi Không Được Lớn Hơn Giá Gốc');
        }
        $this->validate($req,
            [
                'loaisp'=>'required',
                'thuonghieu'=>'required',
                // 'ten'=>'required|unique:products,name',
                'ten'=>'required',
                'mota'=>'required',
                'giagoc'=>'required|gte:50000|lte:10000000',
                'hinhanh'=>'required'
            ],
            [
                'loaisp.required'=>'Bạn Chưa Chọn Loại Sản Phẩm',
                'thuonghieu.required'=>'Bạn Chưa Chọn Thương Hiệu',
                'ten.required'=>'Bạn Chưa Nhập Tên Sản Phẩm',
                // 'ten.unique'=>'Tên Sản Phẩm đã tồn tại',
                'mota.required'=>'Bạn Chưa Nhập Mô Tả Sản Phẩm',
                'giagoc.required'=>'Bạn Chưa Nhập Giá Gốc Sản Phẩm',    
                'giagoc.gte'=>'Giá Gốc Của Sản Phẩm Phải Lớn Hơn 50,000đ',
                'giagoc.lte'=>'Giá Gốc Của Sản Phẩm Phải Bé Hơn 10,000,000đ',   
                'hinhanh.required'=>'Bạn Chưa Chọn Ảnh Sản Phẩm'
            ]);
        $product = new Product;
        $product->name = $req->ten;
        $product->id_type = $req->loaisp;
        $product->id_brand = $req->thuonghieu;
        $product->description = $req->mota;
        $product->unit_price = $req->giagoc;
        if($req->giakhuyenmai == null || $req->giakhuyenmai <= 0 || $req->giakhuyenmai >  $req->giagoc){
            $product->promotion_price = $product->unit_price;
        }
        else{
            $product->promotion_price = $req->giakhuyenmai;
        }
        //gender
        //$product->unit = $req->unit;
        $type = ProductType::find($req->loaisp);
        if($type->gender == 1){
            $product->gender = 1;
        }else{
            $product->gender = 0;
        }
        
        //upload image
        $arrImg = array();
        if($req->hasFile('hinhanh'))
        {
            foreach ($req->hinhanh as $file) {
                $name = $file->getClientOriginalName(); // lay cai ten cua file hinhanh
                $hinh = str_random(4)."_".$name;
                while (file_exists("source/images/".$hinh)) {
                    $hinh = str_random(4)."_".$name;
                }
                $file->move("source/images",$hinh);
                array_push($arrImg, $hinh);
                
            }
            
            // $file = $req->file('hinhanh'); //lay file hinhanh
            // $name = $file->getClientOriginalName(); // lay cai ten cua file hinhanh
            // $hinh = str_random(4)."_".$name;
            // while (file_exists("source/images/".$hinh)) {
            //     $hinh = str_random(4)."_".$name;
            // }
            // $file->move("source/images",$hinh);
            $product->image= json_encode($arrImg,JSON_FORCE_OBJECT);
            print_r($product->image);
        }
        else{
            $product->image="";
        }

        //slug
        $slug = new Slug();
        $product->slug = $slug->createSlugProduct($req->ten);
        
        //sale
        if($product->promotion_price == $product->unit_price){
            $product->sale = 0.00;
        }else{
            $product->sale = 100-(($req->giakhuyenmai/$req->giagoc)*100);
        }
        //color
        if($req->input('color_array')!=null){
            $arrColor = $req->input('color_array');
            $product->color= json_encode($arrColor,JSON_FORCE_OBJECT);
        }
        

        $product->save();
        return redirect('admin/Product/them')->with('thongbao','Thêm Sản Phẩm Thành Công');
    }
    public function getSua($id)
    {
        $category = Category::all();
        $product = Product::find($id);
        $producttype = ProductType::where('id_category',$product->product_type->category->id)->get();
        $color = Color::all();
        $brand = Brand::all();
        return view('admin.Product.sua',['product'=>$product,'producttype'=>$producttype,'brand'=>$brand,'color'=>$color,'category'=>$category]);
    }
    public function postSua(Request $req,$id)
    {
        $product = Product::find($id);
        $giakm = $req->giakhuyenmai;
        $giagoc = $req->giagoc;
        if($giakm>$giagoc){
            return redirect()->back()->with('error','Giá Khuyến Mãi Không Được Lớn Hơn Giá Gốc');
        }
        $this->validate($req,
            [
                'loaisp'=>'required',
                'thuonghieu'=>'required',
                'ten'=>'required',
                'giagoc'=>'required|gte:50000|lte:10000000',
                'giakhuyenmai'=>'gte:0'
                // 'hinhanh'=>'required'
            ],
            [
                'loaisp.required'=>'Bạn Chưa Chọn Loại Sản Phẩm',
                'thuonghieu.required'=>'Bạn Chưa Chọn Thương Hiệu',
                'ten.required'=>'Bạn Chưa Nhập Tên Sản Phẩm',
                'giagoc.required'=>'Bạn Chưa Nhập Giá Gốc Sản Phẩm',
                'giagoc.gte'=>'Giá Gốc Của Sản Phẩm Phải Lớn Hơn 50,000đ',
                'giagoc.lte'=>'Giá Gốc Của Sản Phẩm Phải Bé Hơn 10,000,000đ',
                'giakhuyenmai.gte'=>'Giá Khuyến Mãi Của Sản Phẩm Phải Là Số Nguyên Dương',
                // 'hinhanh.required'=>'Bạn Chưa Chọn Ảnh Sản Phẩm'
            ]);
        $product->name = $req->ten;
        $product->id_type = $req->loaisp;
        $product->id_brand = $req->thuonghieu;
        $product->description = $req->mota;
        $product->unit_price = $req->giagoc;
        if($req->giakhuyenmai == null || $req->giakhuyenmai <= 0 || $req->giakhuyenmai >  $req->giagoc){
            $product->promotion_price = $product->unit_price;
        }
        else{
            $product->promotion_price = $req->giakhuyenmai;
        }
        //$product->unit = $req->unit;
        $type = ProductType::find($req->loaisp);
        if($type->gender == 1){
            $product->gender = 1;
        }else{
            $product->gender = 0;
        }

        //upload image
        $arrImg = array();
        $oldArr = json_decode($product->image,true);
        if($req->hasFile('hinhanh'))
        {
            for($i=0;$i<sizeof($oldArr);$i++){
                unlink("source/images/".$oldArr[$i]);
            }
            foreach ($req->hinhanh as $file) {
                $name = $file->getClientOriginalName(); // lay cai ten cua file hinhanh
                $hinh = str_random(4)."_".$name;
                while (file_exists("source/images/".$hinh)) {
                    $hinh = str_random(4)."_".$name;
                }
                $file->move("source/images",$hinh);
                array_push($arrImg, $hinh);   
            }
            $product->image= json_encode($arrImg,JSON_FORCE_OBJECT);
            // $file = $req->file('hinhanh');
            // $name = $file->getClientOriginalName();
            // $hinh = str_random(4)."_".$name;
            // while (file_exists("source/images/".$hinh)) {
            //     $hinh = str_random(4)."_".$name;
            // }
            // unlink("source/images/".$product->image);
            // $file->move("source/images",$hinh);
            // $product->image= $hinh;
            
        }
        else{
            
        }

        //slug
        // $str = $req->ten;
        // $slug = Str::slug($str, '-');
        // $product->slug = $slug;
        $slug = new Slug();
        $product->slug = $slug->createSlugProduct($req->ten,$id);

        //sale
        if($product->promotion_price == $product->unit_price){
            $product->sale = 0.00;
        }else{
            $product->sale = 100-(($req->giakhuyenmai/$req->giagoc)*100);
        }

        //color
        if($req->input('color_array')!=null){
            $arrColor = $req->input('color_array');
            $product->color= json_encode($arrColor,JSON_FORCE_OBJECT);
        }else{
             $product->color=null;
        }
         
        
        $product->save();
        return redirect('admin/Product/sua/'.$id)->with('thongbao','Sửa Sản Phẩm Thành Công');
    }
    public function getHetHang($id)
    {
        $product = Product::find($id);
        $product->status = 2;
        $product->save();
        return redirect('admin/Product/danhsach')->with('thongbao','Cập Nhật Thành Công');
    }
    public function getConHang($id)
    {
        $product = Product::find($id);
        $product->status = 1;
        $product->save();
        return redirect('admin/Product/danhsach')->with('thongbao','Cập Nhật Thành Công');
    }
    public function getNgungKinhDoanh($id)
    {
        $product = Product::find($id);
        $product->status = 3;
        $product->save();
        return redirect('admin/Product/danhsach')->with('thongbao','Cập Nhật Thành Công');
    }

    public function getProductType($danhmuc_id)
    {
        
        $type = ProductType::where('id_category',$danhmuc_id)->get();
        $output = "<option value> Chọn Loại Sản Phẩm</option>";
        foreach ($type as $ty) {
            $output.= "<option value='".sprintf($ty->id)."'>".$ty->name."</option>";
        }
        echo $output;
       
    }
    
    
}
