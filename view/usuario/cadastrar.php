<!DOCTYPE html>
<?php
    session_start();
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $usu = new Usuario('','','','','');
        $lista = $usu->select('*', "id = $id");
    }

    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $email2 = isset($_POST["email2"]) ? $_POST["email2"] : "";
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
    $senha2 = isset($_POST["senha2"]) ? $_POST["senha2"] : "";
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : "";
    $table = "usuario";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $usu = new Usuario("", $nome, $email, $senha, $tipo);
            $usu->inserir();
            header("location:cadsucesso.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Cadastrar</title>
</head>
<body>
    <section id="cadastrar">
        <form action="cadastrar.php?acao=insert" method="POST" class="card">
            <div class="card-header-cadastrar">
                <h2>Cadastrar</h2>
            </div>
            <div class="card-content">
                <input readonly type="hidden" name="id" id="id">
                <div class="card-content-area">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" autocomplete="off" autofocus required>
                </div>
                <div class="card-content-area">
                    <label for="email">Email</label>
                    <input onkeyup='confirmacao();' type="email" id="email" name="email" autocomplete="off" required>
                </div>
                <div class="card-content-area">
                    <label for="email2">Confirmar Email</label>
                    <input onkeyup='confirmacao();' type="email" id="email2" name="email2" autocomplete="off" required>
                </div>
                <div class="card-content-area">
                    <label for="password">Senha</label>
                    <input onkeyup='confirmacao();' type="password" id="senha" name="senha" autocomplete="off" minlength="6" maxlength="20" required>
                </div>
                <div class="card-content-area">
                    <label for="password2">Confirmar Senha</label>
                    <input onkeyup='confirmacao();' type="password" id="senha2" name="senha2" autocomplete="off" minlength="6" maxlength="20" required>
                </div>
                <div class="card-content-area">
                    <label for="">Tipo de conta</label><br>
                    <select name="tipo" id="tipo">
                        <option id="analista" name="analista" value="analista">Analista</option>
                        <option id="programador" name="programador" value="programador">Programador</option>
                    </select>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" value="cadastrar" class="submit" name="enviar" id="enviar" disabled>Cadastrar</button>
                <p class="a">Já tem conta? <a href="login.php">Logar</a></p>
            </div>
        </form>
    </section>
    <script src="../../js/cadastro.js"></script>
</body>
</html>