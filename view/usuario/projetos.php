<!DOCTYPE html>
<?php
    include_once "../../php/utils/autoload.php";
    $id = null;
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        $pro = new Projeto('','','','','','');
        $lista = $pro->select('*', "id = $id");
    }

    $buscar = isset($_POST["buscar"]) ? $_POST["buscar"] : 0;
    $procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : "";
    $table = "projeto";

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>projetos</title>
</head>
<body>
    <header>
        <?php include_once "menu.php"; ?>
    </header>
    <section>
    <form method="post" style="padding-left: 0.7px;">
        <h1>Pesquisar Por:</h1>
        <div class="form-check">
            <input type="radio" name="buscar" value="1" <?php if ($buscar == "1") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">ID</label><br>
            <input type="radio" name="buscar" value="2" <?php if ($buscar == "2") echo "checked" ?> class="form-check-input">
            <label class="form-check-label" for="flexRadioDefault1">Nome</label><br>
        </div>
        <div class="col-auto">
            <div class="input-group">    
                <div class="input-group-text border border-dark rounded-start">Procurar:</div>
                <input type="text" name="procurar" id="procurar" size="25" value="<?php echo $procurar;?>" class="form-control-sm border border-dark rounded-end">
            </div><br>
        </div>
        <button name="acao" id="acao" type="submit" class="btn btn-dark">Procurar</button>
        <br><br>
    </form>
        <div>
            <table border='1' class="table table-light table-striped">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">#ID</th>
                        <th scope="col">Nome do projeto</th>
                        <th scope="col">Prazo</th>
                        <th scope="col">Descição</th>
                        <th scope="col">Documento</th>
                        <th scope="col">Programador</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $lista = Projeto::listar($buscar, $procurar);
                    foreach ($lista as $linha) {
                ?>
                    <tr>
                        <th scope="row"><?php echo $linha['id'];?></th>
                        <th scope="row"><?php echo $linha['nome'];?></th>
                        <th scope="row"><?php $date = strtotime($linha['prazo']);$dia = date('d/m/Y',$date);echo $dia;?></th>
                        <th scope="row"><?php echo $linha['descricao'];?></th>
                        <th scope="row"><?php echo $linha['documento'];?></th>
                        <th scope="row"><?php echo $linha['idusu'];?></th>
                    </tr>
                <?php } ?> 
                </tbody>
            </table>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>