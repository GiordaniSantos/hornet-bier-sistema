<?php
namespace App\Repositories;

use App\Models\Problema;

class ProblemaRepository extends AbstractRepository
{
    public function __construct(Problema $model)
    {
        parent::__construct($model);
    }
}