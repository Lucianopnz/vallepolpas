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
	$sql = "SELECT SUM(pesodespolpa) AS peso_total FROM insumos WHERE producao = 'N' ";
	$result  = mysqli_query($conectar,$sql);
	$row = mysqli_fetch_assoc($result);
    $peso_total = $row['peso_total'];

    $sql = "SELECT SUM(pesopolpa) AS rend_total FROM insumos WHERE producao = 'N'";
	$result  = mysqli_query($conectar,$sql);
	$row = mysqli_fetch_assoc($result);
    $rend_total = $row['rend_total'];

    // INSUMOS POR FRUTA

    // ACEROLA
    $sql = "SELECT IFNULL(SUM(pesodespolpa), 0) AS totalacerola FROM insumos WHERE producao = 'N' AND fruta = 'ACEROLA'";
    $result  = mysqli_query($conectar,$sql);
    if (result == NULL){
        $peso_acerola = 0;
    } else {
        $row = mysqli_fetch_assoc($result);
        $peso_acerola = $row['totalacerola']; 
    }

    // CAJU 
    $sql = "SELECT IFNULL(SUM(pesodespolpa), 0) AS totalcaju FROM insumos WHERE producao = 'N' AND fruta = 'CAJU'";
    $result  = mysqli_query($conectar,$sql);
    if (result == NULL){
        $peso_caju = 0;
    } else {
        $row = mysqli_fetch_assoc($result);
        $peso_caju = $row['totalcaju']; 
    }          

    // GOIABA
    $sql = "SELECT IFNULL(SUM(pesodespolpa), 0) AS totalgoiaba FROM insumos WHERE producao = 'N' AND fruta = 'GOIABA'";
    $result  = mysqli_query($conectar,$sql);
    if (result == NULL){
        $peso_goiaba = 0;
    } else {
        $row = mysqli_fetch_assoc($result);
        $peso_goiaba = $row['totalgoiaba']; 
    }

    // MANGA
    $sql = "SELECT IFNULL(SUM(pesodespolpa), 0) AS totalmanga FROM insumos  WHERE producao = 'N' AND fruta = 'MANGA'";
    $result  = mysqli_query($conectar,$sql);
    if (result == NULL){
        $peso_manga = 0;
    } else {
        $row = mysqli_fetch_assoc($result);
        $peso_manga = $row['totalmanga']; 
    }

    // MARACUJA
    $sql = "SELECT IFNULL(SUM(pesodespolpa), 0) AS totalmaracuja FROM insumos  WHERE producao = 'N' AND fruta = 'MARACUJ??'";
    $result  = mysqli_query($conectar,$sql);
    if (result == NULL){
        $peso_maracuja = 0;
    } else {
        $row = mysqli_fetch_assoc($result);
        $peso_maracuja = $row['totalmaracuja']; 
    } 

    // TOTAL ESTOQUE
    $sql = "SELECT SUM(polpa) AS peso_total FROM producao WHERE aceite = 'S'";
	$result  = mysqli_query($conectar,$sql);
	$row = mysqli_fetch_assoc($result);
    $peso_total2 = $row['peso_total'];  

    // ESTOQUE POR FRUTA

    // ACEROLA
    $sql = "SELECT IFNULL(SUM(polpa), 0) AS totalacerola FROM producao WHERE aceite = 'S' AND fruta = 'ACEROLA'";
    $result  = mysqli_query($conectar,$sql);
    if (result == NULL){
        $pesopolpa_acerola = 0;
    } else {
        $row = mysqli_fetch_assoc($result);
        $pesopolpa_acerola = $row['totalacerola']; 
    }

    // CAJU 
    $sql = "SELECT IFNULL(SUM(polpa), 0) AS totalcaju FROM producao WHERE aceite = 'S' AND fruta = 'CAJU'";
    $result  = mysqli_query($conectar,$sql);
    if (result == NULL){
        $pesopolpa_caju = 0;
    } else {
        $row = mysqli_fetch_assoc($result);
        $pesopolpa_caju = $row['totalcaju']; 
    }          

    // GOIABA
    $sql = "SELECT IFNULL(SUM(polpa), 0) AS totalgoiaba FROM producao WHERE aceite = 'S' AND fruta = 'GOIABA'";
    $result  = mysqli_query($conectar,$sql);
    if (result == NULL){
        $pesopolpa_goiaba = 0;
    } else {
        $row = mysqli_fetch_assoc($result);
        $pesopolpa_goiaba = $row['totalgoiaba']; 
    }

    // MANGA
    $sql = "SELECT IFNULL(SUM(polpa), 0) AS totalmanga FROM producao WHERE aceite = 'S' AND fruta = 'MANGA'";
    $result  = mysqli_query($conectar,$sql);
    if (result == NULL){
        $pesopolpa_manga = 0;
    } else {
        $row = mysqli_fetch_assoc($result);
        $pesopolpa_manga = $row['totalmanga']; 
    }

    // MARACUJA
    $sql = "SELECT IFNULL(SUM(polpa), 0) AS totalmaracuja FROM producao WHERE aceite = 'S' AND fruta = 'MARACUJ??'";
    $result  = mysqli_query($conectar,$sql);
    if (result == NULL){
        $pesopolpa_maracuja = 0;
    } else {
        $row = mysqli_fetch_assoc($result);
        $pesopolpa_maracuja = $row['totalmaracuja']; 
    } 

    // $sql = "SELECT * FROM estoque_polpa";
    // $result  = mysqli_query($conectar,$sql);
	// $row = mysqli_fetch_assoc($result);
    
    // $acerola = $row['acerola'];  
    // $caju = $row['caju']; 
    // $goiaba = $row['goiaba']; 
    // $manga = $row['manga']; 
    // $maracuja = $row['maracuja']; 
    
    

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>   
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Valle Polpas</title>
        
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"> 
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/valleStilo.css">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>  
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> 
        <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>        
        
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script> 
    
        <style>
            .textCam{
                font-size: 12px;                
            }

            .text-linha{
                line-height: 1.1;
            }
        </style>
    </head>
    
    <body>
        <div class="wrapper">
            <span class="top-left"><img src="imagens/Logo.png" width="160" height="120" alt="User" /></span>
            
            <input type="hidden" id="ds1">
            <input type="hidden" id="ds2">
            <input type="hidden" id="ds3">

            <!-- <div class="top">Top</div> -->
            <div class="sidebar">
                <!-- <h4 style="text-align: center;">Ind??stria & Com??rcio</h4> -->
                <ul class="itens">
                    <li ><a href="#"><i class="fas fa-desktop fa-2x" ></i><span> Painel de Controle</span></a></li>
                    <li><a href="#"><i class="fas fa-address-card fa-2x"></i><span> Cadastros <i class="ico right fas fa-plus"></i></span></a>
                        <ul class="cad" style="display: none;">
                            <li class="nav-item"><a class="nav-link" href="valleCadfornecedor.php"><i class="fas fa-dolly"></i> Fornecedor</a></li>
                            <li><a class="nav-link" href="valleCadfrutas.php"><i class="fas fa-apple-alt"></i></i> Fruta</a></li>
                        </ul>
                    </li>
                    <li><a href="valleInsumos.php"><i class="fas fa-dolly-flatbed fa-2x"></i><span> Insumos</span></a></li>
                    <li><a href="#"><i class="fas fa-cogs fa-2x"></i><span> Produ????o <i class="ico right fas fa-plus"></i></span></a>
                        <ul class="cad" style="display: none;">
                            <li class="nav-item"><a class="nav-link" href="valleProducao.php"><i class="fas fa-cog"></i> Produ????o</a></li>
                            <li><a class="nav-link" href="valleProdFinal.php"><i class="fas fa-clipboard-check"></i> Finalizado</a></li>
                        </ul>
                    </li>
                    <li><a href="valleRelatorios.php"><i class="fas fa-print fa-2x"></i><span> Relat??rios</span></a></li>              
                </ul>

                <!-- <div class="direito">
                    <h6>Ind??stria & Com??rcio</h6>
                </div> -->
                <div class="legal">
                    <div class="copyright">
                        &copy; 2020 - 2021 <a href="#">Valle Polpas</a>.
                    </div>
                    <div class="version">
                        <b>Version: </b> 20.30.06
                    </div>
                </div>
                
            </div> <!-- Fim Sidebar -->

            <div class="main">

                               
                
                <div class="row">
                    <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card-panel bg-light">
                            <div class="float-left">
                                <h6>Pedidos</h6>
                                <h4><span>780 Kg</span></h4>                                         
                                
                            </div>
                            <div class="float-right">
                                <i class="fas fa-cart-plus"></i>
                            </div>
                        </div>
                    </div>    -->
                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card-panel bg-light">
                            <div class="float-left">        
                                <h6>Insumos</h6>        
                                <h3><span><?php echo number_format($peso_total); ?> Kg</span></h3>
                                <h6 style=" opacity: 0.5;">: <?php echo number_format($rend_total); ?> kg polpa</h6>    
                            </div>
                            <div class="float-right">
                                <i class="fas fa-dolly-flatbed"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card-panel  bg-light">
                        <div class="float-left">
                            <h6>Produ????o (m??s)</h6>
                            <h3><span>47 Ton</span></h3>
                            <h6 style=" opacity: 0.5;">Anual: 130 Ton</h6> 
                        </div>
                        <div class="float-right">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card-panel bg-light">
                            <div class="float-left">
                                <h6>Estoque Polpas</h6>
                            <h3>
                                <?php echo number_format($peso_total2); ?> Kg
                            </h3>
                            
                            </div>
                            <div class="float-right">
                                <img class="fas" src="imagens/icon_merc.png" alt="">
                                <!-- <i class="fas fa-boxes"></i> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" >
                        <div class="card-panel bg-info" >
                            <div class="float-left text-linha" >        
                                <h6>Camaras Frias</h6>   
                                <div class="row">
                                    <div class="col-8 text-light"><span class="textCam">T??nel:</span></div>
                                    <div class="col-4 text-light"><span id="temper1"> </span>&deg</div>
                                </div>
                                <div class="row">
                                    <div class="col-8 text-light"><span class="textCam">Armazenamento:</span></div>
                                    <div class="col-4 text-light"><span id="temper2"> </span>&deg</div>
                                </div>
                                <div class="row">
                                    <div class="col-8 text-light"><span class="textCam">Resfriamento:</span></div>
                                    <div class="col-4 text-light"><span id="temper3"> </span>&deg</div>
                                </div>
                                
                            </div>
                            <div class="float-right">
                                <i class="fas fa-thermometer-half text-light"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <?php
                    $resultado = mysqli_query($conectar, "SELECT * FROM insumos WHERE producao = 'N' ORDER BY id DESC");
                    $linhas = mysqli_num_rows($resultado);
                ?>

                <div class="row mt-1">
                    
                    <!-- TABELA INSUMOS -->
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="tabela">
                        <div class="d-flex">
                            <span class="p-2 mr-auto" style="margin-left: 15px; font-weight: bold; color: #4CAF50;">
                                :: INSUMOS
                            </span>
                            
                           
                            <div class="dropdown">
                                <button type="button"   class="btn btn-light btn-sm dropdown-toggle" style="margin-right:10px;" data-toggle="dropdown">
                                    Exportar dados
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" onclick="exportEXCEL()" href="#"><i class="fas fa-file-excel text-success" ></i> Excel</a>
                                    <a class="dropdown-item" target='_blank' href="modelPDF1.php"><i class="fas fa-file-pdf text-danger"></i> PDF</a>
                                </div>
                            </div>
                           
                        </div>

                        <div class="card-table" style="overflow-x:auto;">                            
                        
                                <table id="tableInsumos" class="table table-hover" style="width:100%">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="15%" >Lote</th>
                                            <th width="50%" >Fruta</th>
                                            <th width="20%" >Peso</th>
                                            <th width="15%" >Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            while($linhas = mysqli_fetch_array($resultado)){
                                                if($linhas['aceite'] == "S") {
                                                    echo "<tr>";
                                                    echo "<td>".$linhas['lote']."</td>";
                                                    echo "<td>".$linhas['fruta']."</td>";
                                                    echo "<td>".$linhas['pesodespolpa']." Kg</td>";                                        
                                                    //echo "<td><button type='button' class='btn btn-info btnver'>Seleciona</button></td>";
                                                    //echo "<td><button type='button' class='btn btn-info btnVer' id=".$linhas['id']."><i class='far fa-check-circle'></i></button></td>";
                                                    echo "<td><a class='btnVer' href='#' id=".$linhas['id']."><img src='imagens/verifica.png'></a></td>";
                                                    echo "</tr>";
                                                } else {
                                                    echo "<tr>";
                                                    echo "<td>".$linhas['lote']."</td>";
                                                    echo "<td>".$linhas['fruta']."</td>";
                                                    echo "<td>".$linhas['pesodespolpa']." Kg</td>";                                        
                                                    //echo "<td><button type='button' class='btn btn-info btnver'>Seleciona</button></td>";
                                                    //echo "<td><button type='button' class='btn btn-info btnVer' id=".$linhas['id']."><i class='far fa-check-circle'></i></button></td>";
                                                    echo "<td><a data-toggle='modal' class='btnVer' href='#modalAviso' ><img src='imagens/lock.png'></a></td>";
                                                    
                                                    echo "</tr>";
                                                }
                                                
                                            }
                                        ?>

                                        
                                        
                                    </tbody>
                                </table>

                                <!-- Modal -->
                                        <div class="modal fade" id="modalAviso" role="dialog">
                                            <div class="modal-dialog">
                                            
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning">
                                                <h4 class="modal-title "><i class="fas fa-exclamation-triangle"></i> ATEN????O</h4>
                                                </div>
                                                <div class="modal-body">
                                                <p><h6> O LOTE selecionado nao est?? liberado para produ????o!</h6></p>
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                            
                                            </div>
                                        </div>

                                        <!-- The Modal -->
                                        <div class="modal fade" id="myModal">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header alert-info text-dark">
                                                    <h4 class="modal-title">Lote #<span id="lotefabricacao"></span></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body" id="info_dados">
                                                    <form method="post" id="view-dados">
                                                        <input type="hidden" name="id" id="id">
                                                        <input type="hidden" name="pesoBase" id="pesoBase">
                                                        
                                                        <h5 class="modal-title">Data de Fabrica????o: <span id="data"></span></h5>
                                                        <h5 class="modal-title">Lote de Entrada: <span id="loteentrada"></span></h5>
                                                        <h5 class="modal-title alert-secondary">Fruta: <span id="fruta"></span></h5>  
                                                        <h5 class="modal-title">Peso Fruta: <span id="pesofruta"></span> kg</h5> 
                                                        <h5 class="modal-title">Peso Polpas: <span id="pesopolpa"></span> kg</h5> 
                                                        <h5 class="modal-title">Qtd de Polpas: <span id="qtdpolpa"></span> Unidades</h5> 
                                                        <h5 class="modal-title">Rendimento: <span id="rendimento"></span> %</h5> 
                                                        <h5 class="modal-title">Tipo Embalagem: <span id="embalagem"></span></h5>                                                             
                                                            
                                                     
                                                        
                                                    </form>
                                                </div> <!-- Modal body FIM -->

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                                </div>

                                                </div> <!-- Modal-content fim -->
                                            </div> <!-- Modal-dialog fim -->
                                        </div> <!-- Modal fade fim -->  

                        </div> <!-- card-table fim -->
                        

                        
                    </div> <!-- col fim -->

                    <!-- INICIO TABELA PRODU????O -->

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="tabela">
                    <div class="d-flex">
                            <span class="p-2 mr-auto" style="margin-left: 15px; font-weight: bold; color: #4CAF50;">
                                :: PRODU????O DE POLPAS
                            </span>

                            <div class="dropdown">
                                <button type="button" class="btn btn-light btn-sm dropdown-toggle" style="margin-right:10px;" data-toggle="dropdown">
                                    Exportar dados
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#"><i class="fas fa-file-excel text-success" ></i> Excel</a>
                                    <a class="dropdown-item" target='_blank' href="modelPDF2.php"><i class="fas fa-file-pdf text-danger"></i> PDF</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-table" style="overflow-x:auto;">       

                            <?php
                                $resultado = mysqli_query($conectar, "SELECT * FROM producao WHERE aceite = 'S' ORDER BY id DESC");
                                $linhas = mysqli_num_rows($resultado);
                            ?>   
                            
                            <div class="table-responsive">
                    
                            <table id="example" class="table table-hover" >
                                <thead class="bg-light">
                                    <tr>
                                        <th >Lote</th>
                                        <th >Fruta</th>
                                        <th >Peso</th>
                                        <th >Qtd Polpas</th>
                                        <th >Emb.</th>
                                        <th >Detalhe</th>
                                        
                                    </tr>
                                </thead>
                                <tbody style="height: 100%;">
                                    <?php
                                        while($linhas = mysqli_fetch_array($resultado)){ 
                                            
                                                echo "<tr>";
                                                echo "<td align=right>".$linhas['lotefabricacao']."</td>";
                                                echo "<td>".$linhas['fruta']."</td>";                                            
                                                echo "<td align=right>".number_format($linhas['polpa'])." Kg</td>";
                                                echo "<td align=right>".$linhas['qtdpolpa']."</td>"; 
                                                echo "<td align=center>".$linhas['embalagem']."</td>";
                                                echo "<td align=center><a class='btnVer' href='#' id=".$linhas['id']."><img src='imagens/detalhe.png'></a></td>";
                                                echo "</tr>";                                           
                                            
                                        }
                                    ?>  
                                </tbody>
                            </table>
                        </div>

                        </div> <!-- card-table fim -->                        
                    </div> <!-- col fim -->     

                </div> <!-- row fim -->

                <div class="row mt-5">

                    <!-- INICIO GRAFICO -->

                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  mt-3">
                        <div id="top_x_div"> </div>
                     </div>

                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12  mt-3">
                        <div id="donutchart"></div>
                    </div>
                            
                        
                   
                </div> <!-- row fim -->
            </div> <!-- Fim Main -->           
            
        </div> <!-- Fim Wrapper -->

        
    </body>

    <!-- <script>
        function exportPDF() {
          alert("PDF....")

        }

        function exportEXCEL() {
          alert("Excel....")
        }
    </script> -->

    <script>

        function myFunction() {
            
            var peso = document.getElementById("peso").value
            var verde = document.getElementById("pesoverde").value
            var fdesp = peso - verde
            document.getElementById("pesodesp").value = parseFloat(fdesp).toFixed(2)		
        }

    // VER DADOS

    $(document).ready(function() {
               
        $('.btnVer').on('click', function(){
            var user_id = $(this).attr('id')
            var dados = {id: user_id}
            var dat = new Date();
            var dia  = dat.getDate();
            if (dia< 10) {
                dia  = "0" + dia;
            }

            var mes  = dat.getMonth() + 1;
            if (mes < 10) {
                mes  = "0" + mes;
            }                
                  
            var ano  = dat.getFullYear();
            dataFormatada = dia + "/" + mes + "/" + ano;

            $.ajax({
                url:"select_dados.php",
                method: "POST",
                data: {id: user_id},
                dataType: "json",
                success: function(data){     
                    
                    dat = new Date(data.dataproducao)
					dataFormatada = dat.toLocaleDateString('pt-BR', {
						timeZone: 'UTC'
					})


                    document.getElementById("lotefabricacao").innerText = data.lotefabricacao
                    document.getElementById("data").innerText = dataFormatada
                    document.getElementById("loteentrada").innerText = data.loteentrada
                    document.getElementById("fruta").innerText = data.fruta
                    document.getElementById("pesofruta").innerText = data.pesofruta
                    document.getElementById("pesopolpa").innerText = data.polpa
                    document.getElementById("qtdpolpa").innerText = data.qtdpolpa
                    document.getElementById("rendimento").innerText = data.rendimento
                    document.getElementById("embalagem").innerText = data.embalagem
                    // $('#loteentrada').val(data.lotefabricacao)
                    // $('#fruta').val(data.fruta)
                    // $('#pesofruta').val(data.pesofruta)
                    // $('#pesopolpa').val(data.polpa)
                    // $('#qtdpolpa').val(data.qtdpolpa)
                    // $('#embalagem').val(data.embalagem)

                    $('#myModal').modal('show')
                }
            })                            
        })
    })

    

    function calcRend(){
        var valor = document.getElementById("peso").value*document.getElementById("efic").value/100
        document.getElementById("peso2").value = valor        
    }

    function verPeso(){
        var pesoBase = document.getElementById("pesoBase").value
        var peso = document.getElementById("peso").value
        if(pesoBase < peso){
            //alert("ATEN????O: Valor maior que estoque!\nPeso maximo permitido: "+pesoBase+" Kg")
            //bootbox.alert("ATEN????O: Peso maximo permitido: "+pesoBase+" Kg");
            bootbox.alert({
                size: "small",
                title: "ATEN????O:",
                message: "Peso maximo permitido: "+pesoBase+" Kg",
                callback: function(){ /* your callback code */ }
            })
            $('#peso').val(pesoBase)
        }
    }

    // function producao(){
    //     location.href = "https://vallepolpas.adm.br/valleProducao.php";
    // }

    $(document).ready(function() {

$("#iniciaprod").click(function() {

    var loteentrada = document.getElementById("lote").value
    var lotefabrica = loteentrada.substring(loteentrada.length - 3)
    var data        = document.getElementById("dataliberacao").value
    var fruta       = document.getElementById("fruta").value
    var peso        = document.getElementById("peso").value
    var horaini     = document.getElementById("inicio").value
    var prevpolpa   = document.getElementById("prevpolpa").value
    var previsto = "0"    

    var usu = "<?php echo $usuario; ?>";

    $.ajax({
        url: "valleRegProducao.php",
        type: "post",
        //data:$("#insert").serialize(),
        data: 'loteentrada=' + loteentrada +
            '&lotefabrica=' + lotefabrica +
            '&data=' + data +
            '&fruta=' + fruta +
            '&peso=' + peso +
            '&horaini=' + horaini +
            '&prevpolpa=' + prevpolpa +
            '&previsto=' + previsto,

        success: function(d) {

            location.href = "https://vallepolpas.adm.br/valleProducao.php";
            //$("#ped").html(d);
            //alert(d);
        }
    });
});

//

});

    // // VER DADOS
    //  $(document).ready(function() {

    //        $('.btnver').on('click', function(){
                              
    //            document.getElementById('peso2').value=''
              
    //           $('#myModal').modal('show')

    //             $tr = $(this).closest('tr')

    //             var data = $tr.children("td").map(function(){
    //                 return $(this).text()
    //             }).get()

    //             console.log(data)

    //             //$('#data').val(data[0])
    //             $('#lote').val(data[0])
    //             $('#fruta').val(data[1])
    //             //$('#variedade').val(data[5])
    //             $('#peso').val(data[2])

                
    //     //      var user_id = $(this).attr("id")
    //     //      var dados = {id:user_id}
    //     //      $.post('buscaDados.php', dados, function(retorna){
    //     //          alert(retorna)
    //     //      })
             
             
    //       })
    //  })

    $(document).ready(function() {
        $('.itens li:has(ul)').click(function(e) {
            //e.preventDefault();

            if($(this).hasClass('ativado')){
                $(this).removeClass('ativado')
                $(this).children('ul').slideUp();
                $(this).find('.right').toggleClass('fas fa-plus fas fa-minus');
                //var url = location.pathname;
                var href = document.getElementById('link').href;
                location.href = href;
                
                
            } else {
                $('.itens li ul').slideUp();
                $('.itens li').removeClass('ativado');
                $(this).addClass('ativado');
                $(this).children('ul').slideDown();
                $(this).find('.right').toggleClass('fas fa-minus fas fa-plus');
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



<script type="text/javascript">

      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Fruta', 'Peso Kg'],
          ["Goiaba", <?php echo $pesopolpa_goiaba; ?>, ],
          ["Manga", <?php echo $pesopolpa_manga; ?>],
          ["Acerola", <?php echo $pesopolpa_acerola; ?>],
          ["Caju", <?php echo $pesopolpa_caju; ?>],
          ["Maracuj??", <?php echo $pesopolpa_maracuja ; ?>]

            
        ]);

        var options = {
          title: 'Polpas em Estoque: <?php echo number_format($peso_total2); ?> Kg',
          is3D: false,
          pieHole: 0.3,
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Estoque de Frutas (Kg)', 'Peso em Kg'],
          ["Goiaba", <?php echo $peso_goiaba; ?>, ],
          ["Manga", <?php echo $peso_manga; ?>],
          ["Acerola", <?php echo $peso_acerola; ?>],
          ["Caju", <?php echo $peso_caju; ?>],
          ["Maracuj??", <?php echo $peso_maracuja ; ?>]
        ]);

        var options = {
          title: 'Chess opening moves',
          
          legend: { position: 'none' },
          
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: ''} // Top x-axis.
            }
          },
          bar: { groupWidth: "80%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>

    <!-- The core Firebase JS SDK is always required and must be listed first -->
  <script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
      https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.2.5/firebase-database.js"></script>

  
  <script>
    // Your web app's Firebase configuration
    var firebaseConfig = {
        apiKey: "AIzaSyAg_t_9QW2yY7gUs1ws9XjSDSf44hzLQ_U",
        authDomain: "espfirebase-9d774.firebaseapp.com",
        databaseURL: "https://espfirebase-9d774-default-rtdb.firebaseio.com",
        projectId: "espfirebase-9d774",
        storageBucket: "espfirebase-9d774.appspot.com",
        messagingSenderId: "1020022239815",
        appId: "1:1020022239815:web:09021de95a1e58e4a8f762"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig)
    

    var rootRef = firebase.database().ref().child('Sensores/')

   
    rootRef.on('value', function(snapshot){ 

        // Temperatura 1
        $('#ds1').val(snapshot.child('sensor1').val())
        var disp1  = document.getElementById('ds1').value  
        document.getElementById("temper1").innerHTML = parseFloat(disp1).toFixed(2)          
        
        // Temperatura 2
        $('#ds2').val(snapshot.child('sensor2').val())
        var disp2  = document.getElementById('ds2').value  
        document.getElementById("temper2").innerHTML = parseFloat(disp2).toFixed(2)     

         // Temperatura 3
         $('#ds3').val(snapshot.child('sensor3').val())
        var disp3  = document.getElementById('ds3').value  
        document.getElementById("temper3").innerHTML = parseFloat(disp3).toFixed(2) 
        
       
                  
    })   

  </script>
    
</html>