<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $req = new Requisito('','','','','','','');
        $lista = $req->select('*', "id = $id");
    }

    $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
    $prazo = isset($_POST["prazo"]) ? $_POST["prazo"] : 0;
    $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
    $idpro = isset($_GET["idpro"]) ? $_GET["idpro"] : 0;
    $status = "backlog";
    $table = "requisito";
    $arquivos_permitidos = ['jpg', 'png', 'jpeg', 'docx', 'pdf', ''];
    $nomes = $_FILES['arquivos']['name'];

    if(isset($_POST['acao'])) {
        $acao = $_POST['acao'];
    } else if(isset($_GET['acao'])) {
        $acao = $_GET['acao'];
    } else {
        $acao = "";
    }

    if($acao == "insert") {
        try{
            $req = new Requisito("", $nome, $prazo, $descricao, $documento, $idpro, $status);
            $req->inserir();
            if(isset($_POST["idusu"])){   
                foreach ($_POST['idusu'] as $idusu){
                    $usureq = new Usuario_Requisito($idusu, $idreq);
                    $usureq->inserir();
                }
            }
            for($i = 0; $i < count($nomes); $i++){
                $extensao = explode('.', $nomes[$i]);
                $extensao = end($extensao);
                if(in_array($extensao, $arquivos_permitidos)){
                    $arqreq = new Arquivo_req($nomes[$i], '');
                    $arqreq->inserir();
                    $mover = move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], '../requisitos/' . $nomes[$i]);
                }
            }
            header("location:requisitos.php?idpro=$idpro");
        } catch(Exception $e) {
            echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "editar") {
        try{
            $req = new Requisito($id, $nome, $prazo, $descricao, $documento, $idpro, "");
            $req->editar();
            header("location:requisitos.php?idpro=$idpro");
        } catch(Exception $e) {
            echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
        }
    } else if($acao == "excluir") {
        try{
            $req = new Requisito($id, "", "", "", "", "", "");
            $req->excluir();
            header("location:requisitos.php?idpro=$idpro");
        } catch(Exception $e) {
            echo "<h1>Erro ao excluir as informações.</h1><br> Erro:".$e->getMessage();
        }
    }

    $pdo = Database::iniciaConexao();
    $consulta = $pdo->query("SELECT prazofim FROM projeto WHERE id = $idpro;");
    while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
        $datafim = $linha['prazofim'];
    }

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Requisito</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <a role='button' href='../../view/usuario/requisitos.php?idpro=<?php echo $idpro?>'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>
    <section id="requisito">
        <form action="<?php if(isset($_GET['id'])) { echo "cadRequisito.php?id=$id&idpro=$idpro&acao=editar";} else {echo "cadRequisito.php?acao=insert&idpro=$idpro&status=$status";}?>" method="POST" style="color: #fff;" class="card-projeto" enctype="multipart/form-data">
            <div><h2>Requisito</h2></div><br>
            <input readonly type="hidden" name="id" id="id" value="<?php if (isset($id)) echo $lista[0]['id'];?>">
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="nome">Nome do requisito</label>
                    <input type="text" id="nome" name="nome" style="width: 62%;" required value="<?php if (isset($id)) echo $lista[0]['nome'];?>" class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="prazo">Prazo de Fim</label>
                    <input type="date" id="prazo" name="prazo" style="width: 71.6%;" required value="<?php if (isset($id)) echo $lista[0]['prazo'];?>" class="form-control-sm border border-dark rounded-end" max="<?php echo $datafim;?>">
                </div>
            </div><br>
            <div class="mb-3">
                <label class="form-label" for="descricao">Descrição</label>
                <textarea id="descricao"  name="descricao" rows="3" required placeholder="<?php if (isset($id)) echo $lista[0]['descricao'];?>" maxlength="550" class="form-control"></textarea>
            </div><br>
            <div class="col-auto">
                <div class="mb-3">
                    <input type="file" multiple id="arquivos[]" name="arquivos[]" required value="<?php if (isset($id)) echo $arquivo;?>" class="form-control border border-dark rounded">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="programador">Programador</label>
                    <select name="idusu[]" id="idusu[]" style="width: 71.3%; text-align: center;" class="form-select-sm border border-dark rounded-end" multiple aria-label="Floating label select example">
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
                <button style="width: 100%;height: 40px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" type="submit"><?php if (isset($id)){ echo "Alterar Requisito"; }else echo "Cadastrar Requisito";?></button>
            </div>
        </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>