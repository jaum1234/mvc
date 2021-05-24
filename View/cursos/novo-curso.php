<?php include __DIR__ . '/../inicio-html.php'?>

<body>
    <div class="container">
        <div class="jumbotron">
            <h1>Novo Curso</h1>
        </div>


        <form action="/salvar-curso<?=isset($curso) ? '?id= ' . $curso->getId() : ''?>" method="post">
            <div class="form-group">
               <label for="descricao">Descriçao</label>
               <input
                type="text"
                id="descricao"
                name="descricao"
                class="form-control"
                value="<?=isset($curso) ? $curso->getDescricao() : '';?>">
            </div>
            <button class="btn btn-primary">Salvar</button>
        </form>

    </div>

<?php include __DIR__ . '/../fim-html.php'?>

