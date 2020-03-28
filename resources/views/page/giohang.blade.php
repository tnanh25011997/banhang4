@extends('master')
@section('title', 'Giỏ Hàng')
@section('content')
<div class="noidunggiohang" id="noidunggiohang">
		<div class="container" id="ndgh">
			<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
							
							    <li class="breadcrumb-item active" aria-current="page">Giỏ Hàng</li>
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
			@if(Session::has('cart'))
			<div class="khoibieutuong">
				<div class="motbieutuong">
					<p><i class="fas fa-shopping-cart"></i></p>
					<p>Giỏ hàng của tôi</p>
					<div class="sothutu">1</div>
				</div>
				<div class="motbieutuong motbieutuong2">
					<p><i class="fas fa-dollar-sign"></i></p>
					<p>Thanh Toán</p>
					<div class="sothutu">2</div>
				</div>
				<div class="motbieutuong motbieutuong2">
					<p><i class="fas fa-check"></i></p>
					<p>Hoàn Tất</p>
					<div class="sothutu">3</div>
				</div>
			</div>
			<div class="banggiohang">
				<table class="table table-hover">
					<thead class="threadgiohang">
						<tr>
							<th>SẢN PHẨM</th>
							<th class="anhgiohangth">HÌNH ẢNH</th>
							<th>GIÁ</th>
							<th>SỐ LƯỢNG</th>
							<th>THÀNH TIỀN</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						
							@foreach($product_cart as $item)
								<tr>
									<td>{{$item['item']['name']}}</td>
									<td class="anhgiohangtd"><img  src="source/images/{{$item['item']['image']}}" alt="" class="anhgiohang"></td>
									@if($item['item']['promotion_price'] == $item['item']['unit_price'])
										<td class="giagiohang">{{number_format($item['item']['unit_price'])}}đ</td>
									@else
										<td class="giagiohang">{{number_format($item['item']['promotion_price'])}}đ</td>
									@endif
									<td class="quantity-cart">
										<form action="update-giohang" method="post">
											@csrf
											<input type="hidden" value="{{$item['item']['id']}}" name="idsp">
										    <input type="number" onchange="updateItem(<?php echo $item['item']['id'] ?>)" class="inputgiohang" min="0" max="20" value="{{$item['qty']}}" id="num_<?php echo $item['item']['id'] ?>" name="soluong">
										    <input type="hidden" value="Cập Nhật">
										</form>
									</td>
									<td class="giagiohang">
									
									{{number_format($item['price'])}}đ
									</td>
									<td><a href="xoa-gio/{{$item['item']['id']}}"><i class="fas fa-trash-alt icontrash"></i></a></td>
								</tr>
							@endforeach
						
						
						
					</tbody>
				</table>
			</div>
			<div class="tongtien">
				<div class="row">
					<div class="col-xl-8 col-lg-6"></div>
					<div class="col-xl-4 col-lg-6">
						<div class="tongthanhtoan">
							<span>Tổng Thanh Toán : </span>
							<span class="tongtien">{{number_format($totalPrice)}}Đ</span>
						</div>
						
					</div>
				</div>
				
				<div class="row muahangthanhtoan">
						<div class="col-xl-6 col-lg-5 col-md-3">
							
						</div>
						<div class="col-xl-6 col-lg-7 col-md-9">
								<div class="row">
									<div class="col-sm-6 chuamuahang">
										<a href="home"><div class="btn btn-light nutttmuahang">TIẾP TỤC MUA HÀNG</div></a>
									</div>
									<div class="col-sm-6 chuathanhtoan">
										<a href="thanh-toan"><span class="btn btn-light nutttthanhtoan">TIẾN HÀNH THANH TOÁN</span></a>
									</div>

								</div>			
						</div>	
				</div>			
			</div>
			@else
			<div style="text-align: center;">
				<img src="source/images/mascot.png" alt="" style="margin-bottom: 20px;">
				<p>Không có sản phẩm nào trong giỏ hàng của bạn.</p>
				<a href="home"><button class="btn btn-primary" style="margin-bottom: 100px; background: #7AAEDD; border: 1px solid #7AAEDD;">Tiếp Tục Mua Sắm</button></a>
			</div>
			@endif

		</div>
</div>

@endsection()