<?php
/**
 * Laravel 4 Base - Eager load relation count with constraint model trait
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   Laravel 4 Base
 */

namespace anlutro\L4Base;

use Illuminate\Database\Query\Expression;

trait WithConstrainedRelationCountModelTrait
{
	/**
	 * Allows for eager loading of relation counts with constraints.
	 * 
	 * Model::withConstrainedRelationCount(['relation' => function($query) {
	 *     $query->where('field', '=', 'value');
	 * }])->get();
	 * 
	 * Returns the model plus a field for count of relations where field=value.
	 * 
	 * $model->relation_count;
	 *
	 * @param  Builder $query
	 * @param  array   $relations  ['rel' => function($query) { ... }]
	 *
	 * @return Builder
	 */
	public function scopeWithConstrainedRelationCount($query, array $relations)
	{
		$relations = (array) $relations;

		foreach ($relations as $relation => $constraint) {
			$instance = $this->$relation();
			$relQuery = $instance->getRelationCountQuery($instance->getRelated()->newQuery());
			$relQuery = $constraint($query);

			$query->mergeBindings($relQuery->getQuery())
				->addSelect(new Expression('('.$relQuery->toSql().') as '.$relation.'_count'));
		}

		// dirty hack... if anyone knows how to avoid it please let me know!
		return $query->addSelect('*');
	}
}
