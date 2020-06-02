@extends('master')
@section('title', 'Ánh Store')
@section('content')
@if(session('thongbao'))
    <div class="alert alert-success" style="text-align: center;">{{session('thongbao')}}</div>
@endif
@if($errors->has('txtsdtkhuyenmai') || $errors->has('txtemailkhuyenmai'))
    <div class="alert alert-danger" style="text-align: center;">
        @foreach($errors->all() as $err)
            {{$err}}<br>
        @endforeach
    </div>
@endif
<div class="noidungtren">
		
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					
					<div class="sanphamkhuyenmai">
						<div class="list-group">
							<p href="#" class="list-group-item list-group-item-action tendanhmuc">SẢN PHẨM MỚI</p>
							@foreach($new_product as $new)
							<?php $arrNewImg = json_decode($new->image,true); ?>
							<a href="chi-tiet-san-pham/{{$new->slug}}">
							<div class="list-group-item list-group-item-action motsanpham">
								<div class="container">
								<div class="row">
									<div class="col-5" style="text-align: right;"><img src="source/images/{{$arrNewImg[0]}}" alt="" class="img-fluid"></div>
									<div class="col-7 thongtin">
										<p class="tensp">{{$new->name}}</p>
										@if($new->promotion_price==$new->unit_price)
										   <p class="gia" style="text-decoration: none;">{{number_format($new->unit_price)}}đ</p>
										   
										@else
										    <p class="gia">{{number_format($new->unit_price)}}đ</p>
										    <p class="giakm">{{number_format($new->promotion_price)}}đ</p>
										@endif
									</div>
								</div>
								</div>

							</div>
							</a>
							@endforeach
							
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					@include('page.slide')
				</div>
				<div class="col-lg-3">
					<div class="sanphamkhuyenmai">
						<div class="list-group">
							<p href="#" class="list-group-item list-group-item-action tendanhmuc">SẢN PHẨM KHUYẾN MÃI</p>
							@foreach($sale_product as $sale)
							<?php $arrSalenImg = json_decode($sale->image,true); ?>
							<a href="chi-tiet-san-pham/{{$sale->slug}}">
							<div class="list-group-item list-group-item-action motsanpham">
								<div class="container">
								<div class="row">
									<div class="col-5" style="text-align: right;"><img src="source/images/{{$arrSalenImg[0]}}" alt="" class="img-fluid"></div>
									<div class="col-7 thongtin">
										<p class="tensp">{{$sale->name}}</p>
										<p class="gia">{{number_format($sale->unit_price)}}đ</p>
										<p class="giakm">{{number_format($sale->promotion_price)}}đ</p>
									</div>
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
	<div class="fashion_sale">
		<div class="container">
			<img src="source/images/fashion_sale.jpg" alt="">
		</div>
	</div>
	<div class="thoitrang">
		<div class="container">
			<div class="thoitrang2">
			    <div class="row">
				    <div class="col-lg-3 bentrai">
					    <div class="phanbentrai">
						    <div class="list-group">
							    <p href="#" class="list-group-item list-group-item-action tenthoitrang"><span class="iconthoitrang"><i class="fas fa-female"></i></span></i></span>MỸ PHẨM NỮ</p>
							    @foreach($myphamnu as $nu)
							    <a href="san-pham-theo-loai/{{$nu->slug}}" class="list-group-item list-group-item-action motthoitrang">{{$nu->name}}</a>
							    @endforeach
						    </div>
					    </div>
				    </div>
				    <div class="col-lg-6">
					    <div class="cacsanpham">
					    	<div class="row">
					    		@foreach($sanpham_nu as $spnu)
					    		<?php $arrFemaleImg = json_decode($spnu->image,true); ?>
					    		<div class="col-sm-4">
					    			<div class="motsanpham">
					    				<div class="anh">
					    				    <img src="source/images/{{$arrFemaleImg[0]}}" alt="" class="img-fluid">
					    				    
					    				    <div class="haiicon">
					    				    	@if($spnu->status==1 && $spnu->color==null)
					    				    	<a href="gio-hang/{{$spnu->id}}" data-placement="top" data-toggle="tooltip" title="Thêm vào giỏ"><i class="fas fa-shopping-cart iconnho"></i></a>
					    				    	@endif
					    				    	<a href="chi-tiet-san-pham/{{$spnu->slug}}" class="tooltest" data-placement="top" data-toggle="tooltip" title="Xem chi tiết"><i class="fas fa-align-center iconnho"></i></a>
					    				    </div>
					    				    
					    				    
					    				</div>
					    				<div class="thongtin">
					    					<div class="ten"><a href="chi-tiet-san-pham/{{$spnu->slug}}">{{$spnu->name}}</a></div>
					    					@if($spnu->promotion_price==$spnu->unit_price)
					    					    <div class="gia" style="text-decoration: none"><p>{{number_format($spnu->unit_price)}}đ</p></div>
					    					@else
					    						<div class="flag-sale main-page">SALE <div class="fold"></div></div>
												<div class="number-sale main-page">-{{round($spnu->sale)}}%</div>
					    					    <div class="gia"><p>{{number_format($spnu->unit_price)}}đ</p></div>
					    					    <div class="giakm"><p>{{number_format($spnu->promotion_price)}}đ</p></div>
					    					@endif
					    				</div>
					    			</div>
					    		</div>
					    		@endforeach
					    	
					    	</div>
					    </div>
				    </div>
				    <div class="col-lg-3 benphai">
					    <img src="source/images/anhbenphai.jpg" alt="" class="img-fluid">
				    </div>
			    </div>
			</div>
		</div>
	</div>

	<div class="thoitrangtt">
		<div class="container">
			<div class="thoitrang2">
			    <div class="row">
				    <div class="col-lg-3 bentrai">
					    <div class="phanbentrai">
						    <div class="list-group">
							    <p href="#" class="list-group-item list-group-item-action tenthoitrang"><span class="iconthoitrang"><i class="fas fa-heart"></i></span></i></span>MỸ PHẨM NAM</p>
							    @foreach($myphamnam as $nam)
							    <a href="san-pham-theo-loai/{{$nam->slug}}" class="list-group-item list-group-item-action motthoitrang">{{$nam->name}}</a>
							    @endforeach
							    
						    </div>
					    </div>
				    </div>
				    <div class="col-lg-6">
					    <div class="cacsanpham">
					    	<div class="row">
					    		@foreach($sanpham_nam as $spnam)
					    		<?php $arrMaleImg = json_decode($spnam->image,true); ?>
					    		<div class="col-sm-4">
					    			<div class="motsanpham">
					    				<div class="anh">
					    				    <img src="source/images/{{$arrMaleImg[0]}}" alt="" class="img-fluid">
					    				    <div class="haiicon">
					    				    	@if($spnam->status==1 && $spnam->color==null)
					    				    	<a href="gio-hang/{{$spnam->id}}"  data-placement="top" data-toggle="tooltip" title="Thêm vào giỏ"><i class="fas fa-shopping-cart iconnho"></i></a>
					    				    	@endif
					    				    	<a href="chi-tiet-san-pham/{{$spnam->slug}}" class="tooltest" data-placement="top" data-toggle="tooltip" title="Xem chi tiết"><i class="fas fa-align-center iconnho"></i></a>
					    				    </div>
					    				</div>
					    				<div class="thongtin">
					    					<div class="ten"><a href="chi-tiet-san-pham/{{$spnam->slug}}">{{$spnam->name}}</a></div>
					    					@if($spnam->promotion_price==$spnam->unit_price)
					    					    <div class="gia" style="text-decoration: none;"><p>{{number_format($spnam->unit_price)}}đ</p></div>
					    					@else
					    						<div class="flag-sale main-page">SALE <div class="fold"></div></div>
												<div class="number-sale main-page">-{{round($spnam->sale)}}%</div>
					    					    <div class="gia"><p>{{number_format($spnam->unit_price)}}đ</p></div>
					    					    <div class="giakm"><p>{{number_format($spnam->promotion_price)}}đ</p></div>
					    					@endif
					    				</div>
					    			</div>
					    		</div>
					    		@endforeach
					    	</div>
					    </div>
				    </div>
				    <div class="col-lg-3 benphai">
					    <img src="source/images/anhbenphai2.png" alt="" class="img-fluid">
				    </div>
			    </div>
			</div>
		</div>
	</div>
	<div class="owl">
		<div class="container">
			<div class="thuonghieu">
				<h3>THƯƠNG HIỆU ĐƯỢC PHÂN PHỐI</h3>
			</div>
			<div class="owl-carousel owl-theme" style="margin: 0 auto;">
			    <div class="item"><img src="source/images/owl1.png" alt=""></div>
			    <div class="item"><img src="source/images/owl2.png" alt=""></div>
			    <div class="item"><img src="source/images/owl3.png" alt=""></div>
			    <div class="item"><img src="source/images/owl4.png" alt=""></div>
			    <div class="item"><img src="source/images/owl5.png" alt=""></div>
			    <div class="item"><img src="source/images/owl6.png" alt=""></div>
			</div>
		</div>
	</div>
	<div class="dangkykhuyenmai">
		<div class="dangkynhantin">
			<h3 style="color: #7AAEDD">ĐĂNG KÝ NHẬN TIN KHUYẾN MÃI</h3>
			<form action="dang-ky-khuyen-mai" method="post">
				@csrf
			  <div class="form-group">
			    <input type="email" required style="width: 40%; margin: 0 auto;" class="form-control" name="txtemailkhuyenmai" placeholder="Email">
			  </div>
			  <div class="form-group">
			    <input type="text" required style="width: 40%; margin: 0 auto;" class="form-control" name="txtsdtkhuyenmai" placeholder="Số điện thoại...">
			  </div>
			  <button type="submit" class="btn btn-primary">Đăng Ký</button>
			</form>	
		</div>		
	</div>
@endsection()