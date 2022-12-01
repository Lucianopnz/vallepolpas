<?php
    session_start();
    include_once("valleSeguranca.php");
    include_once("valleConexao.php");

    $id     = $_POST["id"];    

    $query = mysqli_query($conectar, "DELETE FROM tblPedido WHERE id = $id");

    // $query = mysqli_query($conectar, "UPDATE tblPolpas SET quantidade = quantidade - $peso WHERE polpa = '$polpa' AND unidade = '$unidade'" );


    // $resultado = mysqli_query($conectar, "SELECT * FROM tblPedido WHERE pedido = $pedido");
    // $linhas = mysqli_num_rows($resultado);

    // $query = mysqli_query($conectar, "UPDATE tblPolpas SET quantidade = quantidade - $peso WHERE polpa = '$polpa' AND unidade = '$unidade'" );

    // $resultado = mysqli_query($conectar, "SELECT * FROM tblPedido WHERE pedido = '$pedido'");
    // $linhas = mysqli_num_rows($resultado);
    

?>

    




