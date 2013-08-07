<?php
/**
 * Paste into your app.php config file's aliases and serviceproviders.
 * Remove the ones you don't need.
 */

return array(
	'providers' => array(

		'Authority\AuthorityL4\AuthorityL4ServiceProvider',
		'Cartalyst\Sentry\SentryServiceProvider',
		'Philf\Setting\SettingServiceProvider',

		// local/dev only
		'Profiler\ProfilerServiceProvider',
		'Way\Generators\GeneratorsServiceProvider',

	),
	

	'aliases' => array(

		'Authority' => 'Authority\AuthorityL4\Facades\Authority',
		'Sentry' => 'Cartalyst\Sentry\Facades\Laravel\Sentry',
		'Setting' => 'Philf\Setting\Facades\Setting',
	
	),
);
