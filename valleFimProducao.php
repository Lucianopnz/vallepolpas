<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//


$id                 = $_POST["id"];


// $pesopolpa          = $_POST["pesopolpa"];
// $pesoresiduo        = $_POST["pesoresiduo"];
// // $rendimento         = $_POST["rendimento"];
// $qtdpolpa           = $_POST["qtdpolpa"];
// $embalagem          = $_POST["embalagem"];
// $horafinal          = $_POST["horafinal"];



   
    $query = mysqli_query($conectar, "UPDATE producao SET aceite = 'S' WHERE id = '$id' ")
      or die( mysqli_error( $conectar) );

      $sql = "SELECT * FROM producao WHERE id = $id LIMIT 1 ";
      $result = mysqli_query($conectar, $sql);            
      $row = mysqli_fetch_assoc($result);
      echo json_encode($row);

 

      
?>
