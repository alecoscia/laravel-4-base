# Base files for Laravel 4
Repository for my base Laravel 4 files which I use in practically every project.

## Base Controller
Set `protected $classname = 'MyApp\Controllers\MyController'` in your controllers.
`$this->actionUrl('action')` to generate an URL to MyApp\Controllers\MyController@action.
`$this->redirectToAction('OtherController@action')` to generate a redirect response to another controller in the same namespace.
`$this->actionUrl('Namespace\Controller@action')` to generate the url to a controller in another namespace (although at this point you may as well use URL::action).

## Base Model
- Easily make the model return certain fields as Carbon (DateTime) objects
- All BaseModel functionality is also extracted into traits

## Base TestCase
- Shorter syntax for calling actions - similar to the BaseController functionality
- Assert the current route has filters
- Assert the generated view input fields has values

## Config
- compiled.php including some very commonly used Laravel components as well as Sentry files (which I often use)