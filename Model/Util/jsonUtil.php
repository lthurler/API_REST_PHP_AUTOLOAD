<?php

namespace Util;

use InvalidArgumentException;
use Util\ConstantesGenericasUtil;
use JsonException;


class JsonUtil
{

    public function processarArrayParaRetornar($retorno)
    {
        $dados = [];
        $dados[ConstantesGenericasUtil::TIPO] = ConstantesGenericasUtil::TIPO_ERRO;

        if((is_array($retorno) && count($retorno) > 0) || strlen($retorno) > 10)
        {
            $dados[ConstantesGenericasUtil::TIPO] = ConstantesGenericasUtil::TIPO_SUCESSO;
            $dados[ConstantesGenericasUtil::RESPOSTA] = $retorno;
        }

        $this->retornarJson($dados);

    }

    private function retornarJson($json)
    {
        header('Content-Type: application/json');
        header('Cache-control: no-cache, no-store, must-revalidate');
        header('Access-Control-Allow-Methods: GET,POST,PUT,DELETE');

        echo json_encode($json, JSON_THROW_ON_ERROR, 1024);
        exit;


    }

    public static function tratarCorpoRequisicaoJson()
    {
        try {
            $postJson = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERR0_JSON_VAZIO);
        }
        if (is_array($postJson) && count($postJson) > 0) {
            return $postJson;
        }
    }
}
?>
