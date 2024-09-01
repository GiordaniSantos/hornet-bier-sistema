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
}
