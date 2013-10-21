<?php
namespace anlutro\L4Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

abstract class EloquentRepository
{
	protected $model;
	protected $paginate = false;

	public function __construct(Model $model)
	{
		$this->model = $model;
	}

	public function getModel()
	{
		return $this->model;
	}

	public function setModel(Model $model)
	{
		$this->model = $model;
	}

	public function getAll()
	{
		$query = $this->model->newQuery();

		return $this->runQuery($query);
	}

	public function getByKey($key)
	{
		return $this->model->find($key);
	}

	public function getNew(array $attributes = array())
	{
		return $this->model->newInstance($attributes);
	}

	public function update(Model $model)
	{
		return $model->save();
	}

	public function create(array $attributes = array())
	{
		return $this->model->create($attributes);
	}

	protected function runQuery(Builder $query)
	{
		$this->prepareQuery($query);

		if ($this->paginate === false) {
			return $query->get();
		} else {
			return $query->paginate($this->paginate);
		}
	}

	protected function prepareQuery(Builder $query)
	{
		// ...
	}
}
