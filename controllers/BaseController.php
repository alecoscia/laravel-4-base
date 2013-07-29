<?php
namespace App\Controllers;

use URL, Redirect;

abstract class BaseController extends \Controller
{
	/**
	 * The fully namespaced class name. Used by helper methods. If you set it
	 * yourself you'll save PHP a tiny bit of processing power, otherwise it'll
	 * still find out itself.
	 *
	 * @var string
	 */
	protected $classname;

	/**
	 * Helper function to retrieve this controller's action URLs.
	 *
	 * @param  string $action name of the action to look for
	 * @param  array  $params route parametersa
	 *
	 * @return string         the URL to the action.
	 */
	protected function actionUrl($action, $params = array())
	{
		if (!isset($this->classname)) {
			$this->classname = get_class($this);
		}

		return URL::action($this->classname.'@'.$action, $params);
	}

	/**
	 * Helper function to redirect to another action in the controller.
	 *
	 * @param  string $action name of the action to look for
	 * @param  array  $params (optional) additional parameters
	 *
	 * @return Redirect       a Redirect response.
	 */
	protected function redirectToAction($action, $params = array())
	{
		if (!isset($this->classname)) {
			$this->classname = get_class($this);
		}

		return Redirect::action($this->classname.'@'.$action, $params);
	}
}
