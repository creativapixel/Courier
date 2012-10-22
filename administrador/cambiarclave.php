<?php session_start();
 require_once('../clases/usuario_data.php');
$usuario= new usuariodata();
 if(!isset($_SESSION['usu_id']))
 	{
	die("No tiene acceso  a esta seccion");
 	} 


 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>NUEVA CLAVE</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
<link href="../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
</head>

<body>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr height="5">
    <td height="23">
      
<br></td>
  
  <tr>
    <td height="23" align="left">

	<form name="form1" method="post" action="">
      <fieldset><legend>EDITAR CLAVE</legend>
	  <table border="0" align="center">
        <tr>
          <td colspan="2" align="center" class="texto">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="left"><?php 	

if (isset($_REQUEST['usu_codigo']))
{
$_SESSION['nombre']=$_REQUEST['nombres']; 
 $_SESSION['usuario_id']=$_REQUEST['usu_codigo']; 
}
	if ($_REQUEST['id']==='1')
 		{

 	$usuario->usuario_cambiarclave($_REQUEST['clavea'],$_REQUEST['clave'],$_SESSION['usuario_id']);


        }

	 ?>
	        <input name="id" type="hidden" id="id">
	        </td>
        </tr>
        <tr>
          <td width="212" align="left" class="color_celda">Nombres y Apellidos </td>
          <td width="274" align="left" class="textoblanco"><?php echo strtoupper($_SESSION['nombre']); ?>
        </tr>
        <tr>
          <td align="left" class="color_celda">Clave anterior </td>
          <td align="left"><input name="clavea" type="password" id="clavea"></td>
        </tr>
        <tr>
          <td align="left" class="color_celda">Nueva clave </td>
          <td align="left"><input name="clave" type="password" id="clave" value=""></td>
        </tr>
        <tr>
          <td align="left" class="color_celda">Vuelva a escribir la nueva clave </td>
          <td align="left"><input name="clave1" type="password" id="clave1"></td>
        </tr>
        
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left"><input name="registrar" type="button" class="btn"  onclick="editar();" value="Cambiar clave" /></td>
        </tr>
      </table>
	  
	  </fieldset></form>
	
	
	</td>
  </tr>
</table>
<script language="javascript">

function editar()
{

		if (document.forms.form1.clavea.value=="")
 		{
 			document.forms.form1.clavea.focus();
	 		alert("Ingrese clave anterior");
	 		return false; 
 
 		}
 
		if (document.forms.form1.clave.value=="")
 		{
 		document.forms.form1.clave.focus();
	 	alert("Ingrese clave nueva");
	 	return false; 
 		} 
 
  		if (document.forms.form1.clave1.value=="")
 		{
 		document.forms.form1.clave1.focus();
	 	alert("Ingrese otra vez la clave nueva");
	 	return false; 
		}
 
 		if (document.forms.form1.clave.value!=document.forms.form1.clave1.value)
 		{  
		document.forms.form1.clave.focus();
		alert("Claves nuevas no coinciden");
		return false; 
 		}
 
 document.forms.form1.id.value='1';
 document.forms.form1.action="cambiarclave.php";
 document.forms.form1.method='post';
 document.forms.form1.submit();
		
}


</script>
</body>
</html>
<?php  $usuario->con->cerrar(); 

?>
