<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class Mora implements \JsonSerializable
{
    public string $codigoMora = "ISENTO";
    public string $data = "";
    public float $taxa = 0.0;
    public float $valor = 0.0;

    public const ISENTO = 'ISENTO';
    public const TAXA_MENSAL = 'TAXAMENSAL';
    public const VALOR_POR_DIA = 'VALORDIA';    

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
