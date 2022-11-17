<?php
namespace Nexfor\Api\BancoInter;

class StdSerializable extends \stdClass implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}