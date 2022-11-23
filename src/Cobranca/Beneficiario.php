<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use ReflectionClass;

class Beneficiario implements \JsonSerializable
{
    public string $nome;
    public string $cpfCnpj;
    public string $tipoPessoa;
    public string $cep;
    public string $endereco;
    public string $bairro;
    public string $cidade;
    public string $uf;

    public const PESSOA_FISICA = "FISICA";
    public const PESSOA_JURIDICA = "JURIDICA";
    
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }

    public function GetTipoPessoaList()
    {
        $refl = new ReflectionClass($this);
        $list = $refl->getConstants();
        return $list;
    }
}
?>