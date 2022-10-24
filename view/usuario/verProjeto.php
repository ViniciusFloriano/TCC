<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = $_GET['id'];
    $analista = $_GET['analista'];
    $dados = Projeto::consultarData($id)[0];
    $table = "projeto";
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Projeto</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <a role='button' href='../../view/usuario/projetos.php?analista=<?php echo $analista?>'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>
    <section id="projeto">
        <form action="requisitos.php?idpro=<?php echo $dados['id']?>" method="POST" style="color: #fff;" class="card-projeto">
            <div><h2>Projeto</h2></div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="nome">Nome do projeto</label>
                    <input type="text" id="nome" name="nome" style="width: 65.3%; background-color:#fff;" required style="background-color:#fff;" class="form-control-sm border border-dark rounded-end" value="<?php echo $dados['nome'];?>" disabled>
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="prazoinicio"> Prazo de Início </label>
                    <input type="date" id="prazoinicio" name="prazoinicio" style="width: 68.5%; background-color:#fff;" required value="<?php if (isset($id)) echo $dados['prazoinicio'];?>" class="form-control-sm border border-dark rounded-end" disabled>
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="prazofim"> Prazo de Fim </label>
                    <input type="date" id="prazofim" name="prazofim" style="width: 71.6%; background-color:#fff;" required value="<?php if (isset($id)) echo $dados['prazofim'];?>" class="form-control-sm border border-dark rounded-end" disabled>
                </div>
            </div><br>
            <div class="mb-3">
                <label class="form-label" for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="3" required style="background-color:#fff;" class="form-control" placeholder="<?php echo $dados['descricao'];?>" disabled></textarea>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="documento">Baixar arquivo do projeto</label>
                    <a href='../../<?php echo $dados['documento'];?>' download style="width: 50.5%;background-color:#c93854;color:#ffffff;" class="border border-dark btn btn-danger rounded-end" role="button">Download</a>
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="edital">Edital</label>
                    <input type="text" id="edital" name="edital" style="width: 83.7%; background-color:#fff;" required style="background-color:#fff;" class="form-control-sm border border-dark rounded-end" value="<?php echo $dados['edital'];?>" disabled>
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="programador">Programador(es)</label>
                    <select name="idusu" id="idusu" style="width: 64.9%; text-align: center;" class="form-select-sm border border-dark rounded-end" multiple aria-label="Floating label select example" disabled>
                        <?php
                            $pdo = Database::iniciaConexao();
                            $consulta = $pdo->query("SELECT usuario.nome FROM usuario_projeto LEFT JOIN usuario ON (usuario_projeto.idusu = usuario.id) AND $id = usuario_projeto.idpro AND usuario.status = 'ativado';");
                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option><?php echo $linha['nome'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div><br>
            <div>
                <button style="width: 100%;height: 40px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" type="submit">Requisitos</button>
            </div>
        </form> 
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>