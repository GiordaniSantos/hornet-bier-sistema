<?php
namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository implements RepositoryInterface
{
    protected static $model;

    public static function all(string $orderBy = 'id', string $orderDirection = 'asc'): Collection
    {
        return self::loadModel()::all();
    }

    public static function find(int $id): Model|null
    {
        return self::loadModel()->query()->find($id);
    }

    public static function create(array $attributes = []): Model|null
    {
        return self::loadModel()->query()->create($attributes);
    }

    public static function delete(Model $model): bool
    {
        return $model->delete();
    }

    public static function update(Model $model, array $attributes = []): bool
    {
        return $model->update($attributes);
    }

    public static function loadModel(): Model
    {
        return app(static::$model);
    }
}