<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\RenderHtmlTrait;

class FormularioLogin implements InterfaceControladorRequisicao
{
    use RenderHtmlTrait;

    public function processarRequisicao(): void
    {
        echo $this->renderizarHtml('login/formulario.php', []);
    }
}