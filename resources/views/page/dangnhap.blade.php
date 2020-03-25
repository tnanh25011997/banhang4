@extends('master')
@section('title', 'Đăng Nhập')
@section('content')
<div class="noidungdangky">
		<div class="container">
			<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
							
							    <li class="breadcrumb-item active" aria-current="page">Đăng Nhập</li>
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
			<div class="giohangcuatoi"><p>ĐĂNG NHẬP VÀO HỆ THỐNG</p></div>
			<hr>
			<div class="formdangnhap">
				<div class="row">
					<div class="col-lg-3"></div>
					<div class="col-lg-6">
						<form action="{{route('dangnhap2')}}" method="post">
							@csrf

                            @if(count($errors)>0)
                              	<div class="alert alert-danger">
							    	@foreach($errors->all() as $err)
							    	   <li>{{$err}}</li>
							    	@endforeach
							    </div>
                            @endif
                            @if(session('thongbao'))
                                <div class="alert alert-danger">{{session('thongbao')}}</div>
                            @endif

							<div class="form-group">
								<label for="email">Email</label>
								<input name="email" type="email" class="form-control" id="email" required>
							</div>
							<div class="form-group">
								<label for="pwd">Mật Khẩu</label>
								<input name="password" type="password" class="form-control" id="pwd" required>
							</div>
							<div class="form-group form-check">
								<label class="form-check-label">
									<input class="form-check-input" type="checkbox"> Remember me
								</label>
							</div>
							<button type="submit" class="btn btn-primary nutdangnhap">Đăng Nhập</button> 
							<p style="margin-top: 20px;">Bạn chưa có tài khoản?<a href="dang-ky" style="color: #7AAEDD;"> Đăng ký</a></p>
							<p style="margin-top: 20px;"><a href="quen-mat-khau" style="color: #7AAEDD;"> Quên mật khẩu?</a></p>
						</form>
					</div>
					<div class="col-lg-3"></div>
				</div>
								
								
			</div>
		</div>
</div>
@endsection()