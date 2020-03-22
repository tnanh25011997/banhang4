<!DOCTYPE html>
<html lang="vn"><head>
	<title>@yield('title')</title>
	<base href="{{asset('')}}">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">  
	<!-- <script type="text/javascript" src="source/vendor/bootstrap.js"></script> -->
	<!-- <link rel="stylesheet" href="source/css/bootstrap.css"> -->
	<link rel="icon" href="source/images/logo.png" type="image/gif" sizes="16x16">
	<link rel="stylesheet" href="source/css/fontawesome-all.css"> 
	<link rel="stylesheet" href="source/1.css">
	
	<!-- chatbot -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel= "stylesheet" type= "text/css" href= "source/chatbot/css/style.css">

	<!-- owl carousel -->
	<link rel="stylesheet" href="source/owl_vendor/owl.carousel.min.css">
	<link rel="stylesheet" href="source/owl_vendor/owl.theme.default.min.css">
	<script src="source/owl_vendor/jquery.min.js"></script>
	<script  src="source/owl_vendor/owl.carousel.min.js"></script>


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> -->	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body >
	@include('header')
	@yield('content')
	@include('footer')
	@yield('script')
	@include('chatbot')

	<script type="text/javascript" src="source/1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>   
    <script type="text/javascript" src="source/chatbot/js/script.js"></script>
</body>
</html>