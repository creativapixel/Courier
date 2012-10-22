<?php //session_start();
//require('../impresion/fpdf.php');
require('../impresion/mc_table.php');
require_once('../clases/cargocourier_data.php');

$cargo = new  cargocourierdata();
$empresas = new  empresasdata();
$auxiliares = new  auxiliaresdata();


/*class PDF extends FPDF
{
//Cabecera de página
	function Header()
	{
    	//Logo
    	$this->Image('logo_pb.png',10,8,33);
    	//Arial bold 15
	    $this->SetFont('Arial','B',15);
	    //Movernos a la derecha
	    $this->Cell(80);
	    //Título
	   // $this->Cell(30,10,'Title',1,0,'C');
    	//Salto de línea
    	$this->Ln(20);
	}
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

*/



$pdf=new PDF_MC_Table();


$pdf->FPDF('L','mm','A4');



//$pdf->Open();
$pdf->AliasNbPages();
$pdf->SetLeftMargin(15);
$pdf->PageNo();
//$pdf->SetTopMargin(0);


$pdf->AddPage();
$pdf->SetFont('Arial','',6);

$numeroreportemensual=$auxiliares->numeroreportemensual_nuevo();

if($_REQUEST['empresa']=='0')
{
	$courier="TODOS";
}
else
{
	$courier=$empresas->devuelve_empresaremite($_REQUEST['empresa']);
}

$cargo->nuevo_reportemensual($numeroreportemensual,$_REQUEST['empresa'],$_REQUEST['fecha'],$_REQUEST['fechaf']);

$pdf->Cell(275,10,'MANIFIESTO Nº '.$numeroreportemensual.'',0,0,'C');
$pdf->Ln(10);

$pdf->Cell(50,5,'DE: PERUMAIL EXPRESS S.A.C.',0,0,'L');
$pdf->Cell(170,5,'PARA: '.$courier.'',0,0,'L');
$pdf->Cell(39,5,'FECHA: del '.$_REQUEST['fecha'].' al '.$_REQUEST['fechaf'].'',0,0,'L');
$pdf->Ln(5);

$pdf->Cell(275,5,'',0,0,'C');
$pdf->Ln(5);




$pdf->SetWidths(array(8,62,10,55,80,19,30));
//srand(microtime()*1000000);
$pdf->Row(array('Nº','Empresa Remitente','Nº Guia','Consignado','Dirección','Destino','Oficio'));

$rs= $cargo->cargocourier_listar('','',$_REQUEST['empresa'],$_REQUEST['fecha'],$_REQUEST['fechaf'],'4','');
//$rs= $cargo->cargocourier_listar($_REQUEST['courier_destino'],'','',$_REQUEST['fecha'],$_REQUEST['fechaf'],'3','');

$rs= mysql_query($rs,$cargo->con->cn);

if($rs)
{
	
			 $j=1;
	while($campo =mysql_fetch_array($rs)) 
	{
		//cargamos a las variables los campos de la bd

		$guia=$campo['carcou_id'];
		$razonsocial=$campo['emprem_razonsocial'];
		$direccion=$campo['carcou_direccion'].' - '.$campo['carcou_distrito'];
		$consignado=$campo['carcou_consignadoa'];
		$ciudad=$auxiliares->devuelve_ciudad($campo['ciu_id']);
		$tipoenvio=$campo['carcou_cantidad'].' '.$campo['tipoenv_descripcion'];
		$peso=$campo['carcou_peso'].' Kg';
		$observaciones=$campo['carcou_observaciones'];
		if($cargo->util->obtienefecha($campo['carcou_fecharecepcion'])!='00/00/0000')
		{
			$fecha=$cargo->util->obtienefecha($campo['carcou_fecharecepcion']);
		}
		else
		{
			$fecha='';
		}
		
		$pdf->Row(array($j,$razonsocial,$guia,$consignado,$direccion,$ciudad,$observaciones));

		$j=$j+1;

  	 } 
}



$cargo->con->cerrar();


//$pdf->WriteHTML($htmlTable);
$pdf->Output();
?>

