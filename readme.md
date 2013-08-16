# Base files for Laravel 4
Repository for my base Laravel 4 files which I use in practically every project.

## Composer.json
Contains packages I often use in my  projects:

- `machuga/authority-l4` - Give users roles, restrict access to parts of the app
- `frozennode/administrator` - Bootstrapped admin panels
- `philf/setting` - Save dynamic site settings to a JSON file
- [`anlutro/l4-smart-errors`](https://github.com/anlutro/laravel-4-smart-errors) - Email myself on uncaught exceptions and log 404s
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
- If validate() exists on the model, check that before saving
- Extra flexibility for handling observer classes

Where it makes sense I'll also extract base model functionality into traits.

## Base TestCase
- Shorter syntax for calling actions - similar to the BaseController functionality
- Assert the current route has filters
- Assert the generated view input fields has values

## Base view files
Main layout based on HTML5 Boilerplate. Bootstrap 3 CSS structure. Yields for adding a page title, scripts either in head or at the end of body, and content.

Empty header/footer/sidebar template files.

## Email view layout
Based on the HTML Email Boilerplate (v0.5): http://htmlemailboilerplate.com/

# License
The contents of this repository is released under the [MIT license](http://opensource.org/licenses/MIT).