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

        static::saved(function ($model) {
            if (!$model->nome_admin) {
                $model->nome_admin = $model->nome.' - '.$model->created_at->format('d/m/Y');
                $model->save();
            }
        });
    }
}
