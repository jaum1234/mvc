<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Persistencia implements RequestHandlerInterface
{
    use FlashMessageTrait;

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        
        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );

        //filter_temUmaCaralhadaDeCoisa

        //$descricao = $_POST[
        //    'descricao'
        //];

        $curso = new Curso();
        $curso->setDescricao($descricao);

        $queryString = $request->getQueryParams();
        $id = \filter_var(
            $queryString['id'],
            FILTER_VALIDATE_INT
        );

        if (!is_null($id) && $id !== false) {
            $curso->setId($id);
            $this->entityManager->merge($curso);
            $this->defineMensagem('success', 'Curso atualizado com sucesso');

            /*Haja vista que o metodo merge esta depreciado, outra solucao possivel eh:
            $curso = $this->entityManager->find(Curso::class, $id);
            $curso->setDescricao($descricao);           
            */
        } else {
            $this->entityManager->persist($curso);
            $this->defineMensagem('success', 'Curso adicionado com sucesso');

            /* 
            $curso = new Curso();
            $curso->setDescricao($descricao);
            $this->entityManager->persist($curso);
            */
        }
        
        $this->entityManager->flush();
        
        return new Response(302, ['Location' => 'listar-cursos']);
    }
   
}
