<?php 
session_start();
require_once('../clases/auxiliares_data.php');
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
<title>MANTENIMIENTO</title>
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 


if (isset($_REQUEST['fragilidad_id']))
	{ 	
		$_SESSION['fragilidad_codigo']=$_REQUEST['fragilidad_id'];		
		
 	}

if ($_REQUEST['id']==='1')
 	{
		$auxiliares->fragilidad_editar($_SESSION['fragilidad_codigo'],$_REQUEST['descripcion'],$_REQUEST['precio']);
    }

$auxiliares->fragilidad_ver($_SESSION['fragilidad_codigo']);

?>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php  include("menu.php");?></td>
  </tr>
  <tr>
    <td align="center">  </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><h5>EDITAR FRAGILIDAD </h5></td>
  </tr>
  
  <tr>
    <td align="center">

	
	<form id="form1" name="form1" method="post" action="">

	  <table width="488" border="0" align="center" cellpadding="0" cellspacing="2">
		
        <tr align="left">
          <td width="74" class="color_celda" >Descripci&oacute;n</td>
          <td width="16" align="center" class="color_celda" >:</td>
          <td width="390"><input name="descripcion" type="text" id="descripcion" value="<?php  echo $auxiliares->fra_descripcion; ?>" size="40" />
            <input name="id" type="hidden" id="id" /></td>
        </tr>
        <tr align="left">
          <td class="color_celda" >Precio (S/.) </td>
          <td align="center" class="color_celda" >:</td>
          <td><input name="precio" type="text" id="precio" value="<?php  echo $auxiliares->fra_precio; ?>" /></td>
        </tr>
        <tr align="left">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>

        <tr>
          <td align="center"></td>
          <td align="center">&nbsp;</td>
          <td><input  name="Submit3"  type="button" class="btn" onclick="editar();" value="EDITAR" /> <input name="Submit" type="button" class="btn" value="REGRESAR" onclick="regresar()" /></td>
          </tr>
      </table>
    </form>    </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
</table>
</body>
</html>


 
<script src="../javascript/valida.js" language="javascript"></script>
<script language="javascript">
function editar()
{
	if (document.forms.form1.descripcion.value=="")
	{ 
	 document.forms.form1.descripcion.focus();
	 alert("Ingrese la descripcion");
	 return false; 
	}
	
	if (document.forms.form1.precio.value=="")
	{ 
	 document.forms.form1.precio.focus();
	 alert("Ingrese Nombre de la Precio");
	 return false; 
	}
	

	document.forms.form1.id.value='1'
  	document.forms.form1.action='editarfragilidad.php';
   	document.forms.form1.method='post';
   	document.forms.form1.submit();
	
}
function regresar()
{
  	document.forms.form1.action='fragilidad.php';
   	document.forms.form1.method='post';
   	document.forms.form1.submit();
	
}

</script>


<?php  $auxiliares->con->cerrar();  ?>