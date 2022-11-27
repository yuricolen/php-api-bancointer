<?php
namespace Nexfor\Api\BancoInter\Cobranca;

use Exception;
use ReflectionClass;

class Pagador extends Beneficiario implements \JsonSerializable
{
    public ?string $numero;
    public ?string $complemento;
    public ?string $email;
    public ?string $ddd;
    public ?string $telefone;

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
