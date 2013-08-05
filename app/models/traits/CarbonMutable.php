<?php
namespace anlutro\L4Base;

trait CarbonMutatableModelTrait
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
		return array_merge($dateTimeFields,
			array(static::CREATED_AT, static::UPDATED_AT, static::DELETED_AT)
		);
	}
}
