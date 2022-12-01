<?php
  session_start();
  $usuariot = $_POST['usuario'];
  $senhat = $_POST['senha'];

  $usuariot = preg_replace('/[^[:alnum:]_.-]/','',$usuariot);
  $senhat = addslashes($senhat);


  $_SESSION['usu'] = $_POST['usuario'];
  //echo $usuariot.' - '.$senhat;
  include_once("valleConexao.php");

  $result = mysqli_query($conectar, "SELECT * FROM usuario WHERE usuario='$usuariot' AND senha='$senhat' LIMIT 1");
  $resultado = mysqli_fetch_assoc($result);
  //$linhas = mysqli_num_rows($resultado);
  //echo "Usuário: ".$resultado['nome'];
  if(empty($resultado)){
  	$_SESSION['loginErro'] = "Usuário ou Senha Inválido";
  	header("Location: index.php"); // alterar: contentor.php
  } else {
    $_SESSION['Usuario'] = $resultado['usuario'];
    $_SESSION['Senha'] = $resultado['senha'];

    $_SESSION['UsuarioTipo'] = $resultado['tipo'];

    // $resul = mysqli_query($conectar, "UPDATE usuario SET conectado='S', ultimoacesso = NOW() WHERE usuario='$usuariot' AND senha='$senhat' LIMIT 1");

  }

  if($_SESSION['UsuarioTipo']  == "A" ){
    // Usuario Administrador
    header("Location: https://vallepolpas.adm.br/vallePainelControle.php");
  }

  elseif($_SESSION['UsuarioTipo'] == "O") {
    // Usuario Operador
    header("Location: https://vallepolpas.adm.br/valleOperador.php");
  }

  elseif($_SESSION['UsuarioTipo'] == "C") {
    // Usuario Produção e Controle
    header("Location: https://vallepolpas.adm.br/vp_controle.php");
  }

?>
