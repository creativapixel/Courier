<?php session_start();
  	
require_once('../clases/auxiliares_data.php');
$fragilidad = new  auxiliaresdata();


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
	$fragilidad->fragilidad_nuevo($_REQUEST['descripcion'],$_REQUEST['precio']);
}

if ($_REQUEST['id']==='2')
{
	$fragilidad->fragilidad_borrar($_REQUEST['fragilidad_codigo']);
}
		
		
		
		  
		  ?>

	
	<form name="form1"  id="form1">
        <table width="512" border="0" align="center" cellpadding="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr align="center">
            <td colspan="2"><h5>MANTENIMIENTO DE FRAGILIDAD </h5></td>
          </tr>
          <tr>
            <td colspan="2" align="left" class="enfasis">
			<input name="pagina" type="hidden" id="pagina">
			<input name="id" type="hidden" id="id">
			<input name="fragilidad_codigo" type="hidden" id="fragilidad_codigo"></td>
          </tr>
          <tr>
            <td align="right" class="color_celda">Fragilidad: &nbsp; </td>
            <td width="370" align="left" class="enfasis"><input name="descripcion" type="text" id="descripcion" size="40" onChange='mayusculas(this);'></td>
          </tr>
          <tr>
            <td align="right" class="color_celda">Precio (S/.):&nbsp;&nbsp;</td>
            <td align="left" class="enfasis"><input name="precio" type="text" id="precio"></td>
          </tr>
          <tr>
            <td colspan="2" align="left" class="enfasis">&nbsp;</td>
          </tr>
          <tr>
            <td width="136" align="center"><input name="Submit" type="button" class="btn" onClick="nuevo();" value="Grabar Fragilidad"></td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr class="fondonegro">
                <td width="10%" align="center">ORDEN</td>
                <td width="48%" align="center">DESCRIPCI&Oacute;N</td>
                <td width="21%" align="center">PRECIO</td>
                <td colspan="2" align="center">OPCI&Oacute;N</td>
                </tr>
              
			  <?php  
			 // $parametros="&programa=".$_REQUEST['programa'];
			  //metodo para el paginado de productos por  subcategorias
			 $rs= $fragilidad->listar_fragilidad();
			 if($rs)
			 
			 {$j=1;
			  while($campo =mysql_fetch_array($rs)) { ?>
			  <tr bgcolor="#FFFFFF" style="cursor: hand" onMouseOver="bgColor='#FFDBB7'" onMouseOut ="bgColor='#FFFFFF'">
                <td align="center"><?php echo $j; ?></td>
                <td align="center"><?php echo strtoupper($campo['fra_descripcion']) ?></td>
                <td align="center">S/. <?php echo strtoupper($campo['fra_precio']) ?></td>
                <td width="10%" align="center"><?php if($campo['fra_id']!=3){?><a href="editarfragilidad.php?fragilidad_id=<?php echo $campo['fra_id'];?>">Editar</a><?php } ?></td>
                <td width="11%" align="center"><?php if($campo['fra_id']!=3){?><a href="#" onClick="borrar(<?php echo $campo['fra_id']; ?>)">X Quitar</a><?php } ?></td>
			  </tr>
			  <?php 
			  $j=$j+1;
			  } 
			  } ?>
              <tr>
                <td colspan="5">&nbsp;</td>
                </tr>
              <tr>
                <td colspan="5" align="center"><?php  // echo $vinculo->util->devuelve_paginado($vinculo->query,$parametros,$idioma='1',$color='#006699');  ?></td>
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
if (document.forms.form1.precio.value=="")
{ 
document.forms.form1.precio.focus();
alert("Ingresar el precio");
return false; 
}

document.forms.form1.action='fragilidad.php';
document.forms.form1.method='post';
document.forms.form1.id.value='1'
document.forms.form1.submit();

}


function   borrar(fragilidad_codigo)
{

	if (confirm("¿Seguro que desea eliminar el registro?"))
	{
		document.forms.form1.id.value='2';
		document.forms.form1.fragilidad_codigo.value=fragilidad_codigo;
		document.forms.form1.action='fragilidad.php';
		document.forms.form1.method='post';
		document.forms.form1.submit();
	}
	else
	{
	return false; 
	}
		
		
}




</script>

