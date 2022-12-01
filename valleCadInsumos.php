<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//

$dataentrada        = $_POST["dataentrada"];
$fornecedor         = $_POST["fornecedor"];
$tipo               = $_POST["tipo"];
$fruta              = $_POST["fruta"];
$variedade          = $_POST["variedade"];
$pesoliquido        = $_POST["peso"];
$caixas             = $_POST["caixas"];
$descarte           = $_POST["descarte"];
$pesoverde           = $_POST["pesoverde"];
$pesodespolpa       = $_POST["pesodespolpa"];
$rendimento         = $_POST["rendimento"];
$observacao         = $_POST["observacao"];
$pesopolpa          = $_POST["pesopolpa"];
$producao           = "N";
// $maturacao          = $_POST["maturacao"];
// $ph                 = $_POST["ph"];
// $brix               = $_POST["brix"];
// $rendimento         = $_POST["rendimento"];
// $pesopolpa          = $_POST["pesopolpa"];
$id                 = $_POST["id"];
$aceite             = "N";
$seq = str_pad($id , 6 , '0' , STR_PAD_LEFT);
$lote = substr($fruta, 0, 2).substr($variedade, 0, 2).$seq;

//date("m", strtotime($dataentrada)) PARA INCLUIR O MES
//date("Y", strtotime($dataentrada)). PARA INCLUIR O ANO

//$usuario = $_SESSION['Usuario'];

    $query = mysqli_query($conectar, "INSERT INTO insumos
      (dataentrada, fornecedor, tipo, fruta, variedade, lote, pesoliquido, descarte, pesoverde, pesodespolpa, caixas, rendimento, pesopolpa, aceite, producao, observacao)
      VALUES
      ('$dataentrada', '$fornecedor', '$tipo', '$fruta', '$variedade', '$lote', '$pesoliquido', '$descarte', '$pesoverde', '$pesodespolpa', '$caixas', '$rendimento', '$pesopolpa', '$aceite', '$producao', '$observacao')")
      or die( mysqli_error( $conectar) );
?>
