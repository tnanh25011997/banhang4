<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/',['as'=>'trang-chu','uses'=>'PageController@getIndex']);
Route::get('home',['as'=>'trang-chu','uses'=>'PageController@getIndex']);
Route::get('san-pham',['as'=>'loaisanpham','uses'=>'PageController@getSanPham']);
Route::get('chi-tiet-san-pham/{id}',['as'=>'chitietsanpham','uses'=>'PageController@getChiTiet']);
Route::get('dang-ky',['as'=>'dangky','uses'=>'PageController@getDangKy']);
Route::get('dang-nhap',['as'=>'dangnhap','uses'=>'PageController@getDangNhap']);
Route::get('gio-hang',['as'=>'giohang','uses'=>'PageController@getGioHang']);
Route::get('thanh-toan',['as'=>'thanhtoan','uses'=>'PageController@getThanhToan']);
Route::get('hoan-tat',['as'=>'hoantat','uses'=>'PageController@getHoanTat']);
Route::get('san-pham-theo-loai/{id}',['as'=>'sanphamtheoloai','uses'=>'PageController@getTheoLoai']);
Route::get('thuong-hieu/{id}',['as'=>'thuong-hieu','uses'=>'PageController@getThuongHieu']);
//giohang
Route::get('gio-hang/{id}',['as'=>'giohangid','uses'=>'CartController@getGioHangId']);

Route::post('gio-hang-detail',['as'=>'giohangdetail','uses'=>'CartController@gioHangIdDetail']);
Route::post('update-giohang',['as'=>'update','uses'=>'CartController@updateGioHangId']);
//xóa 1 sp trong gio
Route::get('xoa-gio/{id}',['as'=>'xoagio','uses'=>'CartController@xoaGio']);

//luu vao csdl
Route::post('thanh-toan',['as'=>'dathang','uses'=>'CartController@postCheckout']);

//dangky
Route::post('dang-ky2',['as'=>'dangky2','uses'=>'AccountController@postDangKy']);
//dangnhap
Route::post('dang-nhap2',['as'=>'dangnhap2','uses'=>'AccountController@postDangNhap']);


Route::group(['prefix'=>'tai-khoan','middleware'=>'thuongLogin'],function(){
	
    Route::get('chinhsuathongtin/{id}',['as'=>'chinhsua','uses'=>'AccountController@getChinhSua']);
    Route::post('chinhsuathongtin/{id}',['as'=>'chinhsua','uses'=>'AccountController@postChinhSua']);
    Route::get('chinh-sua-so-dia-chi/{id}',['as'=>'chinhsuasodiachi','uses'=>'AccountController@getChinhSuaSoDiaChi']);
    Route::post('chinh-sua-so-dia-chi/{id}',['as'=>'chinhsuasodiachi','uses'=>'AccountController@postChinhSuaSoDiaChi']);
    Route::get('lichsumuahang_bill/{id}',['as'=>'lichsumuahang_bill','uses'=>'AccountController@getLichSuMuaHangBill']);
    Route::get('lichsumuahang_billdetail/{id}',['as'=>'lichsumuahang_billdetail','uses'=>'AccountController@getLichSuMuaHangBillDetail']);
});
Route::get('dangxuat',['as'=>'logout','uses'=>'AccountController@postDangXuat']);

Route::get('gioi-thieu',['as'=>'gioithieu','uses'=>'PageController@getGioiThieu']);
Route::get('chinh-sach-bao-mat',['as'=>'chinh-sach-bao-mat','uses'=>'PageController@getChinhSachBaoMat']);
Route::get('huong-dan-mua-hang',['as'=>'huong-dan-mua-hang','uses'=>'PageController@getHuongDanMuaHang']);
Route::get('tai-khoan-giao-dich',['as'=>'tai-khoan-giao-dich','uses'=>'PageController@getTaiKhoanGiaoDich']);
Route::get('giao-hang-va-doi-tra',['as'=>'giao-hang-va-doi-tra','uses'=>'PageController@getGiaoHangVaDoiTra']);

//timkiem
Route::get('search',['as'=>'search','uses'=>'PageController@getSearch']);
//tintuc

Route::get('tin-tuc',['as'=>'tintuc','uses'=>'PageController@getTinTuc']);
Route::get('chitiet-tintuc/{id}',['as'=>'chitiettintuc','uses'=>'PageController@getChiTietTinTuc']);

Route::post('dang-ky-khuyen-mai',['as'=>'dang-ky-khuyen-mai','uses'=>'PageController@postDangKyKhuyenMai']);
//comment
Route::post('send-comment',['as'=>'send-comment','uses'=>'AccountController@postSendComment']);

//quen mat khau
Route::get('quen-mat-khau',['as'=>'quen-mat-khau','uses'=>'AccountController@getQuenMatKhau']);
Route::post('quen-mat-khau',['as'=>'quen-mat-khau','uses'=>'AccountController@postQuenMatKhau']);
Route::get('password-reset',['as'=>'passwordreset','uses'=>'AccountController@getResetPassword']);
Route::post('password-reset',['as'=>'password-reset','uses'=>'AccountController@postResetPassword']);

Route::group(['prefix'=>'ajax'],function(){
	Route::get('district/{province_id}','AddressController@getDistrict');

	Route::get('ward/{district_id}','AddressController@getWard');
});
Route::fallback(function(){
    return view('page.errors');
});


//PHAN ADMIN


Route::get('admin/dangnhap','UserController@getDangNhapAdmin');
Route::post('admin/dangnhap','UserController@postDangNhapAdmin');
Route::get('admin/logout','UserController@getDangXuatAdmin');

Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){

	Route::group(['prefix'=>'ProductType'],function(){
		//admin/ProducType/danhsach
		Route::get('danhsach','ProductTypeController@getDanhSach');

		Route::get('sua/{id}','ProductTypeController@getSua');//goi trang sửa lên
		Route::post('sua/{id}','ProductTypeController@postSua'); //gửi DL lên

		Route::get('them','ProductTypeController@getThem');
		Route::post('them','ProductTypeController@postThem');

		Route::get('xoa/{id}','ProductTypeController@getXoa');
	});
	Route::group(['prefix'=>'Product'],function(){

		Route::get('danhsach','ProductController@getDanhSach');

		Route::get('sua/{id}','ProductController@getSua');//goi trang sửa lên
		Route::post('sua/{id}','ProductController@postSua'); //gửi DL lên

		Route::get('them','ProductController@getThem');
		Route::post('them','ProductController@postThem');

		Route::get('xoa/{id}','ProductController@getXoa');
		Route::get('het-hang/{id}','ProductController@getHetHang');
		Route::get('con-hang/{id}','ProductController@getConHang');
		Route::get('ngung-kinh-doanh/{id}','ProductController@getNgungKinhDoanh');

	});
	Route::group(['prefix'=>'nguoidung'],function(){

		Route::get('danhsach','UserController@getDanhSach');

		Route::get('sua/{id}','UserController@getSua');
		Route::post('sua/{id}','UserController@postSua');

		Route::get('them','UserController@getThem');
		Route::post('them','UserController@postThem');

		Route::get('xoa/{id}','UserController@getXoa');
	});
	Route::group(['prefix'=>'Bill'],function(){
		Route::get('danhsach','BillController@getDanhSach');
		Route::get('billdetail/{id}','BillController@getBillDetail');
		Route::get('xacnhan/{id}','BillController@getXacNhan');
		Route::get('huybill/{id}','BillController@getXoa');
		Route::get('lichsudonhang','BillController@getLichSu');
	});
	Route::group(['prefix'=>'Slide'],function(){

		Route::get('danhsach','SlideController@getDanhSach');

		Route::get('sua/{id}','SlideController@getSua');
		Route::post('sua/{id}','SlideController@postSua');

		Route::get('them','SlideController@getThem');
		Route::post('them','SlideController@postThem');

		Route::get('xoa/{id}','SlideController@getXoa');
	});
	Route::group(['prefix'=>'tintuc'],function(){

		Route::get('danhsach','TinTucController@getDanhSach');

		Route::get('sua/{id}','TinTucController@getSua');
		Route::post('sua/{id}','TinTucController@postSua');

		Route::get('them','TinTucController@getThem');
		Route::post('them','TinTucController@postThem');

		Route::get('xoa/{id}','TinTucController@getXoa');
	});
	Route::group(['prefix'=>'Comments'],function(){

		Route::get('danhsach','CommentsController@getDanhSach');
		Route::get('danhsachnhankhuyenmai','CommentsController@getDanhSachNhanKhuyenMai');
		Route::get('xacnhan/{id}','CommentsController@getXacNhan');
		Route::get('xacnhankhuyenmai/{id}','CommentsController@getXacNhanKhuyenMai');
		Route::get('xoa/{id}','CommentsController@getXoa');

	});
	Route::group(['prefix'=>'Brand'],function(){
		Route::get('danhsach','BrandController@getDanhSach');

		Route::get('sua/{id}','BrandController@getSua');
		Route::post('sua/{id}','BrandController@postSua');

		Route::get('them','BrandController@getThem');
		Route::post('them','BrandController@postThem');

		Route::get('xoa/{id}','BrandController@getXoa');
	});
});
