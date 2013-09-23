<?php
/**
 * Laravel 4 Base - ->has() with constraints
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   Laravel 4 Base
 */

namespace anlutro\L4Base\ModelTraits;

use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Expression;

/**
 * Trait for hasConstrained scope functionality.
 */
trait HasConstrained
{

	/**
	 * Allows to use has() with constraints.
	 * 
	 * Example: Get all Models with more than 5 related models where color=blue
	 * 
	 * Model::hasConstrained('related', function($query) {
	 *   $query->where('color', '=', 'red');
	 * }, '>', 5)->get();
	 * 
	 * Put the hasConstrained on the top of your query builder to avoid bugs.
	 *
	 * @param  Builder  $query
	 * @param  string   $relation
	 * @param  Closure  $constraint
	 * @param  string   $operator     default >
	 * @param  int      $number       default 0
	 *
	 * @return Builder
	 */
	public function scopeHasConstrained($query, $relation, $constraint, $operator = '>', $number = 0)
	{
		// get a new query builder for the related model
		$builder = $this->$relation()
			->getRelated()
			->newQuery();

		// get the relation count query
		$subQuery = $this->$relation()
			->getRelationCountQuery($builder);

		// apply user constraint(s)
		$constraint($subQuery);
		
		// get the underlying query builder
		$subQuery = $subQuery->getQuery();

		// get the SQL from the aggregate builder
		$sql = $subQuery->toSql();

		// and finally merge it all together
		return $query->mergeBindings($subQuery)
			->whereRaw( "($sql) $operator ?", [$number] );
	}
}
