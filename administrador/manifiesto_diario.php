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
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="11">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="6" align="center"><h5>
            <img src="../archivos/titulo_manifiestodiario.png" width="382" height="36" />
            <input name="id" type="hidden" id="id" />
          </h5></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="78" align="center" class="color_celda">Courier: </td>
          <td width="301"><?php  	
					$empresas->generar_select_courier_todos('courier_destino','',''); ?></td>
          <td width="101" colspan="-2" align="center" class="color_celda">Fecha Emisi&oacute;n:</td>
          <td width="378">
		  
		  <input name="fecha" type="text" id="fecha" value="<?php echo $_REQUEST['fecha']; ?>" size="10"   />
        <a style='cursor:hand;' onclick='document.form1.fecha.oldValue=document.form1.fecha.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fecha, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a> 
		
		<span class="textoblanco">Hasta</span>
		<input name="fechaf" type="text" id="fechaf" value="<?php echo $_REQUEST['fechaf']; ?>" size="10"/>
            <a style='cursor:hand;' onclick='document.form1.fechaf.oldValue=document.form1.fechaf.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fechaf, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a>		  </td>
          <td width="145"><input name="Submit" type="button" class="btn" value="Generar Manifiesto" onclick="listar_cargos()"/></td>
        </tr>
        <tr>
          <td colspan="6" align="center"><table width="980" border="0">
            <tr align="center" class="fondonegro">
              <td width="3%">N&ordm;</td>
              <td width="15%"> <span class="Estilo2">Empresa Remitente </span></td>
              <td width="7%">N&ordm; Guia </td>
              <td width="17%">Consignado</td>
              <td width="16%">Direcci&oacute;n</td>
              <td width="9%"><span class="Estilo2">Destino</span></td>
              <td width="9%"><span class="Estilo2">Tipo de Envio </span></td>
              <td width="7%">Peso</td>
              <td width="9%">Observaciones</td>
              <td width="8%">Fecha Recepci&oacute;n </td>
            </tr>

            <tr>
              <td colspan="10">
			  <div style="position:static;width:980px; height:450px; overflow:scroll; z-index:1;  ">
			  
			  <table width="100%" border="0">
            <?php  
			  
			 $rs= $cargo->cargocourier_listar($_REQUEST['courier_destino'],'','',$_REQUEST['fecha'],$_REQUEST['fechaf'],'3','');
			 
			 $rs= mysql_query($rs,$cargo->con->cn);
			 
			 if($rs)
			 
			 {
			 $j=1;
			  while($campo =mysql_fetch_array($rs)) { ?>
            <tr bgcolor="#FFFFFF" style="cursor: hand" onMouseOver="bgColor='#FFDBB7'" onMouseOut ="bgColor='#FFFFFF'">
              <td width="3%" align="center"><?php echo $j; ?></td>
              <td width="15%" align="center"><?php echo strtoupper($campo['emprem_razonsocial']); ?></td>
              <td width="7%" align="center"><a href="#" onclick="vista_previa_guia(<?php echo $campo['carcou_id'];?>)"><?php echo $campo['carcou_id'];  ?></a></td>
              <td width="17%" align="center"><?php echo strtoupper($campo['carcou_consignadoa']); ?></td>
              <td width="16%" align="center" ><?php echo strtoupper($campo['carcou_direccion']);  ?> - <?php echo strtoupper($campo['carcou_distrito']);  ?></td>
              <td width="9%" align="center" ><?php echo strtoupper($auxiliares->devuelve_ciudad($campo['ciu_id']));  ?></td>
              <td width="9%" align="center"><?php echo $campo['carcou_cantidad'];  ?> <?php echo strtoupper($campo['tipoenv_descripcion']); ?></td>
              <td width="7%" align="center"><?php echo $campo['carcou_peso']." Kg.";  ?></td>
              <td width="9%" align="center"><?php echo $campo['carcou_observaciones'];  ?></td>
              <td width="8%" align="center"><?php 
			  
			  if ($cargo->util->obtienefecha($campo['carcou_fecharecepcion'])=='00/00/0000')
			  {
			  	echo "";
			  }  
			  else
			  {
			  	echo $cargo->util->obtienefecha($campo['carcou_fecharecepcion']);
			  }
			  ?></td>
            </tr>
            <?php 
			  	$j=$j+1;
  	 
			  } 
			  } ?>
              </table>
			  </div>			  </td>
              </tr>
            <tr>
              <td colspan="2" class="color_celda">Total de cargos emitidos: </td>
              <td align="left" class="enfasis"><?php echo $j -1;?></td>
              <td class="enfasis"><input name="Submit2" type="button" class="btn" value="Imprimir Manifiesto" onclick="vista_previa()" /></td>
              <td colspan="2" class="enfasis">&nbsp;</td>
              <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="10" align="center"><?php
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
	document.forms.form1.action='manifiesto_diario.php';
	document.forms.form1.method='post';
	document.forms.form1.submit();
}

function vista_previa(){
	window.open("manifiesto_impresion.php?courier_destino=<?php echo $_REQUEST['courier_destino'];?>&fecha=<?php echo $_REQUEST['fecha'];?>&fechaf=<?php echo $_REQUEST['fechaf'];?>", "_blank", "resizable,height=600,width=800");
}

<!--  
ap_showWaitMessage('waitDiv', 0);  
//--> 
</SCRIPT>
<?php  $cargo->con->cerrar(); ?>