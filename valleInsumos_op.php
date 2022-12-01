<?php

session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");
//

if(mysqli_connect_errno()){
    echo "falha ao conectar: ". mysqli_connect_error();
    die();

}

// DEFINIR NUMERO DO lote
$sql = "SELECT MAX(id) as id FROM insumos";
$sql = $conectar->query($sql);
$row = $sql->fetch_assoc();;
$novo_id = $row['id'] + 1;

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>   
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <link rel="stylesheet" href="css/vallepolpas.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        
        <!-- <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
        <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        
        <script src="http://cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json"></script>
        <!-- <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script> -->
        <!-- <script src="http://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script> -->
        
        <style>

            .font-texto{
                font-family: "Times New Roman", Times, serif;
            }
            .span-left{
                color: green;                
            }

            .span-right{                
                left: 20px;
            }
        </style>

        
    </head>
    <body>
        <div class="wrapper">
            <!-- <span class="top-left"><img src="imagens/Logo.png" width="160" height="120" alt="User" /></span> -->
            <span class="top-right">
                <span><h4>Registro de Insumos</h4></span>
                <button class="btn btn-secondary btn-sm">Sair</button>
            </span>
            <!-- <div class="top">Top</div> -->
            

            <div class="main">
                
            <div class="content">

                
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus"></i> Novo
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header  bg-secondary text-light">
                                <h5 class="modal-title" id="exampleModalLabel">Registrar novo insumo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body alert-info">
                                
                                <form action="valleCadInsumos.php" method="post">

                                    <input type="hidden" name="id" value="<?php echo $novo_id; ?>">

                                    <div class="row">                        
                                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <label for="dataentrada">Data</label>
                                            <input type="date" class="form-control" id="dataentrada" name="dataentrada" value="<?php echo date('Y-m-d'); ?>" aria-describedby="emailHelp">
                                        </div>

                                        <!-- LISTAGEM DE FORNECEDORES CADASTRADAS -->

                                        <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                            <label for="exampleFormControlSelect1">Fornecedor</label>
                                            <select class="form-control" id="select-fornecedor">
                                            <option>Naldinho</option>
                                            <option>Naldo</option> 
                                            <option>Carlinho</option> 
                                            <option>Anderson</option> 
                                            <option>XYZ polpas</option> 
                                            <option>Timbauba</option> 
                                            </select>
                                        </div>              
                                        
                                    </div>

                                    <div class="row">      
                                        <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                            <label for="exampleFormControlSelect1">Tipo</label>
                                            <select class="form-control" id="select-tipo">
                                            <option>Fruta</option>
                                            <option>Polpa</option> 
                                            </select>
                                        </div>

                                        <!-- LISTAGEM DE FRUTAS CADASTRADAS -->

                                        <div class="form-group col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <label for="exampleFormControlSelect1">Fruta</label>
                                            <select class="form-control" id="select-fruta">

                                                <?php $resultado = mysqli_query($conectar, "SELECT * FROM frutas ORDER BY fruta ASC");
                                                while($row1 = mysqli_fetch_array($resultado)):; ?>
                                                    <option value="<?php echo $row1['rendimento']; ?>"><?php echo $row1["fruta"]; ?></option>
                                                <?php endwhile; ?>                                  
                                            
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <label for="exampleInputPassword1">Variedade</label>
                                            <input type="text" class="form-control" id="variedade" style="text-transform: uppercase;" >
                                        </div> 
                                        
                                    </div>

                                    <div class="row"> 
                                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                            <label for="peso">Peso (kg)</label>
                                            <input type="number" class="form-control" id="peso" >
                                        </div>  
                                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                            <label for="caixas">Caixas</label>
                                            <input type="number" class="form-control" id="caixas" >
                                        </div> 
                                        <div class="form-group col-lg-8 col-md-4 col-sm-6 col-xs-12">
                                            <label for="observacao">Observação</label>
                                            <input type="text" class="form-control" id="observacao" >
                                        </div>
                                        <!--<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                            <label for="exampleInputPassword1">pH</label>
                                            <input type="number" class="form-control" id="ph" >
                                        </div>
                                        <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                            <label for="exampleInputPassword1">Brix</label>
                                            <input type="number" class="form-control" id="brix" >
                                        </div>-->
                                    </div>                       
                                
                                    </div>
                                        <div class="modal-footer alert-info">
                                            <button type="button"  class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="button" id="salvar" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- modal-body fim -->
                </div> <!-- modal-content fim -->

                <?php
                    $resultado = mysqli_query($conectar, "SELECT * FROM insumos ORDER BY id DESC");
                    $linhas = mysqli_num_rows($resultado);
                ?>

                <table  id="example" class="table table-striped " style="width:100%">
                    <thead  class="card-header bg-dark text-white">
                        <tr >                           
                           <th width="11%" >Data</th>
                           <th style='background: #00cc00; color:#000000;' width="7%" >Lote</th>
                           <th width="22%" >Fornecedor</th>
                           <th  style='background: #85adad; color:#000000;' width="22%" >Fruta</th>
                           <!--<th width="14%" >Variedade</th>-->
                           <th width="14%"  align="center" >Qtd. Fruta</th>
                           <!--<th width="4%" >Cx</th>-->
                           <th width="14%"  align="center"  >Prev. Polpa</th>
                           <th width="5%"  ></th>
                           <th width="5%"  ></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           while($linhas = mysqli_fetch_array($resultado)){
                                echo "<tr>";                                
                                echo "<td>".date('d/m/Y', strtotime($linhas['dataentrada']))."</td>";  
                                echo "<td align=center style='background: #33ff33'>".$linhas['lote']."</td>";                              
                                echo "<td style='padding: 10px;'>".$linhas['fornecedor']."</td>";
                                echo "<td style='background: #a3c2c2; padding: 10px;'>".$linhas['fruta']."</td>";
                                //echo "<td>".$linhas['variedade']."</td>";
                                echo "<td align=right style='padding: 3px 40px;'>".$linhas['peso']." Kg</td>"; 
                                //echo "<td>".$linhas['caixas']."</td>";  
                                echo "<td align=right style='padding: 3px 40px;'>".$linhas['pesopolpa']." Kg</td>";                                     
                                echo "<td><button type='button' class='btn btn-danger btn-sm'>Editar</button></td>";
                                if($linhas['aceite'] == "S"){
                                    echo "<td><button type='button' class='btn btn-success btn-sm btnAceite' id=".$linhas['id'].">Aceite <i class='fas fa-check'></i></button></td>";
                                } else {
                                    echo "<td><button type='button' class='btn btn-secondary btn-sm btnAceite' id=".$linhas['id'].">Aceite</button></td>";
                                }
                                
                                
                                echo "</tr>";
                            }
                        ?>

                        <!-- The Modal -->
                        <div class="modal fade" id="myModal">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                        

                                        <!-- Modal body -->
                                        <div class="modal-body" id="info_dados">

                                            <h5 class="font-texto">
                                                <p><span class="span-left">Data.:</span> <span class="span-right" id="datent"></span></p>
                                                <p><span class="span-left">Lote.:</span> <span class="span-right" id="lote"></span></p>
                                                <p><span class="span-left">Fruta:</span> <span class="span-right" id="fruta"></span></p>
                                                <p><span class="span-left">Peso.:</span> <span class="span-right" id="pesoIni"></span> Kg</p>
                                            </h5>
                                            <hr>

                                            <form method="post" id="view-dados">
                                                <input type="hidden" name="id" id="id">
                                                <input type="hidden" name="pesoBase" id="pesoBase">
                                                
                                                
                                                
                                                <h4 style="color: #228C2B;">Previsto</h4>

                                                <div class="row">
                                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label for="efic">Rend. %</label>
                                                        <input type="text" class="form-control" id="efic" name="efic"  onblur="calcRend()">
                                                    </div>
                                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label for="peso2">Peso Polpa</label>
                                                        <input type="text" class="form-control" id="peso2" name="peso2">
                                                    </div>
                                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label for="brix">Brix</label>
                                                        <input type="text" class="form-control" id="brix" name="brix"  onblur="calcRend()">
                                                    </div>
                                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label for="ph">pH</label>
                                                        <input type="text" class="form-control" id="ph" name="ph"  onblur="calcRend()">
                                                    </div>
                                                </div>

                                                <hr>

                                               
                                                <div class="row">
                                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                        <label for="tipoemb">Embalagem</label>
                                                        <select class="form-control" id="tipoemb">
                                                        <option>100 gr</option>
                                                        <option>1 kg</option> 
                                                        </select>
                                                    </div>
                                                    
                                                    
                                                    <div class="form-group col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                        <label for="obs">Observação</label>
                                                        <input type="text" class="form-control" id="obs" name="obs">
                                                    </div>
                                                </div>
                                            </form>
                                        </div> <!-- Modal body FIM -->

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-success" id="confirmar" data-dismiss="modal">Confirmar</button>
                                        </div>

                                        </div> <!-- Modal-content fim -->
                                    </div> <!-- Modal-dialog fim -->
                                </div> <!-- Modal fade fim --> 

                        

                    </tbody>
                </table>              


                    
                </div>
                
                
            </div>

            
            
        </div>

        
    </body>
    <script>

        /**  */
        $(document).ready(function() {
            $('.itens li:has(ul)').click(function(e) {
                e.preventDefault();
                if($(this).hasClass('ativado')){
                    $(this).removeClass('ativado')
                    $(this).children('ul').slideUp();
                    $(this).find('.right').toggleClass('fas fa-plus fas fa-minus');
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
        

        /** TABELA INSUMOS */
        $(document).ready(function() {           
            
            $('#example').dataTable( {
                
                "searching": true,
                paging: false,
                scrollY: "360px",
                order: [[0, 'DESC']],            
                "ordering": true,
                scrollCollapse: true,
                info: false,
                language:{"sSearch": "Filtrar",
                        "zeroRecords": "Registro não encontrado!"}
            })             
        })

        /** ACEITE DE INSUMOS */
        $(document).ready(function() {
        
            $('.btnAceite').on('click', function(){
                var user_id = $(this).attr('id')
                var dados = {id: user_id}
                
                // var dat = new Date();

                //         var dia  = dat.getDate();
                //         if (dia< 10) {
                //             dia  = "0" + dia;
                //         }

                //         var mes  = dat.getMonth() + 1;
                //         if (mes < 10) {
                //             mes  = "0" + mes;
                //         }

                //         var ano  = dat.getFullYear();
                //         dataFormatada = dia + "/" + mes + "/" + ano;

                $.ajax({
                    url:"select_dados.php",
                    method: "POST",
                    data: {id: user_id},
                    dataType: "json",
                    
                    success: function(data){     
                        
                        dat = new Date(data.dataentrada)
                        dataFormatada = dat.toLocaleDateString('pt-BR', {timeZone: 'UTC'})   

                        $('#datent').html(dataFormatada) 
                        $('#lote').html(data.lote)
                        $('#fruta').html(data.fruta)                        
                        $('#pesoIni').html(data.peso)

                        
                        $('#efic').val(data.rendimento)
                        $('#peso2').val(data.pesopolpa)
                        $('#myModal').modal('show')
                    }
                })
                                
            })

        })

    </script>

<script>


$(document).ready(function(){

  $("#salvar").click(function(){

      

    var id = "<?php echo $novo_id; ?>"     
    var fornecedor = document.getElementById("select-fornecedor").options[document.getElementById("select-fornecedor").selectedIndex].text
    var tipo = document.getElementById("select-tipo").options[document.getElementById("select-tipo").selectedIndex].text
    var fruta = document.getElementById("select-fruta").options[document.getElementById("select-fruta").selectedIndex].text
    var dataentrada = document.getElementById("dataentrada").value
    var variedade = (document.getElementById("variedade").value).toUpperCase()
    var peso = document.getElementById("peso").value    
    var caixas = document.getElementById("caixas").value
    var observacao = document.getElementById("obs").value
    var rendimento = $("#select-fruta :checked").val() 
    var pesopolpa = peso*rendimento/100

    // var maturacao = document.getElementById("maturacao").value
    // var ph = document.getElementById("ph").value
    // var brix = document.getElementById("brix").value 

    

    // alert(fornecedor+" "+tipo+" "+fruta+" "+dataentrada+" "+variedade+" "+peso+" "+caixas)

    var usu = "<?php echo $usuario; ?>";

    $.ajax({
      url:"valleCadInsumos.php",
      type:"post",
      //data:$("#insert").serialize(),
      data: 'dataentrada=' + dataentrada +
            '&fornecedor=' + fornecedor +
            '&tipo=' + tipo +
            '&fruta=' + fruta +
            '&variedade=' + variedade +
            '&peso=' + peso +
            '&caixas=' + caixas +
            '&observacao=' + observacao +
            '&rendimento=' + rendimento +
            '&pesopolpa=' + pesopolpa +
            '&id=' + id ,

      success:function(d)
      {

        location.href = "https://vallepolpas.adm.br/valleInsumos.php";
        //$("#ped").html(d);
        //alert(d);
      }
    });
  });

  //

});

//** CONFIRMA ACEITE */

$(document).ready(function(){

$("#confirmar").click(function(){

    var user = document.getElementById("lote")

    var userLote = user.innerHTML
    var ph = document.getElementById("ph").value
    var brix = document.getElementById("brix").value  
  

  $.ajax({
    url:"valleAceite.php",
    type:"post",
    //data:$("#insert").serialize(),
    data: 'lote=' + userLote +
          '&ph=' + ph +
          '&brix=' + brix,

    success:function(d)
    {

      location.href = "https://vallepolpas.adm.br/valleInsumos.php";
      //$("#ped").html(d);
      //alert(d);
    }
  });
});

//

})

</script>


</html>