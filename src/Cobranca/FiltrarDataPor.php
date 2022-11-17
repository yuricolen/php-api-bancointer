<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class FiltrarDataPor
{
    public const VENCIMENTO = 'VENCIMENTO';
    public const EMISSAO = 'EMISSAO';
    public const SITUACAO = 'SITUACAO';

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