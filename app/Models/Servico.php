<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($servico) {
            if ($servico->ordemServicos()->count() > 0) {
                throw new \Exception('Não é possível deletar este serviço pois ele está relacionado à uma ordem de serviço.');
            }
        });
    }

    public function ordemServicos()
    {
        return $this->belongsToMany(OrdemServico::class, 'ordem_servico_servicos', 'servico_id', 'ordem_servico_id');
    }
}
