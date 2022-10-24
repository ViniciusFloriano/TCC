<?php
session_start();
$utf8 = header("Content-Type:text/html; charset=utf-8");
$con = new mysqli('localhost', 'root', '', 'tcc');
$con->set_charset("utf8");

$arquivos_permitidos = ['jpg', 'png', 'jpeg', 'docx', 'pdf', ''];

$arquivos = $_FILES['arquivos'];

$nomes = $arquivos['name'];

for($i = 0; $i < count($nomes); $i++):
    $extensao = explode('.', $nomes[$i]);
    $extensao = end($extensao);
    $nomes[$i] = rand() . "-" . $nomes[$i];

    if(in_array($extensao, $arquivos_permitidos)):
        $query = $con->query("insert into tb_arquivos values(default,'$nomes[$i]')");

        if(mysqli_affected_rows($con) > 0):
            $mover = move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], '../uploads/' . $nomes[$i]);
            $_SESSION['sucesso'] = "Arquivo enviado com sucesso!";
            $destino = header("Location:../teste.php");
        endif;
    else:
        $_SESSION['erro'] = "erro";
        $destino = header("Location:../teste.php");
    endif;
endfor;