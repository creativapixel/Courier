<?php 

session_start();
require_once('../clases/cargocourier_data.php');

$cargo = new  cargocourierdata();
$empresas = new  empresasdata();
$auxiliares = new  auxiliaresdata();

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

if (isset($_REQUEST['cargo_id']))
	{ 	
		$_SESSION['cargo_codigo']=$_REQUEST['cargo_id'];		
		
 	}



if($_REQUEST['id']==='1')
{

	//$volumen,$tiposervicio,$tipoenvio,$formapago,$ciudadaorigen,$empresa,$courier,$fecha,$consigandoa,$distrito,$direccion,$cargo,$contacto,$autorizadopor,$peso,$recibidopor,$recepcionadopor,$dni,$fecharecepcion,$hora,$observaciones,$eliminado,$ciudadorigen)
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
	if($_REQUEST['vol_estandar']!='5')
	{
		$_REQUEST['vol_estandar']='4';
	}
	  		
	$rs= $cargo->cargocourier_editar($_SESSION['cargo_codigo'],$_REQUEST['vol_excesivo'],$_REQUEST['tipo_servicio'],$_REQUEST['tipo_envio'],$_REQUEST['forma_pago'],$_REQUEST['ciudad_destino'],$_REQUEST['empresa_remite'],$_REQUEST['courier_destino'],$_REQUEST['fecha'],$_REQUEST['consignadoa'],$_REQUEST['distritoconsignado'],$_REQUEST['direccionconsignado'],$_REQUEST['cargoremitente'],$_REQUEST['contacto'],$_REQUEST['autorizadopor'],$_REQUEST['peso'],$_REQUEST['recibidopor'],$_REQUEST['recepcionadopor'],$_REQUEST['dni'],$_REQUEST['fecha2'],$_REQUEST['hora'],$_REQUEST['observaciones'],'0',$_REQUEST['ciudad_origen'],$_REQUEST['cantidad'],$_REQUEST['costoservicio'],$_REQUEST['centrocosto'],$_REQUEST['costovolumen'],$_REQUEST['embalaje'],$_REQUEST['fragilidad'],$_REQUEST['costoembalaje'],$_REQUEST['costofragilidad'],$_REQUEST['subtotal'],$_REQUEST['igv'],$_REQUEST['total'],$_REQUEST['costokg'],$_REQUEST['primerkg'],$_REQUEST['kgadicional'],$_REQUEST['zona'],$_REQUEST['vol_maximo'],$_REQUEST['vol_simple'],$_REQUEST['cant_vexcesivo'],$_REQUEST['cant_vmaximo'],$_REQUEST['cant_vsimple'],$_REQUEST['costovolumen_excesivo'],$_REQUEST['costovolumen_maximo'],$_REQUEST['costovolumen_simple'],$_REQUEST['cant_embalaje'],$_REQUEST['cant_fragilidad'],$_REQUEST['igv_incluye'],$_REQUEST['vol_estandar'],$_REQUEST['cant_vestandar'],$_REQUEST['costovolumen_estandar'],$_REQUEST['costo_zona']																																																																																																																																																																																																																																																																									);

}	
	
$cargo->cargocourier_ver($_SESSION['cargo_codigo']);	


if($_REQUEST['id']!='2')
{

$_REQUEST['fecha']=$cargo->util->obtienefecha($cargo->carcou_fecha);
$_REQUEST['centrocosto']=$cargo->carcou_centrocosto; 
$_REQUEST['consignadoa']=$cargo->carcou_consignadoa;
$_REQUEST['distritoconsignado']=$cargo->carcou_distrito;
$_REQUEST['direccionconsignado']=$cargo->carcou_direccion;
$_REQUEST['contacto']= $cargo->carcou_contacto;
$_REQUEST['autorizadopor']=$cargo->carcou_autorizadopor;
$_REQUEST['cantidad']=$cargo->carcou_cantidad;
$_REQUEST['costovolumen']=$cargo->carcou_costovolumen;
$_REQUEST['peso']=$cargo->carcou_peso;
$_REQUEST['primerkg']=$cargo->carcou_costoprimerkg;
$_REQUEST['kgadicional']=$cargo->carcou_costokgadicional;
$_REQUEST['costoservicio']=$cargo->carcou_costoservicio;
$_REQUEST['recibidopor']=$cargo->carcou_recibidopor;
$_REQUEST['observaciones']=$cargo->carcou_observaciones;
$_REQUEST['subtotal']= $cargo->carcou_subtotal;
$_REQUEST['igv']= $cargo->carcou_igv;
$_REQUEST['total']= $cargo->carcou_total;
$_REQUEST['recepcionadopor']=$cargo->carcou_recepcionadopor;
$_REQUEST['dni']=$cargo->carcou_dni;
$_REQUEST['fecha2']=$cargo->util->obtienefecha($cargo->carcou_fecharecepcion);
$_REQUEST['hora']=$cargo->carcou_hora;

$_REQUEST['zona']=$cargo->zon_id;
$_REQUEST['fragilidad']=$cargo->fra_id;
$_REQUEST['embalaje']=$cargo->emb_id;
$_REQUEST['area']=$cargo->area_id;
$_REQUEST['volumen']=$cargo->vol_id;
$_REQUEST['tipo_servicio']=$cargo->tiposerv_id;
$_REQUEST['tipo_envio']=$cargo->tipoenv_id;
$_REQUEST['forma_pago']=$cargo->formpago_id;
$_REQUEST['ciudad_destino']=$cargo->ciu_id;
$_REQUEST['ciudad_origen']=$cargo->carcou_ciudadorigen;
$_REQUEST['empresa_remite']=$cargo->emprem_id;
$_REQUEST['courier_destino']=$cargo->empcou_id;

$_REQUEST['cant_embalaje']=$cargo->cant_embalaje;
$_REQUEST['cant_fragilidad']=$cargo->cant_fragilidad;
$_REQUEST['cant_vexcesivo']=$cargo->cant_vexcesivo;
$_REQUEST['cant_vmaximo']=$cargo->cant_vmaximo;
$_REQUEST['cant_vsimple']=$cargo->cant_vsimple;
$_REQUEST['costovolumen_excesivo']=$cargo->costo_vexcesivo;
$_REQUEST['costovolumen_maximo']=$cargo->costo_vmaximo;
$_REQUEST['costovolumen_simple']=$cargo->costo_vsimple;

$_REQUEST['vol_excesivo']=$cargo->vol_excesivo;
$_REQUEST['vol_maximo']=$cargo->vol_maximo;
$_REQUEST['vol_simple']=$cargo->vol_simple;

$_REQUEST['igv_incluye']=$cargo->carcou_incluyeigv;

$_REQUEST['vol_estandar']=$cargo->vol_estandar;
$_REQUEST['costovolumen_estandar']=$cargo->costo_vestandar;
$_REQUEST['cant_vestandar']=$cargo->cant_vestandar;

	if($cargo->costo_zona=='0.00')
	{
		$_REQUEST['costo_zona']='';
	}
	else
	{
		$_REQUEST['costo_zona']=$cargo->costo_zona;
	}

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

</table>
<form id="form1" name="form1" >
<table width="672" border="0" align="center">
  <tr>
    <td colspan="6"><img src="../archivos/titulo_editarcargo.png" width="382" height="36" /></td>
    </tr>
  <tr>
    <td align="right" class="color_celda">Nro. Cargo : </td>
    <td align="center" class="color_celda">&nbsp;</td>
    <td colspan="4" class="color_celda"><?php echo $_SESSION['cargo_codigo'];?></td>
  </tr>
  <tr>
    <td width="187" align="right" class="color_celda">Fecha Emisi&oacute;n </td>
    <td width="15" align="center" class="color_celda">:</td>
    <td colspan="4">
		<input name="fecha" type="text" id="fecha" value="<?php echo $_REQUEST['fecha']; ?>" size="10"  onkeyup='fn(this.form,this)'/>
        <a style='cursor:hand;' onclick='document.form1.fecha.oldValue=document.form1.fecha.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fecha, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a>	<input name="id" type="hidden" id="id" /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Incluye IGV</td>
    <td align="center" class="color_celda">:</td>
    <td bgcolor="#FFDBB7"><input name="igv_incluye" type="radio" value="1" <?php if($_REQUEST['igv_incluye']=='1'){?>checked="checked"<?php } ?> onclick="calcular()"  />
        <span class="enfasis">S&iacute;</span></td>
    <td bgcolor="#FFDBB7"><input name="igv_incluye" type="radio" value="0" <?php if($_REQUEST['igv_incluye']=='0'){?>checked="checked"<?php } ?> onclick="calcular()" />
        <span class="enfasis">No</span></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Ciudad Origen</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php  	
					$auxiliares->generar_select_ciudad('ciudad_origen','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Courier Destino</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php  	
					$empresas->generar_select_courier('courier_destino','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Zona Destino  </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php  	$auxiliares->generar_select_zona('zona','calcular()',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Costo alternativo zona</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4" bgcolor="#FFFFFF"><input name="costo_zona" type="text" id="costo_zona" value="<?php echo $_REQUEST['costo_zona']; ?>" size="10" onblur="calcular()" />
      (Ingresando un valor, anulara el costo de zona destino por defecto)</td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Ciudad Destino </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php  	
					$auxiliares->generar_select_ciudad('ciudad_destino','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Empresa Remitente </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php  	
					$empresas->generar_select_empresas('empresa_remite','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">N&ordm; Centro Costo </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="centrocosto" type="text" id="centrocosto" value="<?php echo $_REQUEST['centrocosto']; ?>" /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Cargo (Area) </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php  	
					$auxiliares->generar_select_area('cargoremitente','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Consignado a </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="consignadoa" type="text" id="consignadoa" value="<?php echo $_REQUEST['consignadoa']; ?>" size="50" onkeyup='fn(this.form,this)' onchange='mayusculas(this);' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Distrito Consignado </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="distritoconsignado" type="text" id="distritoconsignado" value="<?php echo $_REQUEST['distritoconsignado']; ?>" size="50" onkeyup='fn(this.form,this)' onchange='mayusculas(this);' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Direcci&oacute;n Consignado </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="direccionconsignado" type="text" id="direccionconsignado" value="<?php echo $_REQUEST['direccionconsignado']; ?>" size="50" onkeyup='fn(this.form,this)' onchange='mayusculas(this);' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Contacto</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="contacto" type="text" id="contacto" value="<?php echo $_REQUEST['contacto']; ?>" size="50" onkeyup='fn(this.form,this)' onchange='mayusculas(this);' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Forma de Pago </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php  	
					$auxiliares->generar_select_formapago('forma_pago','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Autorizado por </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="autorizadopor" type="text" id="autorizadopor" value="<?php echo $_REQUEST['autorizadopor']; ?>"  size="50" onkeyup='fn(this.form,this)' onchange='mayusculas(this);' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Tipo de Envio </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php  	
					$auxiliares->generar_select_tipoenvio('tipo_envio','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Cantidad</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="cantidad" type="text" id="cantidad" value="<?php echo $_REQUEST['cantidad']; ?>" size="10" onkeyup='fn(this.form,this)' onblur="calcular()" /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Volumen</td>
    <td align="center" class="color_celda">:</td>
    <td width="112" align="left" class="color_celda">
      Excesivo 
      <input name="vol_excesivo" type="checkbox" id="vol_excesivo" value="3" <?php if($_REQUEST['vol_excesivo']=='3'){?>checked="checked"<?php } ?>  onkeyup='fn(this.form,this)' /></td>
    <td width="112" align="left" class="color_celda">M&aacute;ximo
<input name="vol_maximo" type="checkbox" id="vol_maximo" value="2" <?php if($_REQUEST['vol_maximo']=='2'){?>checked="checked"<?php } ?>  onkeyup='fn(this.form,this)' /></td>
    <td width="109" align="left" class="color_celda">Simple
      <input name="vol_simple" type="checkbox" id="vol_simple" value="1" <?php if($_REQUEST['vol_simple']=='1'){?>checked="checked"<?php } ?>  onkeyup='fn(this.form,this)' />
      <?php  	
	  
	 
	  
	  
					//$auxiliares->generar_select_volumen('volumen','',''); ?></td>
    <td width="109" align="left" class="color_celda">Estandar 
      <input name="vol_estandar" type="checkbox" id="vol_estandar" value="5" <?php if($_REQUEST['vol_estandar']=='5'){?>checked="checked"<?php } ?>  onkeyup='fn(this.form,this)' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Cantidad con Volumen</td>
    <td align="center" class="color_celda">:</td>
    <td><input name="cant_vexcesivo" type="text" id="cant_vexcesivo" value="<?php echo $_REQUEST['cant_vexcesivo']; ?>" size="14"  onkeyup='fn(this.form,this)' onblur="suma_cantidades()" /></td>
    <td><input name="cant_vmaximo" type="text" id="cant_vmaximo" value="<?php echo $_REQUEST['cant_vmaximo']; ?>" size="14"  onkeyup='fn(this.form,this)' onblur="suma_cantidades()" /></td>
    <td><input name="cant_vsimple" type="text" id="cant_vsimple" value="<?php echo $_REQUEST['cant_vsimple']; ?>" size="14"  onkeyup='fn(this.form,this)' onblur="suma_cantidades()" /></td>
    <td><input name="cant_vestandar" type="text" id="cant_vestandar" value="<?php echo $_REQUEST['cant_vestandar']; ?>" size="14" /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Costo Volumen (S/.)</td>
    <td align="center" class="color_celda">:</td>
    <td><input name="costovolumen_excesivo" type="text" id="costovolumen_excesivo" value="<?php echo number_format($_REQUEST['costovolumen_excesivo'],2); ?>" size="14"  onkeyup='fn(this.form,this)' onblur="calcular()" /></td>
    <td><input name="costovolumen_maximo" type="text" id="costovolumen_maximo" value="<?php echo number_format($_REQUEST['costovolumen_maximo'],2); ?>" size="14"  onkeyup='fn(this.form,this)' onblur="calcular()" /></td>
    <td><input name="costovolumen_simple" type="text" id="costovolumen_simple" value="<?php echo number_format($_REQUEST['costovolumen_simple'],2); ?>" size="14"  onkeyup='fn(this.form,this)' onblur="calcular()" /></td>
    <td><input name="costovolumen_estandar" type="text" id="costovolumen_estandar" value="<?php echo number_format($_REQUEST['costovolumen_estandar'],2); ?>" size="14"  onkeyup='fn(this.form,this)' onblur="calcular()" /></td>
  </tr>
  
   <?php
  	
	if ($_REQUEST['vol_excesivo']=='3')
	{
		$costo_vexcesivo=$_REQUEST['cant_vexcesivo']*$_REQUEST['costovolumen_excesivo'];
	}
	else
	{
		$costo_vexcesivo=0;

	}
	
	if ($_REQUEST['vol_maximo']=='2')
	{
		$costo_vmaximo=$_REQUEST['cant_vmaximo']*$_REQUEST['costovolumen_maximo'];
	}
	else
	{
		$costo_vmaximo=0;

	}
	
	if ($_REQUEST['vol_simple']=='1')
	{			
   		$costo_vsimple=$_REQUEST['cant_vsimple']*$_REQUEST['costovolumen_simple'];
	}
	else
	{
		$costo_vsimple=0;
				
	}
	
	if ($_REQUEST['vol_estandar']=='5')
	{			
   		$costo_vestandar=$_REQUEST['cant_vestandar']*$_REQUEST['costovolumen_estandar'];
	}
	else
	{
		$costo_vestandar=0;
				
	}
	
	$totalcostovolumen=$costo_vexcesivo+$costo_vmaximo+$costo_vsimple+$costo_vestandar;	
  ?> 
  
  <tr>
    <td align="right" class="color_celda"><input name="costovolumen" type="hidden" value="<?php echo $totalcostovolumen; ?>" />
      Peso (Kg.) </td>
    <td align="center" class="color_celda">:</td>
    <td><input name="peso" type="text" id="peso" value="<?php echo $_REQUEST['peso'] ?>" size="15" onkeyup='fn(this.form,this)' onblur="calcular()" />
      
	  
	<?php 
	 
	 
	 		if($_REQUEST['costo_zona']=='')
			{
	 			$costo_kg = $auxiliares->devuelve_preciokg($_REQUEST['zona']);
			}
			else
			{
				
				$costo_kg = $_REQUEST['costo_zona'];
			}//$primer_kg = $cargo->calcula_primerkg($_REQUEST['peso'],$costo_kg);	 
	 
			//$primer_kg = $cargo->calcula_primerkg($_REQUEST['peso'],$costo_kg);
			$kg_adicional = $cargo->calcula_kgadicional($_REQUEST['peso'],$costo_kg,$_REQUEST['cantidad']);
	?>	</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Costo Primer Kg. (S/.): </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="primerkg" type="text" id="primerkg" value="<?php echo number_format($_REQUEST['primerkg'],2); ?>"  onkeyup='fn(this.form,this)' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Costo Kg. Adicional (S/.)</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="kgadicional" type="text" id="kgadicional" value="<?php echo number_format($kg_adicional,2); ?>"  onkeyup='fn(this.form,this)'  />     </td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Tipo de Servicio </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php  	
					$auxiliares->generar_select_tiposervicio('tipo_servicio','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Costo Servicio (S/.)</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="costoservicio" type="text" id="costoservicio" value="<?php echo number_format( $_REQUEST['costoservicio'],2); ?>" size="15"  onkeyup='fn(this.form,this)' onblur="calcular()"/></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Embalaje</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php $auxiliares->generar_select_embalaje('embalaje','calcular()',''); ?>
      <?php if($_REQUEST['embalaje']!=4){ ?>
      <input name="cant_embalaje" type="text" id="cant_embalaje" value="<?php echo $_REQUEST['cant_embalaje']; ?>" size="5" onblur="calcular()" />
      <?php } ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Fragilidad</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php $auxiliares->generar_select_fragilidad('fragilidad','calcular()',''); ?>
      <?php if($_REQUEST['fragilidad']!=3){ ?>
      <input name="cant_fragilidad" type="text" id="cant_fragilidad" value="<?php echo $_REQUEST['cant_fragilidad']; ?>" size="5" onblur="calcular()" />
      <?php } ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Recibido en Courier por </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4">
	
	<?php 
	
			$precioembalaje = $_REQUEST['cant_embalaje']*$auxiliares->devuelve_precioembalaje($_REQUEST['embalaje']);
			$preciofragilidad = $_REQUEST['cant_fragilidad']*$auxiliares->devuelve_preciofragilidad($_REQUEST['fragilidad']);
	
	?>
	<input name="recibidopor" type="text" id="recibidopor" value="<?php echo $_REQUEST['recibidopor']; ?>" size="50" onkeyup='fn(this.form,this)' />
	<input name="costofragilidad" type="hidden" id="costofragilidad" value="<?php echo $preciofragilidad;?>" />
	<input name="costoembalaje" type="hidden" id="costoembalaje" value="<?php echo $precioembalaje; ?>" /></td>
  </tr>
  <tr>
    <td align="right" valign="top" class="color_celda">Observaciones</td>
    <td align="center" valign="top" class="color_celda">:</td>
    <td colspan="4"><textarea name="observaciones" cols="65" rows="6" id="observaciones" onkeyup='fn(this.form,this)'><?php echo $_REQUEST['observaciones']; ?></textarea></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Subtotal (S/.) </td>
    <td align="center" valign="top" class="color_celda">:</td>
	 <td colspan="4"><?php 	
	/*echo "costo kg ".$costo_kg."<br>"; 
	echo "vol ".$_REQUEST['costovolumen']."<br>";
	 echo "1er ".$primer_kg."<br>";
	 echo "adic ".$kg_adicional."<br>";
	 echo "serv ".$_REQUEST['costoservicio']."<br>";
	 echo "emb ".$precioembalaje."<br>";
	 echo "frag ".$preciofragilidad."<br>";*/

	$primer_kg=$_REQUEST['primerkg'];
	 
	if ($_REQUEST['igv_incluye']=='0')
	{
	
		$costo_subtotal = $totalcostovolumen + ($primer_kg*$_REQUEST['cantidad']) + $kg_adicional + $_REQUEST['costoservicio'] + $precioembalaje + $preciofragilidad;		
		$valor_igv=$costo_subtotal * $auxiliares->devuelve_igv();
		$costo_total=$costo_subtotal + $valor_igv;	
	
	}
	
	if($_REQUEST['igv_incluye']=='1')
	{
		$costo_total=$totalcostovolumen + ($primer_kg*$_REQUEST['cantidad']) + $kg_adicional + $_REQUEST['costoservicio'] + $precioembalaje + $preciofragilidad;
		$costo_subtotal=$costo_total/(1 + $auxiliares->devuelve_igv());
		$valor_igv=$costo_total-$costo_subtotal;
	}
	
	?>
	 <input name="subtotal" type="text" id="subtotal" value="<?php echo number_format($costo_subtotal,2); ?>" size="15" onkeyup='fn(this.form,this)' /> 
    (Volum. +  1er Kg + Kg Adic. +  Servic. +  Emb. + Frag.) </td>
  </tr>
  <tr>
    <td align="right" class="color_celda">IGV (S/.)</td>
    <td align="center" valign="top" class="color_celda">:</td>
	
    <td colspan="4"><input name="igv" type="text" id="igv" value="<?php echo number_format($valor_igv,2);?>" size="15" onkeyup='fn(this.form,this)'   /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Total (S/.)</td>
    <td align="center" valign="top" class="color_celda">:</td>
    <td colspan="4"><input name="total" type="text" id="total" size="15" value="<?php echo number_format($costo_total,2);?>" onkeyup='fn(this.form,this)' /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Recepcionado por </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="recepcionadopor" type="text" id="recepcionadopor" value="<?php echo $_REQUEST['recepcionadopor']; ?>" size="50" onkeyup='fn(this.form,this)' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">DNI</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="dni" type="text" id="dni" value="<?php echo $_REQUEST['dni']; ?>" size="20" onkeyup='fn(this.form,this)' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Fecha de Recepci&oacute;n </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4">
			<input name="fecha2" type="text" id="fecha2" value="<?php echo $_REQUEST['fecha2']; ?>" size="10"  onkeyup='fn(this.form,this)'/>
        <a style='cursor:hand;' onclick='document.form1.fecha2.oldValue=document.form1.fecha2.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fecha2, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a>	</td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Hora de Recepci&oacute;n </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="hora" type="text" id="hora" value="<?php echo $_REQUEST['hora']; ?>" size="20" onkeyup='fn(this.form,this)' />	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4"><input name="Submit" type="button" class="btn" value="Editar Cargo" onclick="nuevo()" />
      &nbsp;
      <input name="Submit2" type="button" class="btn" value="Ver listado de cargos" onclick="ver_listado()" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
    </form>

</body>
</html>
<script src="../javascript/valida.js">  </script>
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

	/*if (document.forms.form1.cargoremitente.value=="")
	{ 
			document.forms.form1.cargoremitente.focus();
			alert("Ingresar El Cargo que ocupa Remitente");
			return false; 
	}*/
	
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
	
			

document.forms.form1.action='editar_cargo.php';
document.forms.form1.method='post';
document.forms.form1.id.value='1'
document.forms.form1.submit();
}

function ver_listado(){
	document.forms.form1.action='listar_cargos.php';
	document.forms.form1.method='post';
	document.forms.form1.submit();
}

function calcular(){
	document.forms.form1.action='editar_cargo.php';
	document.forms.form1.method='post';
	document.forms.form1.id.value='2'	
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