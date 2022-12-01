<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");



$resultado = mysqli_query($conectar, "SELECT * FROM producao ORDER BY id DESC");
$linhas = mysqli_num_rows($resultado);

require('fpdf/fpdf.php');

// TOTAL ESTOQUE
$sql = "SELECT SUM(polpa) AS peso_total2 FROM producao";
$result  = mysqli_query($conectar,$sql);
$row = mysqli_fetch_assoc($result);
$peso_total2 = $row['peso_total2'];

class PDF extends FPDF
{
  
	/* Cabeçalho */
	function Header()
	{
        
    // Logo
    $this->Image('imagens/Logo.png',10,6,30);
    // Arial bold 13
    $this->SetFont('Times','B',15);
    // Move to the right
    $this->Cell(80);
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
    
    $this->Cell(0,8,"RELATÓRIO DE PRODUÇÃO DE POLPAS",0,0,'L');   
    $this->Cell(0,5,"Armazenamento: Camara 03",0,1,'R'); 
    $this->Cell(0,8,"Relatorio geral de produção",0,0,'L');      
    $this->Cell(0,5,"Tipo: Congelamento",0,1,'R');
    $this->Ln(3);
  }
  
  /* Rodapé */
  function Footer()
  {
    $data = $currentDate = date("d/m/Y");
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
$pdf->Cell(15,8,'Lote',1,0,'L',1);
$pdf->Cell(25,8,'Fabricacao',1,0,'L',1);
$pdf->Cell(40,8,'Fruta',1,0,'L',1);
$pdf->Cell(20,8,'Fruta (kg)',1,0,'L',1);
$pdf->Cell(20,8,'Polpa (kg)',1,0,'L',1);
$pdf->Cell(20,8,'Rend.',1,0,'L',1);
$pdf->Cell(25,8,'Polpa (Qtd)',1,0,'L',1);
$pdf->Cell(25,8,'Embalagem',1,1,'L',1);
$pdf->Ln(4);
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224,235,255);
$fill = false;
while($linhas = mysqli_fetch_array($resultado)){

  $pdf->Cell(15 ,8,$linhas['lotefabricacao'],1,0,'C',$fill);  
  $pdf->Cell(25 ,8,date('d/m/Y', strtotime($linhas['dataproducao'])),1,0,'C',$fill);
  $pdf->Cell(40 ,8,$linhas['fruta'],1,0,'L',$fill);
  $pdf->Cell(20 ,8,number_format($linhas['pesofruta'])." kg",1,0,'R',$fill);
  $pdf->Cell(20 ,8,number_format($linhas['polpa'])." kg",1,0,'R',$fill);
  $pdf->Cell(20 ,8,$linhas['rendimento']." %",1,0,'R',$fill); 
  $pdf->Cell(25 ,8,$linhas['qtdpolpa']." Un",1,0,'R',$fill);  
  $pdf->Cell(25 ,8,$linhas['embalagem'],1,1,'R',$fill);
  $fill = !$fill;
};

	

// $pdf->Cell(118 ,6,'',0,0);
 $pdf->Ln(5);
 $pdf->SetFont('Times','B',15);
 $pdf->Cell(0 ,10,'Resumo do Estoque',0,1, 'R');
 $pdf->SetFont('Times','',12);
 $pdf->Cell(130 ,6,'',0,0, 'L');
 $pdf->Cell(30 ,6,'Peso total de polpas: ',0,0, 'L');
 $pdf->Cell(0 ,6,number_format($peso_total2).' kg',0,1,'R');
 

$pdf->SetFont('Times','',12);
$pdf->Output('Vallepolpas_estoque.pdf', 'I');

?>