<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public static function all(string $orderBy, string $orderDirection): Collection;
    public static function create(array $attributes): Model|null;
    public static function find(int $id): Model|null;
    public static function delete(Model $model): bool;
    public static function update(Model $model, array $attributes): bool;
    public static function loadModel(): Model;    
}