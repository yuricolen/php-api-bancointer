<?php
namespace Nexfor\Api\BancoInter;

use DateTime;
use Exception;
use Nexfor\Api\BancoInter\Cobranca\Boleto;
use Nexfor\Api\BancoInter\Cobranca\FiltrarDataPor;
use Nexfor\Api\BancoInter\Cobranca\MotivoCancelamento;
use Nexfor\Api\BancoInter\Cobranca\OrdenarPor;
use Nexfor\Api\BancoInter\Cobranca\Situacao;
use Nexfor\Api\BancoInter\Cobranca\TipoOrdenacao;
use stdClass;

class ApiCobranca extends ApiBancoInter
{
    public function __construct(TokenRequest $token_request, string $crt_path, string $key_path, TokenResponse $token = null)
    {
        parent::__construct($token_request, $crt_path, $key_path, $token);
    }

    public function CreateBoleto(Boleto $boleto): Boleto
    {
        $response = $this->PostRequest('cobranca/v2/boletos', $boleto);

        $obj = json_decode($response->body);

        if($response->http_code != 200) throw new Exception("Inter API Create Boleto Error {$response->http_code}: {$obj->detail}");

        $boleto->nossoNumero = $obj->nossoNumero;
        $boleto->codigoBarras = $obj->codigoBarras;
        $boleto->linhaDigitavel = $obj->linhaDigitavel;

        return $boleto;
    }

    public function GetBoletoList(
        DateTime $data_inicial,
        DateTime $data_final,
        string $filtrar_data_por = FiltrarDataPor::VENCIMENTO,
        string $situacao = Situacao::EMABERTO,        
        int $itens_por_pagina = 100,
        int $pagina_atual = 0,
        string $ordenar_por = OrdenarPor::PAGADOR,
        string $tipo_ordenacao = TipoOrdenacao::ASC,
        string $nome = null,
        string $email = null,
        string $cpf_cnpj = null
        ) : stdClass
    {
        $error_message = "Inter API Get Boleto List Error: ";

        $query_params_array = [
            'dataInicial' => $data_inicial->format('Y-m-d'),
            'dataFinal' => $data_final->format('Y-m-d'),
            'itensPorPagina' => $itens_por_pagina,
            'paginaAtual' => $pagina_atual
        ];

        $filtrar_data_por_list = FiltrarDataPor::GetMotivoCancelamentoList();
        if(!in_array($filtrar_data_por, $filtrar_data_por_list)) throw new Exception($error_message . "Filtro de data inválido.");
        $query_params_array['filtrarDataPor'] = $filtrar_data_por;

        $situacao_list = Situacao::GetMotivoCancelamentoList();
        if(!in_array($situacao, $situacao_list)) throw new Exception($error_message . "Situação do boleto inválida.");
        $query_params_array['situacao'] = $situacao;

        $ordenar_por_list = OrdenarPor::GetMotivoCancelamentoList();
        if(!in_array($ordenar_por, $ordenar_por_list)) throw new Exception($error_message . "Ordenação inválida.");
        $query_params_array['ordenarPor'] = $situacao;

        $tipo_ordenacao_list = TipoOrdenacao::GetMotivoCancelamentoList();
        if(!in_array($tipo_ordenacao, $tipo_ordenacao_list)) throw new Exception($error_message . "Tipo de ordenação inválida.");
        $query_params_array['tipoOrdenacao'] = $situacao;

        if(!empty($nome)) $query_params_array['nome'] = $nome;
        if(!empty($email)) $query_params_array['email'] = $email;
        if(!empty($cpf_cnpj)) $query_params_array['cpfCnpj'] = $cpf_cnpj;

        $query = http_build_query($query_params_array);

        $response = $this->GetRequest('cobranca/v2/boletos/' . $query);

        $obj = json_decode($response->body);

        if($response->http_code != 200) throw new Exception("Inter API Get Boleto List Error {$response->http_code}: {$obj->detail}");

        return $obj;
    }

    public function GetBoletoSumary(
        DateTime $data_inicial,
        DateTime $data_final,
        string $filtrar_data_por = FiltrarDataPor::VENCIMENTO,
        string $situacao = Situacao::EMABERTO,
        string $nome = null,
        string $email = null,
        string $cpf_cnpj = null,
        string $nosso_numero = null
    ) : stdClass
    {
        $error_message = "Inter API Get Boleto List Error: ";

        $query_params_array = [
            'dataInicial' => $data_inicial->format('Y-m-d'),
            'dataFinal' => $data_final->format('Y-m-d')
        ];

        $filtrar_data_por_list = FiltrarDataPor::GetMotivoCancelamentoList();
        if(!in_array($filtrar_data_por, $filtrar_data_por_list)) throw new Exception($error_message . "Filtro de data inválido.");
        $query_params_array['filtrarDataPor'] = $filtrar_data_por;

        $situacao_list = Situacao::GetMotivoCancelamentoList();
        if(!in_array($situacao, $situacao_list)) throw new Exception($error_message . "Situação do boleto inválida.");
        $query_params_array['situacao'] = $situacao;

        if(!empty($nome)) $query_params_array['nome'] = $nome;
        if(!empty($email)) $query_params_array['email'] = $email;
        if(!empty($cpf_cnpj)) $query_params_array['cpfCnpj'] = $cpf_cnpj;
        if(!empty($nosso_numero)) $query_params_array['nossoNumero'] = $cpf_cnpj;

        $query = http_build_query($query_params_array);

        $response = $this->GetRequest('cobranca/v2/boletos/sumario/' . $query);

        $obj = json_decode($response->body);

        if($response->http_code != 200) throw new Exception("Inter API Get Boleto List Error {$response->http_code}: {$obj->detail}");

        return $obj;
    }

    public function GetBoletoDetails(string $nosso_numero) : stdClass
    {
        $response = $this->GetRequest('cobranca/v2/boletos/' . $nosso_numero);

        $obj = json_decode($response->body);

        if($response->http_code != 200) throw new Exception("Inter API Get Boleto Details Error {$response->http_code}: {$obj->detail}");

        return $obj;
    }

    public function GetBoletoBase64PDF(string $nosso_numero) : string
    {
        $response = $this->GetRequest('cobranca/v2/boletos/' . $nosso_numero . '/pdf');

        $obj = json_decode($response->body);

        if($response->http_code != 200) throw new Exception("Inter API Get Boleto Base64 PDF Error {$response->http_code}: {$obj->detail}");

        return $obj->pdf;
    }

    public function CancelBoleto(string $nosso_numero, string $motivo_cancelamento) : bool
    {
        $error_message = "Inter API Cancel Boleto Error: ";    
        $motivo_list = MotivoCancelamento::GetMotivoCancelamentoList();

        if(!in_array($motivo_cancelamento, $motivo_list)) throw new Exception($error_message . "Motivo do cancelamento inválido.");

        $data = new StdSerializable();
        $data->motivoCancelamento = $motivo_cancelamento;

        $response = $this->PostRequest('cobranca/v2/boletos/' . $nosso_numero . '/cancelar' , $data);

        $obj = json_decode($response->body);

        if($response->http_code != 200) throw new Exception($error_message . "{$response->http_code} {$obj->detail}");

        return true;
    }

    public function CreateWebhook(string $callback_url) : bool
    {
        $error_message = "Inter API Create Webhook Error: ";

        $data = new StdSerializable();
        $data->webhookUrl = $callback_url;
        $response = $this->PutRequest('cobranca/v2/boletos/webhook', $data);

        if($response->http_code != 204) throw new Exception($error_message . "{$response->http_code}");

        return true;
    }
    public function GetWebhook(string $motivo) : stdClass
    {
        $error_message = "Inter API Delete Webhook Error: ";
        $response = $this->GetRequest('cobranca/v2/boletos/webhook');

        if($response->http_code != 200) throw new Exception($error_message . "{$response->http_code}");

        $obj = json_decode($response->body);

        return $obj;
    }
    public function DeleteWebhook(string $motivo) : bool
    {
        $error_message = "Inter API Delete Webhook Error: ";

        $response = $this->DeleteRequest('cobranca/v2/boletos/webhook');

        if($response->http_code != 204) throw new Exception($error_message . "{$response->http_code}");

        return true;
    }
}
?>