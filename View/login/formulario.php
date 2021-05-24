<?php include __DIR__ . '/../inicio-html.php'; ?>

<div class="container">
        <div class="jumbotron">
            <h1>Login</h1>
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
        


    <form action="/realiza-login" method="post">
        <div>
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" class="form-control"></input>
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control"></input>
        </div>

        <button class="btn btn-primary">
            Entrar
        </button>
    </form>

<?php include __DIR__ . '/../fim-html.php'; ?>