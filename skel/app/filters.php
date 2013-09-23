<?php

/**
 * This filter runs before every request.
 */
App::before(function($request)
{
	//
});

/**
 * This filter runs after every request has been handled, but before the
 * response is sent.
 */
App::after(function($request, $response)
{
	//
});

/**
 * Put this filter on routes you only want logged in users to see.
 */
Route::filter('auth', function()
{
	if ( Auth::guest() ) {
		return Redirect::guest( URL::route('login') )
			->withErrors( Lang::get('base.login-required') );
	}
});

/**
 * Put this filter on routes only for NOT logged in users.
 */
Route::filter('guest', function()
{
	if ( Auth::check() ) {
		return Redirect::to('/');
	}
});

/**
 * This filter allows you to restrict access depending on the user's access
 * level(s). Relies on your User model having the hasAccess function on it.
 * 
 * Using the filter access:admin will restrict access to admins only.
 */
Route::filter('access', function($route, $request, $access)
{
	if ( ! Auth::user()->hasAccess($access) ) {
		return Redirect::back()
			->withErrors( Lang::get('base.access-denied') );
	}
});

/**
 * Cross-Site Request Forgery filter - protects your site against simple spam
 * and brute force attacks.
 */
Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token')) {
		throw new Illuminate\Session\TokenMismatchException;
	}
});
