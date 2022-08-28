<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = $_GET['id'];
    $dados = Projeto::consultarData($id)[0];
    $table = "projeto";


    $pdo = Database::iniciaConexao();
    $consulta = $pdo->query("SELECT usuario.nome FROM usuario, projeto WHERE ".$id." = projeto.id AND usuario.tipo = 'programador' AND usuario.id = projeto.idusu;");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $nome = $linha['nome'];
    }
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Destalhes do Projeto</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <section id="projeto">
        <form method="POST" style="color: #fff;" class="card-projeto">
            <div><h2>Cadastrar Projeto</h2></div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="nome">Nome do projeto</label>
                    <input type="text" id="nome" name="nome" required style="background-color:#fff;" class="form-control-sm border border-dark rounded-end" value="<?php echo $dados['nome'];?>" disabled>
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="prazo">Prazo</label>
                    <input type="date" id="prazo" name="prazo" required style="background-color:#fff;" class="form-control-sm border border-dark rounded-end" value="<?php echo $dados['prazo'];?>" disabled>
                </div>
            </div><br>
            <div class="mb-3">
                <label class="form-label" for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="3" required style="background-color:#fff;" class="form-control" value="<?php echo $dados['descricao'];?>" disabled></textarea>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="documento">Documento</label>
                    <a href='<?php echo $dados['documento'];?>' download>Baixar</a>
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="programador">Programador</label>
                    <input type="text" id="idusu" name="idusu" required style="background-color:#fff;" class="form-select-sm border border-dark rounded-end" value="<?php echo $nome;?>" disabled>
                </div>
            </div><br>
            <div>
                <button style="width: 100%;height: 40px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" type="submit">Cadastrar Requisito</button>
            </div>
        </form>
    </section>
    <script src="../../js/cadastro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>