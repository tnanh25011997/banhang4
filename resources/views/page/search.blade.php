@extends('master')
@section('title', 'Sản Phẩm')
@section('content')
<div class="danhsachsanpham">
		<div class="container">
			
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb bread2">
					<li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
					<li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
				</ol>
			</nav>
			<h2>Tìm Kiếm Được : {{count($product)}} Sản Phẩm </h2>
			<hr>
			<div class="row">
				@foreach($product as $sp)
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="motsanpham2">
						<div class="anh2">
							<img src="source/images/{{$sp->image}}" alt="" class="img-fluid">
							<div class="haiicon2">
								<a href="gio-hang/{{$sp->id}}" data-placement="top" data-toggle="tooltip" title="Thêm vào giỏ"><i class="fas fa-shopping-cart iconnho"></i></a>
								<a href="chi-tiet-san-pham/{{$sp->slug}}" data-placement="top" data-toggle="tooltip" title="Xem chi tiết"><i class="fas fa-align-center iconnho"></i></a>
							</div>
						</div>
						<div class="thongtin2">
							<div class="ten2"><a href="chi-tiet-san-pham/{{$sp->slug}}">{{$sp->name}}</a></div>
							@if($sp->promotion_price==$sp->unit_price)
							    <div class="gia2"><p style="text-decoration: none;">{{$sp->unit_price}}đ</p></div>
							@else
							    <div class="gia2"><p>{{$sp->unit_price}}đ</p></div>
							    <div class="gia2km"><p>{{$sp->promotion_price}}đ</p></div>
							@endif
						</div>
					</div>

				</div>
				@endforeach
				
			</div>
			
		</div>
		

</div>
@endsection()