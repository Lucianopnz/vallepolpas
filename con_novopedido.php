<?php

session_start();
include_once("con_seguranca.php");
include_once("con_conexao.php");

//$conectar = mysqli_connect("localhost", "sabordov", "Core4447", "sabordov_SDV") or die (mysqli_error());

if(mysqli_connect_errno()){
    echo "falha ao conectar: ". mysqli_connect_error();
    die();
}

// DEFINIR NUMERO DO PEDIDO
  $sql = "SELECT MAX(pedido) as pedido FROM pedido";
  $sql = $conectar->query($sql);
  $row = $sql->fetch_assoc();;
  $novo_pedido = $row['pedido'] + 1;

  $opcao = $_POST["opcao"];
  $usuario = $_POST["usuario"];

  if ($opcao == "vender") {
     $status = "Cliente";
  } else {
     $status = "Fornecedor";
  }

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

    <title>Compra - Venda - Logistica</title>

  </head>

  <body>
    <div class="wrapper">

      <div id="wrapper">



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

          <!-- Main Content -->
          <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

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

                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                  <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter">5<?php echo $alerts; ?></span>
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
              <div class="text-right">
                <h2 class="h5 text-gray-600">Novo Pedido</h2>
              </div>

              <form action="con_novogera.php" method="post">

              <input type="hidden" name="novopedido" value="<?php echo $novo_pedido; ?>">
              <input type="hidden" name="opcao" value="<?php echo $opcao; ?>">
              <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">

              <div class="form-group">
                <label for="sel1"><?php echo $status; ?>:</label>
                <select class="form-control" id="selcliente" name="selcliente">
                  <?php $resultado = mysqli_query($conectar, "SELECT * FROM cadcliente WHERE usuario like '%".$usuario."%' ORDER BY cliente DESC");
                  while($row1 = mysqli_fetch_array($resultado)):; ?>
                    <option value="<?php echo $row1["cliente"]; ?>"><?php echo $row1["cliente"]; ?></option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="datapedido">Data Pedido:</label>
                <input type="date"  value="<?php echo date("Y-m-d"); ?>" class="form-control" id="datapedido" name="datapedido">
              </div>

              <div class="form-group">
                <label for="dataentrega">Data Entrega:</label>
                <input type="date"  value="<?php echo date("Y-m-d"); ?>" class="form-control" id="dataentrega" name="dataentrega">
              </div>


              <div class="form-group text-right">

                <input type="submit" value="Avançar" onclick="Location: https://nutrio.adm.br/con_novogera.php" class="btn btn-success btn-sm" style='font-size:20px'>

                  <!-- <a class="btn btn-success btn-sm " href="contfnovogera.php" style='font-size:20px'>Avançar <i class='fas fa-angle-double-right'></i></a> -->
                  <!-- <button class="btn btn-success btn-sm " style='font-size:20px'>Avançar <i class='fas fa-angle-double-right'></i></button> -->
              </div>

            </form>


              <!-- <div class="form-group">
                <a class="form-control btn btn-success" href="cont_f.php">Finaliza Pedido</a>
              </div> -->


              <!-- Content Row -->
              <div class="row">


              </div>

              <!-- Content Row -->







            </div>
            <!-- /.container-fluid -->

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


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>

</html>
