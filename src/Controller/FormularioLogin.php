<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\RenderHtmlTrait;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioLogin implements RequestHandlerInterface
{
    use RenderHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizarHtml('login/formulario.php', []);

        return new Response(302, [], $html);
    }
    
}