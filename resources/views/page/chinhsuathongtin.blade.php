@extends('master')
@section('title', 'Chỉnh Sửa Thông Tin')
@section('content')
<div class="noidunggiohang">
		<div class="container">
			<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
							
							    <li class="breadcrumb-item active" aria-current="page">Chỉnh Sửa Thông Tin</li>
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
			<div class="giohangcuatoi"><p>CHỈNH SỬA THÔNG TIN</p></div>
			<hr>
			<div class="formdangky">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<form action="tai-khoan/chinhsuathongtin/{{Auth::user()->id}}" method="post">
							@csrf
							@if(count($errors)>0)
							    <div class="alert alert-danger">
							    	@foreach($errors->all() as $err)
							    	   {{$err}}
							    	@endforeach
							    </div>
							@endif
							@if(Session::has('error'))
							    <div class="alert alert-danger">{{Session::get('error')}}</div>
							@endif
							@if(Session::has('thongbao'))
							    <div class="alert alert-success">{{Session::get('thongbao')}}</div>
							@endif
							        <h4>Thông Tin Tài Khoản</h4>
							        <hr>
									
									<div class="form-group">
										<label for="pwd">Email</label>
										<input name="email" type="email" class="form-control"  disabled value="{{$taikhoan->email}}">
									</div>

									<div class="form-group">
										<input type="checkbox"  id="changePassword" style="cursor:pointer;" name="changePassword">
                                        <label>Đổi Mật Khẩu</label>
									</div>
									<div class="clusterpass" id="clusterpass">
										<div class="form-group">
	                                        <label>Mật Khẩu Cũ</label>
											<input name="old_password" type="password" id="password1" class="form-control" id="pwd" disabled  required>
										</div>
										<div class="form-group">
	                                        <label>Mật Khẩu Mới</label>
											<input name="password" type="password" id="password2" class="form-control" id="pwd" disabled required>
										</div>
										<div class="form-group">
											<label for="pwd">Nhập Lại Mật Khẩu</label>
											<input name="re_password" type="password" id="password3" class="form-control" id="pwd" disabled required>
										</div>
									</div>
									<h4>Thông Tin Cá Nhân</h4>
							        <hr>
							        <div class="form-group">
										<label for="ten">Họ & Tên</label>
										<input name="ten" type="text" class="form-control" id="ten" value="{{$taikhoan->full_name}}" required>
									</div>
								
									<div class="form-group">
										<label for="pwd">Điện Thoại</label>
										<input name="sdt" type="text" class="form-control" value="{{$taikhoan->phone}}"  required>
									</div>
									<div class="form-group">
										<label for="pwd">Địa Chỉ</label>
										<input name="diachi" type="text" class="form-control" value="{{$taikhoan->address}}"  required>
									</div>
									<button type="submit" class="btn btn-primary nutdangky">Chỉnh Sửa</button>

                          
						</form>
					</div>
					<div class="col-md-3"></div>
				</div>
								
								
			</div>

		</div>
</div>

@endsection()
@section('script')
    <script>
        $(document).ready(function(){
        	

            $("#changePassword").change(function() {
            	

               if($(this).is(":checked"))
               {	
               		$("#clusterpass").addClass('clusterpassshow')
                    $("#password1").removeAttr('disabled');
                    $("#password2").removeAttr('disabled');
                    $("#password3").removeAttr('disabled');

               }
               else
               {
               		$("#clusterpass").removeClass('clusterpassshow')
                    $("#password1").attr('disabled', "");
                    $("#password2").attr('disabled', "");
                    $("#password3").attr('disabled', "");
               }
            });
        });
    </script>
@endsection