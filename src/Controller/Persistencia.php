<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;

class Persistencia implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }

    public function processarRequisicao(): void
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

        $id = filter_input(
            INPUT_GET,
            'id',
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
        
        header('Location: /listar-cursos', true, 302);
    }
}
