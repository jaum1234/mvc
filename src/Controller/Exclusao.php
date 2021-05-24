<?php

namespace Alura\Cursos\Controller;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Curso;
use Alura\Cursos\FlashMessageTrait;
use Alura\Cursos\Infra\EntityManagerCreator;


class Exclusao implements InterfaceControladorRequisicao
{
    use FlashMessageTrait;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }

    public function processarRequisicao(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        if (is_null($id) || $id === false) {
            $this->defineMensagem('danger', 'Curso nao existe');
            header('Location: /listar-cursos');
            return;
        }

        $curso = $this->entityManager->getReference(Curso::class, $id);
        $this->entityManager->remove($curso);
        $this->entityManager->flush();
        $this->defineMensagem('success', 'Curso excluido com sucesso');


        header('Location: /listar-cursos');
    }
}
