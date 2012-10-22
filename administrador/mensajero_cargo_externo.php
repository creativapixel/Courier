<?php 
set_time_limit(0);
session_start();
require_once('../clases/cargoexterno_data.php');

$cargo_externo = new  cargo_externo_data();
$empresas = new  empresasdata();
$auxiliares = new  auxiliaresdata();
$mensajero = new Mensajero;

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

if($_REQUEST['id']=='1')
{
	for($i=1;$i<=$_REQUEST['nro_cargos'];$i++)
	{
		if($_REQUEST['cargo'.$i.'']!='')
		{
			$cargo_externo->cargo_externo_asignar($_REQUEST['fecha'],$_REQUEST['cargo'.$i.''],$_REQUEST['courier_destino'],$_REQUEST['mensajero']);
		}
	}
	

}

if($_REQUEST['id']==='2')
{
	$cargo_externo->cargo_externo_no_asignar($_REQUEST['campos']);
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
    <td colspan="6"><img src="../archivos/titulo_generarcargo.png" /></td>
    </tr>
  <tr>
    <td width="179" align="right" class="color_celda">Fecha Salida</td>
    <td width="19" align="center" class="color_celda">:</td>
    <td width="416" colspan="4">
		<input name="fecha" type="text" id="fecha" value="<?php echo $_REQUEST['fecha']; ?>" size="10"  onkeyup='fn(this.form,this)'/>
        <a style='cursor:hand;' onclick='document.form1.fecha.oldValue=document.form1.fecha.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fecha, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a>	<input name="id" type="hidden" id="id" /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Courier Destino</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php  	
					$empresas->generar_select_courier('courier_destino','',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Mensajero</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><?php $mensajero->generar_select_mensajero('mensajero','');?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Nro de Cargos</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="4"><input name="nro_cargos" type="text" id="nro_cargos" size="5" />
      <input name="button" type="button" class="btn" id="button" value="Generar campos" onclick="generar_campos()" /></td>
  </tr>
  <?php if($_REQUEST['id']!='1'){ ?>
  <tr>
    <td align="right" valign="top" class="color_celda">Cargo </td>
    <td align="center" valign="top" class="color_celda">:</td>
    <td colspan="4"><div id="moreUploads"></div></td>
  </tr>
  <?php } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4"><?php if(($_REQUEST['id']!=1) && ($_REQUEST['id']!=2)){?><input name="Submit" type="button" class="btn" value="Asignar Cargo" onclick="nuevo()" /><?php } ?>
      &nbsp;
      <label>
        <input name="button2" type="button" class="btn" id="button2" value="Nuevo" onclick="remover_campos()" />
      </label>
      <input name="Submit2" type="button" class="btn" value="Ver listado de cargos" onclick="ver_listado()" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
  </tr>
</table>
<?php

if(($_REQUEST['id']=='1') || ($_REQUEST['id']=='2'))
{

$rs = $cargo_externo->cargo_externo_listar('0','',$_REQUEST['courier_destino'],$_REQUEST['mensajero'],'','','',$_REQUEST['fecha']);

?>
<table width="245" border="0" align="center">
  <tr class="fondonegro">
    <td width="176" align="center">Cargo</td>
    <td width="59" align="center"><label>
      <input name="button3" type="button" class="btn" id="button3" value="No asignar" onclick="validar_checkbox_seleccionados(1)" />
    </label></td>
  </tr>
<?php
$total=0;
while($campo = mysql_fetch_array($rs))
{
?>  
  <tr class="color_celda">
    <td align="center"><?php echo $campo['carex_nro_cargo'];?></td>
    <td align="center"><label>
      <input type="checkbox" name="campos[<?php echo $campo['carex_id']; ?>]" id="checkbox" />
    </label></td>
  </tr>

<?php 
$total = $total + 1;
} ?> 
	<tr class="color_celda">
    <td colspan="2" align="center">Total cargos: <?php echo $total;?></td>
    </tr>
</table>
<?php } ?>

<p>&nbsp;</p>
</form>

</body>
</html>
<script src="../javascript/valida.js">  </script>
<SCRIPT language="javascript">



function generar_campos()
{
	campos = document.forms.form1.nro_cargos.value;

	for (i=1; i<=campos; i++)
	{
		var d = document.createElement("div");
		var file = document.createElement("input");
		file.setAttribute("type", "text");
		file.setAttribute("name", "cargo"+i);
		file.setAttribute("id","cargo"+i);
		//file.setAttribute("value",i);
		file.setAttribute("onkeyup", "tabular(event,this)");

		d.appendChild(file);
		document.getElementById("moreUploads").appendChild(d);
	}
	
	document.forms.form1.button.disabled=true;
	//document.forms.form1.button2.disabled=true;

}

function remover_campos()
{
	document.forms.form1.action='mensajero_cargo_externo.php';
	document.forms.form1.method='POST';
	document.forms.form1.submit();
}

function nuevo()
{


	
	if (!Esnum(document.forms.form1.nro_cargos.value))
	{
		document.forms.form1.nro_cargos.focus();
	 	alert("Ingrese un valor numerico para la cantidad de cargos");
	 	return false;
	}		

	if (document.forms.form1.nro_cargos.value=="")
	{ 
			document.forms.form1.nro_cargos.focus();
			alert("Ingrese la cantidad de cargos");
			return false; 
	}

			
	
	if (document.forms.form1.fecha.value=="")
	{ 
			document.forms.form1.fecha.focus();
			alert("Ingresar Fecha de Envio");
			return false; 
	}
	
	document.forms.form1.action='mensajero_cargo_externo.php';
	document.forms.form1.method='POST';
	document.forms.form1.id.value='1'
	document.forms.form1.submit();
}

function  borrar()
{

/*	todos=document.getElementsByTagName('input');
	
	for(x=0;x<todos.length;x++){
	
		if(todos[x].type=="checkbox" && todos[x].checked){*/
		
			if (confirm("¿Seguro que desea eliminar los registros seleccionados?"))
			{
   				document.forms.form1.id.value='2';
   				document.forms.form1.action='mensajero_cargo_externo.php';
   				document.forms.form1.method='post';
   				document.forms.form1.submit();
			}
	
			else
			{
				return false; 
			} 
			
/*		}
	}
	
	alert("Seleccione al menos 1 elemento a eliminar");
	return false;			
	
*/
}

function validar_checkbox_seleccionados(f){

	todos=document.getElementsByTagName('input');
	
	for(x=0;x<todos.length;x++){
		if(todos[x].type=="checkbox" && todos[x].checked){
			return borrar();
		}
	}

	alert("Seleccione al menos 1 elemento a eliminar");
	return false;
}


<!--  
ap_showWaitMessage('waitDiv', 0);  
//--> 
</SCRIPT> 

<?php $cargo_externo->con->cerrar();?>