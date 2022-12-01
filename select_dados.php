<?php
    session_start();
    include_once("valleSeguranca.php");
    include_once("valleConexao.php");

    $id = $_POST["id"];

    $sql = "SELECT * FROM insumos WHERE id = $id LIMIT 1 ";
    $result = mysqli_query($conectar, $sql);            
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);

        // if(isset($_POST['user_id'])){
        //     $id = $_POST['user_id'];
        //     $sql = "SELECT * FROM insumos WHERE id = '$id'";
        //     $resultado = mysqli_query($conectar, $sql);
        //     $row = mysqli_fecth_assoc($resultado);
        //     echo $row['lote'];
                    
        // }

?>


