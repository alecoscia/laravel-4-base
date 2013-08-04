<?php
namespace App\Tests;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase {
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
	 * Perform a request on one of the defined controller's actions.
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
		$uri = $this->app['url']->action($this->controllerName.'@'.$action, $params, true);
		$this->crawler = $this->client->request($method, $uri, $input, $files);
 		return $this->client->getResponse();
	}

	/**
	 * Perform a GET request on $action in the controller.
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
	 * Perform a POST request on $action in the controller.
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
	 * Our own implementation to avoid having to type the whole controller name over and over.
	 *
	 * @param  string $action name of the action we're supposed to be redirected to.
	 * @param  array  $params (optional) action parameters
	 * @param  array  $with   (optional) session data
	 *
	 * @return void
	 */
	public function assertRedirectedToAction($action, $params = array(), $with = array())
	{
		$uri = $this->app['url']->action($this->controllerName.'@'.$action, $params, true);
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
	 * Our own implementation to avoid having to type the whole controller name over and over.
	 *
	 * @param  string $action name of the action we're supposed to be redirected to.
	 * @param  array  $params (optional) action parameters
	 *
	 * @return void
	 */
	public function urlToAction($action, $params = array())
	{
		return $this->app['url']->action($this->controllerName.'@'.$action, $params, true);
	}
}
