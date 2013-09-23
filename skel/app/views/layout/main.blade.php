@extends('layout.parent')

@section('wrapper')
	<section class="main normal">
		@include('partial.alerts')

		@yield('content')
	</section>

	<aside class="sidebar">
		@include('partial.sidebar')
	</aside>
@stop