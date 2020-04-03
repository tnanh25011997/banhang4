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
					<!-- <div class="col-lg-3"></div> -->
					<div class="col-lg-12">
						<form action="{{route('dangky2')}}" method="post">
							@csrf
						
							@if(Session::has('thanhcong'))
							    <div class="alert alert-success">{{Session::get('thanhcong')}}</div>
							@endif
							        
							        
									<div class="row">
										<div class="col-md-6">
											<h4>Thông Tin Tài Khoản</h4>
											<hr>
											<div class="form-group">
												<label >Email</label>
												<input name="email" type="email" value="{{ old('email') }}" class="form-control"  required>
												<p style="font-size: 12px; font-style: italic;">(*) Chúng tôi sẽ không xác nhận email của bạn, nhưng 1 email chính chủ sẽ giúp bạn lấy lại mật khẩu khi đã mất</p>
												@if ($errors->has('email'))
											        <p class="help is-danger">{{ $errors->first('email') }}</p>
											    @endif
											</div>
											<div class="form-group">
												<label >Mật Khẩu</label>
												<input name="password" type="password" class="form-control"  required>
												@if ($errors->has('password'))
											        <p class="help is-danger">{{ $errors->first('password') }}</p>
											    @endif
											</div>
											<div class="form-group">
												<label >Nhập Lại Mật Khẩu</label>
												<input name="re_password" type="password" class="form-control"  required>
												@if ($errors->has('re_password'))
											        <p class="help is-danger">{{ $errors->first('re_password') }}</p>
											    @endif
											</div>
										</div>
										<div class="col-md-6">
											<h4>Thông Tin Cá Nhân</h4>
									        <hr>
									        <div class="form-group">
												<label for="ten">Họ & Tên</label>
												<input name="fullname" type="text" value="{{ old('fullname') }}" class="form-control" id="ten" required>
												@if ($errors->has('fullname'))
											        <p class="help is-danger">{{ $errors->first('fullname') }}</p>
											    @endif
											</div>
											
											<div class="form-group">
												<label >Điện Thoại</label>
												<input name="sdt" type="text" value="{{ old('sdt') }}" class="form-control"  required>
												@if ($errors->has('sdt'))
											        <p class="help is-danger">{{ $errors->first('sdt') }}</p>
											    @endif
											</div>
											<div class="form-group">
												<label>Tỉnh</label>
												<select class="form-control" required name="province" id="province">
													<option value> Chọn Tỉnh/Thành Phố</option>
													@foreach($province as $prov)
												    	<option value="{{sprintf('%02d', $prov->id)}}">{{$prov->name}}</option>
												    @endforeach

												 </select>
												 @if ($errors->has('province'))
											        <p class="help is-danger">{{ $errors->first('province') }}</p>
											    @endif
											</div>
											<div class="form-group">
												<label>Quận/Huyện</label>
												<select class="form-control" required name="district" id="district">
													<option value> Chọn Quận/Huyện</option>
													
												 </select>
												 @if ($errors->has('district'))
											        <p class="help is-danger">{{ $errors->first('district') }}</p>
											    @endif
											</div>
											<div class="form-group">
												<label>Xã/Phường</label>
												<select class="form-control" required name="ward" id="ward">
													<option value> Chọn Xã/Phường</option>
													
												 </select>
												 @if ($errors->has('ward'))
											        <p class="help is-danger">{{ $errors->first('ward') }}</p>
											    @endif
											</div>
											<div class="form-group">
												<label >Số Nhà/Thôn</label>
												<input name="diachi" type="text" value="{{ old('diachi') }}" required class="form-control"  required>
												@if ($errors->has('diachi'))
											        <p class="help is-danger">{{ $errors->first('diachi') }}</p>
											    @endif
											</div>
											<button type="submit" class="btn btn-primary nutdangky">Đăng Ký</button>
										</div>
									</div>
									
									
									
						</form>
					</div>
					<!-- <div class="col-lg-3">
						
					</div> -->
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
@endsection()