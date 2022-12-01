<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//

$lote               = $_POST["lote"];
$ph                 = $_POST["ph"];
$brix               = $_POST["brix"];


    $query = mysqli_query($conectar, "UPDATE insumos SET ph = '$ph', brix= '$brix', aceite='S' WHERE lote= '$lote'");
     
    
?>
