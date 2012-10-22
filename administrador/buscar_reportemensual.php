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
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<script language="JavaScript">
	PopCalendar = getCalendarInstance();
	PopCalendar.initCalendar();
</script>	
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php  include("menu.php");?></td>
  </tr>
  <tr>
    <td><form  id="form1" name="form1">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
        <tr>
          <td width="10">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6" align="center"><h5>
            <img src="../archivos/titulo_buscarreportemensual.png" width="382" height="36" />
            <input name="id" type="hidden" id="id" />
          </h5></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="113" align="center" class="color_celda">Nro. de Reporte : </td>
          <td width="179"><input name="nro" type="text" id="nro" value="<?php echo $_REQUEST['nro'];?>" /></td>
          <td width="179" colspan="-2" align="center"><input name="Submit" type="button" class="btn" value="Buscar Reporte" onclick="listar_cargos()"/></td>
          <td width="272">&nbsp;</td>
          <td width="199">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6" align="center"><table width="950" border="0">
            <tr align="center" class="fondonegro">
              <td width="9%">Fecha Emisi&oacute;n </td>
              <td width="8%">Zona</td>
              <td width="9%"><span class="Estilo2">Destino</span></td>
              <td width="5%">N&ordm; Guia </td>
              <td width="9%"><span class="Estilo2">Tipo de Envio</span></td>
              <td width="6%">Peso </td>
              <td width="5%">1er. Kg </td>
              <td width="8%">Kg. Adicional </td>
              <td width="5%">Volumen</td>
              <td width="5%">Fragilidad</td>
              <td width="6%">Embalaje</td>
              <td width="7%">Subtotal</td>
              <td width="5%">IGV</td>
              <td width="6%">Total</td>
              <td width="7%">Otros</td>
            </tr>

            <tr>
              <td colspan="15">
			  <div style="position:static;width:950px; height:450px; overflow:scroll; z-index:1;  ">
			  
			  <table width="100%" border="0">
            <?php  
			  
			 $rs= $cargo->reporte_buscar($_REQUEST['nro'],'2');
			 
			 $rs= mysql_query($rs,$cargo->con->cn);
			 
			 if($rs)
			 
			 {
			 $j=1;
			  while($campo =mysql_fetch_array($rs)) { ?>
            <tr bgcolor="#FFFFFF" style="cursor: hand" onMouseOver="bgColor='#FFDBB7'" onMouseOut ="bgColor='#FFFFFF'">
              <td width="9%" align="center">
			  <?php 
			  

			  	echo $cargo->util->obtienefecha($campo['carcou_fecha']);

			  ?>			  </td>
              <td width="8%" align="center"><?php echo $campo['zon_descripcion'];  ?></td>
              <td width="9%" align="center"><?php echo strtoupper($auxiliares->devuelve_ciudad($campo['ciu_id']));  ?></td>
              <td width="5%" align="center"><a href="#" onclick="vista_previa_guia(<?php echo $campo['carcou_id'];?>)"><?php echo $campo['carcou_id'];  ?></a></td>
              <td width="9%" align="center"><?php echo $campo['carcou_cantidad'];  ?>&nbsp;<?php echo strtoupper($campo['tipoenv_descripcion']); ?></td>
              <td width="6%" align="center" ><?php echo $campo['carcou_peso']." Kg.";  ?></td>
              <td width="5%" align="center" >S/. <?php echo $campo['carcou_costoprimerkg'];  ?></td>
              <td width="8%" align="center" >S/. <?php echo $campo['carcou_costokgadicional'];  ?></td>
              <td width="5%" align="center" >S/. <?php echo $campo['carcou_costovolumen'];  ?></td>
              <td width="6%" align="center" >S/. <?php echo $campo['carcou_costofragilidad'];  ?></td>
              <td width="5%" align="center">S/. <?php echo $campo['carcou_costoembalaje'];  ?></td>
              <td width="8%" align="center">S/. <?php echo $campo['carcou_subtotal'];  ?></td>
              <td width="5%" align="center">S/. <?php echo $campo['carcou_igv'];  ?></td>
              <td width="6%" align="center">S/. <?php echo $campo['carcou_total'];  ?></td>
              <td width="6%" align="center">&nbsp;</td>
            </tr>
            <?php 
			  	$j=$j+1;
  	 
			  } 
			  } ?>
              </table>
			  </div>			  </td>
              </tr>
            <tr>
              <td colspan="3" class="color_celda">Total de cargos emitidos: </td>
              <td align="left" class="enfasis"><?php echo $j -1;?></td>
              <td class="enfasis">&nbsp;</td>
              <td colspan="7" class="enfasis">&nbsp;</td>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="15" align="center"><?php
								//echo $proveedor->util->devuelve_paginado($proveedor->query); 
				?></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>
<SCRIPT language="javascript">

function vista_previa_guia(guia){
	window.open("cargo_impresion.php?cargo_codigo="+guia, "_blank", "resizable,height=600,width=800");
}

function listar_cargos(){
	document.forms.form1.action='buscar_reportemensual.php';
	document.forms.form1.method='post';
	document.forms.form1.submit();
}



<!--  
ap_showWaitMessage('waitDiv', 0);  
//--> 
</SCRIPT>
<?php  $cargo->con->cerrar(); ?>