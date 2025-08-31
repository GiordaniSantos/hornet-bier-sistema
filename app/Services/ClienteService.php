<?php 
namespace App\Services;

use App\Repositories\ClienteRepository;

class ClienteService extends AbstractService
{
    public function __construct(ClienteRepository $repository)
    {
        parent::__construct($repository);
    }
}