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
							    <li class="breadcrumb-item active" aria-current="page">Giao Hàng Và Đổi Trả</li>
							    
						    </ol>
					    </nav>
					</div>
					<div class="noidunggioithieu">
						<h3 style="text-align: center;">GIAO HÀNG VÀ ĐỔI TRẢ</h3>
						<b>1. Đối Tác Giao Hàng</b>
						<p>Giao Hàng Nhanh/ Giao Hàng Tiết Kiệm</p>
						<b>2. Chính sách đổi trả</b>
						<p>Chúng tôi chấp nhận đổi trả nếu hàng bán ra lỗi thuộc về chúng tôi hoặc đơn vị vận chuyển, nếu lỗi thuộc về khách hàng, chúng tôi không chấp nhận đổi trả.</p>
						<p>Sản phẩm bán ra chỉ có thể đổi trả trong vòng 3 ngày kể từ ngày nhận hàng, quá thời gian trên, chúng tôi không chịu trách nhiệm</p>
						<p>Liên hệ chăm sóc khách hàng để được hướng dẫn đổi trả hàng</p>
						<p>Chăm sóc khách hàng: 0384795999</p>
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
