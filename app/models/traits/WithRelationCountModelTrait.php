<?php
/**
 * Laravel 4 Base - Eager load relation count model trait
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   Laravel 4 Base
 */

namespace anlutro\L4Base;

use Illuminate\Database\Query\Expression;

trait WithRelationCountModelTrait
{
	/**
	 * Allows for eager loading of relation counts.
	 * 
	 * Model::withRelationCount('relation1', 'relation2')->get();
	 * $model->relation1_count;
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
			$relQuery = $instance->getRelationCountQuery($instance->getRelated()->newQuery());

			$query->mergeBindings($relQuery->getQuery())
				->addSelect(new Expression('('.$relQuery->toSql().') as '.$relation.'_count'));
		}

		// dirty hack... if anyone knows how to avoid it please let me know!
		return $query->addSelect('*');
	}
}
