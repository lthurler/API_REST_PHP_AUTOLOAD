<?php

use Util\RotasUtil;
use Validator\RequestValidator;
use Util\ConstantesGenericasUtil;

require_once 'bootstrap.php';


try {
    $requestValidator = new RequestValidator(RotasUtil::getRotas());
    $retorno = $requestValidator->processarRequest();

} catch (Exception $exception)
{
    echo json_encode([
        ConstantesGenericasUtil::TIPO => ConstantesGenericasUtil::TIPO_ERRO,
        ConstantesGenericasUtil::RESPOSTA => utf8_encode($exception->getMessage())
    ]);
    exit;
}
?>
