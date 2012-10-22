<?php 
session_start();
require_once('../clases/auxiliares_data.php');
$igv = new  auxiliaresdata();
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


if (isset($_REQUEST['igv_id']))
	{ 	
		$_SESSION['igv_codigo']=$_REQUEST['igv_id'];		
		
 	}


 	

if ($_REQUEST['id']==='1')
 	{
		$igv->igv_editar($_SESSION['igv_codigo'],$_REQUEST['igv']);
    }
	



$igv->devuelve_igv('1');

?>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php  include("menu.php");?></td>
  </tr>
  <tr>
    <td align="center">
  </td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="center">

	
	<form id="form1" name="form1" method="post" action="">

	  <table width="248" border="0" align="center" cellpadding="0" cellspacing="2">
		
        <tr align="left">
          <td width="81" class="color_celda" >Valor:
            <input name="id" type="hidden" id="id" /></td>
          <td width="12" >:</td>
          <td width="147"><input name="igv" type="text" id="igv" value="<?php  echo $igv->devuelve_igv('1');
 ?>" size="10" /></td>
        </tr>
        <tr align="left">
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          </tr>

        <tr>
          <td align="center"><a href="igv.php">Regresar</a></td>
          <td align="center">&nbsp;</td>
          <td align="center"><input  name="Submit3"  type="button" class="btn" onclick="editar();" value="EDITAR" />		  </td>
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
	if (document.forms.form1.igv.value=="")
	{ 
	 document.forms.form1.igv.focus();
	 alert("Ingrese Valor para el IGV");
	 return false; 
	}	
	




	document.forms.form1.id.value='1'
  	document.forms.form1.action='editarigv.php';
   	document.forms.form1.method='post';
   	document.forms.form1.submit();
	
}



</script>


<?php  $igv->con->cerrar();  ?>