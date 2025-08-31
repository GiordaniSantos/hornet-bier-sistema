<?php 
namespace App\Services;

use App\Repositories\ProblemaRepository;

class ProblemaService extends AbstractService
{
    public function __construct(ProblemaRepository $repository)
    {
        parent::__construct($repository);
    }
}