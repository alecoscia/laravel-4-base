<?php
/**
 * Laravel 4 Base - ->has() with constraints
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   Laravel 4 Base
 */

namespace anlutro\L4Base;

use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

		if ($instance instanceof HasOneOrMany) {
			$query->join($foreignTable, $foreignTable.'.'.$foreignKey, '=', $this->table.'.'.$this->primaryKey);
		} elseif ($instance instanceof BelongsTo) {
			$primaryKey = $instance->getModel()->getKeyName();
			$query->join($foreignTable, $foreignTable.'.'.$primaryKey, '=', $this->table.'.'.$foreignKey);
		} else {
			throw new \InvalidArgumentException('Only works on HasOneOrMany and BelongsTo relationships.');
		}


		call_user_func($constraints, $query, $foreignTable);
		
		return $query->addSelect($this->table . '.*');
	}
}
