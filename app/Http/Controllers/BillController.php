<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\BillDetail;
use App\Customer;
use App\Comments;
use App\Product;
use App\nguoidung;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function getDanhSach()
    {
        $new_bill = Bill::where('tinhtrang',0)->get();
        $new_comments = Comments::where('status',0)->get();
        $product = Product::all();
        $nguoidung = nguoidung::all();
    	$bill = Bill::all();
    	return view('admin.Bill.danhsach',['bill'=>$bill,'new_bill'=>$new_bill,'new_comments'=>$new_comments,
        'product'=>$product,'nguoidung'=>$nguoidung]);
    }
    public function getBillDetail($id)
    {
    	$billdetail = BillDetail::where('id_bill',$id)->get();
    	$bill = Bill::find($id);
    	$customer = Customer::find($bill->id_customer);//dùng where thì phải duyệt for

    	return view('admin.Bill.billdetail',compact('billdetail','customer'));
    }
    public function getXacNhan($id)
    {
        $bill = Bill::find($id);
        $bill->tinhtrang = 1;
        $bill->save();
        return redirect('admin/Bill/danhsach')->with('thongbao','Xác Nhận Bill Thành Công');
       
    }
    public function getGiaoHang($id)
    {
        $bill = Bill::find($id);
        $bill->tinhtrang = 2;
        $bill->save();
        return redirect('admin/Bill/danhsach')->with('thongbao','Xác Nhận Giao Hàng Thành Công');
    }
    public function getHuyGiaoHang($id)
    {
        $bill = Bill::find($id);
        $bill->tinhtrang = 0;
        $bill->save();
        return redirect('admin/Bill/danhsach')->with('thongbao','Hủy Giao Hàng Thành Công');
    }
    public function getLichSu()
    {
        $thongke=DB::table("bills")->select(DB::raw("MONTH(created_at) as Thang")  ,DB::raw("(SUM(total)) as Tong"))->groupBy(DB::raw("MONTH(created_at)"))->where('tinhtrang',1)->whereYear('created_at', '2020')->get();
        $bill = Bill::where('tinhtrang',1)->get();
        
        return view('admin.Bill.lichsudonhang',compact('bill','thongke'));
    }
    public function getXoa($id)
    {
        $bill = Bill::find($id);
        $billdetail = BillDetail::where('id_bill',$id)->get();
        foreach ($billdetail as $bd) {
            $bd->delete();
        }
        $bill->delete();
        return redirect('admin/Bill/danhsach')->with('thongbao','Xóa Bill Thành Công');
    }
}
