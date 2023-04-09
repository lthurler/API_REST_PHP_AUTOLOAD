<?php

namespace Validator;


use Util\JsonUtil;
use Service\UsuariosService;
use InvalidArgumentException;
use Util\ConstantesGenericasUtil;
use Repository\TokensAutorizadosRepository;

class RequestValidator
{

    private array $request;
    private array $dadosRequest;
    private object $TokensAutorizadosRepository;


    const GET = 'GET';
    const DELETE = 'DELETE';
    const USUARIOS = 'USUARIOS';



    public function __construct($request)
    {
        $this->TokensAutorizadosRepository = new TokensAutorizadosRepository();
        $this->request = $request;
        $this->dadosRequest = array();
    }

    public function processarRequest()
    {
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);        
        
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
            $this->dadosRequest = JsonUtil::tratarCorpoRequisicaoJson();
        }
        
        $this->TokensAutorizadosRepository->validarToken(getallheaders()['Authorization']);
        $metodo = $this->request['metodo'];
        
        return $this->$metodo();
    }

    private function get()
    {
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);

        if (in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_GET, true))
        {
            switch ($this->request['rota'])
            {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $retorno = $UsuariosService->validarGet();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $retorno;

    }

    private function delete()
    {
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);

        if (in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_DELETE, true))
        {
            switch ($this->request['rota'])
            {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $retorno = $UsuariosService->validarDelete();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $retorno;

    }

    private function post()
    {
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);

        if (in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_POST, true))
        {
            switch ($this->request['rota'])
            {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $UsuariosService->setDadosCorpoRequest($this->dadosRequest);
                    $retorno = $UsuariosService->validarPost();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $retorno;

    }

    private function put()
    {
        $retorno = utf8_encode(ConstantesGenericasUtil::MSG_ERRO_TIPO_ROTA);

        if (in_array($this->request['rota'], ConstantesGenericasUtil::TIPO_PUT, true))
        {
            switch ($this->request['rota'])
            {
                case self::USUARIOS:
                    $UsuariosService = new UsuariosService($this->request);
                    $UsuariosService->setDadosCorpoRequest($this->dadosRequest);
                    $retorno = $UsuariosService->validarPut();
                    break;
                default:
                    throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
            }
        }
        return $retorno;

    }
}
?>
