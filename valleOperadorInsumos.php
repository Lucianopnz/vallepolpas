<?php

session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//

if(mysqli_connect_errno()){
    echo "falha ao conectar: ". mysqli_connect_error();
    die();

}

// DEFINIR NUMERO DO lote
$sql = "SELECT MAX(id) as id FROM insumos";
$sql = $conectar->query($sql);
$row = $sql->fetch_assoc();;
$novo_id = $row['id'] + 1;

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>   
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    
    <style>

        body {
            margin: 0 0 30px 0;
                 
        }

        .nav {
           position: fixed;
           bottom: 0;
           width: 100%;
           height: 150px;
           box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
           background-color: #00b33c;
           display: flex;
           overflow-x: auto;            
        }

        /* .nav i {
            font-size: 50px;
            display: flex;
        } */

        .nav__link {
            min-width: 50px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex-grow: 1;
            white-space: nowrap;
            font-size: 35px;
            color: #444444;
            text-decoration: none;
        }

        .main {
            align-items: center;
        }

    </style>

    </head>
    <body>
        <div class="main">
            <img src="imagens/Logo.png" width="640" height="480" alt="User" />
        </div>
        <nav class="nav">

            <a href="#" class="nav__link">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav__text">Inicio</span>
            </a>

            <a href="#" class="nav__link">
                <i class="fas fa-plus fa-2x"></i>
                <span class="nav__text">Novo</span>
            </a>

            <a href="#" class="nav__link">
                <i class="fas fa-boxes fa-2x"></i>
                <span class="nav__text">Estoque</span>
            </a>

            <a href="#" class="nav__link">
                <i class="fas fa-cogs fa-2x"></i>
                <span class="nav__text">Processo</span>
            </a>
            
        </nav>
    </body>
</html>