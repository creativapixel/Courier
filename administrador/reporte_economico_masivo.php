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
    <td colspan="5"><img src="../archivos/titulo_reporteeconomicomasivo.png" /></td>
    </tr>

  <tr>
    <td width="124" align="right" class="color_celda">Empresa Remitente </td>
    <td width="18" align="center" class="color_celda">:</td>
    <td width="563" colspan="3"><?php  	
					$empresas->generar_select_empresa_todos('empresa_remite','',''); ?>
      <input name="id" type="hidden" id="id" /></td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Fecha Emisi&oacute;n </td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><input name="fecha" type="text" id="fecha" value="<?php echo $_REQUEST['fecha']; ?>" size="10"   onkeyup='fn(this.form,this)'/>
        <a style='cursor:hand;' onclick='document.form1.fecha.oldValue=document.form1.fecha.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fecha, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a> 
        
        al
        
 <input name="fecha2" type="text" id="fecha2" value="<?php echo $_REQUEST['fecha2']; ?>" size="10" o  onkeyup='fn(this.form,this)'/>
        <a style='cursor:hand;' onclick='document.form1.fecha2.oldValue=document.form1.fecha2.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fecha2, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a>       
         
      </td>
  </tr>
  <tr>
    <td align="right" class="color_celda">Estado Deficiencia</td>
    <td align="center" class="color_celda">:</td>
    <td colspan="3"><select name="estado" id="estado" >
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
        <td width="70" align="left" class="color_celda">Empresa</td>
        <td colspan="3" align="left"><span class="textoblanco"><?php echo strtoupper($empresas->devuelve_empresaremite($_REQUEST['empresa_remite'])); ?></span></td>
        <td width="158" align="left">Del <span class="textoblanco"><?php echo $_REQUEST['fecha'];  ?></span> al <span class="textoblanco"><?php echo $_REQUEST['fecha2'];  ?></span></td>
        <td width="73" align="left">&nbsp;</td>
        <td width="89" align="right">&nbsp;</td>
        <td width="50" align="right">&nbsp;</td>
        <td colspan="4" align="right"><span class="enfasis">
          <input name="Submit4" type="button" class="btn" value="Imprimir Reporte" onclick="vista_previa()"/>
        </span></td>
    </tr>
      <tr align="center" class="fondonegro">
        <td width="70">N&ordm; Guia </td>
        <td width="73">Fecha</td>
        <td width="71">Zona</td>
        <td width="183">Consignado</td>
        <td width="158">Direcci&oacute;n</td>
        <td width="73">Ciudad</td>
        <td width="89">Observaciones</td>
        <td width="50">Costo Tipo Envio</td>
        <td width="46">Costo Envio</td>
        <td width="40">Costo Cacerio</td>
        <td width="30">Inc. Igv</td>
        <td width="23">&nbsp;</td>
    </tr>
      <tr>
        <td colspan="12"><div style="position:static;width:950px; height:450px; overflow:scroll; z-index:1;  ">
            <table width="950" border="0">
              <?php  
			
			  $rs=$cargo->cargomasivo_listar_impresion('4',$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['fecha2'],$_REQUEST['estado'],'');
			  
			 if($rs)
			 
			 {
			 $j=1;
			 
			  	while($campo =mysql_fetch_array($rs)){?>
              <tr bgcolor="#FFFFFF" style="cursor: hand" onmouseover="bgColor='#FFDBB7'" onmouseout ="bgColor='#FFFFFF'">
                <td width="70" align="center"><?php echo $campo['cmas_id'];  ?></td>
                <td width="73" align="center"><?php echo $cargo->util->obtienefecha($campo['cmas_fecha']);  ?></td>
                <td width="71" align="center"><?php echo strtoupper($campo['ze_descripcion']); ?></td>
                <td width="183" align="center"><?php echo strtoupper($campo['cmas_destinatario']); ?></td>
                <td width="158" align="center"><?php echo strtoupper($campo['cmas_direccion']); ?> <?php echo strtoupper($campo['cmas_caserio']); ?></td>
                <td width="73" align="center"><?php echo strtoupper($campo['ub_descripcion']);  ?></td>
                <td width="89" align="center">
				<?php 
				if($campo['def_id']!='10')
				{
					echo strtoupper($campo['def_descripcion']);
				} 
				?></td>
                <td width="50" align="center">S/. <?php echo number_format($campo['cmas_costotipoenvio'],2)?></td>
                <td width="46" align="center">S/. <?php echo number_format($campo['cmas_costoenvio'],2)?></td>
                <td width="40" align="center">S/. <?php echo $campo['cmas_costocaserio']?></td>
                <td width="30" align="center">
				<?php 
				
				if($campo['cmas_incluyeigv']=='1')
				{
					echo "S&iacute;";
					}
				else
				{
					echo "No";
					}
				?>
                </td>
                <td width="23" align="center">&nbsp;</td>
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
              <td width="15%">Total Cargos Masivos</td>
              <td><?php echo $j - 1; ?></td>
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
	window.open("reporte_masivos_economico.php?empresa_remite=<?php echo $_REQUEST['empresa_remite'];?>&fecha=<?php echo $_REQUEST['fecha'];?>&fecha2=<?php echo $_REQUEST['fecha2'];?>&estado=<?php echo $_REQUEST['estado'];?>&reporte=4", "_blank", "resizable,height=600,width=800");
}

function ver_datos()
{

document.forms.form1.action='reporte_economico_masivo.php';
document.forms.form1.method='get';
document.forms.form1.submit();
}



<!--  
ap_showWaitMessage('waitDiv', 0);  
//--> 
</SCRIPT> 

<?php $cargo->con->cerrar();?>