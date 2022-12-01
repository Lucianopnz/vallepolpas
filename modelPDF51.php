<?php
session_start();
include_once("valleSeguranca.php");
include_once("valleConexao.php");

$pedido = $_GET['pedido'];

$resultado = mysqli_query($conectar, "SELECT * FROM tblPedido WHERE pedido = $pedido");
$linhas = mysqli_num_rows($resultado);

require('fpdf/fpdf.php');

// TOTAL ESTOQUE
$sql = "SELECT SUM(totalpedido) AS total FROM tblPedidos WHERE pedido = $pedido";
$result  = mysqli_query($conectar,$sql);
$row = mysqli_fetch_assoc($result);
$peso_total2 = $row['total'];

class PDF extends FPDF
{
  
	/* Cabeçalho */
	function Header()
	{
        $pedido = $_GET['pedido'];
        $cliente = $_GET['cliente'];
        $dtpedido = $_GET['datapedido'];
        $vlrUnitario = $_GET['vlrUnitario'];
        $vlrTotal = $_GET['vlrTotal'];
        
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
    
    $this->Cell(0,8,"Pedido # ".$pedido." ",0,1,'L');       
    $this->Cell(0,8,"Cliente: ".$cliente." ",0,1,'L');  
    $this->Cell(0,8,"Data: ".date('d/m/Y', strtotime($dtpedido))." ",0,1,'L');   
    //$this->Cell(0,5,"Tipo: Congelamento",0,1,'R');
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
$pdf->Cell(25,8,'Ordem',1,0,'C',1);
$pdf->Cell(80,8,'Descrição',1,0,'L',1);
$pdf->Cell(15,8,'Unid.',1,0,'C',1);
$pdf->Cell(25,8,'Peso (kg)',1,0,'C',1);
$pdf->Cell(25,8,'Unitário',1,0,'C',1);
$pdf->Cell(25,8,'Total',1,1,'C',1);
$pdf->Ln(4);
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224,235,255);
$fill = false;
$ordem = 1;
$peso = 0;
$total = 0.00;
while($linhas = mysqli_fetch_array($resultado)){

  $pdf->Cell(25 ,8,"00".$ordem,1,0,'C',$fill);
  $pdf->Cell(80 ,8,$linhas['descricao'],1,0,'L',$fill);
  $pdf->Cell(15 ,8,$linhas['unidade'],1,0,'R',$fill);
  $pdf->Cell(25 ,8,number_format($linhas['peso'])." kg",1,0,'R',$fill);
  $pdf->Cell(25 ,8,'R$ ' . number_format($linhas['vlr_unitario'], 2, ',', '.'),1,0,'R',$fill);
  $pdf->Cell(25 ,8,'R$ ' . number_format($linhas['vlr_total'], 2, ',', '.'),1,1,'R',$fill);  
  $fill = !$fill;
  $ordem = $ordem + 1;
  $peso = $peso + $linhas['peso'];
  $total = $total + $linhas['vlr_total'];
};

 $pdf->Ln(5);
 $pdf->Cell(120 ,6,'',0,0, 'L');
 $pdf->Cell(25 ,8,number_format($peso)." kg",1,0,'R',$fill);
 $pdf->Cell(25 ,8,'',0,0, 'L');
 $pdf->Cell(25 ,8,'R$ ' . number_format($total, 2, ',', '.'),1,1,'R',$fill); 
 $pdf->Ln(5);
 $pdf->Cell(120 ,6,'Pedido entregue: ___________________________________________',0,0, 'L');
 $pdf->Ln(20);
 $pdf->Cell(195 ,6,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - ',0,1, 'C');
 $pdf->Ln(6);
 $resultado = mysqli_query($conectar, "SELECT * FROM tblPedido WHERE pedido = $pedido");
$linhas = mysqli_num_rows($resultado);

// copia
$pedido = $_GET['pedido'];
$cliente = $_GET['cliente'];

// Logo
// Arial bold 13
$pdf->SetFont('Times','B',15);
// Move to the right
$pdf->Cell(80);
// Title
$pdf->Cell(30,10,'Valle Industria e Comercio de Polpas',0,1,'C');
// Arial bold 10
$pdf->SetFont('Arial','',10);
// Move to the right
$pdf->Cell(80);
// Sub-Title
$pdf->Cell(30,5,'Rua Vasco da Gama, 38 - Petrolina/PE',0,0,'C');
$pdf->Ln(3);
$pdf->Cell(0,5,"","B",1,'C');


$pdf->Cell(0,8,"Pedido # ".$pedido." ",0,1,'L');       
$pdf->Cell(0,8,"Cliente: ".$cliente." ",0,1,'L');  
$pdf->Cell(0,8,"Data: ".date('d/m/Y', strtotime($dtpedido))." ",0,1,'L');

 $pdf->SetFillColor(232,232,232);
$pdf->SetFont('Times','',12);
$pdf->Cell(25,8,'Ordem',1,0,'C',1);
$pdf->Cell(80,8,'Descrição',1,0,'L',1);
$pdf->Cell(15,8,'Unid.',1,0,'C',1);
$pdf->Cell(25,8,'Peso (kg)',1,0,'C',1);
$pdf->Cell(25,8,'Unitário',1,0,'C',1);
$pdf->Cell(25,8,'Total',1,1,'C',1);
$pdf->Ln(4);
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224,235,255);
$fill = false;
$ordem = 1;
$peso = 0;
$total = 0.00;
while($linhas = mysqli_fetch_array($resultado)){

  $pdf->Cell(25 ,8,"00".$ordem,1,0,'C',$fill);
  $pdf->Cell(80 ,8,$linhas['descricao'],1,0,'L',$fill);
  $pdf->Cell(15 ,8,$linhas['unidade'],1,0,'R',$fill);
  $pdf->Cell(25 ,8,number_format($linhas['peso'])." kg",1,0,'R',$fill);
  $pdf->Cell(25 ,8,'R$ ' . number_format($linhas['vlr_unitario'], 2, ',', '.'),1,0,'R',$fill);
  $pdf->Cell(25 ,8,'R$ ' . number_format($linhas['vlr_total'], 2, ',', '.'),1,1,'R',$fill);  
  $fill = !$fill;
  $ordem = $ordem + 1;
  $peso = $peso + $linhas['peso'];
  $total = $total + $linhas['vlr_total'];
};

 $pdf->Ln(5);
 $pdf->Cell(120 ,6,'',0,0, 'L');
 $pdf->Cell(25 ,8,number_format($peso)." kg",1,0,'R',$fill);
 $pdf->Cell(25 ,8,'',0,0, 'L');
 $pdf->Cell(25 ,8,'R$ ' . number_format($total, 2, ',', '.'),1,1,'R',$fill); 

 $pdf->SetFont('Times','',12);
 $pdf->Output('Vallepolpas_pedidos.pdf', 'I');

?>