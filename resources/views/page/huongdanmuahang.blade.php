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
							    <li class="breadcrumb-item active" aria-current="page">Hướng Dẫn Mua Hàng</li>
							    
						    </ol>
					    </nav>
					</div>
					<div class="noidunggioithieu">
						<h3 style="text-align: center;">HƯỚNG DẪN MUA HÀNG</h3>
						<p>B1: Chọn loại hàng cần mua</p>
						<p>B2: Click nút Thêm vào giỏ hàng</p>
						<p>B3: Đi đến giỏ hàng</p>
						<p>B4: Tiến hành thanh toán</p>
						<p>B5: Điền đầy đủ thông tin</p>
						<p>B6: Đặt hàng thành công</p>
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
