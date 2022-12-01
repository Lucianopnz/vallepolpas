<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//

$dataentrada        = $_POST["dataentrada"];
$fornecedor         = $_POST["fornecedor"];
$endereco           = $_POST["endereco"];
$telefone           = $_POST["telefone"];
$cidade             = $_POST["cidade"];
$uf                 = $_POST["uf"];
$tipo               = $_POST["tipo"];
$observacao         = $_POST["observacao"];

$id                 = $_POST["id"];


    $query = mysqli_query($conectar, "INSERT INTO fornecedor
      (dataentrada, fornecedor, endereco, cidade, uf, telefone, tipo, observacao)
      VALUES
      ('$dataentrada', '$fornecedor', '$endereco', '$cidade', '$uf', '$telefone',  '$tipo', '$observacao')")
      or die( mysqli_error( $conectar) );
?>
