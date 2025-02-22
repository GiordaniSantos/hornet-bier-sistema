<?php
namespace App\Enums;

enum TaxaPagamento: int
{
    case Nao = 1;
    case CartaoCredito = 2;
    case CartaoDebito = 3;
    case Boleto = 4;
    case Pix = 5;

    public static function getDescription($value)
    {
        return match ($value) {
            self::Nao->value => 'Não Cobrado',
            self::CartaoCredito->value => 'Cartão de Crédito - 5,31%',
            self::CartaoDebito->value => 'Débito - 3,99%',
            self::Boleto->value => 'Boleto - R$3,49',
            self::Pix->value => 'Pix - 0,99%',
            default => 'Sem taxa',
        };
    }

    public function descricao(): string
    {
        return match($this) {
            self::Nao => 'Não Cobrado',
            self::CartaoCredito => 'Cartão de Crédito - 5,31%',
            self::CartaoDebito => 'Débito - 3,99%',
            self::Boleto => 'Boleto - R$3,49',
            self::Pix => 'Pix - 0,99%',
        };
    }

    public static function getInputOptions(): array
    {
        return array_reduce(self::cases(), function ($carry, $item) {
            $carry[$item->value] = $item->descricao();
            return $carry;
        }, []);
    }
}