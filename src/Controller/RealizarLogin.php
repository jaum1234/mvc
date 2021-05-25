<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Usuario;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class RealizarLogin implements RequestHandlerInterface
{
    use FlashMessageTrait;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioDeUsuarios = $entityManager
        ->getRepository(Usuario::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = \filter_input(
            INPUT_POST,
            'email',
            FILTER_VALIDATE_EMAIL
        );
        
        $resposta = new Response(300, ['Location' => '/login']);
        if (is_null($email) || $email === false) {
            $this->defineMensagem('danger', 'E-mail inválidos');
            return $resposta;
        }

        $senha = \filter_input(
            INPUT_POST,
            'senha',
            FILTER_SANITIZE_STRING
        );

        $usuario = $this->repositorioDeUsuarios->findOneBy([
            'email' => $email
        ]);

        $resposta = new Response(300, ['Location' => '/login']);
        if (is_null($usuario) || !$usuario->senhaEstaCorreta($senha)) {
            $this->defineMensagem('danger', 'E-mail ou senha inválidos');
            \header('Location: /login');
            return $resposta;
        }

        $_SESSION['logado'] = true;
        $this->defineMensagem('success', 'Login realizado com sucesso');


        return new Response(302, ['Location' => '/listar-cursos']);
    }
    
}

