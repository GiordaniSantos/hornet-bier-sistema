<?php
namespace App\Enums;

enum StatusOrdemServico: string
{
    case Aberto = 'AB';
    case Fechado = 'FC';
    case EmAndamento = 'EA';
    case NaoExecutado = 'NE';

    public static function getDescription($value)
    {
        return match ($value) {
            StatusOrdemServico::Aberto->value => 'Aberto',
            StatusOrdemServico::EmAndamento->value => 'Em Andamento',
            StatusOrdemServico::Fechado->value => 'Fechado',
            StatusOrdemServico::NaoExecutado->value => 'Não Executado',
            default => 'Status desconhecido',
        };
    }
}