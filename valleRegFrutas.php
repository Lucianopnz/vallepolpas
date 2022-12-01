<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//

$fruta          = $_POST["fruta"];
$rendimento     = $_POST["rendimento"];
$pesocaixa      = $_POST["pesocaixa"];



    $query = mysqli_query($conectar, "INSERT INTO frutas
      (fruta, rendimento, pesocaixa)
      VALUES
      ('$fruta', '$rendimento', '$pesocaixa')")
      or die( mysqli_error( $conectar) );
?>
