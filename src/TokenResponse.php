<?php

namespace Nexfor\Api\BancoInter;

class TokenResponse implements \JsonSerializable
{
    public string $access_token;
    public string $token_type;
    public int $expires_in;
    public string $scope;

    public function __construct(string $access_token, string $token_type, int $expires_in, string $scope)
    {
        $this->access_token = $access_token;
        $this->token_type = $token_type;
        $this->expires_in = $expires_in;
        $this->scope = $scope;
    }

    function IsExpired() : bool
    {
        return (time() >= ($this->token->expires_in - 10));
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
