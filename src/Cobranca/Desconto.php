<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class Desconto implements \JsonSerializable
{
    public string $codigoDesconto = "NAOTEMDESCONTO";
    public string $data = "";
    public float $taxa = 0.0;
    public float $valor = 0.0;

    public const NAO_TEM_DESCONTO = 'NAOTEMDESCONTO';
    public const VALOR_FIXO = 'VALORFIXODATAINFORMADA';
    public const PERCENTUAL_FIXO = 'PERCENTUALDATAINFORMADA';
    public const VALOR_DIA_CORRIDO = 'VALORANTECIPACAODIACORRIDO';
    public const VALOR_DIA_UTIL = 'VALORANTECIPACAODIAUTIL';
    public const PERCENTUAL_DIA_CORRIDO = 'PERCENTUALVALORNOMINALDIACORRIDO';
    public const PERCENTUAL_DIA_UTIL = 'PERCENTUALVALORNOMINALDIAUTIL';

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function GetTaxaList()
    {
        $refl = new ReflectionClass($this);
        $list = $refl->getConstants();
        return $list;
    }
}
