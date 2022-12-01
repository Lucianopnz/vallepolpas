<?php
    session_start();
    include_once("valleSeguranca.php");
    include_once("valleConexao.php");
    //

    $dataentrada        = $_POST["dataentrada"];
    $cliente            = $_POST["cliente"];
    $endereco           = $_POST["endereco"];
    $telefone           = $_POST["telefone"];
    $cidade             = $_POST["cidade"];
    $uf                 = $_POST["uf"];
    $bairro             = $_POST["bairro"];
    $observacao         = $_POST["observacao"];
    $id                 = $_POST["id"];


    $query = mysqli_query($conectar, "INSERT INTO tblClientes
      (dataentrada, cliente, endereco, cidade, uf, telefone, bairro, observacao)
      VALUES
      ('$dataentrada', '$cliente', '$endereco', '$cidade', '$uf', '$telefone', '$bairro', '$observacao')");
      
?>
