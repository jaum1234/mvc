<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Deslogar implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        session_destroy();
        return new Response(300, ['Location' => '/login']);
    }
    
}