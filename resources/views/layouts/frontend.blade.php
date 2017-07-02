<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	<link rel="stylesheet" type="text/css" href="{{asset('storage/assets/bootstrap/css/bootstrap.min.css')}}">
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
<script type="text/javascript" src="{{asset('storage/assets/bootstrap/js/bootstrap.min.js')}}"></script>

@yield('jscontainer')
</body>
</html>
