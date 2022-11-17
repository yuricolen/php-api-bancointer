<?php
namespace Nexfor\Api\BancoInter\Cobranca;

class Boleto implements \JsonSerializable
{
    private $seuNumero = null;
    private $valorNominal = 0.0;
    private $valorAbatimento = 0.0;
    private $dataVencimento = null;
    private $numDiasAgenda = 60;

    private $pagador = null;
    private $mensagem = null;
    private $desconto1 = null;
    private $desconto2 = null;
    private $desconto3 = null;
    private $multa = null;
    private $mora = null;

    private $nossoNumero = null;
    private $codigoBarras = null;
    private $linhaDigitavel = null;

    private $dataEmissao = null;
    private $dataLimite = "SESSENTA";
    private $cnpjCPFBeneficiario = null;

    public const SESSENTA_DIAS = 60;
    public const TRINTA_DIAS = 30;

    /**
     * @deprecated Esse campo não é mais utilizado
     * @return mixed
     */
    public function getDataEmissao()
    {
        return $this->dataEmissao;
    }

    /**
     * @return mixed
     */
    public function getSeuNumero()
    {
        return $this->seuNumero;
    }

    /**
     * @deprecated Esse campo não é mais utilizado
     * @return string
     */
    public function getDataLimite()
    {
        return $this->dataLimite;
    }

    /**
     * @return mixed
     */
    public function getDataVencimento()
    {
        return $this->dataVencimento;
    }

    /**
     * @return number
     */
    public function getValorNominal()
    {
        return $this->valorNominal;
    }

    /**
     * @return number
     */
    public function getValorAbatimento()
    {
        return $this->valorAbatimento;
    }

    /**
     * @deprecated Esse campo não é mais utilizado
     * @return mixed
     */
    public function getCnpjCPFBeneficiario()
    {
        return $this->cnpjCPFBeneficiario;
    }

    /**
     * @return int
     */
    public function getNumDiasAgenda()
    {
        return $this->numDiasAgenda;
    }

    /**
     *
     * @return Pagador
     */
    public function getPagador(): Pagador
    {
        return $this->pagador;
    }

    /**
     *
     * @return Mensagem
     */
    public function getMensagem(): Mensagem
    {
        return $this->mensagem;
    }

    /**
     * @return Desconto
     */
    public function getDesconto1(): Desconto
    {
        return $this->desconto1;
    }

    /**
     * @return Desconto
     */
    public function getDesconto2(): Desconto
    {
        return $this->desconto2;
    }

    /**
     * @return Desconto
     */
    public function getDesconto3(): Desconto
    {
        return $this->desconto3;
    }

    /**
     * @return \ctodobom\APInterPHP\Cobranca\Multa
     */
    public function getMulta(): Multa
    {
        return $this->multa;
    }

    /**
     * @return \ctodobom\APInterPHP\Cobranca\Mora
     */
    public function getMora(): Mora
    {
        return $this->mora;
    }

    /**
     * @deprecated Esse campo não é mais utilizado
     * @param mixed $dataEmissao
     */
    public function setDataEmissao($dataEmissao)
    {
        $this->dataEmissao = $dataEmissao;
        return $this;
    }

    /**
     * @param mixed $seuNumero
     */
    public function setSeuNumero($seuNumero)
    {
        $this->seuNumero = $seuNumero;
        return $this;
    }

    /**
     * @deprecated Esse campo não é mais utilizado
     * @param string $dataLimite
     */
    public function setDataLimite($dataLimite)
    {
        $this->dataLimite = $dataLimite;
        return $this;
    }

    /**
     * @param mixed $dataVencimento
     */
    public function setDataVencimento($dataVencimento)
    {
        $this->dataVencimento = $dataVencimento;
        return $this;
    }

    /**
     * @param number $valorNominal
     */
    public function setValorNominal($valorNominal)
    {
        $this->valorNominal = $valorNominal;
        return $this;
    }

    /**
     * @param number $valorAbatimento
     */
    public function setValorAbatimento($valorAbatimento)
    {
        $this->valorAbatimento = $valorAbatimento;
        return $this;
    }

    /**
     * @deprecated Esse campo não é mais utilizado
     * @param mixed $cnpjCPFBeneficiario
     */
    public function setCnpjCPFBeneficiario($cnpjCPFBeneficiario)
    {
        $this->cnpjCPFBeneficiario = $cnpjCPFBeneficiario;
        return $this;
    }

    /**
     * @param int $numDiasAgenda
     */
    public function setNumDiasAgenda(int $numDiasAgenda)
    {
        $this->numDiasAgenda = $numDiasAgenda;
        return $this;
    }

    /**
     *
     * @param Pagador $pagador
     */
    public function setPagador(Pagador $pagador)
    {
        $this->pagador = $pagador;
        return $this;
    }

    /**
     *
     * @param Mensagem $mensagem
     */
    public function setMensagem(Mensagem $mensagem)
    {
        $this->mensagem = $mensagem;
        return $this;
    }

    /**
     * @param \ctodobom\APInterPHP\Cobranca\Desconto $desconto1
     */
    public function setDesconto1($desconto1)
    {
        $this->desconto1 = $desconto1;
        return $this;
    }

    /**
     * @param \ctodobom\APInterPHP\Cobranca\Desconto $desconto2
     */
    public function setDesconto2($desconto2)
    {
        $this->desconto2 = $desconto2;
        return $this;
    }

    /**
     * @param \ctodobom\APInterPHP\Cobranca\Desconto $desconto3
     */
    public function setDesconto3($desconto3)
    {
        $this->desconto3 = $desconto3;
        return $this;
    }

    /**
     * @param \ctodobom\APInterPHP\Cobranca\Multa $multa
     */
    public function setMulta(Multa $multa)
    {
        $this->multa = $multa;
        return $this;
    }

    /**
     * @param \ctodobom\APInterPHP\Cobranca\Mora $mora
     */
    public function setMora(Mora $mora)
    {
        $this->mora = $mora;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNossoNumero()
    {
        return $this->nossoNumero;
    }

    /**
     * @return mixed
     */
    public function getCodigoBarras()
    {
        return $this->codigoBarras;
    }

    /**
     * @return mixed
     */
    public function getLinhaDigitavel()
    {
        return $this->linhaDigitavel;
    }

    /**
     * @param mixed $nossoNumero
     */
    public function setNossoNumero($nossoNumero)
    {
        $this->nossoNumero = $nossoNumero;
        return $this;
    }

    /**
     * @param mixed $codigoBarras
     */
    public function setCodigoBarras($codigoBarras)
    {
        $this->codigoBarras = $codigoBarras;
        return $this;
    }

    /**
     * @param mixed $linhaDigitavel
     */
    public function setLinhaDigitavel($linhaDigitavel)
    {
        $this->linhaDigitavel = $linhaDigitavel;
        return $this;
    }

    public function __construct()
    {
        $this->mensagem = new Mensagem();
        $this->desconto1 = new Desconto();
        $this->desconto2 = new Desconto();
        $this->desconto3 = new Desconto();
        $this->multa = new Multa();
        $this->mora = new Mora();
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
