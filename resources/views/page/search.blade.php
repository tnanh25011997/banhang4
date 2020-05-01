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
				<?php 
				    $arrSaleImg = json_decode($sp->image,true);
				?>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="motsanpham2">
						<div class="anh2">
							<img src="source/images/{{$arrSaleImg[0]}}" alt="" class="img-fluid">
							<div class="haiicon2">
								@if($sp->status==1)
								<a href="gio-hang/{{$sp->id}}" data-placement="top" data-toggle="tooltip" title="Thêm vào giỏ"><i class="fas fa-shopping-cart iconnho icon-shopping-cart"></i></a>
								@endif
								<a href="chi-tiet-san-pham/{{$sp->slug}}" data-placement="top" data-toggle="tooltip" title="Xem chi tiết"><i class="fas fa-align-center iconnho"></i></a>
							</div>
						</div>
						<div class="thongtin2">
							<div class="ten2"><a href="chi-tiet-san-pham/{{$sp->slug}}">{{$sp->name}}</a></div>
							@if($sp->promotion_price==$sp->unit_price)
							    <div class="gia2"><p style="text-decoration: none;">{{$sp->unit_price}}đ</p></div>
							@else
								<div class="flag-sale">SALE <div class="fold"></div></div>
								<div class="number-sale">-{{round($sp->sale)}}%</div>
							    <div class="gia2"><p>{{$sp->unit_price}}đ</p></div>
							    <div class="gia2km"><p>{{$sp->promotion_price}}đ</p></div>
							@endif
							@if($sp->rate!=null && $sp->rate!=0)
								<div class="rating-pro-page">
									<?php for($i=1; $i<=$sp->rate; $i++){ ?>
	    								<i class="fas fa-star" style="color: #ffc120"></i>
	    							<?php } ?>
	    							<?php for($i=1; $i<=5-$sp->rate; $i++){ ?>
	    								<i class="fas fa-star" style="color: grey"></i>
	    							<?php } ?>
								</div>
							@endif
						</div>
					</div>

				</div>
				@endforeach
				
			</div>
			<div class="row" style="">{{$product->links()}}</div>
			
		</div>
		

</div>
@endsection()