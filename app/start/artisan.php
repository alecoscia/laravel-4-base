<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
| The classes in these directories are never used outside of Artisan, so
| remove them from composer.json and just leave them here instead.
|
| The classes in these directories need to be in the global namespace for
| this to work - but they're never called in your real app so who cares!
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/database/migrations',
	app_path().'/database/seeds',

));
