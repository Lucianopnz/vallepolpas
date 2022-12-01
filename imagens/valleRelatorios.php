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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
	 crossorigin="anonymous"></script>


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
		<span class="top-left"><img src="imagens/Logo.png" width="160" height="120" alt="User" /></span>
		
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
				<li><a href="#"><i class="fas fa-print fa-2x"></i><span> Relatórios</span></a></li>
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

            <span>Relarórios</span>

                <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-panel bg-light">
                                <div class="float-left">
                                    <h6>Ficha Frutas</h6>
                                    <img src="imagens/pdf.png" alt=""> <img src="imagens/xls.png" alt="">                                 
                                    
                                </div>
                                <div class="float-right">
                                <i class="fas fa-apple-alt"></i>
                                </div>
                            </div>
                        </div>   
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-panel bg-light">
                                <div class="float-left">        
                                    <h6>Insumos</h6>        
                                    <img src="imagens/pdf.png" alt=""> <img src="imagens/xls.png" alt="">
                                </div>
                                <div class="float-right">
                                    <i class="fas fa-dolly-flatbed"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="card-panel  bg-light">
                            <div class="float-left">
                                <h6>Estoque</h6>
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
                                    <h6>Gerencial</h6>
                                <h3>
                                    <?php echo number_format($peso_total2); ?> Kg
                                </h3>
                                
                                </div>
                                <div class="float-right">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card-panel bg-light">
                            <div class="float-left">
                                <h6>Fornecedores</h6>
                                <h4><span>xx</span></h4>                                         
                                
                            </div>
                            <div class="float-right">
                                <i class="fas fa-cart-plus"></i>
                            </div>
                        </div>
                    </div>   
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="card-panel bg-light">
                            <div class="float-left">        
                                <h6>Frutas</h6>        
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
                            <h6>Material</h6>
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
                                <h6>Equipamentos</h6>
                            <h3>
                                <?php echo number_format($peso_total2); ?> Kg
                            </h3>
                            
                            </div>
                            <div class="float-right">
                                <i class="fas fa-boxes"></i>
                            </div>
                        </div>
                    </div>
                </div>


				

			</div> <!-- Fim content-->

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