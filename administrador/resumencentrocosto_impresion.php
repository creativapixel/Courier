<?php //session_start();
//require('../impresion/fpdf.php');
require('../impresion/mc_table.php');
require_once('../clases/cargocourier_data.php');






$cargo = new  cargocourierdata();
$empresas = new  empresasdata();
$auxiliares = new  auxiliaresdata();

$pdf=new PDF_MC_Table();



class PDF extends FPDF
{


//Pie de página
function Footer()
{
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}





$pdf->FPDF('L','mm','A4');






//$pdf->Open();
$pdf->AliasNbPages();
$pdf->SetLeftMargin(15);
$pdf->PageNo();
//$pdf->SetTopMargin(0);


$pdf->AddPage();
$pdf->SetFont('Arial','',7);

$numeroresumen=$auxiliares->numeroresumen_nuevo();

if($_REQUEST['empresa_remite']=='0')
{
	$empresa="TODOS";
}
else
{
	$empresa=$empresas->devuelve_empresaremite($_REQUEST['empresa_remite']);
}

$cargo->nuevo_resumencentrocosto($numeroresumen,$_REQUEST['empresa_remite'],$_REQUEST['centrocosto']);

$pdf->Cell(270,10,'RESUMEN POR CENTRO DE COSTO Nº '.$numeroresumen.'',0,0,'C');
$pdf->Ln(10);

$pdf->Cell(50,5,'DE: PERUMAIL EXPRESS S.A.C.',0,0,'L');
//$pdf->Ln(5);
$pdf->Cell(70,5,'PARA: '.$empresa.'',0,0,'L');
$pdf->Cell(70,5,'CENTRO COSTO: '.$_REQUEST['centrocosto'].'',0,0,'L');
//$pdf->Ln(5);
$pdf->Cell(170,5,'FECHA: del '.$_REQUEST['fechai'].' al '.$_REQUEST['fechaf'].'',0,0,'L'); //fechas
$pdf->Ln(5);

$pdf->Cell(275,5,'',0,0,'C');
$pdf->Ln(5);




$pdf->SetWidths(array(7,15,25,40,12,20,15,18,20,18,18,16,16));	
//srand(microtime()*1000000);
$pdf->Row(array('Nº','Fec. Emis.','Zona','Destino','Nº Guia','Tipo de Envio','Peso','1er Kg.','Kg. Adicional','Volumen','Fragilidad','Embalaje','Importe'));

//			 $rs= $cargo->cargocourier_listar('','',$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['fechaf'],'5',$_REQUEST['centrocosto']);


$rs= $cargo->cargocourier_listar('','',$_REQUEST['empresa_remite'],$_REQUEST['fechai'],$_REQUEST['fechaf'],'5',$_REQUEST['centrocosto']);

$rs= mysql_query($rs,$cargo->con->cn);


if($rs)
{
	$j=1;
	$suma_subtotal=0;
	$suma_igv=0;
	$suma_total=0;
	while($campo =mysql_fetch_array($rs)) 
	{
		//cargamos a las variables los campos de la bd
		if($cargo->util->obtienefecha($campo['carcou_fecha'])!='00/00/0000')
		{
			$fecha=$cargo->util->obtienefecha($campo['carcou_fecha']);
		}
		else
		{
			$fecha='';
		}
		$primerkg=$campo['carcou_costoprimerkg'];
		$kgadicional=$campo['carcou_costokgadicional'];
		$volumen=$campo['carcou_costovolumen'];
		$fragilidad=$campo['carcou_costofragilidad'];
		$embalaje=$campo['carcou_costoembalaje'];
		$subtotal=$campo['carcou_subtotal'];
		$igv=$campo['carcou_igv'];
		$total=$campo['carcou_total'];
		$guia=$campo['carcou_id'];
		$centrocosto=$campo['carcou_centrocosto'];
		$zona=$campo['zon_descripcion'];
		$ciudad=$auxiliares->devuelve_ciudad($campo['ciu_id']);
		$tipoenvio=$campo['carcou_cantidad'].' '.$campo['tipoenv_descripcion'];
		$peso=$campo['carcou_peso'].' Kg';

		$pdf->Row(array($j,$fecha,$zona,$ciudad,$guia,$tipoenvio,$peso,'S/. '.$primerkg,'S/. '.$kgadicional,'S/. '.$volumen,'S/. '.$fragilidad,'S/. '.$embalaje,'S/. '.$subtotal));

		$suma_subtotal=$suma_subtotal + $subtotal;
		$j=$j+1;

		//$suma_igv=$suma_igv + $igv;
		//$suma_total=$suma_total + $total;	
				
  	 } 
}


$pdf->Row(array('','','','','','','','','','','','Subtotal','S/. '.number_format($suma_subtotal,2)));
$igv=$suma_subtotal*0.19;
$total=$suma_subtotal+$igv;

$pdf->Row(array('','','','','','','','','','','','igv','S/. '.number_format($igv,2)));
$pdf->Row(array('','','','','','','','','','','','total','S/. '.number_format($total,2)));

$cargo->con->cerrar();

//$pdf->WriteHTML($htmlTable);
$pdf->Output();
?>

