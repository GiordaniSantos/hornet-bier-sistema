<?php 
namespace App\Services;

use App\Repositories\MarcaRepository;

class MarcaService extends AbstractService
{
    public function __construct(MarcaRepository $repository)
    {
        parent::__construct($repository);
    }
}