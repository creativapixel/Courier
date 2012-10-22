<?php session_start();
  	
require_once('../clases/auxiliares_data.php');
$area = new  auxiliaresdata();


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
	$area->area_nuevo($_REQUEST['descripcion']);
}

if ($_REQUEST['id']==='2')
{
	$area->area_borrar($_REQUEST['area_codigo']);
}
		
		
		
		  
		  ?>

	
	<form name="form1"  id="form1">
        <table width="512" border="0" align="center" cellpadding="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr align="center">
            <td colspan="2"><h5>MANTENIMIENTO DE AREA</h5></td>
          </tr>
          <tr>
            <td colspan="2" align="left" class="enfasis">
			<input name="pagina" type="hidden" id="pagina">
			<input name="id" type="hidden" id="id">
			<input name="area_codigo" type="hidden" id="area_codigo"></td>
          </tr>
          <tr>
            <td align="right" class="color_celda">Area: &nbsp; </td>
            <td width="370" align="left" class="enfasis"><input name="descripcion" type="text" id="descripcion" size="40" onChange='mayusculas(this);'></td>
          </tr>
          <tr>
            <td colspan="2" align="left" class="enfasis">&nbsp;</td>
          </tr>
          <tr>
            <td width="136" align="center"><input name="Submit" type="button" class="btn" onClick="nuevo();" value="Grabar Area"></td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr class="fondonegro">
                <td width="10%" align="center">ORDEN</td>
                <td align="center">DESCRIPCI&Oacute;N</td>
                <td colspan="2" align="center">OPCI&Oacute;N</td>
                </tr>
              
			  <?php  
			 // $parametros="&programa=".$_REQUEST['programa'];
			  //metodo para el paginado de productos por  subcategorias
			 $rs= $area->listar_area();
			 if($rs)
			 
			 {$j=1;
			  while($campo =mysql_fetch_array($rs)) { ?>
			  <tr bgcolor="#FFFFFF" style="cursor: hand" onMouseOver="bgColor='#FFDBB7'" onMouseOut ="bgColor='#FFFFFF'">
                <td align="center"><?php echo $j; ?></td>
                <td align="center"><?php echo strtoupper($campo['area_descripcion']) ?></td>
                <td width="10%" align="center"><a href="editararea.php?area_id=<?php echo $campo['area_id'];?>">Editar</a></td>
                <td width="11%" align="center"><a href="#" onClick="borrar(<?php echo $campo['area_id']; ?>)">X Quitar</a></td>
			  </tr>
			  <?php 
			  $j=$j+1;
			  } 
			  } ?>
              <tr>
                <td colspan="4">&nbsp;</td>
                </tr>
              <tr>
                <td colspan="4" align="center"><?php  // echo $vinculo->util->devuelve_paginado($vinculo->query,$parametros,$idioma='1',$color='#006699');  ?></td>
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
alert("Ingresar la descripción");
return false; 
}

document.forms.form1.action='area.php';
document.forms.form1.method='post';
document.forms.form1.id.value='1'
document.forms.form1.submit();

}


function   borrar(area_codigo)
{

	if (confirm("¿Seguro que desea eliminar el registro?"))
	{
		document.forms.form1.id.value='2';
		document.forms.form1.area_codigo.value=area_codigo;
		document.forms.form1.action='area.php';
		document.forms.form1.method='post';
		document.forms.form1.submit();
	}
	else
	{
	return false; 
	}
		
		
}




</script>

