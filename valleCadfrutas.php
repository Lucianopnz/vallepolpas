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
	<link rel="stylesheet" href="css/valleStilo.css">
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
		.font-texto {
			font-family: "Times New Roman", Times, serif;
		}

		.span-left {
			color: green;
		}

		.span-right {
			left: 20px;
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
						<li><a href="#"><i class="fas fa-apple-alt"></i> Fruta</a></li>
					</ul>
				</li>

				<li><a href="valleInsumos.php"><i class="fas fa-dolly-flatbed fa-2x"></i><span> Insumos</span></a></li>
				<li><a href="valleProducao.php"><i class="fas fa-cogs fa-2x"></i><span> Produção </span></a></li>
				<li><a href="#"><i class="fas fa-print fa-2x"></i><span> Relatórios</span></a></li>
			</ul>


			<div class="legal">
				<div class="copyright">
					&copy; 2020 - 2021 <a href="#">Valle Polpas</a>.
				</div>
				<div class="version">
					<b>Version: </b> 20.30.06
				</div>
			</div>

		</div> <!-- fim div sidebar -->

		<div class="main">

			<!--<div class="content">-->


				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalFrutas">
                    <i class="fas fa-plus"></i> Frutas
                </button>

				<!-- Modal -->
				<div class="modal fade" id="modalFrutas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
						    <div class="modal-content">
                                <div class="modal-header  bg-info text-light">
                                    <h5 class="modal-title" id="exampleModalLabel">Cadastro de Frutas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

							    <div class="modal-body bg-light">

								    <form action="#" method="post">

                                        <input type="hidden" name="id" value="<?php echo $novo_id; ?>">

                                        <div class="row">
                                                

                                            <div class="form-group col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                                <label for="fruta">Fruta</label>
                                                <input type="text" class="form-control" id="fruta">
                                            </div>

											<div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                <label for="rendimento">Rendimento</label>
                                                <input type="text" class="form-control" id="rendimento">
                                            </div>

											<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                <label for="pesocaixa">Peso Caixa</label>
                                                <input type="text" class="form-control" id="pesocaixa">
                                            </div>

                                        </div> <!-- Fim Row -->                                       
                                                                                
                                        
                                    </form>

							    </div> <!-- Fim Modal Body -->

                                <div class="modal-footer alert-info">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <button type="button" id="salvar" class="btn btn-primary">Salvar</button>
                                </div>

						    </div> <!-- Fim Modal Content -->	
                        </div> 	<!-- Modal-dialog fim -->
			        </div> 	<!-- Modal fade fim --> 

					<?php
                        $resultado = mysqli_query($conectar, "SELECT * FROM frutas ORDER BY id DESC");
                        $linhas = mysqli_num_rows($resultado);
                    ?>

                    <table  id="example" class="table table-striped " style="width:100%">
                        <thead  class="card-header bg-dark text-white">
                            <tr >      
								<th width="50%" >Fruta</th>                           
								<th width="15%" >Rendimento</th>  
								<th width="15%" >Peso Caixa</th> 
								<th width="20%" >Detalhes</th>                     
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($linhas = mysqli_fetch_array($resultado)){
                                    echo "<tr>";                                
                                                                
                                    echo "<td style='padding: 10px;'>".$linhas['fruta']."</td>";                                
                                    echo "<td style='padding: 10px;'>".$linhas['rendimento']." </td>";  
									echo "<td style='padding: 10px;'>".$linhas['pesocaixa']." </td>";  
                                    echo "<td><button type='button' class='btn btn-info btn-sm'><i class='fas fa-user-edit'></i> Editar</button></td>";                                 
                                                                    
                                    echo "</tr>";
                                } ?>

                        </tbody>
                    </table>  
				
			<!--</div>  fim div content -->
		</div> <!-- fim div main -->
	</div> <!-- fim div wrapper -->


</body>
<script>
	/**  */
	$(document).ready(function() {
		$('.itens li:has(ul)').click(function(e) {
			//e.preventDefault();
			if ($(this).hasClass('ativado')) {
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

		$('#example').dataTable({

			"searching": true,
			paging: false,
			scrollY: "360px",
			order: [
				[0, 'DESC']
			],
			"ordering": true,
			scrollCollapse: true,
			info: false,
			language: {
				"sSearch": "Filtrar",
				"zeroRecords": "Registro não encontrado!"
			}
		})
	})

	/** ACEITE DE INSUMOS */
	$(document).ready(function() {

		$('.btnAceite').on('click', function() {
			var user_id = $(this).attr('id')
			var dados = {
				id: user_id
			}

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
				url: "select_dados.php",
				method: "POST",
				data: {
					id: user_id
				},
				dataType: "json",

				success: function(data) {

					dat = new Date(data.dataentrada)
					dataFormatada = dat.toLocaleDateString('pt-BR', {
						timeZone: 'UTC'
					})

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
	$(document).ready(function() {

		$("#salvar").click(function() {

			var fruta = document.getElementById("fruta").value
			var rendimento = document.getElementById("rendimento").value
			var pesocaixa = document.getElementById("pesocaixa").value			

			var usu = "<?php echo $usuario; ?>";

			$.ajax({
				url: "valleRegFrutas.php",
				type: "post",
				//data:$("#insert").serialize(),
				data: 'fruta=' + fruta +
					'&rendimento=' + rendimento +
					'&pesocaixa=' + pesocaixa,

				success: function(d) {

					location.href = "https://vallepolpas.adm.br/valleCadfrutas.php";
					//$("#ped").html(d);
					//alert(d);
				}
			});
		});

		//

	});

	//** CONFIRMA ACEITE */

	$(document).ready(function() {

		$("#confirmar").click(function() {

			var user = document.getElementById("lote")

			var userLote = user.innerHTML
			var ph = document.getElementById("ph").value
			var brix = document.getElementById("brix").value


			$.ajax({
				url: "valleAceite.php",
				type: "post",
				//data:$("#insert").serialize(),
				data: 'lote=' + userLote +
					'&ph=' + ph +
					'&brix=' + brix,

				success: function(d) {

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