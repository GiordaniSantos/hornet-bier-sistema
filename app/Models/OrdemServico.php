<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusOrdemServico;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = 'ordem_servicos';

    protected $fillable = ['status', 'modelo', 'serie', 'numero_motor', 'valor', 'cliente_id', 'observacao', 'marca_id', 'voltagem'];

    public static function rules(): array
    {
        return [
            'modelo' => 'max:300',
            'numero_motor' => 'max:300',
            'observacao' => 'max:1000',
            'serie' => 'max:200',
            //'valor' => 'numeric',
            'voltagem' => 'required|in:127,220',
            'cliente_id' => 'required|exists:clientes,id'
        ];
    }

    public static function feedback(): array
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'numero_motor.max' => 'O campo Número do Motor não pode ultrapassar 300 caracteres.',
            'observacao.max' => 'O campo Observação não pode ultrapassar 1000 caracteres.',
            'modelo.max' => 'O campo :attribute não pode ultrapassar 300 caracteres.',
            'serie.max' => 'O campo :attribute não pode ultrapassar 200 caracteres.',
            'cliente_id.exists' => 'O cliente informado não existe!',
            'cliente_id.required' => 'O cliente deve ser selecionado!',
            'voltagem.in' => 'O valor deve ser 127V ou 220V',
            //'valor.numeric' => "O campo :attribute deve ser do tipo numérico"
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            if (!$model->numero) {
                $model->numero = $model->id.'.'.$model->cliente->id.'.'.date('Y');
                $model->save();
            }
            if (!$model->status) {
                $model->status = StatusOrdemServico::Aberto->value;
                $model->save();
            }
        });
    }

    public function getStatusFormatado()
    {
        return match ($this->status) {
            StatusOrdemServico::Aberto->value => 'Aberto',
            StatusOrdemServico::Fechado->value => 'Fechado',
            StatusOrdemServico::EmAndamento->value => 'Em Andamento',
            StatusOrdemServico::NaoExecutado->value => 'Não Executado',
            default => 'Status desconhecido',
        };
    }

    public function getWhatsappLink($isApi = false)
    {
        if (!($this->cliente->celular)) {
            return false;
        }

        $ordens = [];
        $ordens[] = $this;
        $mensagem = Helper::formataMensagemWhatsapp($ordens);

        if($isApi){
            return Helper::getWhatsappUrlApi(Helper::getWhatsappCelular($this->cliente->celular), $mensagem);
        }

        return Helper::getWhatsappUrl(Helper::getWhatsappCelular($this->cliente->celular), $mensagem);
    }

    public function cliente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }

    public function marca(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Marca', 'marca_id', 'id');
    }

    public function problemas()
    {
        return $this->belongsToMany(Problema::class, 'ordem_servico_problemas', 'ordem_servico_id', 'problema_id');
    }

    public function servicos()
    {
        return $this->belongsToMany(Servico::class, 'ordem_servico_servicos', 'ordem_servico_id', 'servico_id');
    }

    public function pecas()
    {
        return $this->belongsToMany(Peca::class, 'ordem_servico_pecas', 'ordem_servico_id', 'peca_id')->withPivot(['quantidade', 'valor_peca']);
    }
}
