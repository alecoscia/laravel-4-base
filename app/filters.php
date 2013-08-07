<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Session\TokenMismatchException;

// App::before(function($request)
// {
//	
// });

// App::after(function($request, $response)
// {
//	
// });

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new TokenMismatchException;
	}
});
