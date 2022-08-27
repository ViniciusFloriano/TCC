<?php
    session_set_cookie_params(0);
    session_start();
    if(!isset($_SESSION['id']) || $_SESSION['id'] == ''){
        header("Location:login.php");
    }
    include_once ("../../php/utils/autoload.php");
    $data = Usuario::consultarData($_SESSION['id'])[0];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Perfil</title>
</head>
<body>
    <?php
        if($_SESSION['tipo'] == "analista"){
            echo "<a role='button' href='../../view/usuario/analista.php'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>";
        }else if($_SESSION['tipo'] == "programador"){
            echo "<a role='button' href='../../view/usuario/programador.php'><img src='../../img/arrow.svg' style='width: 2.5%;'></a>";
        }
    ?>
    <section id="perfil">            
        <form action="../../php/controle/controlePerfil.php?acao=editar" method="post" style="color: #fff;"  class="card-perfil">
            <div><h2>Informações de pefil</h2></div><br>
            <div class="col-auto">
                <div class="input-group">    
                    <label class="input-group-text border border-dark rounded-start" for="nome">Nome completo</label>
                    <input required type="text" id="nome" name="nome" style="background-color:#fff; width: 65%;" value="<?php echo $data['nome'];?>" <?php if(!isset($_GET['update'])) {echo "disabled";}?> class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="email">E-mail</label>
                    <input required type="email" id="email" name="email" style="background-color:#fff; width: 81%;" value="<?php echo $data['email'];?>" <?php if(!isset($_GET['update'])) {echo "disabled";}?> class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" for="senha">Senha</label>
                    <input required onkeyup='confirmarSenha();' type="password" id="senha" name="senha" minlength="6" style="background-color:#fff; width: 82%;" value="<?php if(!isset($_GET['update'])) {echo $data['senha'];}?>" <?php if(!isset($_GET['update'])) {echo "disabled";}?> class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" <?php if(!isset($_GET['update'])) {echo "hidden";}?> for="novasenha">Nova senha</label>
                    <input onkeyup='confirmarSenha();' type="password" id="novasenha" name="novasenha" style="width: 73%;" minlength="6" maxlength="20" <?php if(!isset($_GET['update'])) {echo "hidden";}?> class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div class="col-auto">
                <div class="input-group">
                    <label class="input-group-text border border-dark rounded-start" <?php if(!isset($_GET['update'])) {echo "hidden";}?> for="novasenhaconfirma">Confirmar senha</label>
                    <input onkeyup='confirmarSenha();' type="password" id="novasenhaconfirma" name="novasenhaconfirma" minlength="6" maxlength="20" style="width: 64%;" <?php if(!isset($_GET['update'])) {echo "hidden";}?> class="form-control-sm border border-dark rounded-end">
                </div>
            </div><br>
            <div>
                <div><a onclick="<?php if(isset($_GET['update'])) {echo "return confirm('Deseja mesmo cancelar?')";}?>" href="<?php if(!isset($_GET['update'])) {echo "perfil.php?update=true";} else {echo "perfil.php";}?>"><button style="width: 100%;height: 40px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" type="button" id="editarEcancelar" onclick="editarEcancela()"><?php if(!isset($_GET['update'])) {echo "Editar";} else {echo "Cancelar";}?></button></a></div>
            <br>
                <div><button style="width: 100%;height: 40px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" type="submit" id="enviar" <?php if(!isset($_GET['update'])) {echo "hidden";}?> disabled>Salvar</button></div>
            <br>
                <div><a href="../../php/controle/controleLogin.php"><button style="width: 100%;height: 40px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" type="button">Encerrar sessão</button></a></div>
            <br>
                <div><a onclick="return confirm('Deseja mesmo excluir?')" href="../../php/controle/controlePerfil.php?acao=excluir"><button style="width: 100%;height: 40px;background-color: #a13854;border:none;color:#fff;margin: 10px 0;" type="button" value="excluir">Excluir a conta</button></a></div>
            </div>
        </form>
    </section>
    <script>var senhaAtual = "<?php echo $data["senha"];?>";</script>
    <script src="../../js/perfil.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>