<?php
namespace Nexfor\Api\BancoInter\Cobranca;

class Boleto implements \JsonSerializable
{
    public string $seuNumero;
    public float $valorNominal = 0.0;    
    public string $dataVencimento;
    public int $numDiasAgenda = 60;
    //public float $valorAbatimento = 0.0;

    public Pagador $pagador;
    public ?Mensagem $mensagem;
    public ?Desconto $desconto1;
    public ?Desconto $desconto2;
    public ?Desconto $desconto3;
    public ?Multa $multa;
    public ?Mora $mora;
    public ?Beneficiario $beneficiario;

    public string $nossoNumero;
    public string $codigoBarras;
    public string $linhaDigitavel;

    public string $dataEmissao;
    //public string $dataLimite = "SESSENTA";
    //public $cnpjCPFBeneficiario = null;

    public const SESSENTA_DIAS = 60;
    public const TRINTA_DIAS = 30;

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
