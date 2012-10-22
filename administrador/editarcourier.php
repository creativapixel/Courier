<?php 
session_start();
require_once('../clases/empresas_data.php');
$empresa = new  empresasdata();
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


if (isset($_REQUEST['cou_id']))
	{ 	
		$_SESSION['courier_codigo']=$_REQUEST['cou_id'];		
		
 	}

if ($_REQUEST['id']==='1')
 	{
		$empresa->courier_editar($_SESSION['courier_codigo'],$_REQUEST['descripcion'],$_REQUEST['ciudad']);
    }

$empresa->courier_ver($_SESSION['courier_codigo']);

$_REQUEST['ciudad']=$empresa->ciu_id;


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
    <td align="center"><h5>EDITAR COURIER</h5></td>
  </tr>
  
  <tr>
    <td align="center">

	
	<form id="form1" name="form1" method="post" action="">
      
	  <table width="488" border="0" align="center" cellpadding="0" cellspacing="2">
		
        <tr align="left">
          <td class="color_celda" >Ciudad</td>
          <td align="left" class="color_celda" >&nbsp;:</td>
          <td>			<?php  
		  
		  if (isset($_REQUEST['courier_id']))
		   	{
					$_REQUEST['courier']=$_REQUEST['courier_id'];
    		}
		 
					$auxiliares->generar_select_ciudad('ciudad','',''); ?>
            <input name="id" type="hidden" id="id" /></td>
        </tr>
        <tr align="left">
          <td width="73" class="color_celda" >Descripci&oacute;n</td>
          <td width="22" align="left" class="color_celda" >&nbsp;:</td>
          <td width="246"><input name="descripcion" type="text" id="descripcion" value="<?php  echo $empresa->empcou_razonsocial; ?>" size="40" /></td>
        </tr>
        <tr align="left">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>

        <tr>
          <td align="center"><a href="modelos.php"></a></td>
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
	 alert("Ingrese Nombre del Courier");
	 return false; 
	}

	document.forms.form1.id.value='1'
  	document.forms.form1.action='editarcourier.php';
   	document.forms.form1.method='post';
   	document.forms.form1.submit();
	
}

function regresar()
{
  	document.forms.form1.action='courier.php';
   	document.forms.form1.method='post';
   	document.forms.form1.submit();	
}

</script>


<?php  $empresa->con->cerrar();  ?>