<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class MotivoCancelamento
{
    public const ACERTOS = 'ACERTOS';
    public const APEDIDODOCLIENTE = 'APEDIDODOCLIENTE';
    public const PAGODIRETOAOCLIENTE = 'PAGODIRETOAOCLIENTE';
    public const SUBSTITUICAO = 'SUBSTITUICAO';

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