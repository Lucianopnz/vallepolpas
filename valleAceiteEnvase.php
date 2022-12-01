<?php
    session_start();
    include_once("valleSeguranca.php");
    include_once("valleConexao.php");

    $id             =  $_POST["id"];
    $lote           = $_POST["lote"];
    $qtdpolpa      = $_POST["qtdpolpa"];
    $horafinal    = $_POST["horafinal"];
    $embalagem     = $_POST["embalagem"];

    $query = mysqli_query($conectar, "UPDATE producao SET qtdpolpa = '$qtdpolpa', horafinal= '$horafinal',  embalagem= '$embalagem', aceiteenvase='S' WHERE id= '$id'");
         
?>
