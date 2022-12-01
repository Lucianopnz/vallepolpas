<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");

$fruta                = $_POST["fruta"];
$produto              = $_POST["produto"];
$peso                 = $_POST["peso"];
$embalagem            = $_POST["embalagem"];

// $ac100            = $_POST["ac100"];
// $ac1              = $_POST["ac1"];



// if($fruta == "ACEROLA" AND $embalagem == "100 g"){     
//       $query = mysqli_query($conectar, "UPDATE estoque SET acerola_100 = acerola_100 + $peso" );
// } elseif($fruta == "ACEROLA" AND $embalagem == "1 kg"){
//       $query = mysqli_query($conectar, "UPDATE estoque SET acerola_1 = acerola_100 + $peso" );
// } elseif($fruta == "CAJU" AND $embalagem == "100 g"){
//       $query = mysqli_query($conectar, "UPDATE estoque SET caju_100 = caju_100 + $peso" );
// } elseif($fruta == "CAJU" AND $embalagem == "1 kg"){
//       $query = mysqli_query($conectar, "UPDATE estoque SET caju_1 = caju_1 + $peso" );
// } elseif($fruta == "GOIABA" AND $embalagem == "100 g"){
//       $query = mysqli_query($conectar, "UPDATE estoque SET goiaba_100 = goiaba_100 + $peso" );
// } elseif($fruta == "GOIABA" AND $embalagem == "1 kg"){
//       $query = mysqli_query($conectar, "UPDATE estoque SET goiaba_1 = goiaba_1 + $peso" );
// } elseif($fruta == "MANGA" AND $embalagem == "100 g"){
//       $query = mysqli_query($conectar, "UPDATE estoque SET manga_100 = manga_100 + $peso" );
// } elseif($fruta == "MANGA" AND $embalagem == "1 kg"){
//       $query = mysqli_query($conectar, "UPDATE estoque SET manga_1 = manga_1 + $peso" );
// } elseif($fruta == "MARACUJA" AND $embalagem == "100 g"){
//       $query = mysqli_query($conectar, "UPDATE estoque SET maracuja_100 = maracuja_100 + $peso" );
// } elseif($fruta == "MARACUJA" AND $embalagem == "1 kg"){
//       $query = mysqli_query($conectar, "UPDATE estoque SET maracuja_1 = maracuja_1 + $peso" );
// }

$query = mysqli_query($conectar, "UPDATE tblPolpas SET quantidade = quantidade + $peso WHERE polpa = '$produto' AND unidade = '$embalagem'" );


$query = mysqli_query($conectar, "INSERT INTO estoque_polpa (polpa, peso, embalagem) VALUES 
      ('$produto', '$peso', '$embalagem')")
      or die( mysqli_error( $conectar) );


      

      
?>
