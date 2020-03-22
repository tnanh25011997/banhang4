@extends('master')
@section('title', 'Hoàn Tất')
@section('content')
<div class="noidunggiohang">
		<div class="container">
			<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
							
							    <li class="breadcrumb-item active" aria-current="page">Hoàn Tất</li>
						    </ol>
					    </nav>
			</div>
			<div class="row">
				<div class="col-sm-2">
					<div class="thanhngang"></div>
				</div>
				<div class="col-sm-10">
					
				</div>
			</div>
			<div class="giohangcuatoi"><p>GIỎ HÀNG CỦA TÔI</p></div>
			<hr>
			<div class="khoibieutuong">
				<div class="motbieutuong">
					<p><i class="fas fa-shopping-cart"></i></p>
					<p>Giỏ hàng của tôi</p>
					<div class="sothutu">1</div>
				</div>
				<div class="motbieutuong ">
					<p><i class="fas fa-dollar-sign"></i></p>
					<p>Thanh Toán</p>
					<div class="sothutu">2</div>
				</div>
				<div class="motbieutuong ">
					<p><i class="fas fa-check"></i></p>
					<p>Hoàn Tất</p>
					<div class="sothutu">3</div>
				</div>
			</div>
			<div class="thongbaohoantat">
				<h4>Quý khách đã đặt hàng thành công!</h4>
				<p>Chúng tôi sẽ liên hệ để xác nhận đơn hàng trong thời gian sớm nhất</p>
				<a href="{{route('trang-chu')}}"><button class="btn btn-primary nutttmuasam">Tiếp Tục Mua Sắm</button></a>
			</div>

			

		</div>
</div>
@endsection()