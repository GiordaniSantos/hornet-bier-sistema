<?php
namespace App\Repositories;

use App\Models\Servico;

class ServicoRepository extends AbstractRepository
{
    public function __construct(Servico $model)
    {
        parent::__construct($model);
    }
}