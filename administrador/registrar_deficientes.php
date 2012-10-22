<?php 
session_start();
require_once('../clases/cargomasivo_data.php');

include_once "../clases/PHPPaging.lib.php";
$paging = new PHPPaging;

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

if($_REQUEST['id']==='2')
{
	$cargo->cargomasivo_borrar('1');
}


if (!isset($_REQUEST['npaginas'])){
	$_REQUEST['npaginas']=50;
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

 <?php

if($_REQUEST['id']==='1')
{


	$cargo->editar_deficiencia($_REQUEST['codigo_masivo'],$_REQUEST['deficiente']);
	

}
	

?>

<script language="Javascript" src="../javascript/PopCalendar.js"></script>
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
</head>
	<body  onLoad="this.document.form1.cargo.focus();">

<script language="JavaScript">
	PopCalendar = getCalendarInstance();
	PopCalendar.initCalendar();
</script>	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr height="5">
    <td > <?php  include("menu.php");?></td>
  </tr>

</table>
	
	
<form name="form1" id="form1">
<table width="719" border="0" align="center">
  <tr>
    <td colspan="5"><img src="../archivos/titulo_registrardeficientes.png" /></td>
    </tr>

  
  <tr>
    <td align="right" class="color_celda">N&deg; Cargo</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><label>
      <input type="text" name="cargo" id="cargo" onkeyup='fn(this.form,this)' onchange='ver_datos();' />
    </label>
      <input name="id" type="hidden" id="id" /></td>
  </tr>
</table>

<table width="950" border="0" align="center">
      <tr align="center">
        <td colspan="8" align="right">&nbsp;</td>
    </tr>
      <tr align="center" class="fondonegro">
        <td width="69">N&ordm; Guia </td>
        <td width="160"><span class="Estilo2">Empresa Remitente </span></td>
        <td width="83">Area</td>
        <td width="177">Consignado</td>
        <td width="143">Direcci&oacute;n</td>
        <td width="134">Tel&eacute;fono</td>
        <td width="133">Estado Deficiente</td>
        <td width="21">&nbsp;</td>
    </tr>
      <tr>
        <td colspan="8"><div style="position:static;width:950px; height:200px; overflow:scroll; z-index:1;  ">
            <table width="950" border="0">
              <?php  
			
			  $rs=$cargo->cargomasivo_listar('2',$_REQUEST['cargo'],'','','');
			  
			  $paging->porPagina($_REQUEST['npaginas']);
			  $paging->mostrarAnterior("< Anterior");
			  $paging->mostrarSiguiente("Siguiente >");		  
			  $paging->agregarConsulta($rs);
			  
			  $paging->ejecutar();


			 if($rs)
			 
			 {
			 $j=1;
			 
			  while($campo = $paging->fetchResultado()) {
			  
			  $_REQUEST['deficiente']=$campo['def_id'];
			   ?>
              <tr bgcolor="#FFFFFF" style="cursor: hand" onmouseover="bgColor='#FFDBB7'" onmouseout ="bgColor='#FFFFFF'">
                <td width="67" align="center"><?php echo $campo['cmas_id'];  ?>
                <input name="codigo_masivo" type="hidden" id="codigo_masivo" value="<?php echo $campo['cmas_id']; ?>" /></td>
                <td width="160" align="center"><?php echo strtoupper($campo['emprem_razonsocial']); ?></td>
                <td width="82" align="center"><?php echo strtoupper($campo['area_descripcion']); ?></td>
                <td width="175" align="center" ><?php echo strtoupper($campo['cmas_destinatario']); ?></td>
                <td width="143" align="center"><?php echo strtoupper($campo['cmas_direccion']); ?> <?php echo strtoupper($campo['cmas_caserio']); ?> <?php echo strtoupper($campo['ub_descripcion']); ?></td>
                <td width="135" align="center"><?php echo $campo['cmas_telefono']; ?></td>
                <td width="133"><?php echo $cargo->generar_select_deficientes('deficiente','editar_deficiencia()','')?></td>
                <td width="21">&nbsp;</td>
              </tr>
              <?php 
			  	$j=$j+1;
  	 
			  } 
			  } ?>
            </table>
        </div></td>
      </tr>
      <tr>
        <td colspan="8" class="enfasis"></td>
      </tr>
      <tr>
        <td colspan="8" align="center"></td>
      </tr>
    </table>
</form>

</body>
</html>
<script src="../javascript/valida.js">  </script>
<SCRIPT language="javascript">

function ver_datos()
{

document.forms.form1.action='registrar_deficientes.php';
document.forms.form1.method='get';
document.forms.form1.submit();
}

function editar_deficiencia()
{

document.forms.form1.action='registrar_deficientes.php';
document.forms.form1.method='post';
document.forms.form1.id.value='1'
document.forms.form1.submit();
}





<!--  
ap_showWaitMessage('waitDiv', 0);  
//--> 
</SCRIPT> 

<?php $cargo->con->cerrar();?>