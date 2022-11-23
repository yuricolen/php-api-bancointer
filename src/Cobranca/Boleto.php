<?php
namespace Nexfor\Api\BancoInter\Cobranca;

class Boleto implements \JsonSerializable
{
    public string $seuNumero = null;
    public float $valorNominal = 0.0;    
    public string $dataVencimento = null;
    public int $numDiasAgenda = 60;
    //public float $valorAbatimento = 0.0;

    public Pagador $pagador = null;
    public Mensagem $mensagem = null;
    public Desconto $desconto1 = null;
    public Desconto $desconto2 = null;
    public Desconto $desconto3 = null;
    public Multa $multa = null;
    public Mora $mora = null;

    public string $nossoNumero = null;
    public string $codigoBarras = null;
    public string $linhaDigitavel = null;

    public string $dataEmissao = null;
    //public string $dataLimite = "SESSENTA";
    //public $cnpjCPFBeneficiario = null;

    public const SESSENTA_DIAS = 60;
    public const TRINTA_DIAS = 30;

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
