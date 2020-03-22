@extends('master')
@section('title', 'Tin Tức')
@section('content')
<div class="noidungsanpham">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-12">
					<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
							    <li class="breadcrumb-item active" aria-current="page">Tin Tức</li>
							    
						    </ol>
					    </nav>
					</div>
					<div class="h3" style="margin-bottom: 0px;">TIN TỨC</div>
					<div class="noidungtintuc">
						@foreach($tin as $t)
						<div class="mottin">
							<a href="chitiet-tintuc/{{$t->id}}">
							<div class="anhtin">
								<img src="source/images/{{$t->image}}" style="width: 300px; height: 200px;" alt="">
							</div>
							</a>
							<a href="chitiet-tintuc/{{$t->id}}"><div class="tieudetin"> <h5>{{$t->title}}</h5></div></a>
							<div class="highlight">{{$t->highlight}}</div>
						</div>
						@endforeach
						<div class="row " style="">{{$tin->links()}}</div>
						
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