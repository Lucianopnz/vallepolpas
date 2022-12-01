<?php

session_start();
include_once("con_seguranca.php");
include_once("con_conexao.php");

//$conectar = mysqli_connect("localhost", "sabordov", "Core4447", "sabordov_SDV") or die (mysqli_error());
//$conectar = mysqli_connect("localhost", "nutrio", "Publi130814&", "nutrio_contentor") or die (mysqli_error());

if(mysqli_connect_errno()){
    echo "falha ao conectar: ". mysqli_connect_error();
    die();
}

$query = mysqli_query($conectar, "DELETE FROM listpedidos WHERE totalpedido = 0;");


$usuario = $_SESSION['usu'];


?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Compra - Venda - Logistica</title>

  </head>

  <body>
    <div class="wrapper">

      <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

          <!-- Sidebar - Brand -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="https://nutrio.adm.br/con_fornecedor.php">
            <div class="sidebar-brand-icon ">
              <i class="fas fa-dolly"></i>
            </div>
            <div class="sidebar-brand-text mx-3 ">Contentor</div>
          </a>

          <!-- Divider -->
          <hr class="sidebar-divider my-0">

          <!-- Nav Item - Dashboard -->
          <li class="nav-item">
            <a class="nav-link" href="con_fornecedor.php">
              <i class="fas fa-clipboard-list"></i>
              <span style="color:White">Pedidos</span></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="con_pedido.php">
              <i class="fas fa-plus fa-fw " style="color:GreenYellow"></i>
              <span style="color:GreenYellow">Novo Pedido</span></a>
          </li>

          <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-fw"></i></a> -->

          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">
            Cadastro
          </div>

          <!-- Nav Item - Pages Collapse Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-folder-plus"></i>
              <span style="color:White">Cadastros</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="con_cadclientes.php">Clientes</a>
                <a class="collapse-item" href="con_cadfornecedor.php">Fornecedores</a>
                <a class="collapse-item" href="con_cadproduto.php">Produtos</a>

              </div>
            </div>
          </li>



          <!-- Divider -->
          <hr class="sidebar-divider">

          <!-- Heading -->
          <div class="sidebar-heading">
            Outros
          </div>

          <!-- Nav Item - Outros Menu -->
          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinance" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-file-invoice-dollar"></i>
              <span style="color:White">Financeiro</span>
            </a>
            <div id="collapseFinance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="con_pagamentos.php">Pagamentos</a>
                <a class="collapse-item" href="con_recebimentos.php">Recebimentos</a>
                <a class="collapse-item" href="con_extrato.php">Extratos</a>

              </div>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-print"></i>
              <span style="color:White">Relatórios</span>
            </a>
            <div id="collapseReport" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">

                <a class="collapse-item" href="#">Gerencial</a>
                <a class="collapse-item" href="#">Tabela de Preços</a>
                <a class="collapse-item" href="#">Produtos</a>


              </div>
            </div>
          </li>

          <!-- Nav Item - Charts -->
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-fw fa-chart-area"></i>
              <span style="color:White">Gráficos</span></a>
          </li>

          <!-- Nav Item - Tables -->
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-fw fa-table"></i>
              <span style="color:White">Tabelas</span></a>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider d-none d-md-block">

          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

          <!-- Main Content -->
          <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-info topbar mb-4 static-top shadow">

              <h3>Contentor</h3>

              <!-- Topbar Navbar -->
              <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">

                  <!-- Dropdown - Messages -->
                  <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                      <div class="input-group">
                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                          <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </li>

                <!-- Log out -->
                <li class="nav-item dropdown no-arrow mx-1">
                  <a class="btn btn-dark btn-sm" href="con_logout.php" >
                    <span class="glyphicon glyphicon-log-out"></span> Sair
                  </a>
                </li>

                <br>





                <!-- Nav Item - User Information -->


              </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">



              <!-- Page Heading -->


              <!-- Content Row -->
              <?php
                // $ped = 5;
                  $resultado = mysqli_query($conectar, "SELECT * FROM listpedidos WHERE usuario like '%".$usuario."%' OR cliente like '%".$usuario."%' ORDER BY pedido DESC");
                  // $linhas = mysqli_num_rows($resultado);
                  foreach ($resultado as $linhas) {

                  // while($linhas = mysqli_fetch_array($resultado)){ ?>

                <div>

                  <form action="con_edita.php" method="post">

                    <input type="hidden" name="editapedido" value="<?php echo $linhas['pedido']; ?>">
                    <input type="hidden" name="cliente" value="<?php echo $linhas['cliente']; ?>">
                    <input type="hidden" name="datapedido" value="<?php echo $linhas['datapedido']; ?>">
                    <input type="hidden" name="dataentrega" value="<?php echo $linhas['dataentrega']; ?>">
                    <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">

                    <div class="d-sm-flex align-items-center justify-content-between">
                      <?php echo date('d/m/Y', strtotime($linhas['datapedido'])); ?>
                      <input type="submit" value="Ped #<?php echo $linhas['pedido']; ?>" onclick="Location: https://nutrio.adm.br/nt/contfedita.php" class="btn btn-outline-secondary ">

                    </div>


                  </form>

                  <!-- <div class="h6 text-gray-800">Data Pedido: <?php echo date('d/m/Y', strtotime($linhas['datapedido'])); ?></div> -->
                  <?php
                  if ($linhas['opcao'] == "vender" AND $linhas['usuario'] == $usuario) { ?>
                     <div class="h6 font-weight-bold text-gray"><?php echo $linhas['cliente']; ?></div>
                  <?php }

                  if ($linhas['opcao'] == "vender" AND $linhas['usuario'] != $usuario) { ?>
                     <div class="h6 font-weight-bold text-gray"><?php echo $linhas['fornecedor']; ?></div>
                  <?php }

                  if ($linhas['opcao'] == "comprar" AND $linhas['usuario'] == $usuario) { ?>
                     <div class="h6 font-weight-bold text-gray"><?php echo $linhas['fornecedor']; ?></div>
                  <?php }

                  if ($linhas['opcao'] == "comprar" AND $linhas['usuario'] != $usuario) { ?>
                     <div class="h6 font-weight-bold text-gray"><?php echo $linhas['cliente']; ?></div>
                  <?php } ?>

                  <div>Itens: 03</div>
                  <div>Peso: 5.000 kg</div>

                  <?php
                  if ($linhas['opcao'] == "vender" AND $linhas['usuario'] == $usuario) { ?>
                    <div class="h6 mb-0 font-weight-bold text-success text-right"><?php echo 'R$ ' . number_format($linhas['totalpedido'], 2, ',', '.'); ?> (+)</div>
                  <?php }

                  if ($linhas['opcao'] == "vender" AND $linhas['usuario'] != $usuario) { ?>
                    <div class="h6 mb-0 font-weight-bold text-danger text-right"><?php echo 'R$ ' . number_format($linhas['totalpedido'], 2, ',', '.'); ?> (-)</div>
                  <?php }

                  if ($linhas['opcao'] == "comprar" AND $linhas['usuario'] == $usuario) { ?>
                    <div class="h6 mb-0 font-weight-bold text-danger text-right"><?php echo 'R$ ' . number_format($linhas['totalpedido'], 2, ',', '.'); ?> (-)</div>
                  <?php }

                  if ($linhas['opcao'] == "comprar" AND $linhas['usuario'] != $usuario) { ?>
                    <div class="h6 mb-0 font-weight-bold text-success text-right"><?php echo 'R$ ' . number_format($linhas['totalpedido'], 2, ',', '.'); ?> (+)</div>
                  <?php } ?>





                  <hr>
                </div>

              <?php } ?>


          </div>
          <!-- End of Main Content -->

          <!-- Footer -->
          <footer class="sticky-footer bg-white">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span>Copyright &copy; Nutrio Alimentos 2019</span>
              </div>
            </div>
          </footer>
          <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

      </div>

    </div>




    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="js/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>


      $(document).ready(function(){

        $('.editar').click(function(){


           var el = this;

           var pedido = this.id;





           $.ajax({
             url:"con_novogera.php",
             type:"post",
             //data:$("#insert").serialize(),
             data: 'pedido=' + pedido ,

             success:function(d)
             {
               //history.go(0)
               //$("#ped").html(d);
               //alert(d);
             }
           });
         });
       });

      </script>

  </body>

</html>
