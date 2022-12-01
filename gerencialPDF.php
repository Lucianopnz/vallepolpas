<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");



require('fpdf/fpdf.php');

// TOTAL ESTOQUE
// $sql = "SELECT SUM(polpa) AS peso_total2 FROM producao";
// $result  = mysqli_query($conectar,$sql);
// $row = mysqli_fetch_assoc($result);
// $peso_total2 = $row['peso_total2'];

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
    
    $this->Cell(0,8,"RELATORIO GERENCIAL",0,0,'L');   
    $this->Cell(0,5,"Data: 05/10/2021",0,1,'R'); 
    $this->Cell(0,8,"Demonstrativo Anual",0,0,'L');      
    $this->Cell(0,5,"Hora: 10:55:00",0,1,'R');
    $this->Ln(3);
    $this->Cell(0,8,"INSUMOS (valores em Kg)",0,0,'L');  
    $this->Cell(0,5,"Ano: 2021",0,1,'R');
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
$pdf->Cell(25,8,'Fruta',1,0,'L',1);
$pdf->Cell(12,8,'Jan',1,0,'C',1);
$pdf->Cell(12,8,'Fev',1,0,'C',1);
$pdf->Cell(12,8,'Mar',1,0,'C',1);
$pdf->Cell(12,8,'Abr',1,0,'C',1);
$pdf->Cell(12,8,'Mai',1,0,'C',1);
$pdf->Cell(12,8,'Jun',1,0,'C',1);
$pdf->Cell(12,8,'Jul',1,0,'C',1);
$pdf->Cell(12,8,'Ago',1,0,'C',1);
$pdf->Cell(12,8,'Set',1,0,'C',1);
$pdf->Cell(12,8,'Out',1,0,'C',1);
$pdf->Cell(12,8,'Nov',1,0,'C',1);
$pdf->Cell(12,8,'Dez',1,0,'C',1);
$pdf->Cell(20,8,'Total',1,1,'C',1);
$pdf->Ln(4);
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(224,235,255);
$fill = false;

$resultado = mysqli_query($conectar, "SELECT * FROM resumoinsumos ORDER BY id DESC");
$linhas = mysqli_num_rows($resultado);


while($linhas = mysqli_fetch_array($resultado)){

  $pdf->Cell(25 ,8,$linhas['fruta'],0,0,'L',$fill);    
  $pdf->Cell(12 ,8,$linhas['janeiro'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['fevereiro'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['marco'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['abril'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['maio'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['junho'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['julho'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['agosto'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['setembro'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['outubro'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['novembro'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['dezembro'],0,0,'R',$fill); 
  $pdf->Cell(20 ,8,$linhas['total'],0,1,'R',$fill);
  $fill = !$fill;
};

$pdf->Ln(4);	
$pdf->SetFillColor(232,232,232);
$pdf->Cell(25 ,8,'',0,0,'L',$fill);    
  $pdf->Cell(12 ,8,8000,0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['fevereiro'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['marco'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['abril'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['maio'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['junho'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['julho'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['agosto'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['setembro'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['outubro'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['novembro'],0,0,'R',$fill);
  $pdf->Cell(12 ,8,$linhas['dezembro'],0,0,'R',$fill); 
  $pdf->Cell(20 ,8,$linhas['total'],0,1,'R',$fill);

$pdf->Ln(5);
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,8,"PRODUCAO DE POLPAS (valores em Kg)",0,1,'L');
$pdf->Line(10,125,200,125);
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(224,235,255);
$fill = false;
$pdf->Ln(3);

$resultado = mysqli_query($conectar, "SELECT * FROM resumoproducao ORDER BY id DESC");
$linhas = mysqli_num_rows($resultado);

while($linhas = mysqli_fetch_array($resultado)){

    $pdf->Cell(25 ,8,$linhas['fruta'],0,0,'L',$fill);    
    $pdf->Cell(12 ,8,$linhas['janeiro'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['fevereiro'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['marco'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['abril'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['maio'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['junho'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['julho'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['agosto'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['setembro'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['outubro'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['novembro'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['dezembro'],0,0,'R',$fill); 
    $pdf->Cell(20 ,8,$linhas['total'],0,1,'R',$fill);
    $fill = !$fill;
  };
  
  $pdf->Ln(4);	
  $pdf->SetFillColor(232,232,232);
  $pdf->Cell(25 ,8,'',0,0,'L',$fill);    
    $pdf->Cell(12 ,8,8000,0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['fevereiro'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['marco'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['abril'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['maio'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['junho'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['julho'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['agosto'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['setembro'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['outubro'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['novembro'],0,0,'R',$fill);
    $pdf->Cell(12 ,8,$linhas['dezembro'],0,0,'R',$fill); 
    $pdf->Cell(20 ,8,$linhas['total'],0,1,'R',$fill);

    $pdf->Ln(8);
    /***
  Create the chart
***/

$rowLabels = array( "Caju", "Maracuja", "Acerola", "Manga", "Goiaba" );
$chartWidth = 160;

$chartColours = array(
  array( 255, 100, 100 ),
  array( 100, 255, 100 ),
  array( 100, 100, 255 ),
  array( 255, 255, 100 ),
  array( 255, 100, 255 ),
);

$data = array(
  array( 9940, 10100, 9490, 11730 ),
  array( 19310, 21140, 20560, 22590 ),
  array( 25110, 26260, 25210, 28370 ),
  array( 27650, 24550, 30040, 31980 ),
  array( 22650, 28550, 33040, 38980 ),
);
$chartXPos = 20;
$chartYPos = 250;
$chartWidth = 160;
$chartHeight = 50;
$chartXLabel = "Frutas";
$chartYLabel = "Producao 2021";
$chartYStep = 20000;

// Compute the X scale
$xScale = count($rowLabels) / ( $chartWidth - 40 );

// Compute the Y scale

$maxTotal = 0;

foreach ( $data as $dataRow ) {
  $totalSales = 0;
  foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;
  $maxTotal = ( $totalSales > $maxTotal ) ? $totalSales : $maxTotal;
}

$yScale = $maxTotal / $chartHeight;

// Compute the bar width
$barWidth = ( 1 / $xScale ) / 1.5;

// Add the axes:

$pdf->SetFont( 'Arial', '', 10 );

// X axis
$pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + $chartWidth, $chartYPos );

for ( $i=0; $i < count( $rowLabels ); $i++ ) {
  $pdf->SetXY( $chartXPos + 40 +  $i / $xScale, $chartYPos );
  $pdf->Cell( $barWidth, 10, $rowLabels[$i], 0, 0, 'C' );
}

// Y axis
$pdf->Line( $chartXPos + 30, $chartYPos, $chartXPos + 30, $chartYPos - $chartHeight - 8 );

for ( $i=0; $i <= $maxTotal; $i += $chartYStep ) {
  $pdf->SetXY( $chartXPos + 7, $chartYPos - 5 - $i / $yScale );
  $pdf->Cell( 20, 10, number_format( $i ). ' Kg', 0, 0, 'R' );
  $pdf->Line( $chartXPos + 28, $chartYPos - $i / $yScale, $chartXPos + 30, $chartYPos - $i / $yScale );
}

// Add the axis labels
$pdf->SetFont( 'Arial', 'B', 12 );
$pdf->SetXY( $chartWidth / 2 + 20, $chartYPos + 8 );
$pdf->Cell( 30, 10, $chartXLabel, 0, 0, 'C' );
$pdf->SetXY( $chartXPos + 7, $chartYPos - $chartHeight - 12 );
$pdf->Cell( 100, 10, $chartYLabel, 0, 0, 'R' );

// Create the bars
$xPos = $chartXPos + 40;
$bar = 0;

foreach ( $data as $dataRow ) {

  // Total up the sales figures for this product
  $totalSales = 0;
  foreach ( $dataRow as $dataCell ) $totalSales += $dataCell;

  // Create the bar
  $colourIndex = $bar % count( $chartColours );
  $pdf->SetFillColor( $chartColours[$colourIndex][0], $chartColours[$colourIndex][1], $chartColours[$colourIndex][2] );
  $pdf->Rect( $xPos, $chartYPos - ( $totalSales / $yScale ), $barWidth, $totalSales / $yScale, 'DF' );
  $xPos += ( 1 / $xScale );
  $bar++;
}


 

$pdf->SetFont('Times','',12);
$pdf->Output('Vallepolpas_RelGerencial.pdf', 'I');

?>