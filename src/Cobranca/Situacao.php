<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class Situacao
{
    public const EXPIRADO = 'EXPIRADO';
    public const VENCIDO = 'VENCIDO';
    public const EMABERTO = 'EMABERTO';
    public const PAGO = 'PAGO';
    public const CANCELADO = 'CANCELADO';
    
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public static function GetMotivoCancelamentoList()
    {
        $refl = new ReflectionClass(__CLASS__);
        $list = $refl->getConstants();
        return $list;
    }
}