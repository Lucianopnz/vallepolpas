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
    //$this->Image('imagens/Logo.png',10,6,30);
    // Arial bold 13
    $this->SetFont('Times','B',10);
    $this ->SetLeftMargin(2);
    // Move to the right
    //$this->Cell(80);
    // Title
    //$this->Image('imagens/Logo.png',10,6,0);
    $this->Cell(0,4,'Valle Industria e Comercio de Polpas',0,1,'L');
    // Sub-Title
    $this->SetFont('Times','',8);
    $this->Cell(0,4,'Rua Vasco da Gama, 38 - Petrolina/PE',0,1,'C');   
    $this->Cell(0,4,"----------------------------------------------------------------------",0,1,'C');

    //nome
    //$this ->SetLeftMargin(2);
    $this->Cell(0,4,"Pedido # ".$pedido." ",0,1,'L');       
    $this->Cell(0,4,"Cliente: ".$cliente." ",0,1,'L');  
    $this->Cell(0,4,"Data: ".date('d/m/Y', strtotime($dtpedido))." ",0,1,'L');   
    //$this->Cell(0,5,"Tipo: Congelamento",0,1,'R');
    $this->Ln(1);
  }
  
  /* Rodapé */
  function Footer()
  {
    $data = $currentDate = date("d/m/Y");
  // Position at 1.5 cm from bottom
  //$this->SetY(-50);
  // Arial italic 8
  $this->SetFont('Arial','',8);
  $this->Cell(0,4,"----------------------------------------------------------------------",0,1,'C');
  $this->Cell(0,4,'OBRIGADO PELA PREFERÊNCIA',0,1,'C');
  $this->Cell(0,4,"----------------------------------------------------------------------",0,1,'C');

  }
}

/* Instanciation of inherited class */
//$pdf = new PDF();
$pdf = new PDF ('P','mm',array(80,150));

$pdf->AliasNbPages();
$pdf->AddPage();

//Cabeçalho da Tabela
$pdf->SetFillColor(232,232,232);
//$pdf ->SetLeftMargin(2);
$pdf->SetFont('Times','',8);
$pdf->Cell(0,4,"----------------------------------------------------------------------",0,1,'C');
$pdf->Cell(15,4,'ITEM',0,0,'L');
$pdf->Cell(30,4,'DESCRIÇÃO',0,1,'L');
$pdf->Cell(10,4,'UNID.',0,0,'L');
$pdf->Cell(12,4,'QTD(KG)',0,0,'C');
$pdf->Cell(20,4,'VLR.UNIT',0,0,'R');
$pdf->Cell(22,4,'VLR.TOTAL',0,1,'R');
$pdf->Cell(0,4,"----------------------------------------------------------------------",0,1,'C');
$pdf->Ln(1);
$pdf->SetFont('Arial','',8);
$pdf->SetFillColor(224,235,255);
//$fill = false;
$ordem = 1;
$peso = 0;
$total = 0.00;
while($linhas = mysqli_fetch_array($resultado)){

  $pdf->Cell(15 ,4,"00".$ordem,0,0,'L',$fill);
  $pdf->Cell(30 ,4,$linhas['descricao'],0,1,'L',$fill);
  $pdf->Cell(10 ,4,$linhas['unidade'],0,0,'L',$fill);
  $pdf->Cell(12 ,4,$linhas['peso'],0,0,'C');
  $pdf->Cell(20 ,4,'R$ ' . number_format($linhas['vlr_unitario'], 2, ',', '.'),0,0,'R');
  $pdf->Cell(22 ,4,'R$ ' . number_format($linhas['vlr_total'], 2, ',', '.'),0,1,'R');  
  $ordem = $ordem + 1;
  $peso = $peso + $linhas['peso'];
  $total = $total + $linhas['vlr_total'];
};

 $pdf->Ln(5);
 //$pdf->Cell(5 ,8,'',0,0, 'L');
 //$pdf->Cell(15 ,8,number_format($peso)." kg",0,0,'R',$fill);
 //$pdf->Cell(25 ,8,'',0,0, 'L');
 $pdf->SetFont('Arial','B',8); 
 $pdf->Cell(35,6,'TOTAL',0,0,'L');
 $pdf->Cell(29 ,6,'R$ ' . number_format($total, 2, ',', '.'),0,1,'R'); 
 //$pdf->Ln(1);
 $pdf->SetFont('Arial','',8);
 $pdf->Cell(15,4,'Peso total: ',0,0,'L');
 $pdf->Cell(12,4,$peso.' kg',0,1,'C');
 
 $resultado = mysqli_query($conectar, "SELECT * FROM tblPedido WHERE pedido = $pedido");
 $linhas = mysqli_num_rows($resultado);


 $pdf->SetFont('Times','',8);
 $pdf->Output('Vallepolpas_pedidos.pdf', 'I');

?>