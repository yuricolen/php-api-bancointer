<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class Multa implements \JsonSerializable
{
    public string $codigoMulta = "NAOTEMMULTA";
    public string $data = "";
    public float $taxa = 0.0;
    public float $valor = 0.0;

    public const NAO_TEM_MULTA = 'NAOTEMMULTA';
    public const VALOR_FIXO = 'VALORFIXO';
    public const PERCENTUAL = 'PERCENTUAL';

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function GetCodigoMoraList()
    {
        $refl = new ReflectionClass($this);
        $list = $refl->getConstants();
        return $list;
    }
}
