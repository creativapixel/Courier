<?php  

		session_start();
		require_once("clases/session_data.php");
 		$session = new sessiondata(); 
		$usuario = new usuariodata();

 ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PM Express v1.0 - SISTEMA DE REGISTRO DE CARGOS POR COURIER</title>
<link href="estilos/css_sistema.css" rel="stylesheet" type="text/css">
<link href="imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">


</head>
<?php 
if (isset($_REQUEST['id']))
{
	if ($_REQUEST['id']==='1')
 	{
 
		$_SESSION['area']='1';
		$session->validausuario($_REQUEST['email'],$_REQUEST['clave']);
	}
 }

?>
<body >
<div align="center">
  <p>&nbsp;</p>
  <h4><img src="imagenes/logo_siscourier.png"></h4>
</div>
<table width="384" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
  <tr>
    <td width="380" background="imagenes/fondologin.jpg">
      <form name="form1">
        <table width="100%" border="0" cellpadding="2" cellspacing="0">
          <tr>
            <td colspan="4" align="center" background="imagenes/lin_menu.jpg" class="textoblanco">Logearse</td>
          </tr>
          <tr>
            <td rowspan="4" align="center"><img src="imagenes/login_llave.png"></td>
            <td height="26" colspan="3">Ingrese sus datos de acceso por favor. </td>
          </tr>
          <tr>
            <td width="80">E-Mail
            <input name="id" type="hidden" id="id" /></td>
            <td width="7">:</td>
            <td width="161"><input name="email" type="text" id="email" onkeyup="fn(this.form,this)" /></td>
          </tr>
          <tr>
            <td>Contrase&ntilde;a</td>
            <td>:</td>
            <td><input name="clave" type="password" id="clave" onkeyup="fn(this.form,this)" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><input name="Submit" type="button" class="btn"  onclick="logearse();" value="Ingresar" onkeyup='fn(this.form,this)'/></td>
          </tr>
        </table>
    </form></td>
  </tr>
</table>
</body>
</html>
<script src="javascript/valida.js">  </script>
<script language="javascript">

function  logearse()
{
document.forms.form1.id.value='1';
document.forms.form1.action='index.php';
document.forms.form1.method='post';
document.forms.form1.submit();

}

</script>

<?php 
$session->usuario->con->cerrar(); 

?>
