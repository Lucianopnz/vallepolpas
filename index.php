<?php
  session_start();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="imagens/favicon.ico">

    <title>Valle Polpas</title>

    <link href="css/logar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  </head>

<body>

  <?php
    unset($_SESSION['Usuario'],
          $_SESSION['Senha'],
          $_SESSION['Tipo']
    );
  ?>

<div class="wrapper fadeInDown">
  <div id="formContent" style="background: #00cc00;">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <br/>
      <h4>Valle Polpas</h4>
      <h6>Indústria e Comércio</h6>
      <!-- <img src="imagens\logoVP.png"  alt="User Icon" height="80" width="60" /> -->
    </div>

    <!-- Login Form -->
    <form method="POST" action="valleValidalogin.php">

      <input type="text"  class="fadeIn second" name="usuario" placeholder="Usuário">
      <input type="password"  class="fadeIn third" name="senha" placeholder="Senha">
      <input type="submit" class="fadeIn fourth" value="Conectar" style="background: #5D6D7E;">

    </form>

    <!-- Remind Passowrd -->
    <div id="formFooter">
      <?php
        if(isset($_SESSION['loginErro'])){
          echo $_SESSION['loginErro'];
          unset($_SESSION['loginErro']);
        }
      ?>
      <!-- <a class="underlineHover" href="#">Forgot Password?</a> -->
    </div>

  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>
