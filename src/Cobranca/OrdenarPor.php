<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class OrdenarPor
{
    public const PAGADOR = 'PAGADOR';
    public const NOSSONUMERO = 'NOSSONUMERO';
    public const SEUNUMERO = 'SEUNUMERO';
    public const DATASITUACAO = 'DATASITUACAO';
    public const DATAVENCIMENTO = 'DATAVENCIMENTO';
    public const VALOR = 'VALOR';
    public const STATUS = 'STATUS';
    
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