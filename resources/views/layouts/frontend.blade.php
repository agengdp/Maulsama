<!DOCTYPE html>
<html>
<head>
	{!! SEO::generate() !!}
	<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" type="text/css" href="{{asset('storage/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('storage/assets/css/main.css')}}">
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5XSDHSR');</script>
	<!-- End Google Tag Manager -->
</head>
<body>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5XSDHSR"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
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
