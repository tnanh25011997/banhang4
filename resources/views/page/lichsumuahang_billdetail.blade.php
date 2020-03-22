@extends('master')
@section('title', 'Chi Tiết Đơn Hàng')
@section('content')
<div class="noidunggiohang">
		<div class="container">
			<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
								<li class="breadcrumb-item"><a href="tai-khoan/lichsumuahang_bill/{{Auth::user()->id}}">Lịch Sử Mua Hàng</a></li>
							    <li class="breadcrumb-item active" aria-current="page">Chi Tiết Hóa Đơn</li>
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
			<div class="giohangcuatoi"><p>CHI TIẾT HÓA ĐƠN {{$bill->id}} </p></div>
			<hr>
			<div class="banggiohang">
				<table class="table table-hover">
					<thead class="threadgiohang">
						<tr>
							<th>ID</th>
							<th>Tên Sản Phẩm</th>
							<th>Số Lượng</th>
							<th>Đơn Giá</th>
						</tr>
					</thead>
					<tbody>
						@foreach($billDetail as $bd)
						<tr>
							<td>{{$bd->id}}</td>
							<td>{{$bd->product->name}}</td>
							<td>{{$bd->quantity}}</td>
							<td>{{number_format($bd->unit_price)}}đ</td>
							
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>

		</div>
</div>
	
@endsection()