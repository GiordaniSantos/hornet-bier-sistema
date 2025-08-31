<?php 
namespace App\Services;

use App\Repositories\ServicoRepository;

class ServicoService extends AbstractService
{
    public function __construct(ServicoRepository $repository)
    {
        parent::__construct($repository);
    }
}