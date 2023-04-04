<?php

namespace Validator;

class RequestValidator
{
   
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function processarRequest()
    {
        echo 'Continua na proxima parte';
    }
}
?>
