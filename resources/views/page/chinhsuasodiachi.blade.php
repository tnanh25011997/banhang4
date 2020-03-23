@extends('master')
@section('title', 'Chỉnh Sửa Thông Tin')
@section('content')
<div class="noidunggiohang">
		<div class="container">
			<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
							
							    <li class="breadcrumb-item active" aria-current="page">Chỉnh Sửa Sổ Địa Chỉ</li>
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
			<div class="giohangcuatoi"><p>CHỈNH SỬA SỔ ĐỊA CHỈ</p></div>
			<hr>
			<div class="formdangky">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<form action="tai-khoan/chinh-sua-so-dia-chi/{{Auth::user()->id}}" method="post">
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
							        
							        <h5><b>{{$taikhoan->full_name}}</b></h5>
							        <p>{{$taikhoan->email}}</p>
							        <hr>
									
									<div class="form-group">
										<label>Tỉnh</label>
										<select class="form-control" required="" name="province" id="province">
											<option value> Chọn Tỉnh/Thành Phố</option>
											@foreach($province as $prov)
										    	<option value="{{sprintf('%02d', $prov->id)}}">{{$prov->name}}</option>
										    @endforeach
										 </select>
									</div>
									<div class="form-group">
										<label>Quận/Huyện</label>
										<select class="form-control" required="" name="district" id="district">
											<option value> Chọn Quận/Huyện</option>
											
										 </select>
									</div>
									<div class="form-group">
										<label>Quận/Huyện</label>
										<select class="form-control" required="" name="ward" id="ward">
											<option value> Chọn Xã/Phường</option>
											
										 </select>
									</div>
									<div class="form-group">
										<label >Số Nhà/Thôn</label>
										<input name="diachi" type="text" class="form-control"  required>
									</div>
									<button type="submit" class="btn btn-primary nutdangky">Chỉnh Sửa</button>

                          
						</form>
					</div>
					<div class="col-md-3">
						
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