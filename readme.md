# Base files for Laravel 4
Repository for my base Laravel 4 files which I use in practically every project.

## Base Controller
Shorter syntax for redirecting/generating URLs to namespaced controllers

- Set `protected $classname = 'MyApp\Controllers\MyController'` in your controllers
- `$this->actionUrl(...)` to find the URL to an action
- `$this->redirectToUrl(...)` to generate a redirect response to an action
- `'action'` becomes `'MyApp\Controllers\MyController@action'`
- `'OtherController@action'` becomes `'MyApp\Controllers\OtherController@action'`
- `'OtherNamespace\Controller@action'` stays as is

## Base Model
- Easily make the model return certain fields as Carbon (DateTime) objects
- All BaseModel functionality is also extracted into traits

## Base TestCase
- Shorter syntax for calling actions - similar to the BaseController functionality
- Assert the current route has filters
- Assert the generated view input fields has values

## Config
- compiled.php including some very commonly used Laravel components as well as Sentry files (which I often use)
- database config for testing to easily check for unintentional DB hits or easily use an isolated SQLLite database.

## ~~Runtime ClassLoader~~
~~I hated needing to load my migration/seeding/command classes into my application, so I figured out that with a custom artisan start-file I could dynamically load them only when using php artisan.~~

Apparently this doesn't work - migrations will run fine, but if you try to rollback/reset/refresh the classes won't be found.

# License
The contents of this repository is released under the [MIT license](http://opensource.org/licenses/MIT).