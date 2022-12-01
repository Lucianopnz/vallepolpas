<?php
    session_start();
    include_once("valleSeguranca.php");
    include_once("valleConexao.php");

    $pedido     = $_POST["pedido"];
    $polpa      = $_POST["polpa"];
    $peso       = $_POST["peso"];
    $unidade    = $_POST["unidade"];
    $vlrUnit    = $_POST["vlrUnit"];
    $vlrTotal   = $_POST["vlrTotal"];

    $query = mysqli_query($conectar, "INSERT INTO tblPedido (pedido, descricao, peso, unidade, vlr_unitario, vlr_total)
              VALUES ('$pedido', '$polpa', '$peso', '$unidade', '$vlrUnit', '$vlrTotal')");

    $query = mysqli_query($conectar, "UPDATE tblPolpas SET quantidade = quantidade - $peso WHERE polpa = '$polpa' AND unidade = '$unidade'" );


    $resultado = mysqli_query($conectar, "SELECT * FROM tblPedido WHERE pedido = $pedido");
    $linhas = mysqli_num_rows($resultado);

    // $query = mysqli_query($conectar, "UPDATE tblPolpas SET quantidade = quantidade - $peso WHERE polpa = '$polpa' AND unidade = '$unidade'" );

    // $resultado = mysqli_query($conectar, "SELECT * FROM tblPedido WHERE pedido = '$pedido'");
    // $linhas = mysqli_num_rows($resultado);
    

?>

    




