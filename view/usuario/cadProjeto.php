<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $pro = new Projeto('','','','','','');
        $lista = $pro->select('*', "id = $id");
    }

    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $prazo = isset($_POST["prazo"]) ? $_POST["prazo"] : 0;
    $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
    $documento = isset($_POST["documento"]) ? $_POST["documento"] : "";
    $idusu = isset($_POST["idusu"]) ? $_POST["idusu"] : "";
    $table = "projeto";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $pro = new Projeto("", $nome, $prazo, $descricao, $documento, $idusu);
            $pro->inserir();
            header("location:projetos.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Cadastrar Projeto</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <section id="projeto">
        <form action="cadProjeto.php?acao=insert" method="POST" style="color: #fff;" class="card-projeto">
            <div><h2>Cadastrar Projeto</h2></div><br>
            <input readonly type="hidden" name="id" id="id">
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="nome">Nome do projeto</label>
                    <input type="text" id="nome" name="nome" required class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="prazo">Prazo</label>
                    <input type="date" id="prazo" name="prazo" required class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="mb-3">
                <label class="form-label" for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="3" required class="form-control"></textarea>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="documento">Documento</label>
                    <input type="text" id="documento" name="documento" required class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="programador">Programador</label>
                    <select name="idusu" id="idusu" class="form-select-sm border border-dark rounded-end" aria-label="Floating label select example">
                        <?php
                            $pdo = Database::iniciaConexao();
                            $consulta = $pdo->query("SELECT * FROM usuario WHERE tipo = 'programador';");
                            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <option value="<?php echo $linha['id'];?>"><?php echo $linha['nome'];?></option>
                        <?php } ?>
                    </select>
                </div>
            </div><br>
            <div>
                <button style="width: 100%;height: 40px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" type="submit">Cadastrar projeto</button>
            </div>
        </form>
    </section>
    <script src="../../js/cadastro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>