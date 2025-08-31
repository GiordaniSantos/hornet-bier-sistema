<?php
namespace App\Repositories;

use App\Models\Peca;

class PecaRepository extends AbstractRepository
{
    public function __construct(Peca $model)
    {
        parent::__construct($model);
    }
}