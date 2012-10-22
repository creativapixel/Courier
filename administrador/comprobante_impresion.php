<?php 	require('../impresion/mc_table.php');
		require_once "../clases/ventas_data.php";
	
	$venta = new Ventas;
	$comprobante = new Comprobante;
	$cliente = new Cliente;

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
$pdf->SetLeftMargin(10);
$pdf->PageNo();
//$pdf->SetTopMargin(0);


$pdf->AddPage();
$pdf->SetFont('Arial','',7);


/*$almacen_reporte=$almacen->nombre_almacen($_REQUEST['almacen'],'');
	

if($_REQUEST['actividad']=='1')
{
	$actividad="INGRESOS";
	$titulo_actividad="Origen";
}
else
{
	$actividad="SALIDAS";
	$titulo_actividad="Destino";	
}
*/
if($_REQUEST['fecha']!='' && $_REQUEST['fechaf']!='')
{
	$fecha = $_REQUEST['fecha'];
	$fechaf = $_REQUEST['fechaf'];	
	
	$fechas = 'Comprobantes emitidos desde el '.$fecha.' al '.$fechaf;
}

$pdf->Cell(295,10,'REPORTE DE COMPROBANTES EMITIDOS',0,0,'C');
$pdf->Ln(10);

if($fechas!='')
{
	$pdf->Cell(295,10,$fechas,0,0,'C');
	$pdf->Ln(10);
}

$pdf->SetWidths(array(120,20,25,15,25,25,25,15));	

$pdf->Row(array('Cliente','Tipo','Nº Comprobante','Fecha','Subtotal','IGV','Total','Estado'));



		$j='1';
		
		$rs=$venta->venta_consulta($_REQUEST['cliente'],$_REQUEST['tipocomprobante'],$_REQUEST['fecha'],$_REQUEST['fechaf'],'1');	

  		$suma_precio=0;
		$suma_importe=0;
		
		while($campo = mysql_fetch_array($rs)){
			
			$fecha = $venta->_util->obtienefecha($campo['ven_fecha']);
			$cliente =$campo['cli_razonsocial'];
			$tipo = $campo['tipc_descripcion'];
			$incluyeigv = $campo['ven_incluyeigv'];
			$comprobante = $venta->_util->ceros_izquierda($campo['ven_nro_doc'],5);
			$comprobante_serie = $venta->_util->ceros_izquierda($campo['ven_serie_doc'],3);			

		if($incluyeigv==0)
		{
			$subtotal = $venta->sumaimporte_detalleventa($campo['ven_id'],2);
			$igv = $subtotal * 0.19;
			$total = $subtotal + $igv;			
		}
		
		if($incluyeigv==1)
		{
			$total=$venta->sumaimporte_detalleventa($campo['ven_id'],2);
			$subtotal=$total/1.19;	
			$igv=$total-$subtotal;		
		}

			
			$subtotal=number_format($subtotal,2);
			$igv=number_format($igv,2);
			$total=number_format($total,2);
			/*$total=number_format($venta->sumaimporte_detalleventa($campo['ven_id'],2));
			$subtotal=number_format($total/1.19,2);
			$igv=number_format($total-$subtotal,2);*/
			
			$moneda=$campo['tipm_descripcion'];
			
      		if($campo['ven_anulado']=='1')
			{
        		$estado="Anulado";
			}
			else
			{
				$estado="";
			}			
			
			$pdf->Row(array($cliente,$tipo,$comprobante_serie.' - '.$comprobante,$fecha,$moneda.' '.$subtotal,$moneda.' '.$igv,$moneda.' '.$total,$estado));
			
			$j=$j+1;
			
			//$suma_precio=$suma_precio+$precio;
			//$suma_importe=$suma_importe+$importe;			
		} 



//$pdf->Row(array('','','','','Totales',$moneda.' '.number_format($suma_precio,2),$moneda.' '.number_format($suma_importe,2)));

/*}
$igv=$suma_subtotal*0.19;
$total=$igv+$suma_subtotal;


$pdf->Row(array('','','','','','','','','','','IGV','S/. '.number_format($igv,2)));
$pdf->Row(array('','','','','','','','','','','Total','S/. '.number_format($total,2)));
*/


$venta->con->cerrar(); 

//$pdf->WriteHTML($htmlTable);
$pdf->Output();
?>

