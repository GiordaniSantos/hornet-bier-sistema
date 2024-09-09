<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use LaravelLegends\PtBrValidator\Rules\CpfOuCnpj;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'nome_contato', 'cpf_cnpj', 'cidade', 'email', 'celular', 'celular_secundario', 'telefone'];

    public static function rules(Cliente $cliente = null): array
    {
        return [
            'nome' => 'required|max:250',
            //'cpf_cnpj' => ['required', new CpfOuCnpj],
            'cidade' => 'max:200',
            'nome_contato' => 'max:250'
            //'email' => ['max:255', Rule::unique('clientes')->ignore($cliente ? $cliente->id : null)],
        ];
    }

    public static function feedback(): array
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.max' => 'O campo :attribute não pode ultrapassar 250 caracteres.',
            'cidade.max' => 'O campo :attribute não pode ultrapassar 200 caracteres.',
            'nome_contato.max' => 'O campo :attribute não pode ultrapassar 250 caracteres.'
            //'email.max' => 'O campo email não pode ultrapassar 255 caracteres.',
            //'email.email' => 'O campo email deve ser do tipo Email.',
        ];
    }
}
