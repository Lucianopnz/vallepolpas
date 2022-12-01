<?php
    session_start();
    include_once("valleSeguranca.php");
    include_once("valleConexao.php");

    $lote           = $_POST["lote"];
    $pesopolpa      = $_POST["pesopolpa"];
    $pesoresiduo    = $_POST["pesoresiduo"];
    $rendimento     = $_POST["rendimento"];

    $query = mysqli_query($conectar, "UPDATE producao SET polpa = '$pesopolpa', residuo= '$pesoresiduo',  rendimento= '$rendimento', aceitedespolpa='S' WHERE loteentrada = '$lote'");

    //$query = mysqli_query($conectar, "UPDATE producaototal SET totalpolpa = totalpolpa + '$pesopolpa' WHERE fruta= '$fruta'");
    // ver $fruta
?>
