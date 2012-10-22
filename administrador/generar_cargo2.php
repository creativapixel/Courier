<?php
session_start();
/*require_once('../clases/cargocourier_data.php');

$cargo = new  cargocourierdata();
$empresas = new  empresasdata();
$auxiliares = new  auxiliaresdata();
*/
if(!isset($_SESSION['usu_id']))
{
	die("No tiene acceso  a esta seccion");
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PM Express v1.0 - SISTEMA DE REGISTRO DE CARGOS POR COURIER</title>
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
<link href="../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
<div ID="waitDiv" style="position:absolute;left:300;top:300;visibility:hidden"> 
<table  border="0" align="center"> 
<tr><td> 
<img src="../imagenes/loading9.gif" border="0"> 
</td> 
</tr></table> 
</div> 
<SCRIPT> 
<!-- 
var DHTML = (document.getElementById || document.all || document.layers); 
function ap_getObj(name) { 
if (document.getElementById) 
{ return document.getElementById(name).style; } 
else if (document.all) 
{ return document.all[name].style; } 
else if (document.layers) 
{ return document.layers[name]; } 
} 
function ap_showWaitMessage(div,flag) { 
if (!DHTML) return; 
var x = ap_getObj(div); x.visibility = (flag) ? 'visible':'hidden' 
if(! document.getElementById) if(document.layers) x.left=280/2; return true; } ap_showWaitMessage('waitDiv', 3); 
//--> 
</SCRIPT> 

<script language="Javascript" src="../javascript/PopCalendar.js"></script>
</head>
	<body>



<?php

if($_REQUEST['id']==='1')
{

	if($_REQUEST['vol_excesivo']!='3')
	{
		$_REQUEST['vol_excesivo']='4';
	}
	if($_REQUEST['vol_maximo']!='2')
	{
		$_REQUEST['vol_maximo']='4';
	}
	if($_REQUEST['vol_simple']!='1')
	{
		$_REQUEST['vol_simple']='4';
	}
	  		
	$rs= $cargo->cargocourier_nuevo($_REQUEST['vol_excesivo'],$_REQUEST['tipo_servicio'],$_REQUEST['tipo_envio'],$_REQUEST['forma_pago'],$_REQUEST['ciudad_destino'],$_REQUEST['empresa_remite'],$_REQUEST['courier_destino'],$_REQUEST['fecha'],$_REQUEST['consignadoa'],$_REQUEST['distritoconsignado'],$_REQUEST['direccionconsignado'],$_REQUEST['cargoremitente'],$_REQUEST['contacto'],$_REQUEST['autorizadopor'],$_REQUEST['peso'],$_REQUEST['recibidopor'],$_REQUEST['recepcionadopor'],$_REQUEST['dni'],$_REQUEST['fecha2'],$_REQUEST['hora'],$_REQUEST['observaciones'],'0',$_REQUEST['ciudad_origen'],$_REQUEST['cantidad'],$_REQUEST['costoservicio'],$_REQUEST['centrocosto'],$_REQUEST['costovolumen'],$_REQUEST['embalaje'],$_REQUEST['fragilidad'],$_REQUEST['costoembalaje'],$_REQUEST['costofragilidad'],$_REQUEST['subtotal'],$_REQUEST['igv'],$_REQUEST['total'],$_REQUEST['costokg'],$_REQUEST['primerkg'],$_REQUEST['kgadicional'],$_REQUEST['zona'],$_REQUEST['vol_maximo'],$_REQUEST['vol_simple'],$_REQUEST['cant_vexcesivo'],$_REQUEST['cant_vmaximo'],$_REQUEST['cant_vsimple'],$_REQUEST['costovolumen_excesivo'],$_REQUEST['costovolumen_maximo'],$_REQUEST['costovolumen_simple'],$_REQUEST['cant_embalaje'],$_REQUEST['cant_fragilidad'],$_REQUEST['igv_incluye']);
				
$_REQUEST['cargoremitente']="";
$_REQUEST['consignadoa']="";
$_REQUEST['distritoconsignado']="";
$_REQUEST['direccionconsignado']="";
$_REQUEST['contacto']="";
$_REQUEST['autorizadopor']="";
$_REQUEST['peso']="";
$_REQUEST['recibidopor']="";
$_REQUEST['recepcionadopor']="";
$_REQUEST['dni']="";
$_REQUEST['fecha2']="";
$_REQUEST['hora']="";
$_REQUEST['observaciones']="";
$_REQUEST['cantidad']="";


$_REQUEST['vol_excesivo']="";
$_REQUEST['vol_maximo']="";
$_REQUEST['vol_simple']="";

$_REQUEST['cant_vexcesivo']="";
$_REQUEST['cant_vmaximo']="";
$_REQUEST['cant_vsimple']="";

$_REQUEST['costovolumen_excesivo']=0.00;
$_REQUEST['costovolumen_maximo']=0.00;
$_REQUEST['costovolumen_simple']=0.00;

$_REQUEST['cant_embalaje']="";
$_REQUEST['cant_fragilidad']="";

$_REQUEST['costoservicio']="";
$_REQUEST['centrocosto']="";
$_REQUEST['costovolumen']="";
$_REQUEST['costoembalaje']="";
$_REQUEST['costofragilidad']="";
$_REQUEST['zona']=0;
$_REQUEST['embalaje']=0;
$_REQUEST['fragilidad']=0;
$_REQUEST['subtotal']="";
$_REQUEST['igv']="";
$_REQUEST['total']="";
$_REQUEST['costokg']="";
$_REQUEST['kgadicional']="";
$_REQUEST['primerkg']="";

}
	

?>	
	
	
	
<script language="JavaScript">
	PopCalendar = getCalendarInstance();
	PopCalendar.initCalendar();
</script>	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr height="5">
    <td > <?php  include("menu.php");?></td>
  </tr>

</table><?php include("form_cargo.php");?>
</body>
</html>

<SCRIPT language="javascript">


function nuevo()
{

	if (document.forms.form1.zona.value=="0")
	{ 
			document.forms.form1.zona.focus();
			alert("Seleccione el Tipo de Zona");
			return false; 
	}

	if (document.forms.form1.fecha.value=="")
	{ 
			document.forms.form1.fecha.focus();
			alert("Ingresar Fecha de Envio");
			return false; 
	}
	
	/*
	if (document.forms.form1.igv_incluye[0].checked=="")
	{ 
			document.forms.form1.igv_incluye.focus();
			alert("Indique si incluye o no IGV");
			return false; 
	}	

	*/
	
	if (document.forms.form1.consignadoa.value=="")
	{ 
			document.forms.form1.consignadoa.focus();
			alert("Ingresar Consignado");
			return false; 
	}
	
	if (document.forms.form1.direccionconsignado.value=="")
	{ 
			document.forms.form1.direccionconsignado.focus();
			alert("Ingresar direccion Consignado");
			return false; 
	}

	/*if (document.forms.form1.contacto.value=="")
	{ 
			document.forms.form1.contacto.focus();
			alert("Ingresar Contacto");
			return false; 
	}*/
	
	if (document.forms.form1.autorizadopor.value=="")
	{ 
			document.forms.form1.autorizadopor.focus();
			alert("Ingresar el campo - Autorizado por");
			return false; 
	}
	
	if (document.forms.form1.cantidad.value=="")
	{ 
			document.forms.form1.cantidad.focus();
			alert("Ingresar la cantidad");
			return false; 
	}
	
	if (!Esnum(document.forms.form1.cantidad.value))
	{
		document.forms.form1.cantidad.focus();
	 	alert("Ingrese un valor numerico para cantidad");
	 	return false;
	}		

	if (document.forms.form1.peso.value=="")
	{ 
			document.forms.form1.peso.focus();
			alert("Ingresar el peso");
			return false; 
	}

	if (!Esnum(document.forms.form1.peso.value))
	{
		document.forms.form1.peso.focus();
	 	alert("Ingrese un valor numerico para el peso");
	 	return false;
	}	
	
			

document.forms.form1.action='generar_cargo.php';
document.forms.form1.method='post';
document.forms.form1.id.value='1'
document.forms.form1.submit();
}


function agregar_ciudad()
{
	window.open("nuevaciudad.php?fecha="+document.forms.form1.fecha.value+"&ciudad_origen="+document.forms.form1.ciudad_origen.value+"&courier_destino="+document.forms.form1.courier_destino.value+"&ciudad_destino="+document.forms.form1.ciudad_destino.value+"&empresa_remite="+document.forms.form1.empresa_remite.value+"&cargoremitente="+document.forms.form1.cargoremitente.value+"&consignadoa="+document.forms.form1.consignadoa.value+"&distritoconsignado="+document.forms.form1.distritoconsignado.value+"&direccionconsignado="+document.forms.form1.direccionconsignado.value+"&contacto="+document.forms.form1.contacto.value+"&forma_pago="+document.forms.form1.forma_pago.value+"&autorizadopor="+document.forms.form1.autorizadopor.value+"&tipo_envio="+document.forms.form1.tipo_envio.value+"&peso="+document.forms.form1.peso.value+"&recibidopor="+document.forms.form1.recibidopor.value+"&tipo_servicio="+document.forms.form1.tipo_servicio.value+"&recepcionadopor="+document.forms.form1.recepcionadopor.value+"&dni="+document.forms.form1.dni.value+"&fecha2="+document.forms.form1.fecha2.value+"&hora="+document.forms.form1.hora.value+"&observaciones="+document.forms.form1.observaciones.value+"&cantidad="+document.forms.form1.cantidad.value, "ventana", "resizable,height=140,width=500");
}


function agregar_courier()
{
	window.open("nuevocourier.php?fecha="+document.forms.form1.fecha.value+"&ciudad_origen="+document.forms.form1.ciudad_origen.value+"&courier_destino="+document.forms.form1.courier_destino.value+"&ciudad_destino="+document.forms.form1.ciudad_destino.value+"&empresa_remite="+document.forms.form1.empresa_remite.value+"&cargoremitente="+document.forms.form1.cargoremitente.value+"&consignadoa="+document.forms.form1.consignadoa.value+"&distritoconsignado="+document.forms.form1.distritoconsignado.value+"&direccionconsignado="+document.forms.form1.direccionconsignado.value+"&contacto="+document.forms.form1.contacto.value+"&forma_pago="+document.forms.form1.forma_pago.value+"&autorizadopor="+document.forms.form1.autorizadopor.value+"&tipo_envio="+document.forms.form1.tipo_envio.value+"&peso="+document.forms.form1.peso.value+"&recibidopor="+document.forms.form1.recibidopor.value+"&tipo_servicio="+document.forms.form1.tipo_servicio.value+"&recepcionadopor="+document.forms.form1.recepcionadopor.value+"&dni="+document.forms.form1.dni.value+"&fecha2="+document.forms.form1.fecha2.value+"&hora="+document.forms.form1.hora.value+"&observaciones="+document.forms.form1.observaciones.value+"&cantidad="+document.forms.form1.cantidad.value, "ventana", "resizable,height=140,width=500");
}


function agregar_empresa()
{
	window.open("nuevaempresa.php?fecha="+document.forms.form1.fecha.value+"&ciudad_origen="+document.forms.form1.ciudad_origen.value+"&courier_destino="+document.forms.form1.courier_destino.value+"&ciudad_destino="+document.forms.form1.ciudad_destino.value+"&empresa_remite="+document.forms.form1.empresa_remite.value+"&cargoremitente="+document.forms.form1.cargoremitente.value+"&consignadoa="+document.forms.form1.consignadoa.value+"&distritoconsignado="+document.forms.form1.distritoconsignado.value+"&direccionconsignado="+document.forms.form1.direccionconsignado.value+"&contacto="+document.forms.form1.contacto.value+"&forma_pago="+document.forms.form1.forma_pago.value+"&autorizadopor="+document.forms.form1.autorizadopor.value+"&tipo_envio="+document.forms.form1.tipo_envio.value+"&peso="+document.forms.form1.peso.value+"&recibidopor="+document.forms.form1.recibidopor.value+"&tipo_servicio="+document.forms.form1.tipo_servicio.value+"&recepcionadopor="+document.forms.form1.recepcionadopor.value+"&dni="+document.forms.form1.dni.value+"&fecha2="+document.forms.form1.fecha2.value+"&hora="+document.forms.form1.hora.value+"&observaciones="+document.forms.form1.observaciones.value+"&cantidad="+document.forms.form1.cantidad.value, "ventana", "resizable,height=140,width=500");
}

function agregar_area()
{
	window.open("nuevaarea.php?fecha="+document.forms.form1.fecha.value+"&ciudad_origen="+document.forms.form1.ciudad_origen.value+"&courier_destino="+document.forms.form1.courier_destino.value+"&ciudad_destino="+document.forms.form1.ciudad_destino.value+"&empresa_remite="+document.forms.form1.empresa_remite.value+"&cargoremitente="+document.forms.form1.cargoremitente.value+"&consignadoa="+document.forms.form1.consignadoa.value+"&distritoconsignado="+document.forms.form1.distritoconsignado.value+"&direccionconsignado="+document.forms.form1.direccionconsignado.value+"&contacto="+document.forms.form1.contacto.value+"&forma_pago="+document.forms.form1.forma_pago.value+"&autorizadopor="+document.forms.form1.autorizadopor.value+"&tipo_envio="+document.forms.form1.tipo_envio.value+"&peso="+document.forms.form1.peso.value+"&recibidopor="+document.forms.form1.recibidopor.value+"&tipo_servicio="+document.forms.form1.tipo_servicio.value+"&recepcionadopor="+document.forms.form1.recepcionadopor.value+"&dni="+document.forms.form1.dni.value+"&fecha2="+document.forms.form1.fecha2.value+"&hora="+document.forms.form1.hora.value+"&observaciones="+document.forms.form1.observaciones.value+"&cantidad="+document.forms.form1.cantidad.value, "ventana", "resizable,height=140,width=500");
}


function ver_listado(){
	document.forms.form1.action='listar_cargos.php';
	document.forms.form1.method='post';
	document.forms.form1.submit();
}



function suma_cantidades(){
	
/*	if (parseInt(document.forms.form1.cantidad.value)<parseInt(document.forms.form1.cant_vexcesivo.value)+parseInt(document.forms.form1.cant_vmaximo.value)+parseInt(document.forms.form1.cant_vsimple.value)){
	
			
			//document.forms.form1.cantidad.focus();
			alert("El numero ingresado supera la cantidad");
			return false;
	
	}*/
}

function calcular_kgnuevo(){
	
	if (document.forms.form1.cantidad.value>1){
	
		document.forms.form1.peso.value=parseFloat(document.forms.form1.peso.value)-parseInt(document.forms.form1.cantidad.value);
	}
}


<!--  
ap_showWaitMessage('waitDiv', 0);  
//--> 
</SCRIPT> 

<?php $cargo->con->cerrar();?>