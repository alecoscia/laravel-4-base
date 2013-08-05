<?php
namespace App\Tests;

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

		return require __DIR__.'/../../bootstrap/start.php';
	}

	/**
	 * The controller to test, fully namespaced.
	 *
	 * @var string
	 */
	protected $controllerName;

	/**
	 * Perform a request on an action. If $this->controllerName is set, you
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
		$action = $this->parseAction($action);
		$uri = $this->app['url']->action($action, $params, true);

		$this->crawler = $this->client->request($method, $uri, $input, $files);
		
 		return $this->client->getResponse();
	}

	/**
	 * Perform a GET request on an action.
	 *
	 * @param  string $action name of the action.
	 * @param  array  $params (optional) parameters
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
	 * @param  array  $params (optional) parameters
	 * @param  array  $params (optional) parameters
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
	 * Assert that we're redirected to an action. If $this->controllerName is
	 * set, you just need the action name.
	 *
	 * @param  string $action name of the action
	 * @param  array  $params (optional) action parameters
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
	public function assertRouteHasFilter($filtername, $when='before')
	{
		$route = $this->app['router']->getCurrentRoute();

		if ($when == 'before') {
			$filters = $route->getBeforeFilters();
		} elseif ($when == 'after') {
			$filters = $route->getAfterFilters();
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
			"Disrepency in input#$id - Expected: $value - Real: $realValue");
	}

	/**
	 * Get the URL to an action. If $this->controllerName is set, you don't need
	 * to add the controller name.
	 *
	 * @param  string $action name of the action
	 * @param  array  $params (optional) action parameters
	 *
	 * @return void
	 */
	public function urlToAction($action, $params = array())
	{
		$action = $this->parseAction($action);

		return $this->app['url']->action($action, $params, true);
	}

	/**
	 * Check if $this->controllerName has been set and if the action given
	 * contains a @, then return the appropriate full action name.
	 *
	 * @param  string $action
	 *
	 * @return string
	 */
	public function parseAction($action)
	{
		if (strpos($action, '@') === false && !empty($this->controllerName)) {
			return $this->controllerName . '@' . $action;
		}

		return $action;
	}
}
