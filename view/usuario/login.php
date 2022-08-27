<?php
    include_once "../../php/utils/autoload.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Login</title>
</head>
<body>
    <section id="login">
        <form action="../../php/controle/controleLogin.php" method="post" id="form" class="card">
            <div class="card-header-login">
                <h2>Login</h2>
            </div>
            <div class="card-content">
                <div class="card-content-area">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" autocomplete="off" autofocus required>
                </div>
                <div class="card-content-area">
                    <label for="password">Senha</label>
                    <input type="password" id="senha" name="senha" autocomplete="off" required>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" value="Login" class="submit">
                <p class="a">Não tem conta? <a href="cadastrar.php">Cadastrar</a></p>
                <a href="#" class="recuperar_senha">Esqueceu a senha?</a>
            </div>
        </form>
    </section>
</body>
</html>