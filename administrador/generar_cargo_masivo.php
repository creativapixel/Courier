<?php 

session_start();
require_once('../clases/cargomasivo_data.php');

$cargo = new  cargomasivodata();
$empresas = new  empresasdata();
$auxiliares = new  auxiliaresdata();

if(!isset($_SESSION['usu_id']))
{
	die("No tiene acceso  a esta seccion");
}

if(!isset($_REQUEST['ciudad_origen']))
{
	$_REQUEST['ciudad_origen']='2';
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

	$rs= $cargo->cargomasivo_nuevo($_REQUEST['ciudad_destino'],$_REQUEST['zona'],$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['consignadoa'],$_REQUEST['area'],$_REQUEST['distritoconsignado'],$_REQUEST['direccionconsignado'],$_REQUEST['recepcionadopor'],$_REQUEST['dni'],$_REQUEST['parentesco'],'0',$_REQUEST['telefono']);
				

$_REQUEST['consignadoa']="";
$_REQUEST['distritoconsignado']="";
$_REQUEST['direccionconsignado']="";
$_REQUEST['recepcionadopor']="";
$_REQUEST['dni']="";
$_REQUEST['telefono']="";


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
<table width="638" border="0" align="center">
  <tr>
    <td colspan="5"><img src="../archivos/titulo_generarcargo.png" /></td>
    </tr>
  <tr>
    <td width="179" align="right" class="color_celda">Fecha Emisi&oacute;n </td>
    <td width="19" align="center" class="color_celda">:</td>
    <td width="418" colspan="3">
		<input name="fecha" type="text" id="fecha" value="<?php echo $_REQUEST['fecha']; ?>" size="10"  onkeyup='fn(this.form,this)'/>
        <a style='cursor:hand;' onclick='document.form1.fecha.oldValue=document.form1.fecha.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fecha, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a>	<input name="id" type="hidden" id="id" /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Zona Destino  </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><?php  	$auxiliares->generar_select_zona_masivo('zona','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Ciudad Destino </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><?php  	
					$auxiliares->generar_select_ciudad('ciudad_destino','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Empresa Remitente </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><?php  	
					$empresas->generar_select_empresas('empresa_remite','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Cargo (Area) </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><?php  	
					$auxiliares->generar_select_area('area','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Consignado a </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="consignadoa" type="text" id="consignadoa" value="<?php echo $_REQUEST['consignadoa']; ?>" size="50" onkeyup='fn(this.form,this)' onchange='mayusculas(this);' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Distrito Consignado </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="distritoconsignado" type="text" id="distritoconsignado" value="<?php echo $_REQUEST['distritoconsignado']; ?>" size="50" onkeyup='fn(this.form,this)' onchange='mayusculas(this);' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Direcci&oacute;n Consignado </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="direccionconsignado" type="text" id="direccionconsignado" value="<?php echo $_REQUEST['direccionconsignado']; ?>" size="50" onkeyup='fn(this.form,this)' onchange='mayusculas(this);' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Tel&eacute;fono</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><label>
      <input name="telefono" type="text" id="telefono" value="<?php echo $_REQUEST['telefono']; ?>" />
    </label></td>
  </tr>

  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Recepcionado por </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="recepcionadopor" type="text" id="recepcionadopor" value="<?php echo $_REQUEST['recepcionadopor']; ?>" size="50" onkeyup='fn(this.form,this)' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">DNI</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="dni" type="text" id="dni" value="<?php echo $_REQUEST['dni']; ?>" size="20" onkeyup='fn(this.form,this)' /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Parentesco</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="parentesco" type="text" id="parentesco" value="<?php echo $_REQUEST['parentsco']; ?>" /></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3"><input name="Submit" type="button" class="btn" value="Registrar Cargo" onclick="nuevo()" />
      &nbsp;
      <input name="Submit2" type="button" class="btn" value="Ver listado de cargos" onclick="ver_listado()" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
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
			

document.forms.form1.action='generar_cargo_masivo.php';
document.forms.form1.method='post';
document.forms.form1.id.value='1'
document.forms.form1.submit();
}


function ver_listado(){
	document.forms.form1.action='listar_cargos_masivo.php';
	document.forms.form1.method='post';
	document.forms.form1.submit();
}



<!--  
ap_showWaitMessage('waitDiv', 0);  
//--> 
</SCRIPT> 

<?php $cargo->con->cerrar();?>