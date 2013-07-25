# Base class files for Laravel 4
My repository for base class files for Laravel 4.

Being tired of writing App\Models\MyModel or App\Controllers\MyController in strings related to getting URLs or redirecting in Laravel 4, I wrote some helper functions and organized them in base classes.

The repository may expand to include more functionality in the future. Check the documentation in the .php files for more information on existing functions.


## Base Controller
Includes functions to easily get the URL to or redirect to an action within the same controller.


## Base Model
Includes functions to easily get and set fields that relate to date/time as Carbon objects.


## Base TestCase
Assuming that you have separate tests for each controller, lets you easily call actions in the controller as well as assert redirections to actions within that controller.