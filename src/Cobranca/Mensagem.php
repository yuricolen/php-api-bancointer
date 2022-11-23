<?php
namespace Nexfor\Api\BancoInter\Cobranca;

class Mensagem implements \JsonSerializable
{
    public string $linha1 = "";
    public string $linha2 = "";
    public string $linha3 = "";
    public string $linha4 = "";
    public string $linha5 = ""; 

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
