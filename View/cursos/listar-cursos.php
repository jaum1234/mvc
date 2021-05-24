<?php include __DIR__ . '/../inicio-html.php'?>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1>Listar cursos</h1>
        </div>
        <?php if (isset($_SESSION['mensagem'])): ?>
        <div class="alert alert-<?=$_SESSION['tipo_mensagem']?>">
        <?=$_SESSION['mensagem'];?>
        </div>
<?php
        unset($_SESSION['mensagem']); 
        unset($_SESSION['tipo_mensagem']); 
    endif; 
    ?>        

        <a href="/novo-curso" class="btn btn-primary mb-2">Novo curso</a>

        <ul class="list-group">
            <?php foreach ($cursos as $curso): ?>
            <li class="list-group-item d-flex justify-content-between">
                <?=$curso->getDescricao();?>
                <span>
                    <a href="/alterar-curso?id=<?=$curso->getId()?>" class="btn btn-info bt-sm">Alterar</a>
                    <a href="/excluir-curso?id=<?=$curso->getId();?>" class="btn btn-danger bt-sm">Excluir</a>
                </span>
            </li>
            <?php endforeach;?>
        </ul>
    </div>

<?php include __DIR__ . '/../fim-html.php'?>
