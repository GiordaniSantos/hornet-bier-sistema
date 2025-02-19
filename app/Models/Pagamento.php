<?php

namespace App\Models;

use App\Enums\StatusPagamento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pagamento extends Model
{
    use HasFactory;

    protected $fillable = ['valor', 'status', 'tipo', 'cliente_id', 'ordem_servico_id', 'session_id'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($pagamento) {
            $pagamento->itens()->delete();
        });
    }

    public function getWhatsappLinkPagamento($link = null, $isApi = false)
    {
        if (!($this->itens[0]['cliente']['celular'])) {
            return false;
        }

        $pagamentos = [];
        $pagamentos[] = $this;
        $mensagem = Helper::formataMensagemLinkPagamentoWhatsapp($link, $pagamentos);

        return Helper::getWhatsappUrl(Helper::getWhatsappCelular($this->itens[0]['cliente']['celular']), $mensagem);
    }

    public function isPaid()
    {
        return $this->status === StatusPagamento::Pago->value;
    }

    public function itens(): HasMany
    {
        return $this->hasMany(PagamentoItem::class, 'pagamento_id', 'id');
    }
}
