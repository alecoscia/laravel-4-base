@extends('layout.parent')

@section('wrapper')
	<section class="main fullwidth">
		@include('partial.alerts')

		@yield('content')
	</section>
@stop