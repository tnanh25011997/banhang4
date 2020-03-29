@extends('master')
@section('title', 'Giới Thiệu')
@section('content')
<div class="noidungsanpham">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-12">
					<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
							    <li class="breadcrumb-item active" aria-current="page">Chính Sách Bảo Mật</li>
							    
						    </ol>
					    </nav>
					</div>
					<div class="noidunggioithieu">
						<h3 style="text-align: center;">CHÍNH SÁCH BẢO MẬT</h3>
						<b>1. Mục đích và phạm vi thu thập</b>
						<p>Việc thu thập dữ liệu chủ yếu trên Sàn TMĐT Ánh Store bao gồm: email, điện thoại, tên đăng nhập, mật khẩu đăng nhập, địa chỉ Khách hàng. Đây là các thông tin mà Ánh Store cần Khách hàng cung cấp bắt buộc khi đăng ký sử dụng dịch vụ và Ánh Store sử dụng nhằm liên hệ xác nhận khi Khách hàng đăng ký sử dụng dịch vụ trên Ánh Store, đảm bảo quyền lợi cho Khách hàng.</p>
						<p>Các Khách hàng sẽ tự chịu trách nhiệm về bảo mật và lưu giữ mọi hoạt động sử dụng dịch vụ dưới tên đăng ký, mật khẩu và hộp thư điện tử của mình. Ngoài ra, Khách hàng có trách nhiệm thông báo kịp thời cho Sàn TMĐT Ánh Store về những hành vi sử dụng trái phép, lạm dụng, vi phạm bảo mật, lưu giữ tên đăng ký và mật khẩu của bên thứ ba để có biện pháp giải quyết phù hợp.</p>
						<b>2. Phạm vi sử dụng thông tin</b>
						<p>Sàn TMĐT Ánh Store sử dụng thông tin Khách hàng cung cấp để:</p>
						<ul>
							<li>Cung cấp các dịch vụ đến Khách hàng.</li>
							<li>Gửi các thông báo về các hoạt động trao đổi thông tin giữa Khách hàng và Sàn TMĐT vn.</li>
							<li>Liên lạc và giải quyết với khách hàng trong những trường hợp đặc biệt.</li>
							<li>Không sử dụng thông tin cá nhân của Khách hàng ngoài mục đích xác nhận và liên hệ có liên quan đến giao dịch tại Ánh Store.</li>
						</ul>
						<b>3. Thời gian lưu trữ thông tin</b>
						<p>Dữ liệu cá nhân của Khách hàng sẽ được lưu trữ cho đến khi có yêu cầu hủy bỏ hoặc tự Khách hàng đăng nhập và thực hiện hủy bỏ. Còn lại trong mọi trường hợp thông tin cá nhân Khách hàng sẽ được bảo mật trên máy chủ của Ánh Store.</p>
					</div>
					
				</div>
				
				<div class="col-lg-3 col-12">
					<div class="sanphamkhuyenmai">
						<div class="list-group">
							<p href="#" class="list-group-item list-group-item-action tendanhmuc">SẢN PHẨM KHUYẾN MÃI</p>
							@foreach($sale_product as $sp)
							<a href="chi-tiet-san-pham/{{$sp->slug}}">
							<div class="list-group-item list-group-item-action motsanpham">
								<div class="row">
									<div class="col-5" style="text-align: right;"><img src="source/images/{{$sp->image}}"  alt="" class="img-fluid"></div>
									<div class="col-7 thongtin">
										<p class="tensp">{{$sp->name}}</p>
										<p class="gia">{{number_format($sp->unit_price)}}đ</p>
										<p class="giakm">{{number_format($sp->promotion_price)}}đ</p>
									</div>
								</div>

							</div>
							</a>
							@endforeach
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
