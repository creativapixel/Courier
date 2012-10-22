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
	$_REQUEST['npaginas']=100;
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

	//añadimos en el array las extensiones aceptadas. ejem: array("html","exe","php");
	$extensiones=array("csv"); 
	//contamos cuantos valores trae el array
	$num = count($extensiones);
	$valor = $num-1;

	//recuperamos el nombre del archivo
	$nombre_archivo = $HTTP_POST_FILES['file']['name'];
	
	//recuperamos la extension del archivo
	$extension_archivo = explode(".",$nombre_archivo);


	//verificamos si la extension que queremos subir es soportada
	for($i=0; $i<=$valor; $i++) {

		if($extensiones[$i] != $extension_archivo[1])
		{
			echo "<script>alert('El tipo de archivo seleccionado no es de extension CSV. Por favor verifique.');</script>";
			//exit;
		}
		else
		{
		
			$nombre_archivo = ereg_replace(" ", "", $nombre_archivo); 
			$ruta='masivos_cvs/'.$nombre_archivo;//ruta  completa
	
			if (!empty($HTTP_POST_FILES['file']['tmp_name']))
			{
    			move_uploaded_file($HTTP_POST_FILES['file']['tmp_name'],$ruta);
		
			}

			//masivo_importar($fecha,$zona,$ciudad,$empresa,$cargo,$eliminado)
			$cargo->masivo_importar($_REQUEST['fecha'],$_REQUEST['zona'],$_REQUEST['ciudad_destino'],$_REQUEST['empresa_remite'],$_REQUEST['area'],'0',$ruta);
			//$_REQUEST['zona']=0;
		
		}		
	}

	
	

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
	<body>

<script language="JavaScript">
	PopCalendar = getCalendarInstance();
	PopCalendar.initCalendar();
</script>	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr height="5">
    <td > <?php  include("menu.php");?></td>
  </tr>

</table>
	
	
<form name="form1" id="form1" >
<table width="719" border="0" align="center">
  <tr>
    <td colspan="5"><img src="../archivos/titulo_listadocargosmasivos.png" /></td>
    </tr>

  <tr>
    <td width="124" align="right" class="color_celda">Empresa Remitente </td>
    <td width="18" align="center" class="color_celda">:</td>
    <td width="563" colspan="3"><?php  	
					$empresas->generar_select_empresa_todos('empresa_remite','ver_datos()',''); ?>
      <input name="id" type="hidden" id="id" /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Fecha Emisi&oacute;n </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="fecha" type="text" id="fecha" value="<?php echo $_REQUEST['fecha']; ?>" size="10" onblur="ver_datos()"  onkeyup='fn(this.form,this)'/>
        <a style='cursor:hand;' onclick='document.form1.fecha.oldValue=document.form1.fecha.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fecha, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Estado Deficiencia</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><select name="estado" id="estado" onchange="ver_datos()">
      <option value="1" <?php if($_REQUEST['estado']=='1'){echo "selected";}?>>TODOS</option>
      <option value="2" <?php if($_REQUEST['estado']=='2'){echo "selected";}?>>SIN DEFICIENCIAS</option>
      <option value="3" <?php if($_REQUEST['estado']=='3'){echo "selected";}?>>CON DEFICIENCIAS</option>
    </select>
    </td>
  </tr>
  <tr>
    <td align="right" class="color_celda">&nbsp;</td>
    <td align="center" class="color_celda">&nbsp;</td>
    <td colspan="3"><input name="Submit" type="button" class="btn" value="Listar Cargos" onclick="ver_datos()" /></td>
  </tr>
  <tr>
    <td align="right">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

<table width="950" border="0" align="center">
      <tr align="center">
        <td colspan="12" align="right"><span class="enfasis">
          <input name="Submit4" type="button" class="btn" value="Imprimir Listado" onclick="vista_previa()"/>
          </span>&nbsp;
          <input name="button" type="button" class="btn" id="button" value="Imprimir Etiqueta Grande" onclick="vista_previa_modelo1()" /> <input name="button2" type="button" class="btn" id="button2" value="Imprimir Etiqueta Peque&ntilde;a" onclick="vista_previa_modelo2()" />
<input name="Submit3" type="button" class="btn" value="Eliminar seleccionados" onclick="validar_checkbox_seleccionados(1)" /></td>
    </tr>
      <tr align="center" class="fondonegro">
        <td width="75">N&ordm; Guia </td>
        <td width="65">Fecha Emisi&oacute;n </td>
        <td width="128"><span class="Estilo2">Empresa Remitente </span></td>
        <td width="90">Area</td>
        <td width="59">Zona</td>
        <td width="83">Ciudad</td>
        <td width="113">Consignado</td>
        <td width="152">Direcci&oacute;n</td>
        <td width="73">Tel&eacute;fono</td>
        <td width="32">Editar</td>
        <td width="35"><input name="grupo" type="checkbox" id="grupo" value="1" onclick="marcar_todos(this.form,this.checked)" /></td>
        <td width="1">&nbsp;</td>
    </tr>
      <tr>
        <td colspan="12"><div style="position:static;width:950px; height:450px; overflow:scroll; z-index:1;  ">
            <table width="950" border="0">
              <?php  
			
			  $rs=$cargo->cargomasivo_listar('3',$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['estado'],'');
			  
			  $paging->porPagina($_REQUEST['npaginas']);
			  $paging->mostrarAnterior("< Anterior");
			  $paging->mostrarSiguiente("Siguiente >");		  
			  $paging->agregarConsulta($rs);
			  
			  $paging->ejecutar();


			 if($rs)
			 
			 {
			 $j=1;
			 
			  while($campo = $paging->fetchResultado()) { ?>
              <tr bgcolor="#FFFFFF" style="cursor: hand" onmouseover="bgColor='#FFDBB7'" onmouseout ="bgColor='#FFFFFF'">
                <td width="70" align="center"><?php echo $campo['cmas_id'];  ?></td>
                <td width="65" align="center"><?php echo $cargo->util->obtienefecha($campo['cmas_fecha']);  ?></td>
                <td width="130" align="center"><?php echo strtoupper($campo['emprem_razonsocial']); ?></td>
                <td width="89" align="center"><?php echo strtoupper($campo['area_descripcion']); ?></td>
                <td width="62" align="center"><?php echo strtoupper($campo['ze_descripcion']); ?></td>
                <td width="83" align="center"><?php echo strtoupper($campo['cmas_ciudad']);  ?></td>
                <td width="114" align="center" ><?php echo strtoupper($campo['cmas_destinatario']); ?></td>
                <td width="144" align="center"><?php echo strtoupper($campo['cmas_direccion']); ?> <?php echo strtoupper($campo['cmas_caserio']); ?></td>
                <td width="75" align="center"><?php echo $campo['cmas_telefono']; ?></td>
                <td width="35" align="center"><a href="editar_cargomasivo.php?cargo_id=<?php echo $campo['cmas_id']?>"><img src="../imagenes/icono_editar.gif" alt="Editar Registro" border="0" /></a></td>
                <td width="25" align="center"><input name="campos[<?php echo $campo['cmas_id'];?>]" type="checkbox" /></td>
                <td width="8" align="center">&nbsp;</td>
              </tr>
              <?php 
			  	$j=$j+1;
  	 
			  } 
			  } ?>
            </table>
        </div></td>
      </tr>
      <tr>
        <td colspan="12" class="enfasis"><table width="100%" border="0" bgcolor="#FFFFFF">
            <tr>
              <td><label>Listar
                <input name="npaginas" type="text" id="npaginas" size="3" onblur="ver_datos()" value="<?php echo $_REQUEST['npaginas']?>"/>
                registros 
                
              </label></td>
              <td><?php 
			  		$links = $paging->fetchNavegacion();
					echo $links;
				?>              </td>
              <td><?php echo "Mostrando ".$num_registros_aqui = $paging->numRegistrosMostrados()." registros. Desde ".$primer_elemento = $paging->numPrimerRegistro()." al ".$ultimo_elemento = $paging->numUltimoRegistro()."
 de un total de ".$total_registros = $paging->numTotalRegistros();
?></td>
              <td><?php echo "P&aacute;gina ".$pagina_actual = $paging->numEstaPagina()." de ".$num_paginas = $paging->numTotalPaginas();?></td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="12" align="center"></td>
      </tr>
    </table>
</form>

</body>
</html>
<script src="../javascript/valida.js">  </script>
<SCRIPT language="javascript">

function vista_previa(){
	window.open("masivos_impresion.php?empresa_remite=<?php echo $_REQUEST['empresa_remite'];?>&fecha=<?php echo $_REQUEST['fecha'];?>&estado=<?php echo $_REQUEST['estado'];?>&reporte=3", "_blank", "resizable,height=600,width=800");
}


function vista_previa_modelo1(){
	window.open("etiqueta1_masivos_impresion.php?empresa_remite=<?php echo $_REQUEST['empresa_remite'];?>&fecha=<?php echo $_REQUEST['fecha'];?>&estado=<?php echo $_REQUEST['estado'];?>&reporte=3", "_blank", "resizable,height=600,width=800");
}


function vista_previa_modelo2(){
	window.open("etiqueta2_masivos_impresion.php?empresa_remite=<?php echo $_REQUEST['empresa_remite'];?>&fecha=<?php echo $_REQUEST['fecha'];?>&estado=<?php echo $_REQUEST['estado'];?>&reporte=3", "_blank", "resizable,height=600,width=800");
}

function ver_datos()
{

document.forms.form1.action='listar_cargos_masivo.php';
document.forms.form1.method='get';
document.forms.form1.submit();
}







function  borrar()
{

		
			if (confirm("¿Seguro que desea eliminar los registros seleccionados?"))
			{
   				document.forms.form1.id.value='2';
   				document.forms.form1.action='listar_cargos_masivo.php';
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

<?php $cargo->con->cerrar();?>