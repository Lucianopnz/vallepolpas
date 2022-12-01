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
                <?php
                    $resultado = mysqli_query($conectar, "SELECT * FROM producao ORDER BY id DESC");
                    $linhas = mysqli_num_rows($resultado);

                    ?>

                    <table class="table" style="width:100%;">
                            <thead>
                                <tr>
                                    <th width="5%">Lote</th>
                                    <th width="10%">Data</th>
                                    <th width="20%">Fruta</th>
                                    <th width="10%">Peso Fruta</th>
                                    <th width="10%">Rend %</th>
                                    <th width="10%">Peso Polpa</th>
                                    <th width="8%">Embalagem</th>
                                    <th width="9%">Polpa</th>
                                    <th width="9%">Envase</th>
                                    <th width="9%">Produção</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($linhas = mysqli_fetch_array($resultado)){ ?>
                                    <tr>
                                        <td><?php echo $linhas['lotefabricacao']; ?></td>
                                        <td ><?php echo date('d/m/Y', strtotime($linhas['dataproducao'])); ?></td>
                                        <td><?php echo $linhas['fruta']; ?></td>
                                        <td ><?php echo $linhas['pesofruta']; ?></td>
                                        <td ><?php echo $linhas['rendimento']; ?>%</td>
                                        <td ><?php echo $linhas['polpa']; ?></td>
                                        <td ><?php echo $linhas['embalagem']; ?></td>
                                        <td ><button class="btn btn-secondary"><i class="fas fa-check"></i></button></td>
                                        <td ><button class="btn btn-secondary"><i class="fas fa-check"></i></button></td>
                                        <td ><button class="btn btn-secondary"><i class="fas fa-check"></i></button></td>
                                        <!-- <td ><a class="btn btn-primary" target='_blank' href="modelPDF5.php?pedido=<?php echo $linhas['pedido']?>&cliente=<?php echo $linhas['cliente']?>&datapedido=<?php echo $linhas['datapedido']?>&vlrUnitario=<?php echo $linhas['vlr_unitario']?>&vlrTotal=<?php echo $linhas['vlr_total']?>"><i class="fas fa-print"></i></a></td> -->
                                        <!-- <td ><a class="btn btn-primary" target='_blank' href="modelPDF.php"><i class="fas fa-print"></i> Imprimir</a></td> -->
                                    </tr>      
                                <?php } ?>                       
                            </tbody>
                        </table>
               

                <?php
                    $resultado = mysqli_query($conectar, "SELECT * FROM producao WHERE aceite = 'N' ORDER BY id DESC");
                    $linhas = mysqli_num_rows($resultado);
                ?>
                

               
                <div class="row">

                    <?php while($linhas = mysqli_fetch_array($resultado)){ ?>
                        
                    <div class="cardprod">
                        <div class="card">   
                                                        
                            <div class="card-header">Fruta: <?php echo $linhas['fruta']; ?> </div>
                            
                                <div class="card-body">

                                    <input type="hidden" id="idFruta_" value="<?php echo $linhas['id']; ?>">
                                    <p>Lote Entrada: <?php echo $linhas['loteentrada']; ?></br>
                                    Lote Fabricação: <?php echo $linhas['lotefabricacao']; ?></br>
                                    Data Produção: <?php echo $linhas['dataproducao']; ?></br>
                                    Peso Fruta: <?php echo $linhas['pesofruta']; ?> Kg</br>
                                    Previsto polpa: <?php echo $linhas['previstopolpa']; ?> Kg</br>
                                    Hora Inicio: <?php echo $linhas['horainicio']; ?></br>
                                    <i class="fas fa-cog "  ></i> <span class="fase">DESPOLPAMENTO</span> </br>
                                    Peso Polpa: <?php echo $linhas['polpa']; ?> Kg</br>
                                    Peso Resíduo: <?php echo $linhas['residuo']; ?> Kg</br>
                                    Rendimento: <?php echo $linhas['rendimento']; ?>%</br>
                                    <i class="fas fa-fill-drip"  ></i> <span class="fase">ENVASAMENTO</span></br>
                                    Qtd Polpas: <?php echo $linhas['qtdpolpa']; ?></br>
                                    Hora Final: <?php echo $linhas['horafinal']; ?></br>
                                    Embalagem: <?php echo $linhas['embalagem']; ?></p>                                          

                                </div> 
                                <div class="card-footer">
                                <?php
                                    if($linhas['aceitedespolpa'] == "S"){ ?>
                                        <button type='button' class='btn btn-success btn-sm btnAceiteDesp' id="<?php echo $linhas['id'] ?>">Despolpa <i class='fas fa-check'></i></button>
                                    <?php } else { ?>
                                        <button type='button' class='btn btn-secondary btn-sm btnAceiteDesp' id="<?php echo $linhas['id'] ?>">Despolpa</button>
                                    <?php }
                                ?>

                                <?php
                                    if($linhas['aceiteenvase'] == "S"){ ?>
                                        <button type='button' class='btn btn-success btn-sm btnAceiteEnva' id="<?php echo $linhas['id'] ?>">Envase <i class='fas fa-check'></i></button>
                                    <?php } else { ?>
                                        <button type='button' class='btn btn-secondary btn-sm btnAceiteEnva' id="<?php echo $linhas['id'] ?>">Envase</button>
                                    <?php }
                                ?>

                                    <!-- <button type="button"  class="btn alert-success btn-sm concluido" id="<?php echo $linhas['id'] ?>">Aceite</button> -->
                                    <button type="button" class="btn btn-primary btn-sm btnAceite" id="<?php echo $linhas['id'] ?>" data-target="#modalConfirma">Aceite</button>
                                </div>   
                                                            
                            </div>
                         </div> 
                        <?php } ?>
                    </div>

                    <!-- The Modal -->

                    <!-- The Modal -->
                    <div class="modal" id="modalConfirma">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">

                            <input type="hidden" id="idFruta">
                            <input type="hidden" id="idProduto">
                            <input type="hidden" id="idPeso">
                            <input type="hidden" id="idEmbalagem">

                            <input type="hidden" id="ac100" value="<?php echo $acerola100; ?>">
                            <input type="hidden" id="ac1" value="<?php echo $acerola1; ?>">

                            <h5 class="modal-title">Processo finalizado com sucesso...</h5>
                            <button type="button" id="fimProcesso" class="close" data-dismiss="modal">&times;</button>
                        </div>

                       

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" id="fechar" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>

                        </div>
                    </div>
                    </div>

                        <div class="modal fade" id="modalEnvase">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">

									<!-- Modal body -->
									<div class="modal-body">

										<h5 class="font-texto">
                                            <input type="hidden" id="id">
                                            
											<p><span class="span-left">Fruta:</span> <span class="span-right" id="fruta"></span></p>
											<p><span class="span-left">Lote:</span> <span class="span-right" id="lote"></span></p>
                                            <p><span class="span-left">Peso Polpa:</span> <span class="span-right" id="polpa"></span> kg</p>
										</h5>
										<hr>

										<form method="post" id="view-dados">
											

											<h4 style="color: #228C2B;">Dados Envasamento</h4>

											<div class="row">
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label for="qtdpolpa">Qtd Polpas (Unid)</label>
													<input type="number" class="form-control" id="qtdpolpa" name="qtdpolpa" onchange="calcRend()">
												</div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label for="horafinal">Hora Final</label>
													<input type="number" class="form-control" id="horafinal" name="horafinal" >
												</div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                    <label for="exampleFormControlSelect1">Embalagem</label>
                                                    <select class="form-control" id="select-tipo">
                                                    <option>100 g</option>
                                                    <option>1 kg</option> 
                                                    </select>
                                                </div>                                                
                                            </div>	
										</form>
									</div>
									<!-- Modal body FIM -->

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										<button type="button" class="btn btn-success" id="confirmarEnva" data-dismiss="modal">Confirmar</button>
									</div>

								</div>	<!-- Modal-content fim -->
							</div>	<!-- Modal-dialog fim -->
						</div> <!-- Modal fade fim -->

						<div class="modal fade" id="modalDespolpa">
							<div class="modal-dialog modal-dialog-centered">
								<div class="modal-content">

									<!-- Modal body -->
									<div class="modal-body">

										<h5 class="font-texto">
											<p><span class="span-left">Fruta:</span> <span class="span-right text-info" id="nomefruta"></span></p>
											<p><span class="span-left">Lote:</span> <span class="span-right text-info" id="numlote"></span></p>
                                            <p><span class="span-left">Peso Fruta:</span> <span class="span-right text-info" id="qpesofruta"></span> kg</p>
										</h5>
										<hr>

										<form method="post" id="view-dados">
											<input type="hidden" name="id" id="id">
											<input type="hidden" name="pesoBase" id="pesoBase">

											<h4 style="color: #228C2B;">Dados Despolpamento</h4>

											<div class="row">
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label for="peso2">Peso Polpa</label>
													<input type="number" class="form-control" id="pesopolpa" name="pesopolpa" onchange="calcRend()">
												</div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label for="efic">Rendimento %</label>
													<input type="number" class="form-control" id="efic" name="efic" >
												</div>
                                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
													<label for="peso2">Peso Residuo</label>
													<input type="number" class="form-control" id="residuo" name="residuo">
												</div>										
										

										</form>
									</div>
									<!-- Modal body FIM -->

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										<button type="button" class="btn btn-success" id="confirmarDesp" data-dismiss="modal">Confirmar</button>
									</div>

								</div><!-- Modal-content fim -->
							</div>	<!-- Modal-dialog fim -->
						</div> <!-- Modal fade fim -->

                        

                        

                        <!-- The Modal -->
						
                                
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
            $(".btnAceite").click(function() {
                var id = $(this).attr('id')    

                //alert("Aceite OK: id:"+id)

                $.ajax({

                    // url: "valleFimProducao.php",
                    // type: "post",
                    // data: 'id=' + id,
                    url: "dados_fimproducao.php",
                    method: "POST",
                    data: { id: id },
                    dataType: "json",

                    success: function(d) {

                        $('#idFruta').val(d.fruta)
                        $('#idProduto').val(d.produto)
                        $('#idPeso').val(d.polpa)
                        $('#idEmbalagem').val(d.embalagem)

                        $('#modalConfirma').modal('show')
                        
                                            
                    }
                })
            })
        })

        $(document).ready(function() {

            $("#fechar").click(function() {

                var fruta = document.getElementById("idFruta").value
                var produto = document.getElementById("idProduto").value
                var peso = document.getElementById("idPeso").value    
                var embalagem = document.getElementById("idEmbalagem").value                    

                $.ajax({
                    url: "valleFimProducao2.php",
                    type: "post",
                    //data:$("#insert").serialize(),
                    data: 'fruta=' + fruta +
                        '&produto=' + produto +
                        '&peso=' + peso +
                        '&embalagem=' + embalagem,

                    success: function(d) {

                        location.href = "https://vallepolpas.adm.br/valleProducao.php";
                        //$("#ped").html(d);
                        //alert(d);
                    }
                });
            });
        })


        /** ACEITE DESPOLPA */
	    $(document).ready(function() {

            $('.btnAceiteDesp').on('click', function() {
                    
                var user_id = $(this).attr('id')      
                var dados = {
                    id: user_id
                }               

                $.ajax({
                    url: "dados_producao.php",
                    method: "POST",
                    data: { id: user_id },
                    dataType: "json",

                    success: function(data) {

                        dat = new Date(data.dataproducao)
                        dataFormatada = dat.toLocaleDateString('pt-BR', {
                            timeZone: 'UTC'
                        })

                        //$('#datent').html(dataFormatada)
                        $('#numlote').html(data.loteentrada)
                        $('#nomefruta').html(data.fruta)
                        $('#qpesofruta').html(data.pesofruta)

                        $('#pesopolpa').val(data.polpa)
                        $('#efic').val(data.rendimento)
                        $('#residuo').val(data.residuo)
                        //$('#peso2').val(data.pesopolpa)
                        $('#modalDespolpa').modal('show')
                    }
                })
            })
        })

        //** CONFIRMA ACEITE DESPOLPA */

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
                    data: 'lote=' + userLote +
                        '&pesopolpa=' + pesopolpa +
                        '&pesoresiduo=' + pesoresiduo +
                        '&rendimento=' + rendimento,

                    success: function(d) {

                        location.href = "https://vallepolpas.adm.br/valleProducao.php";
                        //$("#ped").html(d);
                        //alert(d);
                    }
                });
            });
        })

        // fim processo

        $(document).ready(function() {

            $("#fimProcesso").click(function() {
            
                var fruta = document.getElementById("idFruta").value
                var produto = document.getElementById("idProduto").value
                var peso = document.getElementById("idPeso").value    
                var embalagem = document.getElementById("idEmbalagem").value   
                
                var ac100 = document.getElementById("ac100").value
                var ac1   = document.getElementById("ac1").value
                
            
                $.ajax({
                    url: "valleFimProducao2.php",
                    type: "post",
                    //data:$("#insert").serialize(),
                    data: 'fruta=' + fruta +
                           '&produto=' + produto +
                           '&peso=' + peso +
                           '&embalagem=' + embalagem +
                           '&ac100=' + ac100 +
                           '&ac1=' + ac1,

                    success: function(d) {

                        location.href = "https://vallepolpas.adm.br/valleProducao.php";
                        //$("#ped").html(d);
                        //alert(d);
                    }
                });
            });
        })

        /** ACEITE ENVASE */
	    $(document).ready(function() {

            $('.btnAceiteEnva').on('click', function() {
                    
                var user_id = $(this).attr('id')                
                var dados = {
                    id: user_id
                }               

                $.ajax({
                    url: "dados_producao.php",
                    method: "POST",
                    data: { id: user_id },
                    dataType: "json",

                    success: function(data) {

                        dat = new Date(data.dataentrada)
                        dataFormatada = dat.toLocaleDateString('pt-BR', {
                            timeZone: 'UTC'
                        })

                        //$('#datent').html(dataFormatada)
                        document.getElementById("id").value = user_id
                        $('#lote').html(data.loteentrada)
                        $('#fruta').html(data.fruta)
                        $('#polpa').html(data.polpa)

                        $('#qtdpolpa').val(data.qtdpolpa)
                        $('#horafinal').val(data.horafinal)
                        $('#embalagem').val(data.embalagem)
                        $('#modalEnvase').modal('show')
                    }
                })
            })
        })

        //** CONFIRMA ACEITE DESPOLPA */

        $(document).ready(function() {

            $("#confirmarEnva").click(function() {

                var user = document.getElementById("lote")
                var id = document.getElementById("id").value
                var userLote = user.innerHTML
                var qtdpolpa = document.getElementById("qtdpolpa").value
                var horafinal = document.getElementById("horafinal").value  
                var embalagem   = document.getElementById("select-tipo").value
                //var embalagem = document.getElementById("select-tipo").options[document.getElementById("select-tipo").selectedIndex].text

                $.ajax({
                    url: "valleAceiteEnvase.php",
                    type: "post",
                    //data:$("#insert").serialize(),
                    data: 'lote=' + userLote +
                        '&id=' + id +
                        '&qtdpolpa=' + qtdpolpa +
                        '&horafinal=' + horafinal +
                        '&embalagem=' + embalagem,

                    success: function(d) {

                        location.href = "https://vallepolpas.adm.br/valleProducao.php";
                        //$("#ped").html(d);
                        //alert(d);
                    }
                });
            });
        })

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