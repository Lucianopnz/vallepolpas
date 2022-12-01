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

    $sql = "SELECT SUM(rendimento) AS rend_total FROM insumos";
	$result  = mysqli_query($conectar,$sql);
	$row = mysqli_fetch_assoc($result);
    $rend_total = $row['rend_total'];
    




?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>   
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="css/vallepolpas.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>   
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    
    </head>
    <body>
        <div class="wrapper">
            <span class="top-left"><img src="imagens/Logo.png" width="160" height="120" alt="User" /></span>
            <span class="top-right">
                <span><h4>Painel de Controle</h4></span>
                <button class="btn btn-secondary btn-sm">Sair</button>
            </span>
            <!-- <div class="top">Top</div> -->
            <div class="sidebar">
                <!-- <h4 style="text-align: center;">Indústria & Comércio</h4> -->
                <ul class="itens">
                    <li><a href="#"><i class="fas fa-desktop fa-2x" ></i><span> Painel de Controle</span></a></li>
                    <li><a href="#"><i class="fas fa-address-card fa-2x"></i><span> Cadastros <i class="ico right fas fa-plus"></i></span></a>
                        <ul class="cad" style="display: none;">
                            <li><a href="#"><i class="fas fa-dolly"></i> Fornecedor</a></li>
                            <li><a href="#"><i class="fas fa-user"></i> Usuário</a></li>
                        </ul>
                    </li>
                    <li><a href="valleInsumos.php"><i class="fas fa-dolly-flatbed fa-2x"></i><span> Insumos</span></a></li>
                    <li><a href="#"><i class="fas fa-cogs fa-2x"></i><span> Produção <i class="ico right fas fa-plus"></i></span></a>
                        <ul class="cad" style="display: none;">
                            <li><a href="#"><i class="fas fa-arrow-alt-circle-right"></i> Iniciar Produção</a></li>
                            <li><a href="valleProdCorrente.php"><i class="fas fa-cog"></i> Produção Corrente</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fas fa-print fa-2x"></i><span> Relatórios</span></a></li>              
                </ul>

                <!-- <div class="direito">
                    <h6>Indústria & Comércio</h6>
                </div> -->
                <div class="legal">
                    <div class="copyright">
                        &copy; 2020 - 2021 <a href="#">Valle Polpas</a>.
                    </div>
                    <div class="version">
                        <b>Version: </b> 20.30.06
                    </div>
                </div>
                
            </div>

            <div class="main">           
                
                
                
            </div>

            
            
        </div>

        
    </body>
    <script>

    $(document).ready(function() {
    $('.itens li:has(ul)').click(function(e) {
        e.preventDefault();

        if($(this).hasClass('ativado')){
            $(this).removeClass('ativado')
            $(this).children('ul').slideUp();
        } else {
            $('.itens li ul').slideUp();
            $('.itens li').removeClass('ativado');
            $(this).addClass('ativado');
            $(this).children('ul').slideDown();
        }
    })
})

    $(document).ready(function() {
        $('#example').dataTable( {
            "searching": false,
            paging: false,
            scrollY: "320px",
            scrollCollapse: true,
            info: false
        } );
    } );

    </script>

<script>

var ctxB = document.getElementById("myChart").getContext('2d');
  var myBarChart = new Chart(ctxB, {
  type: 'bar',
  data: {
  labels: ["Acerola", "Goiaba", "Manga", "Abacaxi", "Caju", "Maracuja"],
  datasets: [{
  label: 'Peso (Kg)',
  data: [1500, 1900, 400, 500, 1000, 600],
  backgroundColor: [
  'rgba(255, 99, 132, 0.2)',
  'rgba(54, 162, 235, 0.2)',
  'rgba(255, 206, 86, 0.2)',
  'rgba(75, 192, 192, 0.2)',
  'rgba(153, 102, 255, 0.2)',
  'rgba(255, 159, 64, 0.2)'
  ],
  borderColor: [
  'rgba(255,99,132,1)',
  'rgba(54, 162, 235, 1)',
  'rgba(255, 206, 86, 1)',
  'rgba(75, 192, 192, 1)',
  'rgba(153, 102, 255, 1)',
  'rgba(255, 159, 64, 1)'
  ],
  borderWidth: 2
  }]
  },
  options: {
    title: {
            display: true,
            text: 'Pesos (Kg)'},
           
    legend:{
            display: false,
            },
  scales: {
  yAxes: [{
  ticks: {
  beginAtZero: true
  }
  }]
  }
  }
  });


        
        </script>
</html>