<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\RenderHtmlTrait;
use Nyholm\Psr7\Response;
use Alura\Cursos\Infra\EntityManagerCreator;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;


class FormularioInsercao implements RequestHandlerInterface
{
    use RenderHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizarHtml('cursos/novo-curso.php', []);

        return new Response(200, [], $html);
    }
}