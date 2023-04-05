<?php

namespace Validator;


use Util\jsonUtil;
use Service\UsuariosService;
use Util\ConstantesGenericasUtil;
use Repository\TokensAutorizadosRepository;

class RequestValidator
{

    private $request;
    private array $dadosRequest;
    private object $TokensAutorizadosRepository;


    const GET = 'GET';
    const DELETE = 'DELETE';
    const USUARIOS = 'USUARIOS';


    public function __construct($request)
    {
        $this->request = $request;
        $this->TokensAutorizadosRepository = new TokensAutorizadosRepository();
    }

    public function processarRequest()
    {
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);        
        $this->request['metodo'] == 'POST';

        if (in_array($this->request['metodo'], ConstantesGenericasUtil::TIPO_REQUEST, true))
        {
            $retorno = $this->direcionarRequest();
        }

        return $retorno;
    }

    private function direcionarRequest()
    {
        if ($this->request['metodo']  !== self::GET && $this->request['metodo']  !== self::DELETE)
        {
            $this->dadosRequest = jsonUtil::tratarCorpoRequisicaoJson();
        }
        
        $this->TokensAutorizadosRepository->validarToken(getallheaders()['Authorization']);
        $metodo = $this->request['metodo'];
        
        return $this->$metodo();
    }

    private function get()
    {
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);

        if (in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_GET, 'strict'))
        {
            switch ($this->request['rota'])
            {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $retorno = $UsuariosService->validarGet();
            }
        }

    }


}
?>
