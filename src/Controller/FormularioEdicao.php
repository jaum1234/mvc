<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\RenderHtmlTrait;

class FormularioEdicao 
{
    use RenderHtmlTrait;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
        ->getEntityManager();

        $this->repositorioCursos = $entityManager->getRepository(Curso::class);
    }

    public function processarRequisicao()
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            header('location: /listar-cursos');
            return;
        }

        $curso = $this->repositorioCursos->find($id);
        
        echo $this->renderizarHtml('cursos/novo-curso.php', [
            'curso' => $curso
        ]);

    }
}