<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");

$cliente        = $_POST["sel-cliente"];
$datainicio     = $_POST["datainicio"];
$datafinal      = $_POST["datafinal"]; 

$resultado = mysqli_query($conectar, "SELECT * FROM tblPedidos WHERE cliente = '$cliente' AND date(datapedido) between date('$datainicio') and date('$datafinal') ");
$linhas = mysqli_num_rows($resultado); //tblPedidos

require('fpdf/fpdf.php');

// TOTAL ESTOQUE
$sql = "SELECT SUM(totalpedido) AS total FROM tblPedidos";
$result  = mysqli_query($conectar,$sql);
$row = mysqli_fetch_assoc($result);
$peso_total2 = $row['total'];

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
    
    $this->Cell(0,8,"RELATÓRIO DE PEDIDOS DE POLPAS",0,0,'L');   
    $this->Cell(0,5,"Armazenamento: Camara 03",0,1,'R'); 
    $this->Cell(0,8,"Relatorio geral de pedidos",0,0,'L');      
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
$pdf->Cell(25,8,'Data',1,0,'C',1);
$pdf->Cell(20,8,'Pedido #',1,0,'C',1);
$pdf->Cell(85,8,'Cliente',1,0,'L',1);
$pdf->Cell(30,8,'Total',1,0,'C',1);
$pdf->Cell(30,8,'Tot. Pedido',1,1,'C',1);
$pdf->Ln(4);
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224,235,255);
$fill = false;
$peso = 0;
$total = 0.00;
while($linhas = mysqli_fetch_array($resultado)){

  $pdf->Cell(25 ,8,date('d/m/Y', strtotime($linhas['datapedido'])),1,0,'C',$fill);
  $pdf->Cell(20 ,8,$linhas['pedido'],1,0,'R',$fill);
  $pdf->Cell(85 ,8,$linhas['cliente'],1,0,'L',$fill); 
  $pdf->Cell(30 ,8,number_format($linhas['totalpedido'])." kg",1,0,'R',$fill);  
  $pdf->Cell(30 ,8,'R$ ' . number_format($linhas['vlr_total'], 2, ',', '.'),1,1,'R',$fill);
  $fill = !$fill;
  $peso = $peso + $linhas['totalpedido'];
  $total = $total + $linhas['vlr_total'];
};

	

// $pdf->Cell(118 ,6,'',0,0);
 $pdf->Ln(5);
 $pdf->SetFont('Times','B',15);
 $pdf->Cell(0 ,10,'Resumo de Pedidos',0,1, 'R');
 $pdf->SetFont('Times','',12);
 $pdf->Cell(130 ,6,'',0,0, 'L');
 $pdf->Cell(30 ,6,'Peso total de polpas: ',0,0, 'L');
 $pdf->Cell(0 ,6,number_format($peso).' kg',0,1,'R');
 $pdf->Cell(130 ,6,'',0,0, 'L');
 $pdf->Cell(30 ,6,'Total d Pedido: ',0,0, 'L');
 $pdf->Cell(0 ,6,'R$ ' . number_format($total, 2, ',', '.'),0,1,'R');
 

$pdf->SetFont('Times','',12);
$pdf->Output('Vallepolpas_pedidos.pdf', 'I');

?>