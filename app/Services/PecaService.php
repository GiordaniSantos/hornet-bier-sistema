<?php 
namespace App\Services;

use App\Repositories\PecaRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PecaService
{
    protected PecaRepository $pecaRepository;

    public function __construct(PecaRepository $pecaRepository)
    {
        $this->pecaRepository = $pecaRepository;
    }

    public function all(string $oderBy, string $oderDirection): Collection
    {
        return $this->pecaRepository->all($oderBy, $oderDirection);
    }

    public function createPeca(array $attributes): Model
    {
        $attributes['valor_unitario'] = $this->formatValor($attributes['valor_unitario']);
        return $this->pecaRepository->create($attributes);
    }

    public function updatePeca(Model $peca, array $attributes): bool
    {
        $attributes['valor_unitario'] = $this->formatValor($attributes['valor_unitario']);
        return $this->pecaRepository->update($peca, $attributes);
    }

    public function delete(Model $peca): bool
    {
        return $this->pecaRepository->delete($peca);
    }

    protected function formatValor(string $valor): string
    {
        $valor = str_replace('.', '', $valor);
        $valor = str_replace(',', '.', $valor);
        return $valor;
    }
}