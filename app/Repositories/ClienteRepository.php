<?php
namespace App\Repositories;

use App\Models\Cliente;

abstract class ClienteRepository extends AbstractRepository
{
    protected static $model = Cliente::class;
}