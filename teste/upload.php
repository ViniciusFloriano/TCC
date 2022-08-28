<!DOCTYPE html>
<html>
<body>

<form name="form" method="post" action="upload.php" enctype="multipart/form-data">
    <fieldset class="infraFieldset">
        <legend class="infraLegend">Enviar Arquivos</legend>
        <label id="lblArquivo" for="txtArquivo" class="infraLabelObrigatorio">Documento:</label>
        <input type="file" id="txtArquivo" name="txtArquivo" value="" />
        <button type="submit" accesskey="S" name="sbmSalvar" class="infraButton"><span class="infraTeclaAtalho">E</span>nviar</button>
    </fieldset>
</form>

</body>
</html>
<?php
    $pathToSave = "uploads/";

    /*Checa se a pasta existe - caso negativo ele cria*/
    if (!file_exists($pathToSave)) {
        mkdir($pathToSave);
    }

    if ($_FILES) { // Verificando se existe o envio de arquivos.

        if ($_FILES['txtArquivo']) { // Verifica se o campo não está vazio.
            $dir = $pathToSave; // Diretório que vai receber o arquivo.
            $tmpName = $_FILES['txtArquivo']['tmp_name']; // Recebe o arquivo temporário.

            $name = $_FILES['txtArquivo']['name']; // Recebe o nome do arquivo.
            preg_match_all('/\.[a-zA-Z0-9]+/', $name, $extensao);
            if (!in_array(strtolower(current(end($extensao))), array('.txt', '.pdf', '.doc', '.xls', '.xlms', '.docx'))) {
                echo('Permitido apenas arquivos doc, xls, pdf, docx e txt.');
                header('Location:upload.php');
                die;
            }

            // move_uploaded_file( $arqTemporário, $nomeDoArquivo )
            if (move_uploaded_file($tmpName, $dir.$name)) { // move_uploaded_file irá realizar o envio do arquivo.        
                echo('Arquivo adicionado com sucesso.');
            } else {
                echo('Erro ao adicionar arquivo.');
            }
            echo "<a href='".$dir.$name."' download> Baixar </a>";
        }  
    }

?>