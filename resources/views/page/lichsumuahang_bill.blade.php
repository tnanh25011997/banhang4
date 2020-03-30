@extends('master')
@section('title', 'Lịch Sử Mua Hàng')
@section('content')
<div class="noidunggiohang">
		<div class="container">
			<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
							
							    <li class="breadcrumb-item active" aria-current="page">Lịch Sử Mua Hàng</li>
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
			<div class="giohangcuatoi"><p>LỊCH SỬ MUA HÀNG</p></div>
			<hr>
			@if(sizeof($bill)==0)
				<p>Quý khách chưa có đơn hàng nào, hãy mua sắm nhé!</p>
			@else
			<div class="banggiohang">
				<table class="table table-hover">
					<thead class="threadgiohang">
						<tr>
							<th>ID</th>
							<th>Ngày Đặt Hàng</th>
							<th>Tổng Tiền</th>
							<th>Hình Thức Thanh Toán</th>
							<th>Tình Trạng</th>
							<th>Chi Tiết</th>
						</tr>
					</thead>
					<tbody>
						@foreach($bill as $b)
						<tr>
							<td>{{$b->id}}</td>
							<td>{{$b->date_order}}</td>
							<td>{{number_format($b->total)}}đ</td>
							<td>{{$b->payment}}</td>
							<td>
								<?php if($b->tinhtrang==0){
									echo "Chưa Thanh Toán";
								}
								else{
									echo "Đã Thanh Toán";
								}
								?>
								
							</td>
							<td><a href="tai-khoan/lichsumuahang_billdetail/{{$b->id}}"><button style="background-color:#7AAEDD;border: 1px solid #7AAEDD;" class="btn btn-primary">Chi Tiết</button></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			@endif
		</div>
</div>
	
@endsection()