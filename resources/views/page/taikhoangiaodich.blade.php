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
							    <li class="breadcrumb-item active" aria-current="page">Tài Khoản Giao Dịch</li>
							    
						    </ol>
					    </nav>
					</div>
					<div class="noidunggioithieu">
						<h3 style="text-align: center;">TÀI KHOẢN GIAO DỊCH</h3>
						<p>STK : 23213245648</p>
						<p>Tên : Trần Ngọc Ánh</p>
						<p>Ngân Hàng Công Thương Việt Nam</p>
					</div>
					
				</div>
				
				<div class="col-lg-3 col-12">
					<div class="sanphamkhuyenmai">
						<div class="list-group">
							<p href="#" class="list-group-item list-group-item-action tendanhmuc">SẢN PHẨM KHUYẾN MÃI</p>
							@foreach($sale_product as $sp)
							<?php 
				    			$arrSaleImg = json_decode($sp->image,true);
				    		?>
							<a href="chi-tiet-san-pham/{{$sp->slug}}">
							<div class="list-group-item list-group-item-action motsanpham">
								<div class="row">
									<div class="col-5" style="text-align: right;"><img src="source/images/{{$arrSaleImg[0]}}"  alt="" class="img-fluid"></div>
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
