<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Entity\Curso;
use Alura\Cursos\RenderHtmlTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Alura\Cursos\Controller\ControllerComHtml;

class FormularioInsercao implements InterfaceControladorRequisicao
{
    use RenderHtmlTrait;

    public function processarRequisicao(): void
    {
        echo $this->renderizarHtml('cursos/novo-curso.php', []);
    }
}