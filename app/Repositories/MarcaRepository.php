<?php
namespace App\Repositories;

use App\Models\Marca;

class MarcaRepository extends AbstractRepository
{
    public function __construct(Marca $model)
    {
        parent::__construct($model);
    }
}