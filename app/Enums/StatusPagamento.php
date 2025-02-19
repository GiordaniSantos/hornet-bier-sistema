<?php
namespace App\Enums;

enum StatusPagamento: string
{
    case Pendente = 'pendente';
    case Pago = 'pago';
    case Falhou = 'falhou';
}