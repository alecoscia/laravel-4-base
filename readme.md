# Base files for Laravel 4
Collection of useful Laravel 4 classes and files.

src/ contains classes/traits that are psr-0 autoloaded and can be used at any point in your projects.

skel/ contains useful skeleton files which can be copied into your project root.

Install via composer: `composer require anlutro\l4-base:dev-master`

## Autoloaded classes
### Base Controller
Shorter syntax for redirecting/generating URLs to namespaced controller actions

- Set `protected $classname = 'MyApp\Controllers\MyController'` in your controllers
- `$this->actionUrl(...)` to find the URL to an action
- `$this->redirectUrl(...)` to generate a redirect response to an action
- `'action'` becomes `'MyApp\Controllers\MyController@action'`
- `'OtherController@action'` becomes `'MyApp\Controllers\OtherController@action'`
- `'OtherNamespace\Controller@action'` stays as is

### Model Traits
Advanced scoping functionality. See each trait source file for examples and documentation.

- hasConstrained - has() with constraints
- withAggregate - lazy load sum/count/etc of related model columns
- withRelationCount - lazy load count of related models
- withConstrainedRelationCount - lazy load count of related models with constraint

### Base TestCase
- Shorter syntax for calling actions - similar to the BaseController functionality
- Assert the current route has filters
- Assert the generated view input fields has values
- Improved assertion error messages for assertSessionHas

### Menu Composer
Extend this class and add multiple composers to the menu view found in the skel/ directory

## Skeleton files
### Config
- compiled.php including some very commonly used Laravel components
- database config for testing to easily check for unintentional DB hits or easily use an isolated SQLLite database
- mail.pretend = true in local only

### Base view files
Main layout based on HTML5 Boilerplate. Bootstrap 3 CSS structure. Yields for adding a page title, scripts either in head or at the end of body, and content.

Email layout based on the HTML Email Boilerplate (v0.5): http://htmlemailboilerplate.com/

## License
The contents of this repository is released under the [MIT license](http://opensource.org/licenses/MIT).