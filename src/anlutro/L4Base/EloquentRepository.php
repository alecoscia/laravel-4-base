<?php
/**
 * Laravel 4 Base - Eloquent repository class
 *
 * @author    Andreas Lutro <anlutro@gmail.com>
 * @license   http://opensource.org/licenses/MIT
 * @package   Laravel 4 Base
 */

namespace anlutro\L4Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Abstract repository that provides some basic functionality.
 */
abstract class EloquentRepository
{
	/**
	 * @var Illuminate\Database\Eloquent\Model
	 */
	protected $model;

	/**
	 * How the repository should paginate.
	 *
	 * @var false|int
	 */
	protected $paginate = false;

	/**
	 * Dependency inject the model.
	 *
	 * @param Illuminate\Database\Eloquent\Model $model
	 */
	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * Toggle pagination. False or no arguments to disable pagination, otherwise
	 * provide a number of items to show per page.
	 *
	 * @param  mixed $paginate
	 *
	 * @return void
	 */
	public function togglePagination($paginate = false)
	{
		if ($paginate === false) {
			$this->paginate = false;
		} else {
			$this->paginate = (int) $paginate;
		}
	}

	/**
	 * Get the repository's model.
	 *
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * Set the repository's model.
	 *
	 * @param Illuminate\Database\Eloquent\Model $model
	 */
	public function setModel(Model $model)
	{
		$this->model = $model;
	}

	/**
	 * Get all the rows from the database.
	 *
	 * @return mixed
	 */
	public function getAll()
	{
		$query = $this->model->newQuery();

		return $this->runQuery($query);
	}

	/**
	 * Get a single row by its primary key.
	 *
	 * @param  mixed $key
	 *
	 * @return Illuminate\Database\Eloquent\Model|null
	 */
	public function getByKey($key)
	{
		return $this->model->find($key);
	}

	/**
	 * Get a new instance of the repository's model.
	 *
	 * @param  array  $attributes optional
	 *
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function getNew(array $attributes = array())
	{
		return $this->model->newInstance($attributes);
	}

	/**
	 * Save changes an existing model instance.
	 *
	 * @param  Illuminate\Database\Eloquent\Model $model
	 *
	 * @return boolean
	 */
	public function update(Model $model)
	{
		return $model->save();
	}

	/**
	 * Create a new model instance and save it to the database.
	 *
	 * @param  array  $attributes optional
	 *
	 * @return Illuminate\Database\Eloquent\Model
	 */
	public function create(array $attributes = array())
	{
		return $this->model->create($attributes);
	}

	/**
	 * Run a query builder and return its results.
	 *
	 * @param  Illuminate\Database\Query\Builder $query
	 *
	 * @return mixed
	 */
	protected function runQuery(Builder $query)
	{
		$this->prepareQuery($query);

		if ($this->paginate === false) {
			return $query->get();
		} else {
			return $query->paginate($this->paginate);
		}
	}

	/**
	 * This function is ran by runQuery before fetching the results. Put default
	 * behaviours in this function.
	 *
	 * @param  Illuminate\Database\Query\Builder $query
	 *
	 * @return void
	 */
	protected function prepareQuery(Builder $query) {}
}
