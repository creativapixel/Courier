<?php //session_start();
//require('../impresion/fpdf.php');
require('../impresion/mc_table.php');
require_once('../clases/cargomasivo_data.php');

$cargo = new  cargomasivodata();
$empresas = new  empresasdata();
$auxiliares = new  auxiliaresdata();


$pdf=new PDF_MC_Table();



class PDF extends FPDF
{




//Pie de p�gina
function Footer()
{
    //Posici�n: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',8);
    //N�mero de p�gina
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

$numeroreporte=$auxiliares->numero_reporte_masivo_nuevo('rep_masivo_tec');

if($_REQUEST['empresa_remite']=='0')
{
	$empresa="TODOS";
}
else
{
	$empresa=$empresas->devuelve_empresaremite($_REQUEST['empresa_remite']);
}

//$cargo->nuevo_reportemensual($numeroreporte,$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['fechaf']);

$pdf->Cell(270,10,'REPORTE TECNICO DE CARGOS MASIVOS N� '.$numeroreporte.'',0,0,'C');
$pdf->Ln(10);

$pdf->Cell(50,5,'DE: PERUMAIL EXPRESS S.A.C.',0,0,'L');
//$pdf->Ln(5);
$pdf->Cell(145,5,'PARA: '.$empresa.'',0,0,'L');
//$pdf->Ln(5);
$pdf->Cell(150,5,'FECHA: del '.$_REQUEST['fecha'].' al '.$_REQUEST['fecha2'].'',0,0,'L');
$pdf->Ln(5);

$pdf->Cell(275,5,'',0,0,'C');
$pdf->Ln(5);




$pdf->SetWidths(array(10,15,20,20,60,60,25,25));	
//srand(microtime()*1000000);
$pdf->Row(array('N�','N� Guia','Fec. Emis.','Zona','Consignado','Direccion','Ciudad','Observaciones'));

//$rs= $cargo->cargocourier_listar('','',$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['fechaf'],'4','');

$rs=$cargo->cargomasivo_listar_impresion('4',$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['fecha2'],$_REQUEST['estado'],'');

// mysql_query($rs,$cargo->con->cn);

if($rs)
{
	
		$j=1;
		/*$suma_subtotal=0;
		$suma_igv=0;
		$suma_total=0;*/
	while($campo =mysql_fetch_array($rs)) 
	{
		//cargamos a las variables los campos de la bd
		if($cargo->util->obtienefecha($campo['cmas_fecha'])!='00/00/0000')
		{
			$fecha=$cargo->util->obtienefecha($campo['cmas_fecha']);
		}
		else
		{
			$fecha='';
		}
		
		/*
		$incluye_igv=$campo['carcou_incluyeigv'];
		
		if ($incluye_igv=='0')
		{
			$primerkg=$campo['carcou_costoprimerkg'];
			$kgadicional=$campo['carcou_costokgadicional'];	
			$volumen=$campo['carcou_costovolumen'];
			$fragilidad=$campo['carcou_costofragilidad'];
			$embalaje=$campo['carcou_costoembalaje'];
		}
		else
		{
			$primerkg=number_format($campo['carcou_costoprimerkg']/1.19,2);
			$kgadicional=number_format($campo['carcou_costokgadicional']/1.19,2);
			$volumen=number_format($campo['carcou_costovolumen']/1.19,2);
			$fragilidad=number_format($campo['carcou_costofragilidad']/1.19,2);
			$embalaje=number_format($campo['carcou_costoembalaje']/1.19,2);									
		}
		*/

		/*$subtotal=$campo['carcou_subtotal'];
		$igv=$campo['carcou_igv'];
		$total=$campo['carcou_total'];*/
		$guia=$campo['cmas_id'];
		$zona=$campo['ze_descripcion'];
		$ciudad=$campo['ub_descripcion'];
		$consignado=$campo['cmas_destinatario'];
		$direccion=$campo['cmas_direccion'].' '.$campo['cmas_cacerio'];
		
		if($campo['def_id']!='10')
		{
			$observaciones=$campo['def_descripcion'];		
		}
		else
		{
			$observaciones='';					
		}
		/*$tipoenvio=$campo['carcou_cantidad'].' '.$campo['tipoenv_descripcion'];
		$peso=$campo['carcou_peso'].' Kg';*/
		

		
		$pdf->Row(array($j,$guia,$fecha,$zona,$consignado,$direccion,$ciudad,$observaciones));

		//$suma_subtotal=$suma_subtotal + $subtotal;


		$j=$j+1;
				

  	 } 
}

/*
$pdf->Row(array('','','','','','','','','','','','Subtotal','S/. '.number_format($suma_subtotal,2)));

$igv=$suma_subtotal*0.19;
$total=$igv+$suma_subtotal;


$pdf->Row(array('','','','','','','','','','','','IGV','S/. '.number_format($igv,2)));
$pdf->Row(array('','','','','','','','','','','','Total','S/. '.number_format($total,2)));
*/


$cargo->con->cerrar(); 

//$pdf->WriteHTML($htmlTable);
$pdf->Output();
?>

