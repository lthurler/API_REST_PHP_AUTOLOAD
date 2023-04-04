<?php

use Util\RotasUtil;
use Validator\RequestValidator;

require_once 'bootstrap.php';


try {
    $requestValidator = new RequestValidator(RotasUtil::getRotas());
    $retorno = $requestValidator->processarRequest();

} catch (Exception $exception)
{
    echo $exception->getMessage();
}

?>
