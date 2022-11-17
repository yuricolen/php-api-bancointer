<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class TipoOrdenacao
{
    public const ASC = 'ASC';
    public const DESC = 'DESC';
    
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