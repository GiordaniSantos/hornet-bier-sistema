<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problema extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'descricao'];

    public static function rules(): array
    {
        return [
            'nome' => 'required|max:300',
            'descricao' => 'max:815',
        ];
    }

    public static function feedback(): array
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.max' => 'O campo :attribute não pode ultrapassar 300 caracteres.',
            'descricao.max' => 'O campo :attribute não pode ultrapassar 815 caracteres.',
        ];
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($problema) {
            if ($problema->ordemServicos()->count() > 0) {
                throw new \Exception('Não é possível deletar este problema pois ele está relacionado à uma ordem de serviço.');
            }
        });
    }

    public function ordemServicos()
    {
        return $this->belongsToMany(OrdemServico::class, 'ordem_servico_problemas', 'problema_id', 'ordem_servico_id');
    }
}
