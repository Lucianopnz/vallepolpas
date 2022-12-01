<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//

$dataentrada        = $_POST["entradapolpa"];
$fornecedor         = $_POST["fornecedor"];
$tipo               = $_POST["tipo"];
$fruta              = $_POST["fruta"];
$produto            = $_POST["produto"];
$pesoliquido        = $_POST["peso"];
$tambor             = $_POST["tambor"];
$pesodespolpa       = $_POST["pesodespolpa"];
$observacao         = $_POST["observacao"];
$producao           = "N";
$id                 = $_POST["id"];
$aceite             = "N";
$seq                = str_pad($id , 6 , '0' , STR_PAD_LEFT);
$lote               = substr($fruta, 0, 2).substr("PO", 0, 2).$seq;

    $query = mysqli_query($conectar, "INSERT INTO insumos
      (dataentrada, fornecedor, tipo, fruta, produto, lote, pesoliquido, pesodespolpa, caixas, pesopolpa, aceite, producao, observacao)
      VALUES
      ('$dataentrada', '$fornecedor', '$tipo', '$fruta', '$produto', '$lote', '$pesoliquido', '$pesodespolpa', '$tambor', '$pesopolpa', '$aceite', '$producao', '$observacao')")
      or die( mysqli_error( $conectar) );
?>
