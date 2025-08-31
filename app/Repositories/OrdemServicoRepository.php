<?php
namespace App\Repositories;

use App\Models\OrdemServico;

class OrdemServicoRepository extends AbstractRepository
{
    public function __construct(OrdemServico $model)
    {
        parent::__construct($model);
    }
}