@extends('master')
@section('title')
	{{$ct->name}}
@endsection
@section('content')
<div class="noidungsanpham">
		<div class="container">
			<div class="row">
				
				<div class="col-lg-9 col-12">
					<div class="bread">
					    <nav aria-label="breadcrumb">
						    <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="home">Trang Chủ</a></li>
							    <li class="breadcrumb-item"><a href="san-pham">Sản Phẩm</a></li>
							    <li class="breadcrumb-item active" aria-current="page">{{$ct->name}}</li>
						    </ol>
					    </nav>
					</div>
					 @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('thongbao'))
                        <div class="alert alert-success">{{session('thongbao')}}</div>
                    @endif
					<div class="row">
						<?php 
				    		$arrImg = json_decode($ct->image,true);
				    	?>
					    <div class="col-md-5">
					    	<?php for($j=0;$j<sizeof($arrImg);$j++){ ?>
						    <div class="big-image">
							    <img src="source/images/{{$arrImg[$j]}}"  alt="" class="img-fluid">
						    </div>
						    <?php } ?>
						    <a class="prev-img" onclick="plusSlides(-1)">❮</a>
  							<a class="next-img" onclick="plusSlides(1)">❯</a>
						    <div class="sub-image">
						    	<?php for($i=0;$i<sizeof($arrImg);$i++){ ?>
								<div class="one-image">
									<img class="small-image" src="source/images/{{$arrImg[$i]}}" onclick="currentSlide({{$i+1}})" alt="">
								</div>
								<?php } ?>
							</div>
					    </div>
					    <div class="col-md-7">
					    	<div class="noidunganhchinh">
						        <h2>{{$ct->name}}</h2>
								@if($ct->rate == null || $ct->rate == 0)
									<i class="fas fa-star" style="color: grey"></i>
									<i class="fas fa-star" style="color: grey"></i>
									<i class="fas fa-star" style="color: grey"></i>
									<i class="fas fa-star" style="color: grey"></i>
									<i class="fas fa-star" style="color: grey"></i> (Chưa có đánh giá nào)
								@else
									<?php for($i=1; $i<=$ct->rate; $i++){ ?>
	    								<i class="fas fa-star" style="color: #ffc120"></i>
	    							<?php } ?>
	    							<?php for($i=1; $i<=5-$ct->rate; $i++){ ?>
	    								<i class="fas fa-star" style="color: grey"></i>
	    							<?php } ?>
								@endif
						        @if($ct->promotion_price==$ct->unit_price)
						            <h5 class="giachinh" style="text-decoration: none;">{{number_format($ct->unit_price)}}đ</h5>
						        @else
						            <h5 class="giachinh">{{number_format($ct->unit_price)}}đ</h5>
						            <h4 class="giakhuyenmai">{{number_format($ct->promotion_price)}}đ</h4>
						        @endif
						        <p class="thuong_hieu">Thương hiệu: {{$ct->brand->name}}</p>
						        <span>Số Lượng:</span>
						        <form action="gio-hang-detail" method="post">
						        	@csrf
						        	<!-- <input type="number" style="margin-top: 5px;" min="0" max="50" value="1" name="soluong"> -->
						        	<div class="spin">
										<span>&ndash;</span><input value="1" name="soluong"/><span>+</span>
									</div>
						        	<input type="hidden" value="{{$ct->id}}" name="idsp">
						        	<p>
						        		@if($ct->status==1)
						        		<button type="submit" class="btn btn-primary nutthemvaogio">Thêm Vào Giỏ</button>
						        		@elseif($ct->status==2)
						        		<h4 style="color: red;">Sản Phẩm Đang Hết Hàng</h4>
						        		@else
						        		<h4 style="color: red;">Ngừng Kinh Doanh</h4>
						        		@endif
						        	</p>
						        </form>
						        
						        
						    </div>
					    </div>
				    </div>
				    <div class="motasanpham">
				    	<ul class="nav nav-tabs">
				    		<li class="nav-item">
				    			<a class="nav-link active" data-toggle="tab" href="#menu1">ĐÁNH GIÁ KHÁCH HÀNG</a>
				    		</li>
				    		<li class="nav-item">
				    			<a class="nav-link" data-toggle="tab" href="#home">CHI TIẾT SẢN PHẨM</a>
				    		</li>
				    	</ul>
				    	<!-- Tab panes -->
				    	<div class="tab-content">  		
				    		<div class="tab-pane container active" id="menu1">
								<div class="average-rate">
									@if($ct->rate == null || $ct->rate == 0)
										Chưa có đánh giá nào
									@else
										<h5>Đánh Giá Trung Bình</h5>
										<h2>{{$ct->rate}}/5</h2>
										<?php for($i=1; $i<=$ct->rate; $i++){ ?>
		    								<i class="fas fa-star" style="color: #ffc120"></i>
		    							<?php } ?>
		    							<?php for($i=1; $i<=5-$ct->rate; $i++){ ?>
		    								<i class="fas fa-star" style="color: grey"></i>
		    							<?php } ?>
									@endif
								</div>
								<hr>
								@if(Auth::check())
								<b>Viết ý kiến của bạn về sản phẩm</b>
				    			<div class="inputComment">
				    				<form action="send-comment" method="post">
				    					@csrf
					    				<div class="form-group">
					    				  <div class="productRating">
					    				  	<i class="far fa-star"></i>
					    				  	<i class="far fa-star"></i>
					    				  	<i class="far fa-star"></i>
					    				  	<i class="far fa-star"></i>
					    				  	<i class="far fa-star"></i>
					    				  	<input type="hidden" name="inputProductRating" id="rating-value">
					    				  </div>
										  <label for="comment">Comments:</label>
										  <textarea class="form-control" name="noidung" rows="4" required placeholder="Nhận xét về sản phẩm này" id="comment"></textarea>
										  <input type="hidden" name="id_user" value="{{Auth::user()->id}}">
										  <input type="hidden" name="id_product" value="{{$ct->id}}">
										</div>
										<button type="submit" class="btn btn-primary">Gửi Nhận Xét</button>
									</form>	
				    			</div>
				    			@else
				    			<div class="loginToComment">
				    				<div class="productRating" style="display: none;"></div>
				    				<p></p>Bạn hãy <a style="cursor: pointer; color: #7AAEDD;" data-toggle="modal" data-target="#loginModal">Đăng nhập</a> để viết nhận xét.</p>
				    			</div>
				    			@endif
								<hr>
				    			@foreach($comments as $com)
				    			<?php 
				    				$starsLight = $com->star;
				    				$starGrey = 5- $starsLight;
				    				
				    			?>
				    			
				    			<div class="motcomment">
				    				<div class="container">
				    				<div class="row">
				    					<div class="col-1 avatarUser"><img src="source/chatbot/img/userAvatar.jpg" class="img-fluid" alt=""></div>
				    					<div class="col-11 detailComment">
				    						<div class="nameUser">
				    							{{$com->user->full_name}} <span>đã đánh giá </span>
				    							<?php for($i=1; $i<=$starsLight; $i++){ ?>
				    								<i class="fas fa-star" style="color: #ffc120"></i>
				    							<?php } ?>
				    							<?php for($i=1; $i<=$starGrey; $i++){ ?>
				    								<i class="fas fa-star" style="color: grey"></i>
				    							<?php } ?>
				    							
				    						</div>
				    						<div class="contentComment">{{$com->content}}</div>
				    						<div class="timeComment">{{(date('d/m/Y', strtotime($com->created_at)))}}</div>
				    					</div>
				    				</div>
				    				</div>
				    			</div>
				 				@endforeach
								<div class="row" style="">{{$comments->links()}}</div>
				    		</div>
				    		<div class="tab-pane container fade" id="home">{!!$ct->description!!}</div>
				    	</div>
				    </div>
				</div>
				
				<div class="col-lg-3 col-12">
					<div class="sanphamkhuyenmai">
						<div class="list-group">
							<p href="#" class="list-group-item list-group-item-action tendanhmuc">SẢN PHẨM KHUYẾN MÃI</p>
							@foreach($sale_product2 as $sale2)
							<?php 
				    			$arrSaleImg = json_decode($sale2->image,true);
				    		?>
							<a href="chi-tiet-san-pham/{{$sale2->slug}}">
							<div class="list-group-item list-group-item-action motsanpham">
								<div class="row">
									<div class="col-5" style="text-align: right;"><img src="source/images/{{$arrSaleImg[0]}}" alt="" class="img-fluid"></div>
									<div class="col-7 thongtin">
										<p class="tensp">{{$sale2->name}}</p>
										<p class="gia">{{number_format($sale2->unit_price)}}đ</p>
										<p class="giakm">{{number_format($sale2->promotion_price)}}đ</p>
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
@section('script')
	<script>
		
		//rating
		const stars=document.querySelector(".productRating").children;
		const ratingValue = document.querySelector("#rating-value");
		let index;
		for(let i=0; i<stars.length;i++){
			stars[i].addEventListener("mouseover",function(){
				for(let j=0; j<stars.length; j++){
					stars[j].classList.remove("fas");
					stars[j].classList.add("far");
				}
				for(let j=0; j<=i; j++){
					stars[j].classList.remove("far");
					stars[j].classList.add("fas");
				}
			})
			stars[i].addEventListener("click",function(){
				ratingValue.value = i+1;
				index = i;
			})
			stars[i].addEventListener("mouseout",function(){
				for(let j=0; j<stars.length; j++){
					stars[j].classList.remove("fas");
					stars[j].classList.add("far");
				}
				for(let j=0; j<=index; j++){
					stars[j].classList.remove("far");
					stars[j].classList.add("fas");
				}
			})
		}

		//spin
		var spins = document.getElementsByClassName("spin");
		for (var i = 0, len = spins.length; i < len; i++) {
	    	var spin = spins[i],
	        span = spin.getElementsByTagName("span"),
	        input = spin.getElementsByTagName("input")[0];

		    input.onchange = function() { 	
		    	if(isNaN(input.value)){
		    		alert("số lượng phải từ 1-20");
		    	}
		    	if(input.value < 1){
		    		input.value = 1;
		    		alert("số lượng phải từ 1-20");
		    	}
		    	if(input.value > 20){
		    		input.value = 20;
		    		alert("số lượng phải từ 1-20");
		    	}
		    	input.value = +input.value || 1; 	    	
		    	console.log(input.value);
		    	
		    };
		    span[0].onclick = function() { 
		    	input.value = Math.max(1, input.value - 1); 
		    	console.log(input.value);
		    };
		    // span[1].onclick = function() {
		    //  	input.value -= -1; 
		    // };
		    span[1].onclick = function() {
		     	input.value = Math.min(20, input.value - (-1));  
		     	console.log(input.value);
		    };

		}
		// image
		var slideIndex = 1;
		showSlides(slideIndex);

		function plusSlides(n) {
		  showSlides(slideIndex += n);
		}

		function currentSlide(n) {
		  showSlides(slideIndex = n);
		}

		function showSlides(n) {
		  var i;
		  var bigImage = document.getElementsByClassName("big-image");
		  var smallImage = document.getElementsByClassName("small-image");
		  if (n > bigImage.length){
		  	slideIndex = 1;
		  }
		  if (n < 1){
		  	slideIndex = bigImage.length;
		  }
		  for (i = 0; i < bigImage.length; i++){
		      bigImage[i].style.display = "none";
		  }
		  for (i = 0; i < smallImage.length; i++) {
		      smallImage[i].className = smallImage[i].className.replace(" active", "");
		  }
		  bigImage[slideIndex-1].style.display = "block";
		  smallImage[slideIndex-1].className += " active";
		}
	</script>
@endsection