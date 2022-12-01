<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");



$resultado = mysqli_query($conectar, "SELECT * FROM tblPolpas ORDER BY id ASC");
$linhas = mysqli_num_rows($resultado);

require('fpdf/fpdf.php');

// TOTAL ESTOQUE
$sql = "SELECT SUM(quantidade) AS peso_total2 FROM tblPolpas";
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
    
    $this->Cell(0,8,"RELATÓRIO DE ESTOQUE DE POLPAS",0,0,'L');   
    $this->Cell(0,5,"Armazenamento: Camara 03",0,1,'R'); 
    $this->Cell(0,8,"Relatorio geral de estoque",0,0,'L');      
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
$pdf->Cell(15,8,'Codigo',1,0,'L',1);
$pdf->Cell(70,8,'Polpa',1,0,'L',1);
$pdf->Cell(35,8,'Peso (kg)',1,0,'C',1);
$pdf->Cell(25,8,'Embalagem',1,0,'L',1);
$pdf->Cell(45,8,'Observação',1,1,'L',1);
$pdf->Ln(4);
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224,235,255);
$fill = false;
while($linhas = mysqli_fetch_array($resultado)){

  $pdf->Cell(15 ,8,$linhas['codigo'],1,0,'C',$fill);  
  $pdf->Cell(70 ,8,$linhas['polpa'],1,0,'L',$fill);
  $pdf->Cell(35 ,8,number_format($linhas['quantidade'])." kg",1,0,'R',$fill);
  $pdf->Cell(25 ,8,$linhas['unidade'],1,0,'R',$fill);
  $pdf->Cell(45 ,8," ",1,1,'R',$fill);
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