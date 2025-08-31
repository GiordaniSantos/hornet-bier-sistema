<?php 
namespace App\Services;

use App\Repositories\PecaRepository;
use Illuminate\Database\Eloquent\Model;

class PecaService extends AbstractService
{
    public function __construct(PecaRepository $repository)
    {
        parent::__construct($repository);
    }

    public function createPeca(array $attributes): Model
    {
        $attributes['valor_unitario'] = $this->formatValor($attributes['valor_unitario']);
        return $this->repository->create($attributes);
    }

    public function updatePeca(Model $peca, array $attributes): bool
    {
        $attributes['valor_unitario'] = $this->formatValor($attributes['valor_unitario']);
        return $this->repository->update($peca, $attributes);
    }

    public function delete(Model $peca): bool
    {
        return $this->repository->delete($peca);
    }

    protected function formatValor(string $valor): string
    {
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        return $valor;
    }
}