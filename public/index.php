<?php

require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\ListarCursos;
use Alura\Cursos\Controller\Persistencia;
use Alura\Cursos\Controller\FormularioInsercao;

$caminho = $_SERVER['PATH_INFO'];
$rotas = require __DIR__ . '/../config/routes.php';

if (!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

$ehRotaDeLogin = stripos($caminho, 'login');
if (!isset($_SESSION['logado']) && $ehRotaDeLogin === false) {
    header('Location: /login');
    exit();
}

$classControladora = $rotas[$caminho];
$controlador = new $classControladora();
$controlador->processarRequisicao();



/*
switch ($_SERVER['PATH_INFO']) {
    case '/listar-cursos':  
        $controlador = new ListarCursos();
        $controlador->processarRequisicao();
        break;
    case '/novo-curso': 
        $controlador = new FormularioInsercao();
        $controlador->processarRequisicao();
        break;
    case '/salvar-curso':
        $controlador = new Persistencia();
        $controlador->processarRequisicao();
        break;
    default:
        echo "ERRO 404";
        break;     
}
*/


