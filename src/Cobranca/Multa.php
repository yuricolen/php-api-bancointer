<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class Multa implements \JsonSerializable
{
    private $codigoMulta = "NAOTEMMULTA";
    private $data = "";
    private $taxa = 0.0;
    private $valor = 0.0;

    public const NAO_TEM_MULTA = 'NAOTEMMULTA';
    public const VALOR_FIXO = 'VALORFIXO';
    public const PERCENTUAL = 'PERCENTUAL';
    /**
     * @return string
     */
    public function getCodigoMulta()
    {
        return $this->codigoMulta;
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
     * @param string $codigos
     */
    public function setCodigoMulta($codigoMulta)
    {
        $this->codigoMulta = $codigoMulta;
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
