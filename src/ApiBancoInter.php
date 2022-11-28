<?php
namespace Nexfor\Api\BancoInter;

use Exception;
use RuntimeException;
use stdClass;

abstract class ApiBancoInter
{
    protected string $base_url = 'https://cdpj.partners.bancointer.com.br';
    protected TokenRequest $token_request;
    protected string $crt_path;
    protected string $key_path;
    public ?TokenResponse $token;
    public string $response;

    public function __construct(TokenRequest $token_request, string $crt_path, string $key_path, ?TokenResponse $token = null)
    {
        if (!file_exists($crt_path)) throw new Exception("Arquivo crt não foi encontrado");
        if (!file_exists($key_path)) throw new Exception("Arquivo key não foi encontrado");

        $this->token_request = $token_request;
        $this->crt_path = $crt_path;
        $this->key_path = $key_path;
        $this->token = $token;
    }

    public function GetTokenOAuth(): TokenResponse
    {
        $response = $this->PostRequest('oauth/v2/token', $this->token_request, [] , false);

        if($response->http_code != 200) throw new Exception("Inter API Token Response {$response->http_code}");
        
        $token = json_decode($response->body);
        $token->{'expires_in'} = time() + $token->{'expires_in'};

        return new TokenResponse(
            $token->{'access_token'},
            $token->{'token_type'},
            $token->{'expires_in'},
            $token->{'scope'}
        );
    }

    private function CheckOAuthToken(): void
    {
        if($this->token == null || $this->token->IsExpired()){
            $this->token = $this->GetTokenOAuth();
        }
    }

    private function CrulInit(array $http_params = [])
    {
        $ch = curl_init();

        curl_setopt_array(
            $ch,
            [
                CURLOPT_HTTPHEADER => $http_params,
                CURLOPT_SSLCERT => $this->crt_path,
                CURLOPT_SSLKEY => $this->key_path,
                CURLOPT_RETURNTRANSFER => true
            ]
        );
        return $ch;
    }

    private function CrurlExec($ch) : \stdClass
    {
        $server_response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        $errno = curl_errno($ch);

        curl_close($ch);

        if ($error !== '') throw new Exception($error);

        if ($server_response == '') throw new Exception("Resposta vazia, provavelmente o limite de chamadas foi atingido...\n");

        $obj = new StdSerializable();
        $obj->http_code = $http_code;
        $obj->body = $server_response;

        $this->body_response = $obj;

        return $obj;
    }

    private function GetUrl(string $endpoint) : string
    {
        $url = ltrim($endpoint, '/');
        $url = rtrim($url, '/');

        if(empty($endpoint)) throw new Exception("Nenhum endpoint informado");         
        
        return $this->base_url . '/' . $endpoint;
    }

    protected function GetRequest(string $endpoint, array $http_params = []) : \stdClass
    { 
        $this->CheckOAuthToken();

        $http_params[] = "Authorization: {$this->token->token_type} {$this->token->access_token}" ;

        $ch = $this->CrulInit($http_params);
        curl_setopt_array(
            $ch,
            [
                CURLOPT_URL => $this->GetUrl($endpoint),
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2,
                CURLOPT_HTTPHEADER => $http_params
            ]  
        );
        return $this->CrurlExec($ch);
    }

    protected function PostRequest(string $endpoint, \JsonSerializable $data, array $http_params = [], $post_json = true) : \stdClass
    {
        if (!($data instanceof TokenRequest)) {
            $this->CheckOAuthToken();
        }

        if (empty($http_params)) {
            $http_params = ['Content-type: application/' . ($post_json ? 'json' : 'x-www-form-urlencoded')];
        }

        if ($post_json) {
            $prepared_data = json_encode($data);
        } else {
            $prepared_data = http_build_query($data->jsonSerialize());
        }
        
        if($this->token) $http_params[] = "Authorization: {$this->token->token_type} {$this->token->access_token}" ;

        $ch = $this->CrulInit($http_params);
        curl_setopt_array(
            $ch,
            [
                CURLOPT_URL => $this->GetUrl($endpoint),
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $prepared_data
            ]  
        );

        return $this->CrurlExec($ch);
    }

    protected function PutRequest(string $endpoint, \JsonSerializable $data, array $http_params = [])
    {
        $prepared_data = json_encode($data);

        array_push($http_params, ['Content-type: application/json']) ;

        $ch = $this->CrulInit($http_params);
        curl_setopt_array(
            $ch,
            [
                CURLOPT_URL => $this->GetUrl($endpoint),
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS => $prepared_data
            ]  
        );

        return $this->CrurlExec($ch);
    }

    protected function DeleteRequest(string $endpoint, array $http_params = [])
    {
        array_push($http_params, ['Content-type: application/x-www-form-urlencoded']) ;

        $ch = $this->CrulInit($http_params);
        curl_setopt_array(
            $ch,
            [
                CURLOPT_URL => $this->GetUrl($endpoint),
                CURLOPT_CUSTOMREQUEST => 'DELETE'
            ]  
        );

        return $this->CrurlExec($ch);
    }
}
