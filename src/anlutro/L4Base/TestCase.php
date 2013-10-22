<?php
/**
 * Laravel 4 Base - TestCase
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   Laravel 4 Base
 */

namespace anlutro\L4Base;

/**
 * Abstract TestCase with a lot of handy functions.
 */
abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		// ./vendor/anlutro/l4-base/src/anlutro/Base
		//   ..    /..     /..     /.. /..     /..
		return require __DIR__.'/../../../../../../bootstrap/start.php';
	}

	/**
	 * The controller to test, fully namespaced.
	 *
	 * @var string
	 */
	protected $controller;

	/**
	 * Perform a GET request on an action.
	 *
	 * @param  string $action name of the action.
	 * @param  array  $params (optional) route parameters
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getAction($action, $params = array())
	{
		return $this->callAction('GET', $action, $params);
	}

	/**
	 * Perform a POST request on $action.
	 *
	 * @param  string $action name of the action.
	 * @param  array  $params (optional) route parameters
	 * @param  array  $input  (optional) input data
	 * @param  array  $files  (optional) files data
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function postAction($action, $params = array(), $input = array(), $files = array())
	{
		return $this->callAction('POST', $action, $params, $input);
	}

	/**
	 * Assert that we're redirected to an action. If $this->controller is
	 * set, you just need the action name.
	 *
	 * @param  string $action name of the action
	 * @param  array  $params (optional) route parameters
	 * @param  array  $with   (optional) session data
	 *
	 * @return void
	 */
	public function assertRedirectedToAction($action, $params = array(), $with = array())
	{
		$uri = $this->urlToAction($action, $params);

		$this->assertRedirectedTo($uri, $with);
	}

	/**
	 * Helper function to assert that the current route has a filter.
	 * 
	 * WARNING: Does not work with controllers adding filters in their
	 * constructors (e.g. $this->beforeFilter(...))
	 *
	 * @param  string $filtername name of the filter.
	 * @param  string $when       before|after
	 *
	 * @return void
	 */
	public function assertRouteHasFilter($filtername, $when = 'before')
	{
		$route = $this->app['router']->getCurrentRoute();

		if ($when == 'before') {
			$filters = $route->getBeforeFilters();
		} elseif ($when == 'after') {
			$filters = $route->getAfterFilters();
		} else {
			throw new \InvalidArgumentException('$when must be "before" or "after"');
		}

		if ($this->app['router']->currentRouteAction()) {
			$routeName = $this->app['router']->currentRouteAction();
		} elseif ($this->app['router']->currentRouteName()) {
			$routeName = $this->app['router']->currentRouteName();
		} else {
			$routeName = 'Unknown';
		}

		$this->assertEquals(true, in_array($filtername, $filters),
			"Filter $filtername not present in $routeName");
	}

	/**
	 * Check that an input field has a certain value.
	 * 
	 * WARNING: Does not work with Form::model for some reason unless you
	 * manually specify the values in the Form::input calls
	 *
	 * @param  string $id    id of the input field
	 * @param  string $value expected value
	 *
	 * @return void
	 */
	public function assertInputHasValue($id, $value)
	{
		$realValue = $this->crawler->filter('input#'.$id)->first()->attr('value');

		$this->assertEquals($realValue, $value,
			"Unexpected value in input#{$id}: $realValue -- expected $value");
	}

	/**
	 * Perform a request on an action. If $this->controller is set, you
	 * don't need to include the controller name.
	 *
	 * @param  string $method GET, POST, DELETE etc.
	 * @param  string $action method/function/action name
	 * @param  array  $params (optional) parameters
	 * @param  array  $input  (optional) input data
	 * @param  array  $files  (optional) files data
	 *
	 * @return \Illumniate\Http\Response
	 */
	public function callAction($method, $action, $params = array(), $input = array(), $files = array())
	{
		$uri = $this->urlAction($action, $params);

		$this->crawler = $this->client->request($method, $uri, $input, $files);
		
 		return $this->client->getResponse();
	}

	/**
	 * Get the URL to an action. If $this->controller is set, you don't need
	 * to add the controller name.
	 *
	 * @param  string $action name of the action
	 * @param  array  $params (optional) action parameters
	 *
	 * @return void
	 */
	public function urlAction($action, $params = array())
	{
		$action = $this->parseAction($action);

		return $this->app['url']->action($action, $params, true);
	}

	/**
	 * Parse an action input and try to guess the controller/namespace anlutro\L4Based
	 * on whether or not the input has a @ or \. If one or more aren't present,
	 * guess based on $this->controller.
	 *
	 * @param  string $action
	 *
	 * @return string fully namespaced Controller@Action
	 */
	public function parseAction($action)
	{
		if (!isset($this->controller)) {
			return $action;
		}

		if (strpos($action, '@') === false) {
			return $this->controller . '@' . $action;
		} elseif (strpos($action, '\\') === false) {
			$namespace = substr($this->controller, 0, strrpos($this->controller, '\\'));
			return $namespace . '\\' . $action;
		} else {
			return $action;
		}
	}

	/**
	 * Assert that the session has a given list of values.
	 * 
	 * With improved error message when $value is null.
	 *
	 * @param  string|array  $key
	 * @param  mixed  $value
	 * @return void
	 */
	public function assertSessionHas($key, $value = null)
	{
		if (is_array($key)) return $this->assertSessionHasAll($key);

		if (is_null($value)) {
			$this->assertTrue($this->app['session']->has($key), "Session missing key [$key]");
		} else {
			$this->assertEquals($value, $this->app['session']->get($key));
		}
	}

	/**
	 * Assert that the session has errors bound.
	 * 
	 * With improved error message when $key is null.
	 * 
	 * @param  string|array  $bindings
	 * @param  mixed  $format
	 * @return void
	 */
	public function assertSessionHasErrors($bindings = array(), $format = null)
	{
		$this->assertSessionHas('errors');

		$bindings = (array)$bindings;

		$errors = $this->app['session']->get('errors');

		foreach ($bindings as $key => $value) {
			if (is_int($key)) {
				$this->assertTrue($errors->has($value), "Session missing error [$key]");
			} else {
				$this->assertContains($value, $errors->get($key, $format));
			}
		}
	}
}