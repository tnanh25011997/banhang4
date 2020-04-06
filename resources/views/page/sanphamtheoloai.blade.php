@extends('master')
@section('title', 'Sản Phẩm')
@section('content')
<div class="danhsachsanpham">
		<div class="container">
			
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb bread2">
					<li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
					<li class="breadcrumb-item active" aria-current="page">Sản Phẩm</li>
				</ol>
			</nav>
			<div class="row">
				<div class="col-sm-6">
					<h4>Sản phẩm loại :  {{$tenloai->name}}</h4>
				</div>
				<div class="col-sm-6">
					<div style="text-align: right; margin-top: 15px;" class="sort-by">
						<form method="get" id="form-order">
							<span>Sắp xếp theo:</span>
							<select name="orderby" class="order-product">
								<option {{Request::get('orderby')=="id-asc"?"selected='selected'":""}} value="id-asc">Mặc định</option>
								<option {{Request::get('orderby')=="created-descending"?"selected='selected'":""}} value="created-descending">Mới nhất</option>
								<option {{Request::get('orderby')=="created-ascending"?"selected='selected'":""}} value="created-ascending">Cũ nhất</option>
								<option {{Request::get('orderby')=="price-ascending"?"selected='selected'":""}} value="price-ascending">Giá: Tăng dần</option>
								<option {{Request::get('orderby')=="price-descending"?"selected='selected'":""}} value="price-descending">Giá: Giảm dần</option>
								<option {{Request::get('orderby')=="name-ascending"?"selected='selected'":""}} value="name-ascending">Tên: A-Z</option>
								<option {{Request::get('orderby')=="name-descending"?"selected='selected'":""}} value="name-descending">Tên: Z-A</option>
							</select>
						</form>
					</div>
				</div>
			</div>
			
			<hr>
			<div class="row">
				<div class="col-lg-3">
					<div class="filter-by-price">
						<h5><i class="fas fa-filter"></i> <span>Lọc khoảng giá</span></h5>
						<ul>
							<li><a class="{{ Request::get('price') == 1 ?'active':''}}" href="{{ request()->fullUrlWithQuery(['price' => 1,'page'=>1]) }}"> Dưới 200.000 đ</a></li>
							<li><a class="{{ Request::get('price') == 2 ?'active':''}}" href="{{ request()->fullUrlWithQuery(['price' => 2,'page'=>1]) }}"> 200.000 - 400.000 đ</a></li>
							<li><a class="{{ Request::get('price') == 3 ?'active':''}}" href="{{ request()->fullUrlWithQuery(['price' => 3,'page'=>1]) }}"> 400.000 - 600.000 đ</a></li>
							<li><a class="{{ Request::get('price') == 4 ?'active':''}}" href="{{ request()->fullUrlWithQuery(['price' => 4,'page'=>1]) }}"> 600.000 - 800.000 đ</a></li>
							<li><a class="{{ Request::get('price') == 5 ?'active':''}}" href="{{ request()->fullUrlWithQuery(['price' => 5,'page'=>1]) }}"> 800.000 - 1.000.000 đ</a></li>
							<li><a class="{{ Request::get('price') == 6 ?'active':''}}" href="{{ request()->fullUrlWithQuery(['price' => 6,'page'=>1]) }}"> Trên 1.000.000 đ</a></li>
						</ul>
					</div>
					<div class="list-category-product-page">
						<ul>
							<p>DANH MỤC SẢN PHẨM</p>
							@foreach($danhmuc as $danh)
							<a href="san-pham-theo-loai/{{$danh->slug}}"><li><?php if($danh->gender==0) echo '<i class="fas fa-venus" style="color:#ef77a0;"></i>'; else echo '<i class="fas fa-mars" style="color:#2196f3;"></i>' ?>&nbsp;&nbsp;{{$danh->name}}</li></a>
							@endforeach
						</ul>
					</div>
					<div class="list-category-product-page">
						<ul>
							<p>THƯƠNG HIỆU</p>
							@foreach($brand as $br)
							<a href="thuong-hieu/{{$br->slug}}"><li>{{$br->name}}</li></a>
							@endforeach
						</ul>
					</div>
				</div>
				<div class="col-lg-9">
					<div class="row">
						@foreach($loai_sanpham as $sp)
						<div class="col-lg-4 col-md-6 col-sm-6">
							<div class="motsanpham2">
								<div class="anh2">
									<img src="source/images/{{$sp->image}}" alt="" class="img-fluid">
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
									    <div class="gia2"><p style="text-decoration: none;">{{number_format($sp->unit_price)}}đ</p></div>
									@else
										<div class="flag-sale">SALE <div class="fold"></div></div>
										<div class="number-sale">-{{round($sp->sale)}}%</div>
									    <div class="gia2"><p>{{number_format($sp->unit_price)}}đ</p></div>
									    <div class="gia2km"><p>{{number_format($sp->promotion_price)}}đ</p></div>
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
					<div class="row" style="">{{$loai_sanpham->links()}}</div>
				</div>
				
				
			</div>
			
		</div>
		

</div>
@endsection()
@section('script')
	<script>
		$(document).ready(function() {
			$('.order-product').change(function() {
				$("#form-order").submit();
			});
		});
	</script>
@endsection()