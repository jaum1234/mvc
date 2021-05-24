<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\RenderHtmlTrait;

class ListarCursos implements InterfaceControladorRequisicao
{
    use RenderHtmlTrait;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $this->repositorioDeCursos = $entityManager->getRepository(Curso::class);
    }

    public function processarRequisicao(): void
    {
        $cursos = $this->repositorioDeCursos->findAll();
        echo $this->renderizarHtml('cursos/listar-cursos.php', [
            'cursos' => $cursos
        ]);
    }
}
