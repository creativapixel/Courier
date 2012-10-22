<?php //session_start();
require('../impresion/fpdf2.php');

//require('../impresion/pdf_codabar.php');


require_once('../clases/cargocourier_data.php');
$cargo = new cargocourierdata();
$auxiliares = new auxiliaresdata();


//$pdf=new PDF_Codabar('P','cm','custom',609.449,935.5);
$pdf=new FPDF('P','cm','custom',609.449,935.5); //ingreso medida puntos 

$pdf->SetTopMargin(1.3);
$pdf->SetAutoPageBreak(1);
$pdf->AddPage();
$pdf->SetFont('Arial','',8);






$rs= $cargo->cargocourier_listar('',$_REQUEST['cargo_codigo'],'','','','2','');

$rs= mysql_query($rs,$cargo->con->cn);

$campo= mysql_fetch_array($rs);
$codigo=$campo['carcou_id'];
$fecha=$cargo->util->obtienefecha($campo['carcou_fecha']);
$origen=$auxiliares->devuelve_ciudad($campo['carcou_ciudadorigen']);
$destino=$auxiliares->devuelve_ciudad($campo['ciu_id']);
$centrocosto=$campo['carcou_centrocosto'];
$area=$campo['empcou_razonsocial'];
$remite=$campo['emprem_razonsocial'];
$consignado=$campo['carcou_consignadoa'];
$direccionconsignado=$campo['carcou_direccion'];
$distritodestino=$campo['carcou_distrito'];
$areacargo=$campo['area_descripcion'];
$contacto=$campo['carcou_contacto'];
$forma_pago=$campo['formpago_descripcion'];
$autorizado=$campo['carcou_autorizadopor'];
$tipo_envio=$campo['carcou_cantidad'].' '.$campo['tipoenv_descripcion']." (S)";
$volumen_excesivo=$auxiliares->devuelve_volumen($campo['vol_excesivo']);
$volumen_maximo=$auxiliares->devuelve_volumen($campo['vol_maximo']);
$volumen_simple=$auxiliares->devuelve_volumen($campo['vol_simple']);

$volumen_estandar=$auxiliares->devuelve_volumen($campo['vol_estandar']);


$cant_vsimple=$campo['cant_vsimple'];
/*if ($cant_vsimple==0)
{
	$cant_vsimple='';
}*/

$cant_vexcesivo=$campo['cant_vexcesivo'];
/*if ($cant_vexcesivo==0)
{
	$cant_vexcesivo='';
}*/

$cant_vmaximo=$campo['cant_vmaximo'];
/*if ($cant_vmaximo==0)
{
	$cant_vmaximo='';
}*/

$cant_vestandar=$campo['cant_vestandar'];



$peso=$campo['carcou_peso']." Kg";
$recepcionado=$campo['carcou_recepcionadopor'];
$tiposervicio=$campo['tiposerv_descripcion'];
if($campo['carcou_dni']=='0') { $dni=''; } else {$dni=$campo['carcou_dni'];};
$fecha_recepcion=$cargo->util->obtienefecha($campo['carcou_fecharecepcion']);
$observaciones=$campo['carcou_observaciones'];
$hora= $campo['carcou_hora'];
$fragil=$campo['fra_descripcion'];
$embalaje=$campo['emb_descripcion'];



if($cant_vestandar>0)
{
	$valor=$cant_vestandar.' ESTANDAR';
}
else
{
	$valor=$cant_vsimple.' SIMPLE';
}




$pdf->Cell(15.6,1,'',0,0,'C');
$pdf->Cell(4,1,$codigo,0,0,'C');
$pdf->Ln(1);
$pdf->Cell(19.6,0.5,'',0,0,'C');
$pdf->Ln(0.5);
$pdf->Cell(4.9,0.7,$fecha,0,0,'C');
$pdf->Cell(4.9,0.7,$origen,0,0,'C');
$pdf->Cell(4.9,0.7,$destino,0,0,'C');
$pdf->Cell(4.9,0.7,$area,0,0,'C');
$pdf->Ln(0.7);
$pdf->Cell(9.8,1.4,$remite,0,0,'C');

//$pdf->Ln(1.4);
$pdf->Cell(9.8,0.7,$consignado,0,2,'C');

$pdf->Cell(9.8,0.7,$direccionconsignado.' - '.$distritodestino ,0,0,'C');
$pdf->Ln(0.7);

//$pdf->Cell(9.8,1.4,$consignado,1,0,'C');
//$pdf->Ln(1.4);
$pdf->Cell(1.6,0.5,'',0,0,'C');
$pdf->Cell(4.1,0.5,$areacargo,0,0,'L'); //cargo
$pdf->Cell(4.1,0.5,$centrocosto,0,0,'C'); //cargo
$pdf->Cell(2.2,0.5,'',0,0,'C');
$pdf->Cell(7.6,0.5,$contacto,0,0,'C');
$pdf->Ln(0.5);
$pdf->Cell(19.6,0.5,'',0,0,'C');
$pdf->Ln(0.5);

$pdf->Cell(13.1,0.43,'',0,0,'C');//primera linea forma pago, autorizado, tipo envio
$pdf->Cell(3.3,0.43,$cant_vexcesivo.' EXCESIVO',0,0,'C');//volumen excesivo
$pdf->Cell(3.2,0.43,'',0,0,'C');//primera fila de peso
$pdf->Ln(0.43);

//2da fila
$pdf->Cell(4.9,0.43,$forma_pago,0,0,'C');
$pdf->Cell(4.9,0.43,$autorizado,0,0,'C');
$pdf->Cell(3.3,0.43,$tipo_envio,0,0,'C');
$pdf->Cell(3.3,0.43,$cant_vmaximo.' MAXIMO',0,0,'C');//volumen maximo
$pdf->Cell(3.2,0.43,$peso,0,0,'C');// peso
$pdf->Ln(0.43);



//$cant_vsimple.' SIMPLE'

$pdf->Cell(13.1,0.44,'',0,0,'C');//tercera linea forma pago, autorizado, tipo envio
$pdf->Cell(3.3,0.44,$valor,0,0,'C');//volumen excesivo
$pdf->Cell(3.2,0.44,'',0,0,'C');//tercera fila de peso
$pdf->Ln(0.44);







$pdf->Cell(2.45,0.5,'',0,0,'C'); //titulo fragil
$pdf->Cell(2.45,0.5,'',0,0,'C'); //titulo embalaje
$pdf->Cell(4.9,0.5,'',0,0,'C'); //titulo tipo servicio
$pdf->Cell(3.8,0.5,'',0,0,'C'); //autorizado por
$pdf->Cell(6,0.5,$recepcionado,0,0,'C');
$pdf->Ln(0.5);
$pdf->Cell(2.45,1.3,$fragil,0,0,'C'); //fragil
$pdf->Cell(2.45,1.3,$embalaje,0,0,'C'); //embalaje
$pdf->Cell(4.9,1.3,$tiposervicio,0,0,'C'); //tipo servicio
$pdf->Cell(4.9,1.3,'',0,0,'C');
$pdf->Cell(4.9,0.7,$dni,0,2,'C');
$pdf->Cell(4.9,0.6,'',0,0,'C');
$pdf->Ln(0.6);
$pdf->Cell(9.8,1.3,$observaciones,0,0,'C');
$pdf->Cell(4.9,1.3,'',0,0,'C');
$pdf->Cell(4.9,1.3,$hora,0,0,'C');
$pdf->Ln(1.3);
$pdf->Cell(19.6,1.6,'',0,0,'C');
$pdf->Ln(1.6);//fin



$pdf->Cell(15.6,1.3,'',0,0,'C');
$pdf->Cell(4,1.3,$codigo,0,0,'C');
$pdf->Ln(1.3);
$pdf->Cell(19.6,0.5,'',0,0,'C');
$pdf->Ln(0.5);
$pdf->Cell(4.9,0.7,$fecha,0,0,'C');
$pdf->Cell(4.9,0.7,$origen,0,0,'C');
$pdf->Cell(4.9,0.7,$destino,0,0,'C');
$pdf->Cell(4.9,0.7,$area,0,0,'C');
$pdf->Ln(0.7);

$pdf->Cell(9.8,1.4,$remite,0,0,'C');

//$pdf->Ln(1.4);
$pdf->Cell(9.8,0.7,$consignado,0,2,'C');

$pdf->Cell(9.8,0.7,$direccionconsignado.' - '.$distritodestino ,0,0,'C');
$pdf->Ln(0.7);



$pdf->Cell(1.6,0.5,'',0,0,'C');
$pdf->Cell(4.1,0.5,$areacargo,0,0,'L'); //cargo
$pdf->Cell(4.1,0.5,$centrocosto,0,0,'C'); //cargo
$pdf->Cell(2.2,0.5,'',0,0,'C');
$pdf->Cell(7.6,0.5,$contacto,0,0,'C');
$pdf->Ln(0.5);
$pdf->Cell(19.6,0.5,'',0,0,'C');
$pdf->Ln(0.5);


$pdf->Cell(13.1,0.43,'',0,0,'C');//primera linea forma pago, autorizado, tipo envio
$pdf->Cell(3.3,0.43,$cant_vexcesivo.' EXCESIVO',0,0,'C');//volumen excesivo
$pdf->Cell(3.2,0.43,'',0,0,'C');//primera fila de peso
$pdf->Ln(0.43);

//2da fila
$pdf->Cell(4.9,0.43,$forma_pago,0,0,'C');
$pdf->Cell(4.9,0.43,$autorizado,0,0,'C');
$pdf->Cell(3.3,0.43,$tipo_envio,0,0,'C');
$pdf->Cell(3.3,0.43,$cant_vmaximo.' MAXIMO',0,0,'C');//volumen maximo
$pdf->Cell(3.2,0.43,$peso,0,0,'C');// peso
$pdf->Ln(0.43);

$pdf->Cell(13.1,0.44,'',0,0,'C');//tercera linea forma pago, autorizado, tipo envio
$pdf->Cell(3.3,0.44,$valor,0,0,'C');//volumen excesivo
$pdf->Cell(3.2,0.44,'',0,0,'C');//tercera fila de peso
$pdf->Ln(0.44);



$pdf->Cell(2.45,0.5,'',0,0,'C'); //titulo fragil
$pdf->Cell(2.45,0.5,'',0,0,'C'); //titulo embalaje
$pdf->Cell(4.9,0.5,'',0,0,'C'); //titulo tipo servicio
$pdf->Cell(3.8,0.5,'',0,0,'C'); //autorizado por
$pdf->Cell(6,0.5,$recepcionado,0,0,'C');
$pdf->Ln(0.5);
$pdf->Cell(2.45,1.3,$fragil,0,0,'C'); //fragil
$pdf->Cell(2.45,1.3,$embalaje,0,0,'C'); //embalaje
$pdf->Cell(4.9,1.3,$tiposervicio,0,0,'C'); //tipo servicio
$pdf->Cell(4.9,1.3,'',0,0,'C');
$pdf->Cell(4.9,0.7,$dni,0,2,'C');
$pdf->Cell(4.9,0.6,'',0,0,'C');
$pdf->Ln(0.6);
$pdf->Cell(9.8,1.3,$observaciones,0,0,'C');
$pdf->Cell(4.9,1.3,'',0,0,'C');
$pdf->Cell(4.9,1.3,$hora,0,0,'C');
$pdf->Ln(1.3);
$pdf->Cell(19.6,1.6,'',0,0,'C');
$pdf->Ln(1.6);//fin




$pdf->Cell(15.6,1.3,'',0,0,'C');
$pdf->Cell(4,1.3,$codigo,0,0,'C');
$pdf->Ln(1.3);
$pdf->Cell(19.6,0.5,'',0,0,'C');
$pdf->Ln(0.5);
$pdf->Cell(4.9,0.7,$fecha,0,0,'C');
$pdf->Cell(4.9,0.7,$origen,0,0,'C');
$pdf->Cell(4.9,0.7,$destino,0,0,'C');
$pdf->Cell(4.9,0.7,$area,0,0,'C');
$pdf->Ln(0.7);

$pdf->Cell(9.8,1.4,$remite,0,0,'C');

//$pdf->Ln(1.4);
$pdf->Cell(9.8,0.7,$consignado,0,2,'C');

$pdf->Cell(9.8,0.7,$direccionconsignado.' - '.$distritodestino ,0,0,'C');
$pdf->Ln(0.7);


$pdf->Cell(1.6,0.5,'',0,0,'C');
$pdf->Cell(4.1,0.5,$areacargo,0,0,'L'); //cargo
$pdf->Cell(4.1,0.5,$centrocosto,0,0,'C'); //cargo
$pdf->Cell(2.2,0.5,'',0,0,'C');
$pdf->Cell(7.6,0.5,$contacto,0,0,'C');
$pdf->Ln(0.5);
$pdf->Cell(19.6,0.5,'',0,0,'C');
$pdf->Ln(0.5);


$pdf->Cell(13.1,0.43,'',0,0,'C');//primera linea forma pago, autorizado, tipo envio
$pdf->Cell(3.3,0.43,$cant_vexcesivo.' EXCESIVO',0,0,'C');//volumen excesivo
$pdf->Cell(3.2,0.43,'',0,0,'C');//primera fila de peso
$pdf->Ln(0.43);

//2da fila
$pdf->Cell(4.9,0.43,$forma_pago,0,0,'C');
$pdf->Cell(4.9,0.43,$autorizado,0,0,'C');
$pdf->Cell(3.3,0.43,$tipo_envio,0,0,'C');
$pdf->Cell(3.3,0.43,$cant_vmaximo.' MAXIMO',0,0,'C');//volumen maximo
$pdf->Cell(3.2,0.43,$peso,0,0,'C');// peso
$pdf->Ln(0.43);

$pdf->Cell(13.1,0.44,'',0,0,'C');//tercera linea forma pago, autorizado, tipo envio
$pdf->Cell(3.3,0.44,$valor,0,0,'C');//volumen excesivo
$pdf->Cell(3.2,0.44,'',0,0,'C');//tercera fila de peso
$pdf->Ln(0.44);



$pdf->Cell(2.45,0.5,'',0,0,'C'); //titulo fragil
$pdf->Cell(2.45,0.5,'',0,0,'C'); //titulo embalaje
$pdf->Cell(4.9,0.5,'',0,0,'C'); //titulo tipo servicio
$pdf->Cell(3.8,0.5,'',0,0,'C'); //autorizado por
$pdf->Cell(6,0.5,$recepcionado,0,0,'C');
$pdf->Ln(0.5);
$pdf->Cell(2.45,1.3,$fragil,0,0,'C'); //fragil
$pdf->Cell(2.45,1.3,$embalaje,0,0,'C'); //embalaje
$pdf->Cell(4.9,1.3,$tiposervicio,0,0,'C'); //tipo servicio
$pdf->Cell(4.9,1.3,'',0,0,'C');
$pdf->Cell(4.9,0.7,$dni,0,2,'C');
$pdf->Cell(4.9,0.6,'',0,0,'C'); //fecha
$pdf->Ln(0.6);
$pdf->Cell(9.8,1.3,$observaciones,0,0,'C');
$pdf->Cell(4.9,1.3,'',0,0,'C');
$pdf->Cell(4.9,1.3,$hora,0,0,'C');
$pdf->Output();

?>

