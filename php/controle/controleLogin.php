<?php
        include_once "../utils/autoload.php";
        //Login do usuário com sucesso, Login do usuário sem sucesso, Logout do usuário
        if(Usuario::efetuarLogin($_POST['email'], $_POST['senha'])) {
            if($_SESSION['tipo'] == 'analista')
                header("Location:../../view/usuario/analista.php");
            else if($_SESSION['tipo'] == 'programador')
                header("Location:../../view/usuario/programador.php");
        } else if(isset($_POST['email']) && isset($_POST['senha'])) {
            header("Location: ../../view/usuario/login.php");
        } else {
            header("Location:../../view/usuario/login.php");
        }
    ?>