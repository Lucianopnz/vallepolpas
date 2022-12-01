<?php

session_start();
include_once("vp_seguranca.php");
include_once("vp_conexao.php");

//$conectar = mysqli_connect("localhost", "sabordov", "Core4447", "sabordov_SDV") or die (mysqli_error());
$conectar = mysqli_connect("localhost", "nutrio", "Publi130814&", "nutrio_contentor") or die (mysqli_error());

if(mysqli_connect_errno()){
    echo "falha ao conectar: ". mysqli_connect_error();
    die();
}

// // DEFINIR NUMERO DO CLIENTE
//   $sql = "SELECT MAX(pedido) as pedido FROM pedido";
//   $sql = $conectar->query($sql);
//   $row = $sql->fetch_assoc();;
//   $novo_pedido = $row['pedido'] + 1;

// $novo_pedido = 20;

  $pedido = $_POST["editapedido"];
  $novo_pedido = $_POST["novopedido"];
  $cliente = $_POST["selcliente"];
  $datapedido = $_POST["datapedido"];
  $dataentrega = $_POST["dataentrega"];
  $opcao = $_POST["opcao"];
  $usuario = $_SESSION['Usuario'];
  // $opcao = "vendendo";


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

              </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

              <!-- Page Heading -->
              <div class="text-left">

                Pedido: <?php echo $novo_pedido; ?><?php echo $pedido; ?></br>
                Cliente: <?php echo $cliente; ?></br>
                Data Pedido: <?php echo date('d/m/Y', strtotime($datapedido)); ?></br>
                <hr>
              </div>

              <?php $sql = "SELECT SUM(valortotal) AS valor_ped FROM pedido WHERE pedido = $novo_pedido";
              $result  = mysqli_query($conectar,$sql);
              $row = mysqli_fetch_assoc($result);
              $total_soma = $row['valor_ped'];
              ?>

              <div class="d-flex flex-row" id="ped">
                <div class="p-6 mr-auto"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inserirModal">
                  <i class='fas fa-plus'></i> Inserir
                </button></div>
                <div class="p-6 "><h5><?php echo 'R$ ' . number_format($total_soma, 2, ',', '.'); ?></h5></div>

              </div>
              <hr>

              <?php
                // $ped = 5;
                  $resultado = mysqli_query($conectar, "SELECT * FROM pedido WHERE pedido = $novo_pedido");
                  $linhas = mysqli_num_rows($resultado);

                  while($linhas = mysqli_fetch_array($resultado)){ ?>

              <!-- Earnings (Monthly) Card Example -->
              <div class="card">
                <h5 class="card-header"><?php echo $linhas['produto']; ?></h5>
                <div class="card-body">
                  <p class="card-text">Tipo: <?php echo $linhas['tipo']; ?> </p>
                  <p class="card-text">Quantidade: <?php echo $linhas['quantidade']; ?> <?php echo $linhas['unidade']; ?> </p>
                  <p class="card-text">Preço Unitario: <?php echo 'R$ ' . number_format($linhas['valorunitario'], 2, ',', '.'); ?></p>
                  <p class="card-text">Preço Total: <?php echo 'R$ ' . number_format($linhas['valortotal'], 2, ',', '.'); ?></p>
                </div>
                <h5 class="card-footer text-right">

                  <a href="#" id="del_<?php echo $linhas['id']; ?>" class="delete btn btn-danger mr-auto">Excluir</a>
                  <!-- <a href="#" class="btn btn-warning ">Alterar</a></h5> -->
              </div>

            <?php } ?>

              <!-- Modal -->
              <div class="modal fade" id="inserirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Inserir Produto</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form method="post" id="inserir_produto">
                    <div class="modal-body">

                      <div class="form-group">
                        <label for="sel1">Produto:</label>
                        <select class="form-control" id="selproduto" name="selproduto">
                          <?php $resultado = mysqli_query($conectar, "SELECT * FROM cadprodutos WHERE usuario like '%".$usuario."%' ORDER BY produto DESC");
                          while($row1 = mysqli_fetch_array($resultado)):; ?>
                            <option value="<?php echo $peso = $row1["peso"] ?>"><?php echo $row1["produto"]; ?></option>
                          <?php endwhile; ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="sel1">Tipo:</label>
                        <select class="form-control" id="seltipo" name="seltipo">
                          <option value="1">(1a.) Primeira</option>
                          <option value="2">(2a.) Segunda</option>
                          <option value="3">Polpa</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="quantidade">Quantidade:</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade">
                      </div>

                      <div class="form-group">
                        <label for="sel1">Unidade:</label>
                        <select class="form-control" id="selunidade" name="selunidade">
                          <option value="1">Cx (caixa)</option>
                          <option value="2">Kg (quilo)</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="quantidade">Valor Unitário:</label>
                        <input type="number" class="form-control" id="valorunitario" name="valorunitario">
                      </div>
                      <!-- <a class="btn btn-success" id="confirma" href="ntpagamentos.html">Pagamentos</a> -->
                      <button type="button" id="confirma" data-dismiss="modal" style="width:  150px; height: 40px; margin-top: 30px;" class="btn btn-success" >Confirma</button>

                    </div>
                    <!-- <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <input type="submit" name="inserir" id="inserir" value="Salvar" class="btn btn-primary">
                    </div> -->
                  </form>
                  </div>
                </div>
              </div>
              <!-- Fim Modal -->


              <div class="form-group text-right">
                  <button class="btn btn-success btn-sm" id="finalizar" style='font-size:20px'>Finalizar pedido</button>
                  <!-- <button type="button" id="confirma" data-dismiss="modal" style="width:  150px; height: 40px; margin-top: 30px;" class="btn btn-success" >Confirma</button> -->

              </div>

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

        // Salvar itens do pedido

        $("#confirma").click(function(){

          var n_pedido  = "<?php echo $novo_pedido; ?>";
          var opc       = "<?php echo $opcao; ?>";
          var prod      = document.getElementById("selproduto").options[document.getElementById("selproduto").selectedIndex].text
          var tipo      = document.getElementById("seltipo").options[document.getElementById("seltipo").selectedIndex].text
          var quant     = document.getElementById("quantidade").value
          var unid      = document.getElementById("selunidade").options[document.getElementById("selunidade").selectedIndex].text
          var val       = document.getElementById("valorunitario").value
          var total     = val*quant

          $.ajax({
            url:"con_inserirdados.php",
            type:"post",
            //data:$("#insert").serialize(),
            data: 'pedido=' + n_pedido +
                  '&produto=' + prod +
                  '&tipo=' + tipo +
                  '&quantidade=' + quant +
                  '&unidade=' + unid +
                  '&valor=' + val +
                  '&opcao=' + opc ,

            success:function(d)
            {
              history.go(0)
              //$("#ped").html(d);
              //alert(d);
            }
          });
        });

        // Excluir itens do Pedido

        $('.delete').click(function(){
           var el = this;
           var id = this.id;
           var splitid = id.split("_");

           // Delete id
           var deleteid = splitid[1];
           $.ajax({
             url: 'con_apagardados.php',
             type: 'POST',
             data: { id:deleteid },
             success: function(response)
             {
               history.go(0)
             }
           })
         });


        // Finaliza PEDIDO
        $("#finalizar").click(function(){

          var n_pedido = "<?php echo $novo_pedido; ?>";
          var opc = "<?php echo $opcao; ?>";
          var cli = "<?php echo $cliente; ?>";
          var forn = "fornecedor";
          var datap  = "<?php echo $datapedido; ?>";
          var datae = "<?php echo $dataentrega; ?>";
          var totalsoma  = "<?php echo $total_soma; ?>";
          var usu = "<?php echo $usuario; ?>";

          $.ajax({
            url:"con_inserirdados1.php",
            type:"post",
            //data:$("#insert").serialize(),
            data: 'pedido=' + n_pedido +
                  '&cliente=' + cli +
                  '&fornecedor=' + forn +
                  '&datapedido=' + datap +
                  '&dataentrega=' + datae +
                  '&totalsoma=' + totalsoma +
                  '&opcao=' + opc +
                  '&usuario=' + usu,

            success:function(d)
            {

              location.href = "https://nutrio.adm.br/con_fornecedor.php";
              //$("#ped").html(d);
              //alert(d);
            }
          });
        });

        //

      });
    </script>



  </body>

</html>
