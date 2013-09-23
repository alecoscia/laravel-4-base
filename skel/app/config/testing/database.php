<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Default Database Connection Name
	|--------------------------------------------------------------------------
	|
	| Here you may specify which of the database connections below you wish
	| to use as your default connection for all database work. Of course
	| you may use many connections at once using the Database library.
	|
	| By using 'nonexistant' you will trigger a fatal error each time your
	| tests try to hit the database - which you normally want to avoid.
	|
	| If your tests need to hit the database, SQLLite options are good.
	|
	*/

	'default' => 'nonexistant',

	/*
	|--------------------------------------------------------------------------
	| Database Connections
	|--------------------------------------------------------------------------
	|
	| Here are each of the database connections setup for your application.
	| Of course, examples of configuring each database platform that is
	| supported by Laravel is shown below to make development simple.
	|
	|
	| All database work in Laravel is done through the PHP PDO facilities
	| so make sure you have the driver for your particular database of
	| choice installed on your machine before you begin development.
	|
	*/

	'connections' => array(

		'sqlite' => array(
			'driver'   => 'sqlite',
			'database' => __DIR__.'/../database/testing.sqlite',
			'prefix'   => '',
		),

		'sqlite-mem' => array(
			'driver'   => 'sqlite',
			'database' => ':memory:',
			'prefix'   => '',
		),

		'nonexistant' => array(
			'driver'    => 'mysql',
			'host'      => 'nonexistant',
			'database'  => 'nonexistant',
			'username'  => 'nonexistant',
			'password'  => 'nonexistant',
			'charset'   => 'utf8',
			'collation' => 'utf8_unicode_ci',
			'prefix'    => '',
		),

	),

);
