<div class="menutren">
	
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		<div class="container">
			<div class="brandResponsive" style="display: none;">
					<img src="source/images/logo.png" style="width: 40px;" alt="">
				</div>
			<form class="form-inline" action="search" method="get">
				
				<input class="form-control mr-sm-2 inputtimkiem" style="" name="key" type="text" placeholder="Tìm Kiếm...">
				<button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
			</form>
			
			<ul class="navbar-nav login">
				@if(Auth::check()) 
                    <li class="nav-item tentaikhoan">
					    <p style="margin: 0;" class="nav-link" href=""><i class="fas fa-user"></i> Hello {{Auth::user()->full_name}}!</p>
					    <ul class="listtaikhoan">
					    	<li><a href="tai-khoan/lichsumuahang_bill/{{Auth::user()->id}}">Lịch Sử Mua Hàng</a></li>
					    	<li><a href="tai-khoan/chinhsuathongtin/{{Auth::user()->id}}">Chỉnh Sửa Thông Tin</a></li>
					    	<li><a href="{{route('logout')}}">Đăng Xuất</a></li>
					    </ul>
				    </li>
				    

				@else
					<li class="nav-item">
						<a class="nav-link" style="cursor: pointer;" data-toggle="modal" data-target="#loginModal"><i class="fas fa-user"></i> Tài Khoản</a>
					</li>
					<!-- Modal -->
					<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title giohangcuatoi" id="exampleModalLabel"><p>ĐĂNG NHẬP VÀO HỆ THỐNG</p></h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      		<div class="formdangnhap">
									<div class="row">
										
										<div class="col-lg-12">
											<form action="{{route('dangnhap2')}}" method="post">
												@csrf

					                            @if($errors->has('email_login') || $errors->has('password_login'))
					                              	<div class="alert alert-danger">
												    	@foreach($errors->all() as $err)
												    	   <li>{{$err}}</li>
												    	@endforeach
												    </div>
					                            @endif
					                            @if(session('LoginError'))
					                                <div class="alert alert-danger">{{session('LoginError')}}</div>
					                            @endif

												<div class="form-group">
													<label for="email">Email</label>
													<input name="email_login" type="email" value="{{ old('email_login') }}" class="form-control" id="email" required>
												</div>
												<div class="form-group">
													<label for="pwd">Mật Khẩu</label>
													<input name="password_login" type="password"  class="form-control" id="pwd" required>
												</div>
												<div class="form-group form-check">
													<label class="form-check-label">
														<input class="form-check-input" value="remember" type="checkbox"> Remember me
													</label>
												</div>
												<button type="submit" class="btn btn-primary nutdangnhap">Đăng Nhập</button> 
												<p style="margin-top: 20px;">Bạn chưa có tài khoản?<a href="dang-ky" style="color: #7AAEDD;"> Đăng ký</a></p>
												<p style="margin-top: 20px;"><a href="quen-mat-khau" style="color: #7AAEDD;"> Quên mật khẩu?</a></p>
											</form>
										</div>
										
									</div>
													
													
								</div>
					      </div>
					      
					    </div>
					  </div>
					</div>
					<!-- <li class="nav-item">
						<span class="nav-link" href="">/</span>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="dang-ky">Đăng Ký</a>
					</li> -->
				@endif
				<div class="xomenu"><i class="fas fa-bars"></i></div>
				@if(session()->has('messagecart'))
					   <div class="add-to-cart-success">
							<span class="close" style="cursor: pointer;" onclick="closebuy()"><i style="color:red;"class="far fa-window-close"></i></span>
							<p class="text" style="font-size: 12px;"><i style="color:#92d22f; margin-right:5px;" class="fas fa-check-circle"></i>Thêm vào giỏ hàng thành công!</p>
							<a href="gio-hang"><button type="button" class="btn btn-danger">Xem giỏ hàng và thanh toán</button></a>
						</div>
					@endif
			</ul>

		</div>
	</nav>
	
</div>
<div class="menuduoi">
	<nav class="navbar navbar-expand-sm navbar-light">
		<!-- Brand/logo -->
		<div class="container">
			<a class="navbar-brand" href="home"><img src="source/images/logo.png" style="width: 80px;" alt=""></a>

			<!-- Links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" href="home">TRANG CHỦ</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="gioi-thieu">GIỚI THIỆU</a>
				</li>
				<li class="nav-item sanphammenu">
					<a class="nav-link" href="my-pham-nam">MỸ PHẨM NAM <i class="fas fa-angle-down"></i></a>
					<ul class='sub-nav sub-mpnam'>
						@foreach($loai_sp_nam as $loai)
						<a href="san-pham-theo-loai/{{$loai->slug}}"><li>{{$loai->name}}</li></a>
						@endforeach
						
					</ul>
					
				</li>
				<!-- <li class="nav-item sanphammenu">
					<a class="nav-link" href="my-pham-nu">MỸ PHẨM NỮ</a>
					<ul class='sub-nav sub-mpnu'>
						@foreach($loai_sp_nu as $loai)
						<a href="san-pham-theo-loai/{{$loai->slug}}"><li>{{$loai->name}}</li></a>
						@endforeach
						
					</ul>
					<i class="nut-xuong2 fas fa-angle-down"></i>
				</li> -->
				<li class="nav-item sanphammenu">
					<a class="nav-link" href="my-pham-nu">MỸ PHẨM NỮ <i class="fas fa-angle-down"></i></a>
					<ul class='sub-nav sub-mpnu'>
						@foreach($category as $cate)
						<li>
							<span class="sub-sub-title">{{$cate->name}}</span>
							<ul class="sub-sub-nav">
								@foreach($loai_sp_nu as $loai)
									@if($loai->category->id==$cate->id)
									<a href="san-pham-theo-loai/{{$loai->slug}}"><li>{{$loai->name}}</li></a>
									@endif
								@endforeach
							</ul>
						</li>
						@endforeach
						
					</ul>
					
				</li>
				<li class="nav-item">
					<a class="nav-link" href="tin-tuc">TIN TỨC</a>
				</li>
				
				<li class="nav-item">
					@if(!empty($counttt))
					<a class="nav-link giohang" href="gio-hang"><i class="fas fa-shopping-cart"></i> Giỏ Hàng: <span class="sogiohang">{{$counttt}}</span></a>
					@else
					<a class="nav-link giohang" href="gio-hang"><i class="fas fa-shopping-cart"></i> Giỏ Hàng: <span class="sogiohang">0</span></a>
					@endif
					
				</li>
			</ul>
		</div>
	</nav>
</div>
@if(session('thongbaodangnhap'))
    <div class="alert alert-success" style="text-align: center;margin-bottom: 0px;">{{session('thongbaodangnhap')}}</div>
@endif