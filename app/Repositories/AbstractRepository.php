<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(string $orderBy = 'created_at', string $orderDirection = 'desc'): Collection
    {
        return self::loadModel()::all();
    }

    public function persist(Model $model): bool
    {
        return $model->save();
    }

    public function find(int $id): Model|null
    {
        return self::loadModel()->query()->find($id);
    }

    public function create(array $attributes = []): Model|null
    {
        return self::loadModel()->query()->create($attributes);
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function update(Model $model, array $attributes = []): bool
    {
        return $model->update($attributes);
    }

    public function loadModel(): Model
    {
        return $this->model;
    }
}