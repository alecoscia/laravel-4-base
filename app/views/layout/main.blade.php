<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>
			@yield('title') | 
			{{ Config::get('app.name') ?: 'APP NAME MISSING' }}
		</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

	@if (App::environment() == 'production')
		<link rel="stylesheet" href="css/main.min.css">
	@else
		<link rel="stylesheet" href="css/main.css">
	@endif
		<script src="js/vendor/modernizr-2.6.2.min.js"></script>

		@yield('head')
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

<div class="container">
	<header class="header">
		@include('partial.header')
	</header>
	
	<section class="main">
		@yield('content')
	</section>

	<aside class="sidebar">
		@include('partial.sidebar')
	</aside>

	<footer class="footer">
		@include('partial.footer')
	</footer>
</div>

		<!-- Try to load jQuery from a CDN, if it doesn't work load from local -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>

		<script src="js/plugins.js"></script>
		<script src="js/main.js"></script>

		@yield('scripts')

		<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='//www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','UA-XXXXX-X');ga('send','pageview');
		</script>
	</body>
</html>