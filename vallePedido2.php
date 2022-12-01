<?php

session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//

if(mysqli_connect_errno()){
    echo "falha ao conectar: ". mysqli_connect_error();
    die();

}

$novo_pedido = $_POST["novopedido"];
$idcliente = $_POST["selcliente"];
$cliente = $_POST["cliente"];
$datapedido = $_POST["datapedido"];
$usuario = $_SESSION['Usuario'];

    
if (!empty($_POST['selcliente'])){
    $resultado = mysqli_query($conectar, "SELECT cliente FROM tblClientes WHERE id = $idcliente LIMIT 1");
    $linha = mysqli_fetch_row($resultado);
    $cliente    = $linha[0];
  }




?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>   
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">        
        <link rel="stylesheet" href="css/valleStilo.css">     
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <style>
            .cartao{
                margin-left: 50px;
                margin-top: 10px;
                border-radius: 25px;
                border: 2px solid;
            }

            .resumo{
                position: absolute;
                top: 170px;
                right: 80px;
            }
        </style>
        
    
    </head>
    <body>
        <div class="wrapper">
            <span class="top-left"><img src="imagens/vale-polpa-logo-min.png" width="200" height="130" alt="User" /></span>
        
            <!-- <div class="top">Top</div> -->
            <div class="sidebar">
                <!-- <h4 style="text-align: center;">Indústria & Comércio</h4> -->
                <ul class="itens">
                    <li><a href="vallePainelControle.php"><i class="fas fa-desktop fa-2x" ></i><span> Painel de Controle</span></a></li>
                    <li><a href="#"><i class="fas fa-address-card fa-2x"></i><span> Cadastros <i class="ico right fas fa-plus"></i></span></a>
                        <ul class="cad" style="display: none;">
                            <li><a href="valleCadfornecedor.php"><i class="fas fa-dolly"></i> Fornecedor</a></li>
                            <li><a href="valleCadfrutas.php"><i class="fas fa-apple-alt"></i> Fruta</a></li>
                        </ul>
                    </li>
                    <li><a href="valleInsumos.php"><i class="fas fa-dolly-flatbed fa-2x"></i><span> Insumos</span></a></li>
                    <li><a href="#"><i class="fas fa-cogs fa-2x"></i><span> Produção </span></a></li>
                    <li><a href="valleRelatorios.php"><i class="fas fa-print fa-2x"></i><span> Relatórios</span></a></li>              
                </ul>

               
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

                <input type="hidden" name = "idcliente" value="<?php echo $idcliente; ?>">

                Pedido: <?php echo $novo_pedido; ?></br>
                Cliente: <?php echo $idcliente; ?></br>
                Data Pedido: <?php echo date('d/m/Y', strtotime($datapedido)); ?> </br>
                <hr>

                <?php

                    $sql = "SELECT SUM(peso) AS valor_ped FROM tblPedido WHERE pedido = $novo_pedido";
                    $result  = mysqli_query($conectar,$sql);
                    $row = mysqli_fetch_assoc($result);
                    $total_pedido = $row['valor_ped'];

                    $sql = "SELECT SUM(vlr_total) AS valor_tot FROM tblPedido WHERE pedido = $novo_pedido";
                    $result  = mysqli_query($conectar,$sql);
                    $row = mysqli_fetch_assoc($result);
                    $valor_total = $row['valor_tot'];

                ?>

                <div>
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#inserirModal">
                        <i class="fas fa-plus"></i> Inserir
                    </button>
                </div>

                <?php
                    $resultado = mysqli_query($conectar, "SELECT * FROM tblPedido WHERE pedido = $novo_pedido" );
                    $linhas = mysqli_num_rows($resultado);
                ?>
                
                
                    <table class="table table-sm mt-2 col-8">
                        <thead>
                            <tr>
                                <th width="40%">Polpa</th>
                                <th width="10%">Peso (kg)</th>
                                <th width="10%">Unid.</th>
                                <th width="10%">Unitario</th>
                                <th width="10%">Total</th>
                                <th width="10%"></th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($linhas = mysqli_fetch_array($resultado)){ ?>
                                <tr>
                                    <td><?php echo $linhas['descricao']; ?></td>
                                    <td style="text-align: right;"><?php echo $linhas['peso']; ?>  kg</td>
                                    <td  ><?php echo $linhas['unidade']; ?></td>
                                    <td  ><?php echo $linhas['vlr_unitario']; ?></td>
                                    <td  ><?php echo $linhas['vlr_total']; ?></td>
                                    <td  ><button class="btn btn-warning">Editar</button></td>
                                    <td  ><button class="btn btn-danger btnExcluirItem" id="<?php echo $linhas['id']; ?>">Excluir</button></td>
                                </tr>      
                            <?php } ?>                       
                        </tbody>
                    </table>

                    <div class="resumo">
                        <div class="card alert-secondary" style="width: 18rem; align-items: center;">
                            <div class="card-body">
                                <h5 class="card-title">Peso Total</h5>
                                <p class="card-text"><h3><?php echo $total_pedido; ?>  kg</p>
                                <button class="btn btn-primary finalizaPedido">Finaliza pedido</button>
                            </div>
                        </div>
                        <!-- <h1>Peso Total</h1>
                        <h3>0 kg</h3>
                        <button class="btn btn-primary">Finaliza pedido</button> -->
                    </div>
                
                

						<!-- Modal INSERIR -->
                        <div class="modal fade" id="inserirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header  alert-success">
                                        <h5 class="modal-title" id="exampleModalLabel">Inserir Produto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div><label for="sel1">Polpa</label>
                                                <select class="form-control" id="select-polpa" name="select-polpa">
                                                    <?php $resultado = mysqli_query($conectar, "SELECT * FROM tblPolpadefrutas ORDER BY id ASC");
                                                    while($row1 = mysqli_fetch_array($resultado)):; ?>
                                                    <option value="<?php echo $row1['id']; ?>"><?php echo $row1["polpa"]; ?></option>
                                                    <?php endwhile; ?> 
                                                </select>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col">
                                                <label for="quantidade">Peso (kg)</label>                          
                                                <input type="number" value="1" class="form-control" id="peso" name="peso">
                                            </div>
                                            <div class="form-group col">
                                                <label for="exampleFormControlSelect1">Unidade</label>
                                                <select class="form-control" id="select-unid">
                                                    <option>100 g</option>
                                                    <option>1 kg</option> 
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="quantidade">Unitario</label>                          
                                                <input type="number" value="1" class="form-control" id="vlrUnit" name="vlrUnit" onblur="myFunction()">
                                            </div>
                                            <div class="col">
                                                <label for="quantidade">Total</label>                          
                                                <input type="number" value="1" class="form-control" id="vlrTotal" name="vlrTotal">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" id="cancelar" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="confirmaReg" data-dismiss="modal">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>                    

             
						
                                
            </div> <!-- FIM MAIN -->            
            
        </div>

        
   
    <script>   

        function myFunction(){
            var peso      = document.getElementById("peso").value
            var vlrUnit   = document.getElementById("vlrUnit").value
            document.getElementById("vlrTotal").value = peso*vlrUnit            

        }

    
        $(document).ready(function(){

            $(".btnExcluirItem").click(function(){  
                var id = $(this).attr('id') 
                $.ajax({
                    url:"valle_excluirpolpa.php",
                    type:"post",
                    data: 'id=' + id,

                    success: function(d) {

                        history.go(0)
                        //location.href = "https://vallepolpas.adm.br/vallePedido2.php";
                        //$("#ped").html(d);
                        //alert(d);
                    }
                })

            })
        })

     

        $(document).ready(function() {

            $("#confirmaReg").click(function() {

                var n_pedido  = "<?php echo $novo_pedido; ?>"
                var polpa     = document.getElementById("select-polpa").options[document.getElementById("select-polpa").selectedIndex].text
                var peso      = document.getElementById("peso").value
                var unidade   = document.getElementById("select-unid").options[document.getElementById("select-unid").selectedIndex].text
                var vlrUnit   = document.getElementById("vlrUnit").value
                var vlrTotal  = document.getElementById("vlrTotal").value
                //alert(n_pedido+" "+polpa+" "+peso+" "+unidade)

                $.ajax({
                    url:"valle_inserirpolpa.php",
                    type:"post",
                    data: 'pedido=' + n_pedido +
                            '&polpa=' + polpa +    
                            '&peso=' + peso +              
                            '&unidade=' + unidade +
                            '&vlrUnit=' + vlrUnit + 
                            '&vlrTotal=' + vlrTotal,

                    success: function(d) {

                        history.go(0)
                        //location.href = "https://vallepolpas.adm.br/vallePedido2.php";
                        //$("#ped").html(d);
                        //alert(d);
                    }
                })
            })

            $(".finalizaPedido").click(function() {

                var n_pedido    = "<?php echo $novo_pedido; ?>"
                var cliente     = "<?php echo $idcliente; ?>"
                var datapedido  = "<?php echo $datapedido; ?>"
                var total       = "<?php echo $total_pedido; ?>"    
                var vlr_total   = "<?php echo $valor_total; ?>"                     

                $.ajax({
                    url:"valle_inserirpedido.php",
                    type:"post",
                    data: 'pedido=' + n_pedido +
                            '&cliente=' + cliente +    
                            '&datapedido=' + datapedido +              
                            '&total=' + total +
                            '&vlrtotal=' + vlr_total,

                    success: function(d) {

                            Swal.fire({
                                title: 'Finalizado com sucesso!',
                                icon: 'success',     
                                showConfirmButton: false,           
                                timer: 3000
                            }).then(function() {
                                location.href = "https://vallepolpas.adm.br/vallePedido.php";
                            })

                        //history.go(0)
                        
                        //$("#ped").html(d);
                        //alert(d);
                    }
                })
            })
        })

        
    </script>
 </body>

</html>