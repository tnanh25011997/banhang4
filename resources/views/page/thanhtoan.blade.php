@extends('master')
@section('title', 'Thanh Toán')
@section('content')
<div class="noidunggiohang">
		<div class="container">
			<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
							
							    <li class="breadcrumb-item active" aria-current="page">Thanh Toán</li>
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
			<div class="giohangcuatoi"><p>THANH TOÁN</p></div>
			<hr>
			@if(Session::has('cart'))
			<div class="khoibieutuong">
				<div class="motbieutuong">
					<p><i class="fas fa-shopping-cart"></i></p>
					<p>Giỏ hàng của tôi</p>
					<div class="sothutu">1</div>
				</div>
				<div class="motbieutuong">
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
							<th>GIÁ</th>
							<th>SỐ LƯỢNG</th>
							<th>THÀNH TIỀN</th>
						</tr>
					</thead>
					<tbody>
						@if(Session::has('cart'))
						    @foreach($product_cart as $item) 
								<tr>
									<td>{{$item['item']['name']}}</td>
									
									@if($item['item']['promotion_price'] == 0)
										<td class="giagiohang">{{number_format($item['item']['unit_price'])}}đ</td>
									@else
										<td class="giagiohang">{{number_format($item['item']['promotion_price'])}}đ</td>
									@endif
									<td>
										    {{$item['qty']}}
			
									</td>
									<td class="giagiohang">
									{{number_format($item['price'])}}đ
										
									</td>
									
								</tr>
						    @endforeach
						@endif
					</tbody>
				</table>
			</div>
			<div class="tongtien">
				<div class="row">
					<div class="col-xl-8 col-lg-6 col-md-4"></div>
					<div class="col-xl-4 col-lg-6 col-md-8" style="text-align: right;">
						@if($totalPrice<500000)
						<p>Phí Vận Chuyển : <span class="phiship">{{number_format(30000)}}đ</span> </p>		
						<span>Tổng Thanh Toán : </span>
						<span class="tongtien">{{number_format($totalPrice+30000)}}đ</span>
						@else
						<p>Phí Vận Chuyển : <span class="phiship">0đ</span> </p>		
						<span>Tổng Thanh Toán : </span>
						<span class="tongtien">{{number_format($totalPrice)}}đ</span>
						@endif
					</div>
				</div>
				
			</div>
			<div class="bangthanhtoan">
				<div class="row">

					<div class="col-sm-12">
						<div class="tieudethanhtoan"><h4>ĐỊA CHỈ THANH TOÁN VÀ GIAO HÀNG</h4></div>
						<div class="noidungthanhtoan">
							<h5>THÔNG TIN THANH TOÁN</h5>
							@if(Auth::check())
							@else
							    <a href="{{route('dangnhap')}}">Đăng Nhập để mua hàng</a>
							    <p>Mua hàng không cần tài khoản</p>

							@endif
							
							<div class="formmuahang">
								<form action="{{route('dathang')}}" method="post" >
									@csrf
									@if(count($errors)>0)
							            <div class="alert alert-danger">
									    	@foreach($errors->all() as $err)
									    	   <li>{{$err}}</li>
									    	@endforeach
								        </div>
							        @endif
									@if(Auth::check())
									<!-- <div class="form-group">
                  						<label for="ten">Họ & Tên</label>
                  						<input name="ten" type="text" required value="{{Auth::user()->full_name}}" class="form-control" id="ten">
                  					</div>
                  					<div class="form-group">
                  						<label >Số Điện Thoại</label>
                  						<input name="sdt" type="text" required value="{{Auth::user()->phone}}" class="form-control" >
                  					</div>
                  					<div class="form-group">
                  						<label >Email</label>
                  						<input name="email" type="email" required value="{{Auth::user()->email}}" class="form-control" >
                  					</div>
                  					<div class="form-group">
                  						<label >Địa Chỉ</label>
                  						<input name="diachi" type="text" required value="{{Auth::user()->address}}" class="form-control" >
                  					</div> -->
									<div class="delivery-address">
										<h5>{{Auth::user()->full_name}}</h5>
										<p>Điện Thoại: {{Auth::user()->phone}}</p>
										<p>Email: {{Auth::user()->email}}</p>
										<p style="padding-bottom: 5px;">Địa Chỉ: {{Auth::user()->address}}</p>
										<a href="tai-khoan/chinhsuathongtin/{{Auth::user()->id}}">Chỉnh Sửa Thông Tin</a>
									</div>
				
                  					@else
                  					<div class="row">
                  						<div class="col-md-6">
                  							
		                  					<div class="form-group">
		                  						
		                  						<input name="ten" type="text" required placeholder="Nhập Họ Tên" class="form-control" id="ten">
		                  					</div>
		                  					<div class="row">
		                  						<div class="col-md-7">
		                  							<div class="form-group">
				                  						
				                  						<input name="email" type="email" placeholder="Nhập Email" required class="form-control" >
				                  					</div>
		                  						</div>
		                  						<div class="col-md-5">
		                  							<div class="form-group">
		                  						
		                  							<input name="sdt" placeholder="Nhập SĐT" type="text" required class="form-control input-phone-checkout" >
		                  					</div>
		                  						</div>
		                  					</div>
		                  					<div class="form-group">
		                  						
		                  						<input name="diachi" type="text" placeholder="Nhập Số Nhà/Thôn" required class="form-control" >
		                  					</div>
		                  					
			                  					
                  						</div>
                  						<div class="col-md-6">
                  							<div class="form-group">
												
												<select class="form-control"  name="province" id="province">
													<option value> Chọn Tỉnh/Thành Phố</option>
													@foreach($province as $prov)
												    	<option value="{{sprintf('%02d', $prov->id)}}">{{$prov->name}}</option>
												    @endforeach
												 </select>
											</div>
											<div class="form-group">
												
												<select class="form-control"  name="district" id="district">
													<option value> Chọn Quận/Huyện</option>
													
												 </select>
											</div>
											<div class="form-group">
												
												<select class="form-control"  name="ward" id="ward">
													<option value> Chọn Xã/Phường</option>
													
												 </select>
											</div>
		                  						</div>
											</div>

									@endif
							        <div class="cacthucvanchuyen form-group">
										<h5>CÁCH THỨC THANH TOÁN</h5>
										<div class="form-check">
											<label class="form-check-label">
												<input style="cursor: pointer;" type="radio" class="form-check-input" value="COD" name="payment">
												<img src="source/images/payment-1.png" alt=""> Thanh Toán Khi Nhận Hàng (COD)
											</label>
										</div>
										<div class="form-check">
											<label class="form-check-label">
												<input type="radio" class="form-check-input" value="ATM" name="payment"> <img src="source/images/payment-2.png" alt=""> Chuyển Khoản Ngân Hàng
												<div id="clusterchuyenkhoan">
													<p>STK : 23213245648</p>
													<p>Tên : Trần Ngọc Ánh</p>
													<p>Ngân Hàng Công Thương Việt Nam</p>
												</div>
											</label>
										</div>
										<button type="submit" class="btn btn-primary nutdathang">ĐẶT HÀNG</button>

									</div>
								</form>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			@else
			<div style="text-align: center;">
				<p>Không có sản phẩm nào trong giỏ hàng của bạn.</p>
				<a href="home"><button class="btn btn-primary" style="margin-bottom: 100px; background: #7AAEDD; border: 1px solid #7AAEDD;">Tiếp Tục Mua Sắm</button></a>
			</div>
			@endif
		</div>
</div>
@endsection
@section('script')
    <script>
        $('input[type=radio][name=payment]').change(function() {
		    if (this.value == 'ATM') {
		        $("#clusterchuyenkhoan").addClass('clusterpassshow');
		    }
		    else if (this.value == 'COD') {
		        $("#clusterchuyenkhoan").removeClass('clusterpassshow');
		    }
		});
		$(document).ready(function() {
			$("#province").change(function(event) {
				var province_id = $(this).val();
				$.get("ajax/district/"+province_id,function(data){
					$("#district").html(data);
					$("#ward").html("<option value> Chọn Xã/Phường</option>");
				});
			});
			$("#district").change(function(event) {
				var district_id = $(this).val();
				$.get("ajax/ward/"+district_id,function(data){
					$("#ward").html(data);
				});
			});
		});	
    </script>
@endsection