@extends('master')
@section('title', 'Giới Thiệu')
@section('content')
<div class="noidungsanpham">
		<div class="container">
			<div class="row">
				<div class="col-lg-9 col-12">
					<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
							    <li class="breadcrumb-item active" aria-current="page">Giới thiệu</li>
							    
						    </ol>
					    </nav>
					</div>
					<div class="noidunggioithieu">
						<h3 style="text-align: center;">GIỚI THIỆU</h3>
						<p> Store được thành lập năm 2015, là shop chuyên nhập khẩu và phân phối các thương hiệu mỹ phẩm cao cấp chuyên nghiệp dành cho nam và nữ từ các nước như: Mỹ, Hàn Quốc, Thái Lan, Anh Quốc.</p>
						
						<p>Và từ năm 2015 đến hết 2016 công ty đã nghiên cứu và tự sản xuất ra dòng mỹ phẩm 100% thiên nhiên MENLY, dòng sản phẩm thiên nhiên an toàn đã và đang được nam giới tin dùng hiện nay.</p>
						<p> Store ra đời khởi nguồn từ suy nghĩ, cách duy nhất giúp nam giới trở nên tự tin hơn, phá bỏ suy nghĩ chỉ có phụ nữ mới được làm đẹp.</p>
						<p>Chúng tôi luôn quan niệm rằng: "khách hàng là thượng đế", vì thế chúng tôi luôn đưa ra những sản phẩm chất lượng cao, an toàn, hiệu quả cùng với mức giá hợp lý. </p>
						
						<p>Giá trị: Chúng tôi đang là công ty đi đầu lĩnh vực Mỹ Phẩm ,chúng tôi hứa và sẽ cam kết dịch vụ tốt nhất cho nam. Mang đến giá trị đích thực cho các đối tác, và người tiêu dùng. Bởi vì chỉ có các giá trị chân chính mới tồn tại được với thời gian qua sự kiểm định khắt khe của thị trường.</p>
						<img src="source/images/03.jpg" class="img-fluid" style="width: 500px; display: block; margin: auto; margin-bottom: 30px;" alt="">
						<p>Hiện tại  Store đang phân phối hơn 30 sản phẩm khác nhau, đáp ứng đủ nhu cầu Dưỡng Da – Trang Điểm – Trị Mụn – Trị Sẹo dành riêng cho nam giới khắp mọi nơi. Trong đó dòng  MENLY là sản phẩm chiến lược và cũng là độc quyền của shop phát triển trong thời gian sắp tới. Dòng sản phẩm MENLY gồm có 4 sản phẩm: Sữa Rửa Mặt Trị Mụn Menly – Kem Trị Mụn Menly – Toner Se Khít Lỗ Chân Lông Menly - Serum Dưỡng Trắng Da Menly cải tiến đã ra mắt vào tháng 6/2017 để hoàn thiện trọn bộ chăm sóc da cho nam giới.</p>
						<h5>Vị trí của chúng tôi :</h5>
						<div id="map"  style="width:500px;height:500px; display: block; margin: auto;">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3828.9482889884944!2d107.7645867775156!3d16.32558626387336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31419751ed10112b%3A0xa3dc54d122674bba!2zVHLGsOG7nW5nIFRIUFQgQW4gTMawxqFuZyDEkMO0bmc!5e0!3m2!1svi!2s!4v1562510529143!5m2!1svi!2s" width="100%" height="100%"  frameborder="0" style="border:0" allowfullscreen>
								
							</iframe>
						</div>
					</div>
					
				</div>
				
				<div class="col-lg-3 col-12">
					<div class="sanphamkhuyenmai">
						<div class="list-group">
							<p href="#" class="list-group-item list-group-item-action tendanhmuc">SẢN PHẨM KHUYẾN MÃI</p>
							@foreach($sale_product as $sp)
							<a href="chi-tiet-san-pham/{{$sp->slug}}">
							<div class="list-group-item list-group-item-action motsanpham">
								<div class="row">
									<div class="col-5" style="text-align: right;"><img src="source/images/{{$sp->image}}"  alt="" class="img-fluid"></div>
									<div class="col-7 thongtin">
										<p class="tensp">{{$sp->name}}</p>
										<p class="gia">{{number_format($sp->unit_price)}}đ</p>
										<p class="giakm">{{number_format($sp->promotion_price)}}đ</p>
									</div>
								</div>

							</div>
							</a>
							@endforeach
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
