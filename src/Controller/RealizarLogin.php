<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class RealizarLogin implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
        ->getEntityManager();
        $this->repositorioDeUsuarios = $entityManager
        ->getRepository(Usuario::class);
    }

    public function processarRequisicao(): void
    {

        $email = \filter_input(
            INPUT_POST,
            'email',
            FILTER_VALIDATE_EMAIL
        );
        
        if (is_null($email) || $email === false) {
            echo "E-mail inválido";
            return;
        }

        $senha = \filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING
        );

        $usuario = $this->repositorioDeUsuarios->findOneBy([
            'email' => $email
        ]);


        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem('danger', 'E-mail ou senha inválidos');
            \header('Location: /login');
            return;
        }

        $_SESSION['logado'] = true;
        $this->defineMensagem('success', 'Login realizado com sucesso');


        header('Location:/listar-cursos');
    }

    
}

