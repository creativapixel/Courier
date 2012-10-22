<?php 
session_start();
require_once('../clases/empresas_data.php');
$courier = new  empresasdata();
$auxiliares = new  auxiliaresdata();
/*
if (!isset($_REQUEST['marca']) && !isset($_REQUEST['id']))
{
$_REQUEST['marca']='1';
//$_REQUEST['pagina']='0';
}
*/
 ?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PM Express v1.0 - SISTEMA DE REGISTRO DE CARGOS POR COURIER</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <?php  include("menu.php");?></td>
  </tr>
  <tr>
    <td align="center">
	

	<?php 
		  if($_REQUEST['id']==='1')
{
	  
$courier->courier_nuevo($_REQUEST['descripcion'],'0',$_REQUEST['ciudad']);

}

		
if ($_REQUEST['id']==='2')
{

$courier->courier_borrar($_REQUEST['courier_codigo']);
}
		
		
		
		  
		  ?>

	
	<form name="form1"  id="form1">
        <table width="688" border="0" align="center" cellpadding="0">
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr align="center">
            <td colspan="4"><h5>MANTENIMIENTO DE COURIER DE DESTINO </h5></td>
          </tr>
          <tr>
            <td width="121" align="right" class="color_celda">Ciudad</td>
            <td width="5" align="left" class="color_celda" >:</td>
            <td width="138" align="left">
			<?php  	
			$auxiliares->generar_select_ciudad('ciudad','ver_datos()',''); 
			?>
			<input name="pagina" type="hidden" id="pagina">
			<input name="id" type="hidden" id="id">
			<input name="courier_codigo" type="hidden" id="courier_codigo"></td>
			
            <td width="414" colspan="-2">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" valign="top" class="color_celda">Nombre Courier </td>
            <td align="left" valign="top" class="color_celda">:</td>
            <td colspan="2" align="left"><input name="descripcion" type="text" id="descripcion" size="55" onchange='mayusculas(this);'></td>
          </tr>
          <tr>
            <td colspan="4" align="left" class="enfasis">&nbsp;</td>
          </tr>
          <tr>
            <td><input name="Submit" type="button" class="btn" onClick="nuevo();" value="Grabar Courier"></td>
            <td colspan="2">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="4"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr class="fondonegro">
                <td width="8%" align="center">ORDEN</td>
                <td width="29%" align="center">DESCRIPCI&Oacute;N</td>
                <td width="49%" align="center">CIUDAD</td>
                <td colspan="2" align="center">OPCI&Oacute;N</td>
                </tr>
              
			  <?php  
				//$parametros="&marca=".$_REQUEST['marca'];
			  //metodo para el paginado de productos por  subcategorias
			 $rs= $courier->listar_courierciudad($_REQUEST['ciudad']);
			 if($rs)
			 
			 {$j=1;
			  while($campo =mysql_fetch_array($rs)) { ?>
			  <tr bgcolor="#F0F0F0" style="cursor: hand" onMouseOver="bgColor='#Ffffff'" onMouseOut ="bgColor='#F0F0F0'">
                <td align="center"><?php echo $j; ?></td>
                <td align="center"><?php echo $campo['empcou_razonsocial']; ?></td>
                <td align="center"><?php echo strtoupper($campo['ciu_descripcion']) ?></td>
                <td width="6%" align="center"><a href="editarcourier.php?cou_id=<?php echo $campo['empcou_id']?>">Editar</a></td>
                <td width="8%" align="center"><a href="#" onClick="borrar(<?php echo $campo['empcou_id']; ?>)">X Quitar</a></td>
			  </tr>
			  <?php 
			  $j=$j+1;
			  } 
			  } ?>
              <tr>
                <td colspan="5">&nbsp;</td>
                </tr>
              <tr>
                <td colspan="5" align="center"><?php  // echo $modelo->util->devuelve_paginado($modelo->query,$parametros,$idioma='1',$color='#006699');  ?></td>
              </tr>
            </table></td>
          </tr>
        </table>
    </form></td>
  </tr>
</table>
</body>


</html>
<script src="../javascript/valida.js">  </script>
<script language="javascript">


function nuevo()
{

if (document.forms.form1.descripcion.value=="")
{ 
document.forms.form1.descripcion.focus();
alert("Ingresar nombre del courier");
return false; 
}

document.forms.form1.action='courier.php';
document.forms.form1.method='post';
document.forms.form1.id.value='1'
document.forms.form1.submit();
}

function ver_datos()
{
   document.forms.form1.action='courier.php';
   document.forms.form1.method='post';
   document.forms.form1.submit();
}
function   borrar(cou_id)
{
   document.forms.form1.id.value='2';
   document.forms.form1.courier_codigo.value=cou_id;
   document.forms.form1.action='courier.php';
   document.forms.form1.method='post';
   document.forms.form1.submit();
}




</script>

