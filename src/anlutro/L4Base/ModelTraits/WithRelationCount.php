<?php
/**
 * Laravel 4 Base - Eager load relation count model trait
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   Laravel 4 Base
 */

namespace anlutro\L4Base\ModelTraits;

use Illuminate\Database\Query\Expression;

/**
 * Trait for withRelationCount scope functionality.
 */
trait WithRelationCount
{
	/**
	 * Allows for eager loading of relation counts.
	 * 
	 * Model::withRelationCount(['relation1', 'relation2'])->get();
	 * $model->relation1_count;
	 * 
	 * @todo  any way to get rid of the select table.* at the end?
	 *
	 * @param  Builder      $query
	 * @param  array|string $relations
	 *
	 * @return Builder
	 */
	public function scopeWithRelationCount($query, $relations)
	{
		$relations = (array) $relations;

		foreach ($relations as $relation) {
			$instance = $this->$relation();
			$relQuery = $instance->getRelated()->newQuery();
			$relCountQuery = $instance->getRelationCountQuery($relQuery);
			$sql = $relCountQuery->toSql();

			$query->mergeBindings($relCountQuery->getQuery())
				->addSelect(new Expression("($sql) as {$relation}_count"));
		}

		// dirty hack... if anyone knows how to avoid it please let me know!
		return $query->addSelect($this->table.'.*');
	}
}
