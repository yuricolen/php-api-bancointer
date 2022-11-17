<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class Mora implements \JsonSerializable
{
    private $codigoMora = "ISENTO";
    private $data = "";
    private $taxa = 0.0;
    private $valor = 0.0;

    public const ISENTO = 'ISENTO';
    public const TAXA_MENSAL = 'TAXAMENSAL';
    public const VALOR_POR_DIA = 'VALORDIA';

    /**
     * @return string
     */
    public function getCodigoMora()
    {
        return $this->codigoMora;
    }

    /**
     * @return number
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @return number
     */
    public function getTaxa()
    {
        return $this->taxa;
    }

    /**
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $codigoMora
     */
    public function setCodigoMora($codigoMora)
    {
        $this->codigoMora = $codigoMora;
        return $this;
    }

    /**
     * @param number $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @param number $taxa
     */
    public function setTaxa($taxa)
    {
        $this->taxa = $taxa;
        return $this;
    }

    /**
     * @param string $data
     */
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

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
