<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");

$fornecedor     = $_POST["sel-fornecedor"];
$datainicio     = $_POST["datainicio"];
$datafinal      = $_POST["datafinal"]; 
$check1         = $_POST["radioBox1"]; 
$check2         = $_POST["radioBox2"];



if($check1 == "todos" || $check2 == "todos"){
    $resultado = mysqli_query($conectar, "SELECT * FROM insumos");
    $linhas = mysqli_num_rows($resultado);
} elseif($check1 == "todos" || $check2 == "periodo") {                      
    $resultado = mysqli_query($conectar, "SELECT * FROM insumos WHERE date(dataentrada) between date('$datainicio') and date('$datafinal') ");
    $linhas = mysqli_num_rows($resultado); //SELECT * FROM insumos WHERE date(dataentrada) between date('2022/09/01') and date('2022/09/30')
} elseif($check1 == "forn" || $check2 == "todos"){
    $resultado = mysqli_query($conectar, "SELECT * FROM insumos WHERE fornecedor = '$fornecedor'");
    $linhas = mysqli_num_rows($resultado);
} else{
    $resultado = mysqli_query($conectar, "SELECT * FROM insumos WHERE fornecedor = '$fornecedor' || date(dataentrada) between date('$datainicio') || date('$datafinal')");
    $linhas = mysqli_num_rows($resultado);
}






require('fpdf/fpdf.php');

// TOTAL INSUMOS
$sql = "SELECT SUM(pesodespolpa) AS peso_total FROM insumos WHERE producao = 'N'";
$result  = mysqli_query($conectar,$sql);
$row = mysqli_fetch_assoc($result);
$peso_total = $row['peso_total'];

$sql = "SELECT SUM(pesopolpa) AS rend_total FROM insumos WHERE producao = 'N'";
$result  = mysqli_query($conectar,$sql);
$row = mysqli_fetch_assoc($result);
$rend_total = $row['rend_total'];

$sql = "SELECT SUM(caixas) AS totalcx FROM insumos WHERE producao = 'N'";
$result  = mysqli_query($conectar,$sql);
$row = mysqli_fetch_assoc($result);
$totalcx = $row['totalcx'];

// INSUMOS POR FRUTA

  // ACEROLA
  $sql = "SELECT SUM(pesodespolpa) AS totalacerola FROM insumos WHERE producao = 'N' AND fruta = 'ACEROLA'";
  $result  = mysqli_query($conectar,$sql);
  $row = mysqli_fetch_assoc($result);
  $peso_acerola = $row['totalacerola'];

  $sql = "SELECT SUM(pesopolpa) AS totalacerola FROM insumos WHERE producao = 'N' AND fruta = 'ACEROLA'";
  $result  = mysqli_query($conectar,$sql);
  $row = mysqli_fetch_assoc($result);
  $pesopolpa_acerola = $row['totalacerola'];


  // CAJU

  $sql = "SELECT SUM(pesodespolpa) AS totalcaju FROM insumos WHERE  producao = 'N' AND fruta = 'CAJU'";
  $result  = mysqli_query($conectar,$sql);
  $row = mysqli_fetch_assoc($result);
  $peso_caju = $row['totalcaju'];

  $sql = "SELECT SUM(pesopolpa) AS totalcaju FROM insumos WHERE producao = 'N' AND fruta = 'CAJU'";
  $result  = mysqli_query($conectar,$sql);
  $row = mysqli_fetch_assoc($result);
  $pesopolpa_caju = $row['totalcaju'];

  // GOIABA

  $sql = "SELECT SUM(pesodespolpa) AS totalgoiaba FROM insumos WHERE producao = 'N' AND fruta = 'GOIABA'";
  $result  = mysqli_query($conectar,$sql);
  $row = mysqli_fetch_assoc($result);
  $peso_goiaba = $row['totalgoiaba'];  

  $sql = "SELECT SUM(pesopolpa) AS totalgoiaba FROM insumos WHERE producao = 'N' AND fruta = 'GOIABA'";
  $result  = mysqli_query($conectar,$sql);
  $row = mysqli_fetch_assoc($result);
  $pesopolpa_goiaba = $row['totalgoiaba'];

  // MANGA

  $sql = "SELECT SUM(pesodespolpa) AS totalmanga FROM insumos WHERE producao = 'N' AND fruta = 'MANGA'";
  $result  = mysqli_query($conectar,$sql);
  $row = mysqli_fetch_assoc($result);
  $peso_manga = $row['totalmanga'];

  $sql = "SELECT SUM(pesopolpa) AS totalmanga FROM insumos WHERE producao = 'N' AND fruta = 'MANGA'";
  $result  = mysqli_query($conectar,$sql);
  $row = mysqli_fetch_assoc($result);
  $pesopolpa_manga = $row['totalmanga'];

  // MARACUJA

  $sql = "SELECT SUM(ppesodespolpaeso) AS totalmaracuja FROM insumos WHERE producao = 'N' AND fruta = 'MARACUJÁ'";
  $result  = mysqli_query($conectar,$sql);
  $row = mysqli_fetch_assoc($result);
  $peso_maracuja = $row['totalmaracuja'];

  $sql = "SELECT SUM(pesopolpa) AS totalmaracuja FROM insumos WHERE producao = 'N' AND fruta = 'MARACUJÁ'";
  $result  = mysqli_query($conectar,$sql);
  $row = mysqli_fetch_assoc($result);
  $pesopolpa_maracuja = $row['totalmaracuja'];

  $porc_acerola   = ($peso_acerola*100)/$peso_total;
  $porc_caju      = ($peso_caju*100)/$peso_total;
  $porc_goiaba    = ($peso_goiaba*100)/$peso_total;
  $porc_manga     = ($peso_manga*100)/$peso_total;
  $porc_maracuja  = ($peso_maracuja*100)/$peso_total;

class PDF extends FPDF
{
  
	/* Cabeçalho */
	function Header()
	{
        $fornecedor     = $_POST["sel-fornecedor"];
        $datainicio     = $_POST["datainicio"];
        $datafinal      = $_POST["datafinal"]; 

        $check1         = $_POST["radioBox1"]; 
        $check2         = $_POST["radioBox2"];
        
    // Logo
    $this->Image('imagens/Logo.png',10,6,30);
    // Arial bold 13
    $this->SetFont('Times','B',15);
    // Move to the right
    $this->Cell(50,10,"  ".$check1." ".$check2,0,1,'C');
    // Title
    $this->Cell(30,10,'Valle Industria e Comercio de Polpas',0,1,'C');
    // Arial bold 10
    $this->SetFont('Arial','',10);
    // Move to the right
    $this->Cell(80);
    // Sub-Title
    $this->Cell(30,5,'Rua Vasco da Gama, 38 - Petrolina/PE',0,0,'C');
    $this->Ln(3);
    $this->Cell(0,5,"","B",1,'C');

    //nome
    
    $this->Cell(123,8,"Relatório de Recebimento de Insumos",0,0,'L');   
    $this->Cell(20,8,"Periodo de: ",0,0,'L');
    $this->Cell(20,8,date('d/m/Y', strtotime($datainicio)),0,0,'L');
    $this->Cell(8,8,"Até: ",0,0,'L');
    $this->Cell(20,8,date('d/m/Y', strtotime($datafinal)),0,1,'L');
    $this->Cell(28,8,"Fornecedor:",0,0,'L'); 
    $this->Cell(20,8,$fornecedor,0,1,'L'); 
    
    $this->Ln(3);
  }
  
  /* Rodapé */
  function Footer()
  {
    $data = $currentDate = date("j/n/Y");
  // Position at 1.5 cm from bottom
  $this->SetY(-15);
  // Arial italic 8
  $this->SetFont('Arial','I',8);
  // Page number
  $this->Cell(0,10,'........................ Valle Polpas - data: '.$data.' - Pagina '.$this->PageNo().'/{nb}',0,0,'R');

  }
}

/* Instanciation of inherited class */
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//Cabeçalho da Tabela
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Times','',12);
$pdf->Cell(30,8,'Data',1,0,'L',1);
$pdf->Cell(30,8,'Lote #',1,0,'L',1);
$pdf->Cell(30,8,'Tipo',1,0,'L',1);
$pdf->Cell(55,8,'Fruta',1,0,'L',1);
$pdf->Cell(20,8,'Quant.',1,0,'C',1);
$pdf->Cell(25,8,'Peso Liquido',1,1,'L',1);

$pdf->Ln(4);
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224,235,255);
$fill = false;

while($linhas = mysqli_fetch_array($resultado)){

  $pdf->Cell(30 ,8,date('d/m/Y', strtotime($linhas['dataentrada'])),0,0,'C',$fill);
  $pdf->Cell(30 ,8,$linhas['lote'],0,0,'C',$fill);
  $pdf->Cell(30 ,8,$linhas['tipo'],0,0,'L',$fill);
  $pdf->Cell(55 ,8,$linhas['fruta'],0,0,'L',$fill);
  if($linhas['tipo'] == 'Fruta'){
    $pdf->Cell(20 ,8,number_format($linhas['caixas'])." cx",0,0,'R',$fill);
  } else {
    $pdf->Cell(20 ,8,number_format($linhas['caixas'])." tambor",0,0,'R',$fill);
  }
  
  $pdf->Cell(25 ,8,number_format($linhas['pesoliquido'])." kg",0,1,'R',$fill);
  //$pdf->Cell(20 ,8,$linhas['caixas'],1,1,'R',$fill);
  $fill = !$fill;

};

	

// $pdf->Cell(118 ,6,'',0,0);
 $pdf->Ln(5);
 $pdf->SetFont('Times','B',15);
 $pdf->Cell(0 ,10,'Total de Insumos',0,1, 'R');
 $pdf->SetFont('Times','',12);
 $pdf->Cell(130 ,6,'',0,0, 'L');
 $pdf->Cell(30 ,6,'Peso total frutas: ',0,0, 'L');
 $pdf->Cell(0 ,6,number_format($peso_total).' kg',0,1,'R');
 $pdf->Cell(130 ,6,'',0,0, 'L');
 $pdf->Cell(30 ,6,'Total de caixas: ',0,0, 'L');
 $pdf->Cell(0 ,6,number_format($totalcx).' Unid',0,1,'R');
 $pdf->Cell(130 ,6,'',0,0, 'L');
 $pdf->Cell(30 ,6,'Previsao polpa: ',0,0, 'L');
 $pdf->Cell(0 ,6,number_format($rend_total).' kg',0,1,'R');
 $pdf->Ln(5);
 $pdf->Cell(0,5,"","B",1,'C');
 $pdf->SetFont('Times','B',15);
 $pdf->Cell(0 ,10,'Resumo do Estoque:',0,1, 'L');
 $pdf->SetFont('Times','B',12);
 $pdf->Ln(5);

 $pdf->Cell(30 ,6,'Fruta: ',0,0, 'L');
 $pdf->Cell(30 ,6,'Peso: ',0,0, 'R');
 $pdf->Cell(30 ,6,'% Total: ',0,0, 'R');
 $pdf->Cell(30 ,6,'Prev. Polpa: ',0,1, 'R'); 
 $pdf->SetFont('Times','',12);
 $pdf->Ln(5);

 $pdf->Cell(30 ,6,'Acerola: ',0,0, 'L');
 $pdf->Cell(30 ,6,number_format($peso_acerola).' kg',0,0, 'R');
 $pdf->Cell(30 ,6,number_format($porc_acerola).' %',0,0, 'R');
 $pdf->Cell(30 ,6,number_format($pesopolpa_acerola).' kg',0,1, 'R');
 

 $pdf->Cell(30 ,6,'Caju: ',0,0, 'L');
 $pdf->Cell(30 ,6,number_format($peso_caju).' kg',0,0, 'R');
 $pdf->Cell(30 ,6,number_format($porc_caju).' %',0,0, 'R');
 $pdf->Cell(30 ,6,number_format($pesopolpa_caju).' kg',0,1, 'R');
 

 $pdf->Cell(30 ,6,'Goiaba: ',0,0, 'L');
 $pdf->Cell(30 ,6,number_format($peso_goiaba).' kg',0,0, 'R');
 $pdf->Cell(30 ,6,number_format($porc_goiaba).' %',0,0, 'R');
 $pdf->Cell(30 ,6,number_format($pesopolpa_goiaba).' kg',0,1, 'R');
 

 $pdf->Cell(30 ,6,'Manga: ',0,0, 'L');
 $pdf->Cell(30 ,6,number_format($peso_manga).' kg',0,0, 'R');
 $pdf->Cell(30 ,6,number_format($porc_manga).' %',0,0, 'R');
 $pdf->Cell(30 ,6,number_format($pesopolpa_manga).' kg',0,1, 'R');
 

 $pdf->Cell(30 ,6,'Maracuja: ',0,0, 'L');
 $pdf->Cell(30 ,6,number_format($peso_maracuja).' kg',0,0, 'R');
 $pdf->Cell(30 ,6,number_format($porc_maracuja).' %',0,0, 'R');
 $pdf->Cell(30 ,6,number_format($pesopolpa_maracuja).' kg',0,1, 'R');
 

 $pdf->Ln(5);
 $pdf->Cell(0,5,"","B",1,'C');

$pdf->SetFont('Times','',12);
$pdf->Output('Vallepolpas_insumos.pdf', 'I');

?>