<?php
namespace App\Repositories;

use App\Models\Problema;

abstract class ProblemaRepository extends AbstractRepository
{
    protected static $model = Problema::class;
}