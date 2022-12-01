<?php
ob_start();
if(($_SESSION['Usuario'] == "") || ($_SESSION['Senha'] == "")){

	$_SESSION['loginErro'] = "Área Restrita para usuários cadastrados, tente novamente.";

	header("Location: index.php");
}
