<?php
namespace App\Repositories;

use App\Models\Servico;

abstract class ServicoRepository extends AbstractRepository
{
    protected static $model = Servico::class;
}