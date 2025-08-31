<?php
namespace App\Repositories;

use App\Models\Cliente;

class ClienteRepository extends AbstractRepository
{
    public function __construct(Cliente $model)
    {
        parent::__construct($model);
    }
}