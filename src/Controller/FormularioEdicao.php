<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\RenderHtmlTrait;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class FormularioEdicao implements RequestHandlerInterface
{
    use RenderHtmlTrait;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $queryString = $request->getQueryParams();

        $id = filter_var(
           $queryString['id'],
           FILTER_VALIDATE_INT
        );

        $resposta = new Response(302, ['Location' => '/listar-cursos']);
        if (is_null($id) || $id === false) {
            header('location: /listar-cursos');
            return $resposta;
        }

        $curso = $this->repositorioCursos->find($id);
        
        $html = $this->renderizarHtml('cursos/novo-curso.php', [
            'curso' => $curso
        ]);

        return new Response(200, [], $html);
    }
   
}