<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\StatusOrdemServico;

class OrdemServico extends Model
{
    use HasFactory;

    protected $table = 'ordem_servicos';

    protected $fillable = ['status', 'modelo', 'serie', 'descricao_servico', 'valor', 'pecas_utilizadas', 'cliente_id'];

    public static function rules(): array
    {
        return [
            'modelo' => 'max:300',
            'serie' => 'max:200',
            //'valor' => 'numeric',
            'cliente_id' => 'required|exists:clientes,id'
        ];
    }

    public static function feedback(): array
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'modelo.max' => 'O campo :attribute não pode ultrapassar 300 caracteres.',
            'serie.max' => 'O campo :attribute não pode ultrapassar 200 caracteres.',
            'cliente_id.exists' => 'O cliente informado não existe!',
            'cliente_id.required' => 'O cliente deve ser selecionado!',
            //'valor.numeric' => "O campo :attribute deve ser do tipo numérico"
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            if (!$model->numero) {
                $model->numero = $model->id.'/'.date('Y');
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
            default => 'Status desconhecido',
        };
    }

    public function cliente(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id', 'id');
    }

    public function problemas()
    {
        return $this->belongsToMany(Problema::class, 'ordem_servico_problemas', 'ordem_servico_id', 'problema_id');
    }
}
