<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $req = new Requisito('','','','','','','','');
        $lista = $req->select('*', "id = $id");
    }

    $idpro = isset($_GET["idpro"]) ? $_GET["idpro"] : "";
    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    $table = "requisito";
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>requisitos</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header><br>
    <section>
        <form method="post" style="padding-left: 2em;">
            <h1 style="color:white;">Pesquisar Por:</h1><br>
            <div style="color:white;" class="form-check">
                <input type="radio" name="buscar" value="1" <?php if ($buscar == "1") echo "checked" ?> class="form-check-input">
                <label class="form-check-label" for="flexRadioDefault1">Nome</label><br><br>
            </div>
            <div class="col-auto">
                <div class="input-group">    
                    <div class="input-group-text border border-dark rounded-start">Procurar:</div>
                    <input type="text" name="procurar" id="procurar" size="25" value="<?php echo $procurar;?>" class="form-control-sm border border-dark rounded-end">
                    <button name="acao" id="acao" type="submit" style="background-color: #a13854;border:none;color:#fff;" class="btn btn-dark">Enviar</button>
                </div>
            </div>
        </form>
        <form action="cadRequisito.php?idpro=<?php echo $idpro?>" method="post" style="float: right;padding-right: 2em;">    
            <button style="width: 100%;height: 40px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" class="btn" type="submit">Cadastrar Requisito</button>
        </form>
        <div style="padding-left: 2em;padding-right: 2em;">
            <table border='1' class="table table-light table-striped">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">Nome do requisito</th>
                        <th scope="col">Detalhes</th>
                        <th scope="col">Andamento</th>
                        <th scope="col">Alterar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $lista = Requisito::listar2($buscar, $procurar, $idpro);
                    foreach ($lista as $linha) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['nome'];?></th>
                        <td scope="row"><a href="verRequisito.php?id=<?php echo $linha['id'];?>&idpro=<?php echo $idpro?>"><img src="../../img/info.svg" alt=""></a></td>
                        <td scope="row"><a href="estadoReq.php?idpro=<?php echo $idpro?>"><img src="../../img/clock.svg" alt=""></a></td>
                        <td scope="row"><a href="cadRequisito.php?id=<?php echo $linha['id'];?>&idpro=<?php echo $idpro?>"><img src="../../img/edit.svg" alt=""></a></td>
                        <td scope="row"><a onclick="return confirm('Deseja mesmo excluir?')" href="cadRequisito.php?id=<?php echo $linha['id'];?>&idpro=<?php echo $idpro?>&acao=excluir"><img src="../../img/trash-2.svg" alt=""></a></td>
                    </tr>
                <?php } ?> 
                </tbody>
            </table>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>