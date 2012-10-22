<?php 	require('../impresion/mc_table2.php');
		require_once "../clases/ventas_data.php";
		require_once "../clases/numeros_a_letras_data.php";
		
		$venta = new Ventas;
		$comprobante = new Comprobante;
		$cliente = new Cliente;
		$numerosletras = new Numeros_a_letras;
		
		$pdf=new PDF_MC_Table();

/*class PDF extends FPDF
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
}*/


$pdf=new FPDF('P','cm','custom',597.73,467.42);  //ingreso medida puntos 


//$pdf->Open();
$pdf->AliasNbPages();
$pdf->SetLeftMargin(0.9);
$pdf->PageNo();
$pdf->SetTopMargin(5.5);
$pdf->SetAutoPageBreak(0.9);

$pdf->AddPage();
$pdf->SetFont('Arial','',9);

	$venta->ventas_ver($_REQUEST['codigo']);
		
		
		$cliente_nombre=$venta->_cli_razonsocial;
		$cliente_direccion=$venta->_cli_direccion;
		$cliente_ruc=$venta->_cli_ruc;
		
		if($venta->_ven_guia==0)
		{
			$guia='';
		}
		else
		{
			$guia=$venta->_ven_guia;		
		}
		$e_fecha=$venta->_util->obtienefecha($venta->_ven_fecha);
		
		$fecha = explode("/", $e_fecha);//si fecha esta en formato dia-mes-año 
	
		$dia=$fecha[0]; 
		$mes=$venta->_util->ver_nombre_mes($fecha[1]); 
		$mes_numero=substr($fecha[3],2);
		$anio=substr($fecha[2],3);		
		
		$moneda=$venta->_tipm_descripcion;
		
		
$pdf->Cell(2,0.7,'',0,0,'L');
$pdf->Cell(9.9,0.7,$cliente_nombre,0,0,'L');
$pdf->Cell(1.4,0.7,'',0,0,'L');
$pdf->Cell(6.2,0.7,$e_fecha,0,0,'L');
$pdf->Ln(0.7);

$pdf->Cell(1.4,0.7,'',0,0,'L');
$pdf->Cell(5.6,0.7,$cliente_ruc,0,0,'L');
$pdf->Cell(1.9,0.7,'',0,0,'L');
$pdf->Cell(10.5,0.7,$cliente_direccion,0,0,'L');
$pdf->Ln(0.7);

$pdf->Cell(2.8,0.7,'',0,0,'L');//ruc
$pdf->Cell(16.7,0.7,$guia,0,0,'L');
$pdf->Ln(0.7);

$pdf->Cell(19.5,0.6,'',0,0,'L');//ruc
$pdf->Ln(0.6);



		$j='0';
  		$rsd=$venta->detalleventa_listar($_REQUEST['codigo']);
  		
		while($campod = mysql_fetch_array($rsd)){
			
			$descripcion =$campod['detv_descripcion'];			
			
			if($campod['detv_cantidad']==0)
			{
				$cantidad ='';
			}
			else
			{
				$cantidad =$campod['detv_cantidad'];
			}
			$unidad=$campod['uni_descripcion'];
			$precio=$campod['detv_precio'];
			$importe=$campod['detv_importe'];			
		
			$pdf->Cell(2.5,0.5,$cantidad,0,0,'C');//$cantidad. ' '.$unidad
			$pdf->Cell(13.1,0.5,$descripcion,0,0,'L');	
			//$pdf->Cell(20,0.5,$moneda.' '.$precio,0,0,'C');			
			$pdf->Cell(3.9,0.5,$moneda.' '.$importe,0,0,'C');			
			$pdf->Ln(0.5);	
			
			$suma_importe=$suma_importe + $importe;			
			$j = $j + 1;
		}
		
		if($venta->_ven_incluyeigv==0)
		{
			$subtotal = $suma_importe;	
			$igv = $subtotal * 0.19;
			$total = $subtotal + $igv;			
		}
		
		if($venta->_ven_incluyeigv==1)
		{
			$total=$suma_importe;
			$subtotal=$total/1.19;	
			$igv=$total-$subtotal;		
		}
		

		
		$total_filas=8;
		$resto_filas=$total_filas - $j;
		
		for($i=1;$i<=$resto_filas;$i++)
		{
			//celdas vacias
			$pdf->Cell(19.5,0.5,'',0,0,'C');
			$pdf->Ln(0.5);
			
		}
		
			$pdf->Cell(19.5,0.2,'',0,0,'C');	
			$pdf->Ln(0.2);


$valor = explode(".",number_format($total,2));
$numero_entero=$valor[0];


if($valor[1]=='')
{
	$numero_decimal='00';	
}
else
{
	/*if($valor[1]<10)
	{
		$numero_decimal=$valor[1]*10;
	}
	else
	{*/
		$numero_decimal=$valor[1];
	//}
}
$numero_letras=strtoupper($numerosletras->num2letras($numero_entero)).' CON '.$numero_decimal.'/100 NUEVOS SOLES';

			$pdf->Cell(0.8,0.7,'',0,0,'C');	
			$pdf->Cell(18.6,0.7,$numero_letras,0,0,'L');	
			$pdf->Ln(0.7);
			
			
			
			
		$pdf->Cell(15.6,0.8,'',0,0,'C');
		$pdf->Cell(3.8,0.8,$moneda.' '.number_format($subtotal,2),0,0,'C');	
		$pdf->Ln(0.8);		

		$pdf->Cell(13.5,0.9,'',0,0,'C');
		$pdf->Cell(0.7,0.9,'19',0,0,'C');//19%
		$pdf->Cell(1.5,0.9,'',0,0,'C');	
		$pdf->Cell(3.8,0.9,$moneda.' '.number_format($igv,2),0,0,'C');	
		$pdf->Ln(0.9);		

		$pdf->Cell(15.7,0.9,'',0,0,'C');
		$pdf->Cell(3.8,0.9,$moneda.' '.number_format($total,2),0,0,'C');
		$pdf->Ln(0.9);		

$venta->con->cerrar(); 


$pdf->Output();
?>

