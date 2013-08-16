<?php
/**
 * Laravel 4 Base - Base Model class
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   Laravel 4 Base
 */

namespace anlutro\L4Base;

abstract class Model extends \Illuminate\Database\Eloquent\Model
{
	/**
	 * Fields that should be retrieved as Carbon objects.
	 *
	 * @var array
	 */
	protected $dateTimeFields = array();

	/**
	* Get the attributes that should be converted to dates.
	*
	* @return array
	*/
	public function getDates()
	{
		return array_merge($this->dateTimeFields,
			array(static::CREATED_AT, static::UPDATED_AT, static::DELETED_AT)
		);
	}

	/**
	 * Override the default save function so that it checks if $this->validate()
	 * exists, if so runs it, and if it fails, return false. It is up to the
	 * implementation of validate() how a failed validation should be handled.
	 * Setting a public $this->validator is a decent idea.
	 *
	 * @return boolean
	 */
	public function save()
	{
		if (method_exists($this, 'validate')) {
			if (!$this->validate()) {
				return false;
			}
		}

		return parent::save();
	}

	/**
	 * An array of the observers currently registered with the model.
	 *
	 * @var array
	 */
	private static $observers = array();

	/**
	 * Register an observer with the model.
	 * 
	 * Overrides the Eloquent method so that an observer can only be registered
	 * once - this allows you to register an observer in the model boot method
	 * if you like.
	 *
	 * @param  string  $class
	 *
	 * @return void
	 */
	public static function observe($class)
	{
		// if the observer is already registered, return void
		if (in_array($class, static::$observers)) {
			return;
		}

		self::$observers[] = $class;

		$className = get_class($class);

		$instance = new static;

		foreach ($instance->getObservableEvents() as $event) {
			if (method_exists($class, $event)) {
				static::registerModelEvent($event, $className.'@'.$event);
			}
		}
	}

	/**
	 * Check if the model has an observer. Leave $class as null to check if the
	 * model has any observers at all.
	 *
	 * @param  string|null  $class
	 *
	 * @return boolean
	 */
	public static function hasObserver($class = null)
	{
		if (is_null($class)) {
			// check if self::$observers has any elements
			return empty(self::$observers) ? true : false;
		}

		if (in_array($class, static::$observers)) {
			return true;
		}

		return false;
	}
}
