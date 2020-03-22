@extends('master')
@section('title', 'Quên Mật Khẩu')
@section('content')
<div class="noidungdangky">
		<div class="container">
			<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
							
							    <li class="breadcrumb-item active" aria-current="page">Quên Mật Khẩu</li>
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
			<div class="giohangcuatoi"><p>Quên Mật Khẩu</p></div>
			<hr>
			<div class="formdangnhap">
				<div class="row">
					<div class="col-lg-3"></div>
					<div class="col-lg-6">
						
						<form action="" method="post">
							@csrf

                            @if(count($errors)>0)
                               @foreach($errors->all() as $err)
                                   <div class="alert alert-danger">{{$err}} <br></div>
                               @endforeach
                            @endif
                             @if(session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                            @if(session('thongbao'))
                                <div class="alert alert-success">{{session('thongbao')}}</div>
                            @endif

							<div class="form-group">
								<label>Email</label>
								<input name="emailUser" type="email" class="form-control"  required>
							</div>
							<div class="form-group">
								<label>Mật Khẩu Mới</label>
								<input name="password" type="password" class="form-control"  required>
							</div>
							<div class="form-group">
								<label>Nhập Lại Mật Khẩu Mới</label>
								<input name="re_password" type="password" class="form-control"  required>
							</div>
							
							<button type="submit" class="btn btn-primary nutdangnhap">Lấy Mật Khẩu</button> 
							
						</form>
					</div>
					<div class="col-lg-3"></div>
				</div>
								
								
			</div>
		</div>
</div>
@endsection()