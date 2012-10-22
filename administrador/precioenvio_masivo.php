<?php 

session_start();
require_once('../clases/preciosenvio_data.php');
$precioenvio = new  preciosenviodata();
$empresas = new  empresasdata();
$ubigeo= new ubigeo_data();
$zonaenvio= new zonaenvio_data();
$plazoentrega= new plazoentrega_data();


if(!isset($_SESSION['usu_id']))
{
	die("No tiene acceso  a esta seccion");
}

if(!isset($_REQUEST['ciudad_origen']))
{
	$_REQUEST['ciudad_origen']='2';
}

if($_REQUEST['id']==='2')
{
	$precioenvio->precioenviomasivo_borrar($_POST['campos']);
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
//	function precioenviomasivo_nuevo($zona,$empresa,$minimo,$preciminimo,$maxima,$preciomaxima)
	$rs= $precioenvio->precioenviomasivo_nuevo($_REQUEST['zona'],$_REQUEST['empresa_remite'],$_REQUEST['cantminima'],$_REQUEST['preciominima'],$_REQUEST['preciomaxima']);
	$_REQUEST['preciominima']="";
	$_REQUEST['preciomaxima']="";

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
    <td colspan="5"><img src="../archivos/titulo_precioenvio.png" /></td>
    </tr>

  <tr>
    <td width="198" align="right" class="color_celda">Zona  </td>
    <td width="19" align="center" class="color_celda">:</td>
    <td width="407" colspan="3"><?php  	$zonaenvio->generar_select_zonaenvio_masivo('zona','',''); ?>
      <input type="hidden" name="id" id="id" /></td>
  </tr>

  <tr>
    <td align="right" class="color_celda">Empresa Remitente </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><?php $empresas->generar_select_empresas('empresa_remite','ver_listado()',''); ?></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Cantidad Minima</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="cantminima" type="text" id="cantminima" value="<?php echo $_REQUEST['cantminima']; ?>" size="15" /></td>
  </tr>


  <tr>
    <td align="right" class="color_celda">Precio cantidad minima</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="preciominima" type="text" id="preciominima" value="<?php echo $_REQUEST['preciominima']; ?>" size="15" /></td>
  </tr>
  
  <tr>
    <td align="right" class="color_celda">Precio cantidad maxima</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="preciomaxima" type="text" id="preciomaxima" value="<?php echo $_REQUEST['preciomaxima']; ?>" size="15" /></td>
  </tr>

  
  <tr>
    <td class="color_celda">&nbsp;</td>
    <td class="color_celda">&nbsp;</td>
    <td colspan="3"><input name="Submit" type="button" class="btn" value="Registrar Precio" onclick="nuevo()" />
      &nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
    <table width="90%" border="0" align="center">
      <tr>
        <td colspan="6" align="right"><input name="Submit3" type="button" class="btn" value="Eliminar seleccionados" onclick="validar_checkbox_seleccionados(1)" /></td>
      </tr>
      <tr>
        <td width="15%" align="center" class="fondonegro">Zona</td>
        <td width="43%" align="center" class="fondonegro">Empresa Remitente</td>
        <td width="10%" align="center" class="fondonegro">Cant. Min.</td>
        <td width="12%" align="center" class="fondonegro">Precio Cant Min.</td>
        <td width="13%" align="center" class="fondonegro">Precio Cant. Max.</td>
        <td width="7%" align="center" class="fondonegro"><input name="grupo" type="checkbox" id="grupo" value="1" onclick="marcar_todos(this.form,this.checked)" /></td>
      </tr>
 
            <?php  

			 $rs= $precioenvio->precioenviomasivo_listar($_REQUEST['empresa_remite']);
			 
			 if($rs)
			 
			 {
			 	$j=1;
			  	while($campo =mysql_fetch_array($rs)) { 
			?>

      <tr bgcolor="#FFFFFF" style="cursor: hand" onmouseover="bgColor='#FFDBB7'" onmouseout ="bgColor='#FFFFFF'">
        <td align="center"><?php echo $campo['ze_descripcion']; ?></td>
        <td align="center"><?php echo $campo['emprem_razonsocial']; ?></td>
        <td align="center"><?php echo $campo['ce_cantminima']; ?></td>
        <td align="center">S/. <?php echo $campo['ce_preciominima']; ?></td>
        <td align="center">S/. <?php echo $campo['ce_preciomaxima']; ?></td>
        <td align="center"><input name="campos[<?php echo $campo['ce_id'];?>]" type="checkbox" /></td>
      </tr>

            <?php 
			  $j=$j+1;
			  } 
			  } ?>

  </table>
    <p>&nbsp;</p>
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

	if (document.forms.form1.empresa_remite.value=="0")
	{ 
			document.forms.form1.empresa_remite.focus();
			alert("Seleccione la Empresa Remite");
			return false; 
	}
	
	if (document.forms.form1.cantminima.value=="")
	{ 
			document.forms.form1.cantminima.focus();
			alert("Ingrese la cantida minima");
			return false; 
	}	

	if (!Esnum(document.forms.form1.cantminima.value))
	{
		document.forms.form1.cantminima.focus();
	 	alert("Ingrese un valor numerico para la cantidad minima");
	 	return false;
	}

	if (document.forms.form1.preciominima.value=="")
	{ 
			document.forms.form1.preciominima.focus();
			alert("Ingrese el precio para la cantidad minima");
			return false; 
	}
	
	if (!Esnum(document.forms.form1.preciominima.value))
	{
		document.forms.form1.cantminima.focus();
	 	alert("Ingrese un valor numerico para la precio cantidad minima");
	 	return false;
	}

	if (document.forms.form1.preciomaxima.value=="")
	{ 
			document.forms.form1.preciomaxima.focus();
			alert("Ingrese el precio para la cantidad maxima");
			return false; 
	}

	if (!Esnum(document.forms.form1.preciomaxima.value))
	{
		document.forms.form1.preciomaxima.focus();
	 	alert("Ingrese un valor numerico para el precio cantidad maxima");
	 	return false;
	}
	

document.forms.form1.action='precioenvio_masivo.php';
document.forms.form1.method='post';
document.forms.form1.id.value='1'
document.forms.form1.submit();
}


function ver_listado(){
	document.forms.form1.action='precioenvio_masivo.php';
	document.forms.form1.method='post';
	document.forms.form1.submit();
}


function  borrar()
{

		
			if (confirm("¿Seguro que desea eliminar los registros seleccionados?"))
			{
   				document.forms.form1.id.value='2';
   				document.forms.form1.action='precioenvio_masivo.php';
   				document.forms.form1.method='post';
   				document.forms.form1.submit();
			}
	
			else
			{
				return false; 
			} 
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

<?php $precioenvio->con->cerrar();?>