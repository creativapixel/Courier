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

$numeroreportemensual=$auxiliares->numeroreportemensual_nuevo();

if($_REQUEST['empresa_remite']=='0')
{
	$empresa="TODOS";
}
else
{
	$empresa=$empresas->devuelve_empresaremite($_REQUEST['empresa_remite']);
}

$cargo->nuevo_reportemensual($numeroreportemensual,$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['fechaf']);

$pdf->Cell(270,10,'REPORTE MENSUAL Nº '.$numeroreportemensual.'',0,0,'C');
$pdf->Ln(10);

$pdf->Cell(50,5,'DE: PERUMAIL EXPRESS S.A.C.',0,0,'L');
//$pdf->Ln(5);
$pdf->Cell(145,5,'PARA: '.$empresa.'',0,0,'L');
//$pdf->Ln(5);
$pdf->Cell(150,5,'FECHA: del '.$_REQUEST['fecha'].' al '.$_REQUEST['fechaf'].'',0,0,'L');
$pdf->Ln(5);

$pdf->Cell(275,5,'',0,0,'C');
$pdf->Ln(5);




$pdf->SetWidths(array(10,15,24,38,12,20,15,18,20,18,18,18,18,18,18,18));	
//srand(microtime()*1000000);
$pdf->Row(array('Nº','Fec. Emis.','Zona','Destino','Nº Guia','Tipo de Envio','Peso','1er Kg.','Kg. Adicional','Volumen','Costo Servicio','Fragilidad','Embalaje','Importe'));

$rs= $cargo->cargocourier_listar('','',$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['fechaf'],'4','');

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
		
		$incluye_igv=$campo['carcou_incluyeigv'];
		
/*	*/	if ($incluye_igv=='1')
		{
			$primerkg=$campo['carcou_costoprimerkg'];
			$kgadicional=$campo['carcou_costokgadicional'];	
			$volumen=$campo['carcou_costovolumen'];
			$fragilidad=$campo['carcou_costofragilidad'];
			$embalaje=$campo['carcou_costoembalaje'];
			$costo_servicio=$campo['carcou_costoservicio'];			
		}
		else
		{
			$campo_igv = 1 + $auxiliares->devuelve_igv();
			$primerkg=number_format($campo['carcou_costoprimerkg']*($campo_igv + 1),2);
			$kgadicional=number_format($campo['carcou_costokgadicional']*($campo_igv + 1),2);
			$volumen=number_format($campo['carcou_costovolumen']*($campo_igv + 1),2);
			$fragilidad=number_format($campo['carcou_costofragilidad']*($campo_igv + 1),2);
			$embalaje=number_format($campo['carcou_costoembalaje']*($campo_igv + 1),2);	
			$costo_servicio=number_format($campo['carcou_costoservicio']/($campo_igv + 1),2);			
		}	/**/


		$subtotal=$campo['carcou_subtotal'];
		$igv=$campo['carcou_igv'];
		$total=$campo['carcou_total'];
		$guia=$campo['carcou_id'];
		$zona=$campo['zon_descripcion'];
		$ciudad=$auxiliares->devuelve_ciudad($campo['ciu_id']);
		$tipoenvio=$campo['carcou_cantidad'].' '.$campo['tipoenv_descripcion'];
		$peso=$campo['carcou_peso'].' Kg';
		

		
		$pdf->Row(array($j,$fecha,$zona,$ciudad,$guia,$tipoenvio,$peso,'S/. '.$primerkg,'S/. '.$kgadicional,'S/. '.$volumen,'S/. '.$costo_servicio,'S/. '.$fragilidad,'S/. '.$embalaje,'S/. '.$total));

		//$suma_subtotal=$suma_subtotal + $subtotal;
		//$suma_igv=$suma_igv + $igv;
		$suma_total=$suma_total + $total;

		$j=$j+1;
				

  	 } 
}


//$pdf->Row(array('','','','','','','','','','','','Subtotal','S/. '.number_format($suma_subtotal,2)));

//$igv=$suma_subtotal*0.19;
//$total=$igv+$suma_subtotal;


//$pdf->Row(array('','','','','','','','','','','','IGV','S/. '.number_format($igv,2)));
$pdf->Row(array('','','','','','','','','','','','','Total','S/. '.number_format($suma_total,2)));

$cargo->con->cerrar(); 

//$pdf->WriteHTML($htmlTable);
$pdf->Output();
?>

