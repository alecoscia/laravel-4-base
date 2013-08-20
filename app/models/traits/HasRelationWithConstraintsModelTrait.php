<?php
/**
 * Laravel 4 Base - ->has() with constraints
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   Laravel 4 Base
 */

namespace anlutro\L4Base;

trait HasRelationWithConstraintsModelTrait
{
	/**
	 * Allows to use has() with constraints.
	 * 
	 * Example: Get all Models where related models have color=blue.
	 * 
	 * Model::hasConstraint('related' function($query, $table) {
	 *   $query->where("$table.color", '=', 'red');
	 * })->get();
	 *
	 * @param  Builder  $query
	 * @param  string   $relation
	 * @param  Closure  $constraints
	 *
	 * @return Builder
	 */
	public function scopeHasConstraint($query, $relation, $constraints)
	{
		$instance = $this->$relation();

		$foreignTable = $instance->getModel()->getTable();
		$foreignKey = $instance->getForeignKey();

		$query->join($foreignTable, $foreignTable.'.'.$foreignKey, '=', $this->table.'.'.$this->primaryKey);

		call_user_func($constraints, $query, $foreignTable);
		
		return $query->addSelect($this->table . '.*');
	}
}
