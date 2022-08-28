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
    $idusu = isset($_POST["idusu"]) ? $_POST["idusu"] : "";
    $table = "projeto";
    $pathToSave = "../requisitos/";

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if ($_FILES) { // Verificando se existe o envio de arquivos.

        if ($_FILES['documento']) { // Verifica se o campo não está vazio.
            $dir = $pathToSave; // Diretório que vai receber o arquivo.
            $tmpName = $_FILES['documento']['tmp_name']; // Recebe o arquivo temporário.
            $name = $_FILES['documento']['name']; // Recebe o nome do arquivo.
            preg_match_all('/\.[a-zA-Z0-9]+/', $name, $extensao);
            if (!in_array(strtolower(current(end($extensao))), array('.txt', '.pdf', '.doc', '.xls', '.xlms', '.docx'))) {
                echo('Permitido apenas arquivos doc, xls, pdf, docx e txt.');
                die;
            }
            move_uploaded_file($tmpName, $dir.$name);
            $documento = "localhost/tcc/view/requisitos/".$_FILES['documento']['name'];
        }  
    }

    if($acao == "insert") {
        try{
            $pro = new Projeto("", $nome, $prazo, $descricao, $documento, $idusu);
            $pro->inserir();
            header("location:projetos.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao editar as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {

            $pro = new Projeto($id, $nome, $prazo, $descricao, $documento, $idusu);
            $pro->editar();
            header("location:projetos.php");

    } else if($acao == "excluir") {
        try{
            $pro = new Projeto($id, "", "", "", "", "");
            $pro->excluir();
            header("location:projetos.php");
        } catch(Exception $e) {
            echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
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
        <form action="<?php if(isset($_GET['id'])) { echo "cadProjeto.php?id=$id&acao=editar";} else {echo "cadProjeto.php?acao=insert";}?>" method="POST" style="color: #fff;" class="card-projeto" enctype="multipart/form-data">
            <div><h2>Cadastrar Projeto</h2></div><br>
            <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="nome">Nome do projeto</label>
                    <input type="text" id="nome" name="nome" required value="<?php if (isset($id)) echo $lista[0]['nome'];?>" class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="prazo">Prazo</label>
                    <input type="date" id="prazo" name="prazo" required value="<?php if (isset($id)) echo $lista[0]['prazo'];?>" class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="mb-3">
                <label class="form-label" for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" rows="3" required value="<?php if (isset($id)) echo $lista[0]['descricao'];?>" class="form-control"></textarea>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="documento">Documento</label>
                    <input type="file" id="documento" name="documento" required value="<?php if (isset($id)) echo $arquivo;?>" class="form-control-sm border border-dark rounded-end">
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