<?php
namespace App\Models;

use Carbon\Carbon, DateTime;

abstract class BaseModel extends \Illuminate\Database\Eloquent\Model
{
	/**
	 * Array for storing cached DateTime objects.
	 *
	 * @var array
	 */
	private $dateTimes = array();

	/**
	 * example: public function getTimeAttribute()
	 * { return $this->getDateTimeFieldOf('time'); }
	 *
	 * @param  string $field key of the attribute to get
	 *
	 * @return Carbon (DateTime)
	 */
	private function getDateTimeOf($field)
	{
		if (!isset($this->attributes[$field])) {
			return false;
		} elseif (!isset($this->dateTimes[$field])) {
			$this->dateTimes[$field] = $this->asDateTime($this->attributes[$field]);
		}

		return $this->dateTimes[$field];
	}

	/**
	 * example: public function setTimeAttribute($value)
	 * { $this->setDateTimeOf('time', $value); }
	 *
	 * @param string          $field key of the attribute to set
	 * @param string|DateTime $value what time to set the attribute to
	 */
	private function setDateTimeOf($field, $value)
	{
		if ($this->attributes[$field] = $this->fromDateTime($value)) {
			unset($this->dateTimes[$field]);
		}
	}
}
