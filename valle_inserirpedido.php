<?php
    session_start();
    include_once("valleSeguranca.php");
    include_once("valleConexao.php");

    $pedido         = $_POST["pedido"];
    $cliente        = $_POST["cliente"];
    $datapedido     = $_POST["datapedido"];
    $total          = $_POST["total"];
    $vlrtotal       = $_POST["vlrtotal"];
    

    $query = mysqli_query($conectar, "INSERT INTO tblPedidos (pedido, cliente, datapedido, totalpedido, vlr_total)
              VALUES ('$pedido', '$cliente', '$datapedido', '$total', '$vlrtotal')");

    

?>

    




