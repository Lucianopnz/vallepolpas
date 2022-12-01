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
    
    // TOTAL ESTOQUE

    $sql = "SELECT SUM(acerola_100) AS peso FROM estoque";
	$result  = mysqli_query($conectar,$sql);
	$row = mysqli_fetch_assoc($result);
    $acerola100 = $row['peso'];

    $sql = "SELECT SUM(acerola_1) AS peso FROM estoque";
	$result  = mysqli_query($conectar,$sql);
	$row = mysqli_fetch_assoc($result);
    $acerola1 = $row['peso'];

    $sql = "SELECT * FROM contadorpedido";
    $sql = $conectar->query($sql);
    $row = $sql->fetch_assoc();
    $novo_pedido = $row['contador'] + 1;

    $query = mysqli_query($conectar, "UPDATE contadorpedido SET contador = '$novo_pedido';");




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

        <style>
            .cartao{
                margin-left: 50px;
                margin-top: 10px;
                border-radius: 25px;
                border: 2px solid;
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


            <button class="btn btn-success" data-toggle="modal" data-target="#pedidoModal">Novo Pedido</button>
            <button class="btn btn-info" data-toggle="modal" data-target="#listPedidoModal">Lista Pedidos</button>
            <!-- <a class="btn btn-info" target='_blank' href="modelPDF4.php"><i class="fas fa-file-pdf"></i> Lista Pedidos</a> -->

            <!-- <form action="vallePedido2.php" method="post">

              <input type="hidden" name="novopedido" value="<?php echo $novo_pedido; ?>">
              <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">          

              <input type="submit" value="Novo Pedido" onclick="Location: https://vallepolpas.adm.br/vallePedido2.php" class="btn btn-success btn-sm" style='font-size:20px'>


            </form> -->

                </br></br>

                <?php $resultado = mysqli_query($conectar, "SELECT * FROM tblPedidos ORDER BY pedido DESC");
                    $linhas = mysqli_num_rows($resultado); ?>

                    
                        <table class="table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th width="12%">Data</th>
                                    <th width="10%">Pedido #</th>
                                    <th width="50%">Cliente</th>
                                    <th width="10%">Peso Total</th>
                                    <th width="4%"></th>
                                    <th width="4%"></th>
                                    <th width="4%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($linhas = mysqli_fetch_array($resultado)){ ?>
                                    <tr>
                                        <td ><?php echo date('d/m/Y', strtotime($linhas['datapedido'])); ?></td>
                                        <td><?php echo $linhas['pedido']; ?></td>
                                        <td ><?php echo $linhas['cliente']; ?></td>
                                        <td style="text-align: right;"><?php echo $linhas['totalpedido']; ?>  kg</td>
                                        <td ><button class="btn btn-warning"><i class="fas fa-pen"></i></button></td>
                                        <td ><button class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                                        <td ><a class="btn btn-primary" target='_blank' href="modelPDF5.php?pedido=<?php echo $linhas['pedido']?>&cliente=<?php echo $linhas['cliente']?>&datapedido=<?php echo $linhas['datapedido']?>&vlrUnitario=<?php echo $linhas['vlr_unitario']?>&vlrTotal=<?php echo $linhas['vlr_total']?>"><i class="fas fa-print"></i></a></td>
                                        <!-- <td ><a class="btn btn-primary" target='_blank' href="modelPDF.php"><i class="fas fa-print"></i> Imprimir</a></td> -->
                                    </tr>      
                                <?php } ?>                       
                            </tbody>
                        </table>
                              
                        
                        <!-- Modal INSERIR -->
                        <div class="modal fade" id="pedidoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header  alert-success">
                                        <h5 class="modal-title" id="exampleModalLabel">Pedido # <?php echo $novo_pedido; ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="vallePedido2.php" method="post" >

                                        <input type="hidden" name="novopedido" value="<?php echo $novo_pedido; ?>">
                                        <input type="hidden" name="usuario" value="<?php echo $usuario; ?>">  
                                        
                                        <div class="col-6">
                                            <label for="datapedido">Data Pedido:</label>
                                            <input type="date"  value="<?php echo date("Y-m-d"); ?>" class="form-control" id="datapedido" name="datapedido">
                                        </div>  

                                        <div class="col-12">
                                            <?php
                                            // $ped = 5;
                                                $resultado = mysqli_query($conectar, "SELECT * FROM tblClientes ORDER BY cliente ASC");
                                                $linhas = mysqli_num_rows($resultado);
                                                $ordem = 0;
                                            ?>                 

                                                        
                                            <label for="sel1">Cliente:</label>
                                            <select class="form-control" id="selcliente" name="selcliente">
                                                <?php $resultado = mysqli_query($conectar, "SELECT * FROM tblClientes ORDER BY cliente ASC");
                                                while($row1 = mysqli_fetch_array($resultado)):; ?>
                                                    <option value="<?php echo $row1['cliente']; ?>"><?php echo $row1["cliente"]; ?></option>
                                                <?php endwhile; ?> 
                                            </select>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <!-- <button type="button" class="btn btn-primary" id="confirmaInsert" data-dismiss="modal">Confirmar</button> -->
                                            <input type="submit" value="Confirma" onclick="Location: https://vallepolpas.adm.br/vallePedido2.php" class="btn btn-success btn-sm" style='font-size:20px'>
                                        </div>
                                        


                                        


                                        </form>

                                    


                                        <!-- <div><label for="sel1">Polpa</label>
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
                                                <input type="number" value="1" class="form-control" id="peso" name="peso" onblur="myFunction()">
                                            </div>
                                            <div class="form-group col">
                                                <label for="exampleFormControlSelect1">Unidade</label>
                                                <select class="form-control" id="select-unid">
                                                    <option>100 g</option>
                                                    <option>1 kg</option> 
                                                </select>
                                            </div>
                                        </div> -->
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </div> 

                        <!-- MODADL LISTA PEDIDO -->
                        <div class="modal fade" id="listPedidoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header  alert-info">
                                        <h5 class="modal-title" id="exampleModalLabel">Listar Pedidos</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form action="modelPDF4.php" method="post"  target="_blank">

                                        
                                        <div class="row">
                                            <div class="col-12">
                                                <?php
                                                // $ped = 5;
                                                    $resultado = mysqli_query($conectar, "SELECT * FROM tblClientes ORDER BY cliente ASC");
                                                    $linhas = mysqli_num_rows($resultado);
                                                    $ordem = 0;
                                                ?>                 

                                                            
                                                <label for="sel1">Cliente:</label>
                                                <select class="form-control" id="sel-cliente" name="sel-cliente">
                                                    <?php $resultado = mysqli_query($conectar, "SELECT * FROM tblClientes ORDER BY cliente ASC");
                                                    while($row1 = mysqli_fetch_array($resultado)):; ?>
                                                        <option value="<?php echo $row1['cliente']; ?>"><?php echo $row1["cliente"]; ?></option>
                                                    <?php endwhile; ?> 
                                                </select>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <label for="datapedido">Periodo de:</label>
                                                <input type="date"  value="<?php echo date("Y-m-d"); ?>" class="form-control" id="datainicio" name="datainicio">
                                            </div> 

                                            <div class="col-6">
                                                <label for="datapedido">Até:</label>
                                                <input type="date"  value="<?php echo date("Y-m-d"); ?>" class="form-control" id="datafinal" name="datafinal">
                                            </div> 
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <!-- <button type="button" class="btn btn-primary" id="confirmaInsert" data-dismiss="modal">Confirmar</button> -->
                                            <!-- <input type="submit" value="Confirma" onclick="Location: https://vallepolpas.adm.br/vallePedido2.php" class="btn btn-success btn-sm" style='font-size:20px'> -->
                                            <button type="submit" class="btn btn-primary" ><i class='fas fa-print'></i></button>

                                        </div>
   
                                        </form>

                                        
                                    </div>
                                    
                                </div>
                            </div>
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
                                                <input type="number" value="1" class="form-control" id="peso" name="peso" onblur="myFunction()">
                                            </div>
                                            <div class="form-group col">
                                                <label for="exampleFormControlSelect1">Unidade</label>
                                                <select class="form-control" id="select-unid">
                                                    <option>100 g</option>
                                                    <option>1 kg</option> 
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="confirmaInsert" data-dismiss="modal">Confirmar</button>
                                    </div>
                                </div>
                            </div>
                        </div>                    

             
						
                                
            </div> <!-- FIM MAIN -->            
            
        </div>

        
    </body>
    <script>

        function calcRend(){
            var peso1 = document.getElementById("pesopolpa").value
            var peso2 = document.getElementById("qpesofruta").innerHTML
            var rend  = document.getElementById("efic").value = peso1*100/peso2 
            var resi  =  peso2 - peso1           
            document.getElementById("efic").value = parseFloat(rend).toFixed(2)  
            document.getElementById("residuo").value = parseFloat(resi).toFixed(2)   
        }        

        $(document).ready(function() {
            $('.itens li:has(ul)').click(function(e) {
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
            })
        })

        

        $(document).ready(function() {

            $("#btnTeste").click(function() {
                
                var cliente = document.getElementById("sel-cliente").options[document.getElementById("sel-cliente").selectedIndex].text
                $.ajax({
                    url:"modelPDF4.php",
                    type:"post",
                    data: 'cliente=' + cliente,

                    success: function(d) {
                        alert("Pedido OK")

                        location.href = "https://vallepolpas.adm.br/vallePedido.php";
                        //$("#ped").html(d);
                        //alert(d);
                    }
                })
            })

            $("#confirmaInsert").click(function() {

                var n_pedido  = "<?php echo $novo_pedido; ?>";
                var polpa     = document.getElementById("select-polpa").options[document.getElementById("select-polpa").selectedIndex].text
                var peso      = document.getElementById("peso").value
                var unidade   = document.getElementById("select-unid").options[document.getElementById("select-unid").selectedIndex].text
                        
                $.ajax({
                    url:"valle_inserirpolpa.php",
                    type:"post",
                    data: 'pedido=' + n_pedido +
                            '&polpa=' + polpa +    
                            '&peso=' + peso +              
                            '&unidade=' + unidade,

                    success: function(d) {
                        alert("Pedido OK")

                        location.href = "https://vallepolpas.adm.br/vallePedido.php";
                        //$("#ped").html(d);
                        //alert(d);
                    }
                });
            });
        })

        $(document).ready(function() {

            $("#confirmarDesp").click(function() {
            
                var user = document.getElementById("numlote")
                var userLote = user.innerHTML
                var pesopolpa = document.getElementById("pesopolpa").value
                var pesoresiduo = document.getElementById("residuo").value
                var rendimento = document.getElementById("efic").value                        
            
                $.ajax({
                    url: "valleAceiteDespolpa.php",
                    type: "post",
                    //data:$("#insert").serialize(),
                    data: 'pedido=' + n_pedido +
                            '&polpa=' + polpa +    
                            '&peso=' + peso +              
                            '&unidade=' + unidade,

                    success: function(d) {

                        location.href = "https://vallepolpas.adm.br/valleProducao.php";
                    }
                });
            });
        })


        

    </script>


</html>