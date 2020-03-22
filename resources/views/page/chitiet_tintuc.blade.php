@extends('master')
@section('title')
	{{$tin->title}}
@endsection
@section('content')
<div class="noidungsanpham">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-12">
					<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
							    <li class="breadcrumb-item"><a href="tintuc">Tin Tức</a></li>
							    <li class="breadcrumb-item active" aria-current="page">{{$tin->title}}</li>
							    
						    </ol>
					    </nav>
					</div>
					<div class="h3" style="margin-bottom: 0px;">TIN TỨC</div>
					<div class="noidungtintuc2">
						<h3 class="tieude">{{$tin->title}}</h3>
						<div class="highlight"><p>{!!$tin->highlight!!}</p></div>
						<div class="anhtin"><img src="source/images/{{$tin->image}}" alt="" class="img-fluid" style="width: 800px;"></div>
						<p>{!!$tin->content!!}</p>
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
									<div class="col-5" style="text-align: right;"><img src="source/images/{{$sp->image}}" alt="" class="img-fluid"></div>
									<div class="col-7 thongtin">
										<p class="tensp">{{$sp->name}}</p>
										<p class="gia">{{$sp->unit_price}}đ</p>
										<p class="giakm">{{$sp->promotion_price}}đ</p>
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