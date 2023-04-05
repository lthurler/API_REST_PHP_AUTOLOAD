<?php

namespace Service;


use InvalidArgumentException;
use Util\ConstantesGenericasUtil;
use Repository\UsuariosRepository;


class UsuariosService
{
    private array $dados;
    private object $UsuariosRepository;

    public const TABELA = 'usuarios';
    public const RECURSOS_GET = ['listar'];

    
    public function __construct($dados = [])
    {
        $this->dados = $dados;
        $this->UsuariosRepository = new UsuariosRepository();
    }

    public function validarGet()
    {
        $retorno = null;
        $recurso = $this->dados['recurso'];
        
        if(in_array($recurso, self::RECURSOS_GET))
        {
            $retorno = $this->dados['id'] > 0 ? $this->getOneByKey() :$this->recurso();

        } else 
        {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_RECURSO_INEXISTENTE);
        }

        if ($retorno === null)
        {
            throw new InvalidArgumentException(ConstantesGenericasUtil::MSG_ERRO_GENERICO);
        }

    }

    private function getOneByKey()
    {

    }

    private function listar()
    {
        return $this->UsuariosRepository->getMySQL()->getAll(self::TABELA);
    }
}
?>
