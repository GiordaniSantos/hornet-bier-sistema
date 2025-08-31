<?php 
namespace App\Services;

use App\Repositories\OrdemServicoRepository;

class PdfService extends AbstractService
{
    public function __construct(OrdemServicoRepository $repository)
    {
        parent::__construct($repository);
    }
}