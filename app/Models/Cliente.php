<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'nome_contato', 'cpf_cnpj', 'cidade', 'email', 'celular', 'celular_secundario', 'telefone'];
}
