<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{asset('storage/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('storage/assets/css/main.css')}}">
</head>
<body>

	<nav class="navbar navbar-inverse yamm navbar-static-top header">
		@include('public.includes.navigation')
	</nav>

	<section id="content">
		@yield('content')
	</section>

	<footer>
		@include('public.includes.footer')
	</footer>

<script type="text/javascript" src="{{asset('storage/assets/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('storage/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
@yield('jscontainer')
</body>
</html>
