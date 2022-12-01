<?php

session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//

if(mysqli_connect_errno()){
    echo "falha ao conectar: ". mysqli_connect_error();
    die();

}

// TOTAL INSUMOS
$sql = "SELECT SUM(peso) AS peso_total FROM insumos";
$result  = mysqli_query($conectar,$sql);
$row = mysqli_fetch_assoc($result);
$peso_total = $row['peso_total'];

$sql = "SELECT SUM(pesopolpa) AS rend_total FROM insumos";
$result  = mysqli_query($conectar,$sql);
$row = mysqli_fetch_assoc($result);
$rend_total = $row['rend_total'];



?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Valle Polpas</title>

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        

        <style>
            
            @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap');


            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Roboto', sans-serif;
                font-size: 15px;
                list-style: none;
                text-decoration: none;  
                
            }

            .header-bar{
                height: 7%;
            }
            

            .corpo{
                display: flex;
                align-items: center;
                justify-content: center;
                
                background-image: url("fundoapp.jpg");
                background-color: #cccccc;
                height: 100%;
                width: 100%;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                position: fixed;
                opacity: 50%;

                
            }

            .nav{
                position: fixed;
                bottom: 0;
                width: 100%;
                height: 57px;
                display: flex;
                box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
                background-color: #2a3944;
                /* color: #dcdcdf; */
                overflow-x: auto;         
                text-decoration: none;       
            }

            .navlink{
                display: flex;
                flex-direction: column;
                align-items: center;
                flex-grow: 1;
                
                min-width: 50px;
                overflow: hidden;
                white-space: nowrap;
                margin-top: 2px;
                text-decoration: none;
                -webkit-tap-highlight-color: transparent;
                
            }

            .nav a{
                text-decoration: none;
                color: #dcdcdf;
            }

            .nav a:active{
                color:tomato;
            }

            .imagem{
                position: fixed;
                right: 20px;
            }

            .insumos{
                position: fixed;
                top: 40px;
                left: 20px;
                
            }

            /* footer {     
                display: flex;       
            position: fixed;
            padding: 10px;
            background-color: #2a3944;
            color: #dcdcdf;
            
            bottom: 20px;
            height: 8%;
            width: 100%;
            border-top: 6px solid #00b300;
        } */
            
        </style>
    </head>
    <body>
        
        
        <!-- <div class="header-bar">
            
            
        </div> -->
        <div class="corpo">
            <!-- <img src="Logo.png" width="80%" height="auto" alt="User" /> -->
        </div>

        
            <div class="insumos">
                       
                <!-- <p><img src="imagens/box.png" width="35px" height="35px"/><b> ESTOQUE</b></p>         -->
                <p><b>:: Câmara 01</b></p>
                <p>Fruta: <b><span style="color: red;"><?php echo number_format($peso_total); ?> Kg </span></b></p>
                <p>Polpa: <b><span style="color: green;"><?php echo number_format($rend_total); ?> kg </span></b> (Rend: <?php echo number_format($rend_total/$peso_total*100); ?> %) </p>
                
            </div>
       
        <div class="imagem">
            <img src="Logo.png" width="150px" height="auto" alt="User" /> 
        </div>

        <nav class="nav">
            <a href="#" class="navlink">
                <i class="fa fa-home fa-2x"></i> 
                <span class="navtext">Inicio</span>
            </a>
            <a href="vpolpasinsumos.php" class="navlink">
                <i class="fas fa-plus fa-2x"></i> 
                <span class="navtext">Novo</span>
            </a>
            <a href="vpolpasestoque.php" class="navlink " >
                <i class="fas fa-boxes fa-2x"></i>
                <span class="navtext">Estoque</span>
            </a>
            <a href="#" class="navlink">
                <i class="fas fa-cogs fa-2x"></i> 
                <span class="navtext">Produção</span>
            </a>
        </nav>


        <!-- <footer class="app-footer">

            <ul>
                <li>
                    <a href="vlop1.html">
                        <i class="fa fa-home fa-2x"></i> 
                    </a>
                        Inicio
                    
                </li>

                <li>
                    <a href="vlop2.html">
                        <i class="fas fa-plus fa-2x"></i>
                    </a>
                    Novo
                    
                </li>

                <li>
                    <a href="vlop3.html">
                        <i class="fas fa-boxes fa-2x"></i>
                    </a>
                    Insumos
                
                </li>

                <li>
                    <a href="vlop4.html">
                        <i class="fas fa-cogs fa-2x"></i>
                    </a>
                    Producao
                
                </li>
            </ul>
        </footer> -->
    </body>
</html>