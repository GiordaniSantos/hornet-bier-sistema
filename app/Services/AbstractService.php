<?php 
namespace App\Services;

use App\Interfaces\ServiceInterface;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AbstractService implements ServiceInterface
{
    protected AbstractRepository $repository;

    public function __construct(AbstractRepository $repository)
    {
        $this->repository = $repository;
    }

    public function all(string $orderBy = 'created_at', string $orderDirection = 'desc'): Collection
    {
        return $this->repository->all($orderBy, $orderDirection);
    }

    public function create(array $attributes): Model
    {
        return $this->repository->create($attributes);
    }

    public function update(Model $model, array $attributes): bool
    {
        return $this->repository->update($model, $attributes);
    }

    public function find(int $id): ?Model
    {
        return $this->repository->find($id);
    }

    public function delete(Model $model): bool
    {
        return $this->repository->delete($model);
    }
}