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
				    <!-- <li class="nav-item">
					    <span class="nav-link" href="">/</span>
				    </li> -->
				   <!--  <li class="nav-item">
					    <a class="nav-link" href="{{route('logout')}}">Đăng Xuất</a>
				     </li> -->

				@else
					<li class="nav-item">
						<a class="nav-link" href="dang-nhap"><i class="fas fa-user"></i> Đăng Nhập</a>
					</li>
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
					<a class="nav-link" href="san-pham">SẢN PHẨM <i class="fas fa-angle-down"></i></a>
					<ul class='sub-nav'>
						@foreach($loai_sp as $loai)
						<a href="san-pham-theo-loai/{{$loai->id}}"><li>{{$loai->name}}</li></a>
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