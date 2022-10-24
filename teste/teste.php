<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="database/upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="arquivos[]" multiple required>
    <input type="submit">
  </form>

  <p>
    <?php
      if(isset($_SESSION['erro'])):
        echo $_SESSION['erro'];
        session_unset();
      elseif(isset($_SESSION['sucesso'])):
        echo $_SESSION['sucesso'];
        session_unset();
      endif;
    ?>
  </p>
</body>
</html>