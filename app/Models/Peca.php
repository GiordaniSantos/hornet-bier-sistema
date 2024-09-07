<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'valor_unitario'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($peca) {
            if ($peca->ordemServicos()->count() > 0) {
                throw new \Exception('Não é possível deletar esta peça pois ela está relacionada à uma ordem de serviço.');
            }
        });
    }

    public function ordemServicos()
    {
        return $this->belongsToMany(OrdemServico::class, 'ordem_servico_pecas', 'peca_id', 'ordem_servico_id');
    }
}
