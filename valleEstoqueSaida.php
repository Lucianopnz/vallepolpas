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

                <?php
                    $resultado = mysqli_query($conectar, "SELECT * FROM producao WHERE aceite = 'N' ORDER BY id DESC");
                    $linhas = mysqli_num_rows($resultado);
                ?>
                

               <div class="row">

                    <div class="form-group col-3">
                        <label for="data">Data</label>
                        <input type="date" class="form-control" id="data" name="data" value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="form-group col">
                        <label for="exampleFormControlSelect1">Cliente</label>
                        <select class="form-control" id="select-polpa">
                            <?php $resultado = mysqli_query($conectar, "SELECT * FROM tblClientes ORDER BY cliente ASC");
                                while($row1 = mysqli_fetch_array($resultado)):; ?>
                                <option value="<?php echo $row1['cliente']; ?>"><?php echo $row1["cliente"]; ?></option>
                            <?php endwhile; ?>   
                        </select>
            	    </div>

               </div>

               <hr>

               <div class="row">

                    <div class="form-group col-3">
                        <label for="exampleFormControlSelect1">Sabor da Polpa (Fruta)</label>
                        <select class="form-control" id="select-polpa">
                            <?php $resultado = mysqli_query($conectar, "SELECT * FROM frutas ORDER BY fruta ASC");
                                while($row1 = mysqli_fetch_array($resultado)):; ?>
                                <option value="<?php echo $row1['rendimento']; ?>"><?php echo $row1["fruta"]; ?></option>
                            <?php endwhile; ?>   
                        </select>
                    </div>

                    <div class="form-group col-2">
                        <label for="quant">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade">
                    </div>

                    <div class="form-group col-2">
                        <label for="exampleFormControlSelect1">Unidade</label>
                        <select class="form-control" id="select-tipo">
                            <option value="100">100 g</option>
                            <option value="1000">1 kg</option>
                        </select>
                    </div>

                    <div class="form-group col-2">
                        <label for="quant">Peso Total Kg</label>
                        <input type="number" class="form-control" id="peso">
                    </div>

                    <div style="margin-top: 30px;">
                        <button class="btn btn-success" id="insereItem">Confirma</button>
                    </div>

               </div>

               <hr>

               <div id="itens">

               </div>

               <div style="margin-top: 30px;">
                    <button class="btn btn-primary" id="confirmaItem">Finalizar Pedido</button>
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
            $(".btnAceite").click(function() {
                var id = $(this).attr('id')           

                

                $.ajax({
                    url: "valleFimProducao.php",
                    type: "post",
                    //data:$("#insert").serialize(),
                    data: 'id=' + id,

                    success: function(d) {
                        $('#modalConfirma').modal('show')
                        
                                            
                    }
                })
            })
        })

        $(document).ready(function() {
            $("#fechar").click(function() {
                location.href = "https://vallepolpas.adm.br/valleProducao.php"
            })
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


</html>