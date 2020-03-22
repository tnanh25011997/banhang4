@extends('master')
@section('title', 'Đăng Ký')
@section('content')
<div class="noidungdangky">
		<div class="container">
			<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
							
							    <li class="breadcrumb-item active" aria-current="page">Đăng Ký</li>
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
			<div class="giohangcuatoi"><p>ĐĂNG KÝ THÀNH VIÊN</p></div>
			<hr>
			<div class="formdangky">
				<div class="row">
					<div class="col-lg-3"></div>
					<div class="col-lg-6">
						<form action="{{route('dangky2')}}" method="post">
							@csrf
							@if(count($errors)>0)
							    <div class="alert alert-danger">
							    	@foreach($errors->all() as $err)
							    	   {{$err}}
							    	@endforeach
							    </div>
							@endif
							@if(Session::has('thanhcong'))
							    <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
							@endif
							        <h4>Thông Tin Tài Khoản</h4>
							        <hr>
									
									<div class="form-group">
										<label >Email</label>
										<input name="email" type="email" class="form-control"  required>
										<p style="font-size: 12px; font-style: italic;">(*) Chúng tôi sẽ không xác nhận email của bạn, nhưng 1 email chính chủ sẽ giúp bạn lấy lại mật khẩu khi đã mất</p>
									</div>
									<div class="form-group">
										<label >Mật Khẩu</label>
										<input name="password" type="password" class="form-control"  required>
									</div>
									<div class="form-group">
										<label >Nhập Lại Mật Khẩu</label>
										<input name="re_password" type="password" class="form-control"  required>
									</div>
									
									<h4>Thông Tin Cá Nhân</h4>
							        <hr>
							        <div class="form-group">
										<label for="ten">Họ & Tên</label>
										<input name="fullname" type="text" class="form-control" id="ten" required>
									</div>
									<!-- <div class="form-group">
										<label for="sel1">Giới Tính</label>
										<select class="form-control" id="sel1" name="gioitinh">
											<option>Nam</option>
											<option>Nữ</option>
											
										</select>
									</div> -->
									<div class="form-group">
										<label >Điện Thoại</label>
										<input name="sdt" type="text" class="form-control"  required>
									</div>
									<div class="form-group">
										<label >Địa Chỉ</label>
										<input name="diachi" type="text" class="form-control"  required>
									</div>
									<div class="form-group">
										<label>Tỉnh</label>
										<select class="form-control" id="province">
											<option value> Chọn Tỉnh/Thành Phố</option>
											@foreach($province as $prov)
										    	<option value="{{sprintf('%02d', $prov->id)}}">{{$prov->name}}</option>
										    @endforeach
										 </select>
									</div>
									<div class="form-group">
										<label>Quận/Huyện</label>
										<select class="form-control" id="district">
											<option value> Chọn Quận/Huyện</option>
											
										 </select>
									</div>
									<div class="form-group">
										<label>Quận/Huyện</label>
										<select class="form-control" id="ward">
											<option value> Chọn Xã/Phường</option>
											
										 </select>
									</div>
									<button type="submit" class="btn btn-primary nutdangky">Đăng Ký</button>
						</form>
					</div>
					<div class="col-lg-3">
						
					</div>
				</div>
								
								
			</div>
		</div>
</div>
@endsection()
@section('script')
	<script>
		$(document).ready(function() {
			$("#province").change(function(event) {
				var province_id = $(this).val();
				$.get("ajax/district/"+province_id,function(data){
					$("#district").html(data);
				});
			});
			$("#district").change(function(event) {
				var district_id = $(this).val();
				$.get("ajax/ward/"+district_id,function(data){
					$("#district").html(data);
				});
			});
		});
	</script>
@endsection()