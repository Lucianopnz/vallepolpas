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
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Valle Polpas</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
	<link rel="stylesheet" href="css/valleStilo.css">
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

	
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


	<!-- <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
	<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

	<!-- Moment.js: -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	
	<!-- Brazilian locale file for moment.js-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/pt-br.js"></script>
	
	<!-- Ultimate date sorting plug-in-->
	<script src="https://cdn.datatables.net/plug-ins/1.10.21/sorting/datetime-moment.js"></script>
	

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
						<li><a href="valleCadfrutas.php"><i class="fas fa-apple-alt"></i> Fruta</a></li>
					</ul>
				</li>

				<li><a href="#"><i class="fas fa-dolly-flatbed fa-2x"></i><span> Insumos</span></a></li>
				<li><a href="valleProducao.php"><i class="fas fa-cogs fa-2x"></i><span> Produção </span></a></li>
				<li><a href="valleRelatorios.php"><i class="fas fa-print fa-2x"></i><span> Relatórios</span></a></li>
			</ul>




			<!-- <div class="direito">
                    <h6>Indústria & Comércio</h6>
                </div> -->
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

			<div class="content">


				<button type="button" class="btn btn-primary btninsumos" data-toggle="modal" data-target="#modalInsumos">
                    <i class="fas fa-plus"></i> Insumos
				</button>

				<?php
                    $resultado = mysqli_query($conectar, "SELECT * FROM insumos WHERE producao = 'N' ORDER BY id DESC");
                    $linhas = mysqli_num_rows($resultado);
                ?>

			    <div class="card-deck no-gutters mt-3">

						<?php
                           while($linhas = mysqli_fetch_array($resultado)){ ?>

							<div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
								<div class="card h-100 mb-4">                    
									<div class="card-header">                                
										<h5 class="card-title m-0 p-0 font-weight-bolder text-secondary"><?php echo $linhas['lote'] ?></h5>
									</div>
									<div class="card-body text-left">
										<p class="card-text"><?php echo date('d/m/Y', strtotime($linhas['dataentrada'])) ?></p>
										<!-- <p class="card-text"><?php echo $linhas['fornecedor'] ?></p> -->
										<p class="card-text"><?php echo $linhas['fruta'] ?></p>
										<p class="card-text">Peso Entrada : <?php echo $linhas['pesoliquido'] ?> kg</p>
										<p class="card-text">Peso Descarte: <?php echo $linhas['descarte'] ?> kg</p>
										<p class="card-text">Peso Verde : <?php echo $linhas['pesoverde'] ?> kg</p>
										<p class="card-text">Peso Despolpa: <?php echo $linhas['pesodespolpa'] ?> kg</p>										
									</div>
									<div class="card-footer">

										<button type='button' class='btn btn-danger btn-sm'>Detalhes</button>
										
										<?php

											if($linhas['aceite'] == "S"){ ?>
												<button type='button' class='btn btn-success btn-sm btnAceite' id= <?php echo $linhas['id'] ?>>Aceite <i class='fas fa-check'></i></button>
											<?php } else { ?>
												<button type='button' class='btn btn-secondary btn-sm btnAceite' id=<?php echo $linhas['id'] ?>>Aceite</button>
											<?php } ?>

									</div>
								</div>
							</div>

							<?php
							}
							?>						

				</div>

				<div class="modal fade" id="modalInsumos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Modal title</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<p>Modal body text goes here.</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary">Save changes</button>
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						</div>
						</div>
					</div>
				</div>


				<!-- <div class="row">
					<div class="col-sm-6">
						<div class="card">
						<div class="card-body">
							<h5 class="card-title">Special title treatment</h5>
							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							<a href="#" class="btn btn-primary">Go somewhere</a>
						</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="card">
						<div class="card-body">
							<h5 class="card-title">Special title treatment</h5>
							<p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
							<a href="#" class="btn btn-primary">Go somewhere</a>
						</div>
						</div>
					</div>
				</div> -->
				


				<!-- Modal Frutas -->
				<div class="modal fade" id="modalFrutas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
											<label for="dataentrada">Data Chegada</label>
											<input type="date" class="form-control" id="dataentrada" name="dataentrada" value="<?php echo date('Y-m-d'); ?>"
											 aria-describedby="emailHelp">
										</div>

										<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<label for="brixentrada">Brix Inicial</label>
											<input type="text" class="form-control" id="brixinicial" name="brixinicial">
										</div>

										<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<label for="exampleFormControlSelect1">Tipo</label>
											<select class="form-control" id="select-tipo">
                                            <option>Fruta</option>
                                            <option>Polpa</option> 
                                            </select>
										</div>

									</div>

									<div class="row">

										<!-- LISTAGEM DE FORNECEDORES CADASTRADAS -->

										<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<label for="exampleFormControlSelect1">Fornecedor</label>

											<select class="form-control" id="select-fornecedor">

                                                <?php $resultado = mysqli_query($conectar, "SELECT * FROM fornecedor ORDER BY fornecedor ASC");
                                                while($row1 = mysqli_fetch_array($resultado)):; ?>
                                                    <option value="<?php echo $row1['fornecedor']; ?>"><?php echo $row1["fornecedor"]; ?></option>
                                                <?php endwhile; ?>  
												
											</select>                                          
										</div>

										


									</div>

									<div class="row">

										<!-- LISTAGEM DE FRUTAS CADASTRADAS -->

										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label for="exampleFormControlSelect1">Fruta</label>
											<select class="form-control" id="select-fruta">

                                                <?php $resultado = mysqli_query($conectar, "SELECT * FROM frutas ORDER BY fruta ASC");
                                                while($row1 = mysqli_fetch_array($resultado)):; ?>
                                                    <option value="<?php echo $row1['rendimento']; ?>"><?php echo $row1["fruta"]; ?></option>
                                                <?php endwhile; ?>                                  
                                            
                                            </select>
										</div>

										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label for="exampleInputPassword1">Variedade</label>
											<input type="text" class="form-control" id="variedade" style="text-transform: uppercase;">
										</div>

										

									</div>

									<div class="row">
										
										<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<label for="peso">Peso Liquido (Kg)</label>
											<input type="number" class="form-control" id="peso">
										</div>

										<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
											<label for="caixas">Qtd Cx (Unid)</label>
											<input type="number" class="form-control" id="caixas">
										</div>

										<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
											<label for="pesodesc">Descarte (Kg)</label>
											<input type="number" class="form-control" id="pesodesc" >
										</div>

										<!-- <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
											<label for="porcdesc">% Descarte</label>
											<input type="number" class="form-control" id="porcdesc" disabled>
										</div> -->

										<input type="hidden" id="porcdesc">

										<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
											<label for="pesoverde">Verde (Kg)</label>
											<input type="number" class="form-control" id="pesoverde" onchange="myFunction(this.value)" >
										</div>

										<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<label for="pesodespolpa">Peso Despolpa (Kg)</label>
											<input type="number" class="form-control" id="pesodespolpa">
										</div>

									</div>

									<div class="row">
										
										
										<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<label for="observacao">Observação</label>
											<input type="text" class="form-control" id="observacao">
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
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="button" id="salvar" class="btn btn-primary">Salvar</button>
							</div>
						</div>
						</form>
					</div>
					<!-- modal-body fim -->
				</div>
				<!-- modal-content fim -->


				<!-- Modal Polpa -->
				<div class="modal fade" id="modalPolpas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
											<label for="dataentrada">Data Chegada</label>
											<input type="date" class="form-control" id="dataentrada" name="dataentrada" value="<?php echo date('Y-m-d'); ?>"
											 aria-describedby="emailHelp">
										</div>

										<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<label for="brixentrada">Brix Inicial</label>
											<input type="text" class="form-control" id="brixinicial" name="brixinicial">
										</div>

										<div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<label for="exampleFormControlSelect1">Tipo</label>
											<select class="form-control" id="select-tipo">
                                            <option>Fruta</option>
                                            <option>Polpa</option> 
                                            </select>
										</div>

									</div>

									<div class="row">

										<!-- LISTAGEM DE FORNECEDORES CADASTRADAS -->

										<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<label for="exampleFormControlSelect1">Fornecedor</label>

											<select class="form-control" id="select-fornecedor">

                                                <?php $resultado = mysqli_query($conectar, "SELECT * FROM fornecedor ORDER BY fornecedor ASC");
                                                while($row1 = mysqli_fetch_array($resultado)):; ?>
                                                    <option value="<?php echo $row1['fornecedor']; ?>"><?php echo $row1["fornecedor"]; ?></option>
                                                <?php endwhile; ?>  
												
											</select>                                          
										</div>

										


									</div>

									<div class="row">

										<!-- LISTAGEM DE FRUTAS CADASTRADAS -->

										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label for="exampleFormControlSelect1">Fruta</label>
											<select class="form-control" id="select-fruta">

                                                <?php $resultado = mysqli_query($conectar, "SELECT * FROM frutas ORDER BY fruta ASC");
                                                while($row1 = mysqli_fetch_array($resultado)):; ?>
                                                    <option value="<?php echo $row1['rendimento']; ?>"><?php echo $row1["fruta"]; ?></option>
                                                <?php endwhile; ?>                                  
                                            
                                            </select>
										</div>

										<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<label for="exampleInputPassword1">Variedade</label>
											<input type="text" class="form-control" id="variedade" style="text-transform: uppercase;">
										</div>

										

									</div>

									<div class="row">
										
										<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<label for="peso">Peso Liquido (Kg)</label>
											<input type="number" class="form-control" id="peso">
										</div>

										<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
											<label for="caixas">Qtd Cx (Unid)</label>
											<input type="number" class="form-control" id="caixas">
										</div>

										<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
											<label for="pesodesc">Descarte (Kg)</label>
											<input type="number" class="form-control" id="pesodesc" >
										</div>

										<!-- <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
											<label for="porcdesc">% Descarte</label>
											<input type="number" class="form-control" id="porcdesc" disabled>
										</div> -->

										<input type="hidden" id="porcdesc">

										<div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
											<label for="pesoverde">Verde (Kg)</label>
											<input type="number" class="form-control" id="pesoverde" onchange="myFunction(this.value)" >
										</div>

										<div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
											<label for="pesodespolpa">Peso Despolpa (Kg)</label>
											<input type="number" class="form-control" id="pesodespolpa">
										</div>

									</div>

									<div class="row">
										
										
										<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<label for="observacao">Observação</label>
											<input type="text" class="form-control" id="observacao">
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
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
								<button type="button" id="salvar" class="btn btn-primary">Salvar</button>
							</div>
						</div>
						</form>
					</div>
				</div> <!-- fim modal polpa --> 

				

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
													<input type="number" class="form-control" id="efic" name="efic" onblur="calcRend(this.value)">
												</div>
												<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
													<label for="peso2">Peso Polpa</label>
													<input type="number" class="form-control" id="peso2" name="peso2">
												</div>
												<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
													<label for="brix">Brix</label>
													<input type="text" class="form-control" id="brix" name="brix">
												</div>
												<div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
													<label for="ph">pH</label>
													<input type="text" class="form-control" id="ph" name="ph" >
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
									</div>
									<!-- Modal body FIM -->

									<!-- Modal footer -->
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
										<button type="button" class="btn btn-success" id="confirmar" data-dismiss="modal">Confirmar</button>
									</div>

								</div>
								<!-- Modal-content fim -->
							</div>
							<!-- Modal-dialog fim -->
						</div> <!-- Modal fade fim -->

					</tbody>
				</table>

			</div>

	</div>


	</div>

	<script>
		function myFunction(val) {
		var peso = document.getElementById("peso").value
		var desc = document.getElementById("pesodesc").value
		var pesoverde = document.getElementById("pesoverde").value
		var porc = (desc*100)/peso
		document.getElementById("porcdesc").value = parseFloat(porc).toFixed(2)		
		document.getElementById("pesodespolpa").value = parseFloat(peso - desc - pesoverde).toFixed(2)	
	}

	function calcRend(){
		var peso = document.getElementById("pesoIni").innerHTML
		var rend = document.getElementById("efic").value
		var pesopolpa = (peso*rend)/100
		document.getElementById("peso2").value = parseFloat(pesopolpa).toFixed(2)	
	}

	</script>


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

		moment.locale('pt-br');
		$.fn.dataTable.moment( 'L', 'pt-br' );

		$('#example').dataTable({

			"searching": true,
			paging: false,
			scrollY: "325px",
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
					$('#pesoIni').html(data.pesodespolpa)

					$('#efic').val(data.rendimento)
					$('#peso2').val(data.pesopolpa)
					$('#myModal').modal('show')
				}
			})

		})

	})

	// // BTN INSUMOS 

	// $(document).ready(function() {

	// 	$('.btninsumos').on('click', function() {
			
			
	// 	})

	// })
</script>

<script>
	$(document).ready(function() {

		$("#salvar").click(function() {

			var id = "<?php echo $novo_id; ?>"
			var fornecedor = document.getElementById("select-fornecedor").options[document.getElementById(
				"select-fornecedor").selectedIndex].text
			var tipo = document.getElementById("select-tipo").options[document.getElementById("select-tipo").selectedIndex].text
			var fruta = document.getElementById("select-fruta").options[document.getElementById("select-fruta").selectedIndex]
				.text
			var dataentrada = document.getElementById("dataentrada").value
			var variedade = (document.getElementById("variedade").value).toUpperCase()
			var pesoliquido = document.getElementById("peso").value
			var caixas = document.getElementById("caixas").value
			var descarte = document.getElementById("pesodesc").value
			var pesoverde = document.getElementById("pesoverde").value
			var pesodespolpa = document.getElementById("pesodespolpa").value
			var observacao = document.getElementById("obs").value
			var rendimento = $("#select-fruta :checked").val()
			var pesopolpa = pesodespolpa * rendimento / 100

			var usu = "<?php echo $usuario; ?>";

			$.ajax({
				url: "valleCadInsumos.php",
				type: "post",
				//data:$("#insert").serialize(),
				data: 'dataentrada=' + dataentrada +
					'&fornecedor=' + fornecedor +
					'&tipo=' + tipo +
					'&fruta=' + fruta +
					'&variedade=' + variedade +
					'&peso=' + pesoliquido +
					'&descarte=' + descarte +
					'&pesoverde=' + pesoverde +
					'&caixas=' + caixas +
					'&pesodespolpa=' + pesodespolpa +
					'&observacao=' + observacao +
					'&rendimento=' + rendimento +
					'&pesopolpa=' + pesopolpa +
					'&id=' + id,

				success: function(d) {

					location.href = "https://vallepolpas.adm.br/valleInsumos.php";
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