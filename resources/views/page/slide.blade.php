<div id="demo" class="carousel slide" data-ride="carousel">

	<!-- Indicators -->
	<ul class="carousel-indicators">
		<li data-target="#demo" data-slide-to="0" class="active"></li>
		<li data-target="#demo" data-slide-to="1"></li>
		<li data-target="#demo" data-slide-to="2"></li>
		
	</ul>

	<!-- The slideshow -->
	<div class="carousel-inner">
		<?php $dem=0;
		 ?> 
		@foreach ($slide as $value)
			
		

		<div class="carousel-item <?php if($dem==0) echo "active" ?>">
			<img src="source/images/{{$value->image}}" style="width: 580px; height: 485px;" alt="Los Angeles">
		</div>
		<?php $dem++;
		 ?> 
		@endforeach
	</div>

	<!-- Left and right controls -->
	<a class="carousel-control-prev" href="#demo" data-slide="prev">
		<span class="carousel-control-prev-icon"></span>
	</a>
	<a class="carousel-control-next" href="#demo" data-slide="next">
		<span class="carousel-control-next-icon"></span>
	</a>

</div>