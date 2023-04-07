<?php

use Util\JsonUtil;
use Util\RotasUtil;
use Validator\RequestValidator;
use Util\ConstantesGenericasUtil;

require_once 'bootstrap.php';


try {
    $requestValidator = new RequestValidator(RotasUtil::getRotas());
    $retorno = $requestValidator->processarRequest();

    $jsonUtil = new JsonUtil();
    $jsonUtil->processarArrayParaRetornar($retorno);

} catch (Exception $exception)
{
    echo json_encode([
        ConstantesGenericasUtil::TIPO => ConstantesGenericasUtil::TIPO_ERRO,
        ConstantesGenericasUtil::RESPOSTA => utf8_encode($exception->getMessage())
    ], JSON_THROW_ON_ERROR, 512);
    exit;
}
?>
