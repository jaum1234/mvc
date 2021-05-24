<?php

namespace Alura\Cursos\Controller;

abstract class ControllerComHtml
{
    public function renderizarHtml(string $caminho, array $dados): string 
    {
        extract($dados);
        ob_start();
        require __DIR__ . '/../../View/' . $caminho;
        $html = ob_get_clean();

        return $html;
    }
}

