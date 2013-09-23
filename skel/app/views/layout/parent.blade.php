<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>
			@yield('title') | {{ Config::get('app.name') ?: 'APP NAME MISSING' }}
		</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="{{ URL::asset('css/libs.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('css/app.min.css') }}">

		{{-- <script src="{{ URL::asset('js/modernizr.min.js') }}"></script> --}}

		@yield('head')
	</head>
	<body>
		<!--[if lt IE 7]>
			<p class="browsehappy">@lang('misc.browsehappy', array('url' => 'http://browsehappy.com/'))</p>
		<![endif]-->

<div class="container">
	<header class="header">
		@include('partial.header')
	</header>
	
	<div class="main-wrapper">
		@yield('wrapper')
	</div>

	<footer class="footer">
		@include('partial.footer')
	</footer>
</div>

		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>')</script>
		<script src="{{ URL::asset('js/app.min.js') }}"></script>

		@yield('scripts')

		<!--<script>
			(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
			function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
			e=o.createElement(i);r=o.getElementsByTagName(i)[0];
			e.src='//www.google-analytics.com/analytics.js';
			r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
			ga('create','UA-XXXXX-X');ga('send','pageview');
		</script>-->
	</body>
</html>
