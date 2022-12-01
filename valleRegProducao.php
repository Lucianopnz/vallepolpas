<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//

$loteentrada        = $_POST["loteentrada"];
$lotefabrica        = $_POST["lotefabrica"];
$tipo               = $_POST["tipo"];

if($tipo == "Polpa"){
  $acc = "S";
} else {
  $acc = "N";
}

$fruta              = $_POST["fruta"];
$produto            = $_POST["produto"];
$peso               = $_POST["peso"]; 
$saldopeso          = $_POST["saldopeso"]; 
$horaini            = $_POST["horaini"];
$prevpolpa          = $_POST["prevpolpa"];


if($saldopeso == 0){
  $query = mysqli_query($conectar, "UPDATE insumos SET producao = 'S' WHERE lote = '$loteentrada' ")
      or die( mysqli_error( $conectar) );
} else {
  $query = mysqli_query($conectar, "UPDATE insumos SET pesodespolpa = $saldopeso, producao = 'N' WHERE lote = '$loteentrada' ")
      or die( mysqli_error( $conectar) );
}

    $query = mysqli_query($conectar, "INSERT INTO producao
      (loteentrada, lotefabricacao, fruta, produto, pesofruta, polpa, horainicio, previstopolpa, aceitedespolpa, aceite)
      VALUES
      ('$loteentrada', '$lotefabrica', '$fruta', '$produto', '$peso', '$peso', '$horaini', '$prevpolpa', '$acc', 'N')")
      or die( mysqli_error( $conectar) );
   

      
?>
