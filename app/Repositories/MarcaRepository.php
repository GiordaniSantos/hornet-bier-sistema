<?php
namespace App\Repositories;

use App\Models\Marca;

abstract class MarcaRepository extends AbstractRepository
{
    protected static $model = Marca::class;
}