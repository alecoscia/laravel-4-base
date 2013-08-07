# Base files for Laravel 4
Repository for my base Laravel 4 files which I use in practically every project.

## Composer.json
Contains packages I often use in my  projects:

- `machuga/authority-l4` - Give users roles, restrict access to parts of the app
- `frozennode/administrator` - Bootstrapped admin panels
- `philf/setting` - Save dynamic site settings to a JSON file
- (dev) `way/generators` - Generate model/controller/test... files quickly
- (dev) `mockery/mockery` - Mock objects easily in tests
- (dev) `fzaninotto/faker` - Autogenerate fields for test data

Classmap autoload for directories I commonly use. I usually rename my commands folder to artisan because there's just too damn many folders starting with c.

I removed all the scripts mostly because I want more control over when stuff is actually ran.

## Config
- app-extra.php contains providers and aliases I commonly use, for easy copy-pasting
- compiled.php including some very commonly used Laravel components as well as Sentry files (which I often use)
- database config for testing to easily check for unintentional DB hits or easily use an isolated SQLLite database.
- Stripped much of the files in `app/start` - I offload the tasks that are here at project creation to other files instead

## Smart Errors
Small system for showing a very generic error message to your end-users while sending an email to yourself with all relevant information about the exception.

- Uncaught exceptions send an email with detailed information (referrer, route name/action, any input given and more)
- 404 errors are written in the log as warnings with the URL accessed + referrer
- Simple maintenance mode handler

Copy the app folder into your project, answering yes to any questions about overwriting. Add an include statement for `error.php` in `app/start/global.php` and remove the default `App::error`, `App::missing` and `App::down` handlers.

Add a "developer" key to `app/config/mail.php` containing your or your dev team's email address. Example:

	'developer' => 'webdev@example.com'

https://github.com/anlutro/laravel-4-smart-errors

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

## Email view layout
Based on the HTML Email Boilerplate (v0.5): http://htmlemailboilerplate.com/

## ~~Runtime ClassLoader~~
~~I hated needing to load my migration/seeding/command classes into my application, so I figured out that with a custom artisan start-file I could dynamically load them only when using php artisan.~~

Apparently this doesn't work - migrations will run fine, but if you try to rollback/reset/refresh the classes won't be found.

# License
The contents of this repository is released under the [MIT license](http://opensource.org/licenses/MIT).