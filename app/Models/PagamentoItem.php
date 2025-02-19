<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PagamentoItem extends Model
{
    use HasFactory;

    public $table = 'pagamento_itens';

    protected $fillable = ['valor_item', 'cliente_id', 'ordem_servico_id', 'pagamento_id'];
    
    public function cliente(): HasOne
    {
        return $this->hasOne(Cliente::class, 'id', 'cliente_id');
    }

    public function ordemServico(): HasOne
    {
        return $this->hasOne(OrdemServico::class, 'id', 'ordem_servico_id');
    }
}
