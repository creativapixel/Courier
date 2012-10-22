<?php session_start();
require_once('../clases/usuario_data.php');
$usuario = new  usuariodata();
if(!isset($_SESSION['usu_id']))
 	{
	 die("No tiene acceso  a esta seccion");
 	}

 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PM Express v1.0 - SISTEMA DE REGISTRO DE CARGOS POR COURIER</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
<link href="../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
</head>

<body>
<script language="Javascript" src="../javascript/PopCalendar.js">
</script>
  
<script language="JavaScript">
	PopCalendar = getCalendarInstance();
	PopCalendar.initCalendar();
</script>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr height="5">
    <td height="23">
      <?php  include("menu.php");?>
<br></td>
  </tr>
  <tr>
    <td height="23" align="center"><table width="668" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td align="center"><h4><strong>NUEVO USUARIO </strong></h4></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="justify">
          <p>Ingrese la informaci&oacute;n correcta en cada uno de los recuadros. Todos los datos enviados ser&aacute;n registrados de manera confidencial.</p>
          <p> A trav&eacute;s de Este formulario Ud. Prodra registrarse como Administrador del Sistema </p>
        </div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="23" align="center">
<?php 	

if ($_REQUEST['id']==='1')
{ 

$codigo=$usuario->usuario_nuevo($_REQUEST['tipouser'],$_REQUEST['nombres'],$_REQUEST['apellidos'],$_REQUEST['direccion'],$_REQUEST['telefono'],$_REQUEST['dni'],$_REQUEST['email'],$_REQUEST['clave'],'0');
}

if(!$codigo){ ?>
	<a href="listadousuarios.php">REGRESAR</a>
	<form name="form1" method="post" action="">
      <fieldset style="width:500px;">
      <legend>DATOS PERSONALES</legend>
	  <table width="507" border="0" align="center">  
        <tr>
          <td align="left" class="color_celda">Nombres
            <input name="tipouser" type="hidden" id="tipouser" value="1">
            <input name="id" type="hidden" id="id3" /></td>
          <td align="left" class="color_celda">:</td>
          <td colspan="4" align="left"><label>
            <input name="nombres" type="text" id="nombres" size="40"  value="<?php  echo $_REQUEST['nombres']; ?>"/>
</label></td>
        </tr>
        <tr>
          <td align="left" class="color_celda">Apellidos</td>
          <td align="left" class="color_celda">:</td>
          <td colspan="4" align="left"><input name="apellidos" type="text" id="apellidos" size="40"  value="<?php echo $_REQUEST['apellidos']; ?>"/></td>
        </tr>
        <tr>
          <td align="left" class="color_celda">Direcci&oacute;n</td>
          <td align="left" class="color_celda">:</td>
          <td colspan="4" align="left"><input name="direccion" type="text" id="direccion2" size="40" value="<?php echo $_REQUEST['direccion']; ?>" /></td>
        </tr>
        <tr>
          <td align="left" class="color_celda">Tel&eacute;fono/Mov&iacute;l</td>
          <td align="left" class="color_celda">:</td>
          <td colspan="4" align="left"><input name="telefono" type="text" id="telefono" size="30" value="<?php echo $_REQUEST['telefono']; ?>" /></td>
        </tr>
        <tr>
          <td align="left" class="color_celda">Nro de DNI</td>
          <td align="left" class="color_celda">:</td>
          <td colspan="4" align="left"><input name="dni" type="text" id="nrodoc2" value="<?php echo $_REQUEST['dni']; ?>"></td>
        </tr>
        </table>	  
	  </fieldset><br>
<br>
<fieldset  style="width:500px;">
	  <legend>INFORMACIÓN DE CUENTA</legend>
	  <table width="508">
		<tr>
          <td colspan="3" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3" align="left"><div align="justify">
              <p>Ingrese su email que servir&aacute; de Login para su acceso.<br />
          Ingrese su contrase&ntilde;a. Est&aacute; no debe ser la misma de su correo, invente una solo para el acceso al sistema. </p>
          </div></td>
        </tr>
        <tr>
          <td colspan="3" align="left">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" class="color_celda">Email</td>
          <td align="left" class="color_celda">:</td>
          <td align="left"><input name="email" type="text" id="email" size="35" value="<?php echo $_REQUEST['email']; ?>" /></td>
        </tr>
        <tr>
          <td align="left" class="color_celda">Contrase&ntilde;a</td>
          <td align="left" class="color_celda">:</td>
          <td align="left"><input name="clave" type="password" id="clave" size="20" maxlength="20" /></td>
        </tr>
        <tr>
          <td align="left" class="color_celda">Confirmar Contrase&ntilde;a</td>
          <td align="left" class="color_celda">:</td>
          <td align="left"><input name="clave2" type="password" id="clave2" size="20" maxlength="20" /></td>
        </tr>
        <tr>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
      </table>
	  </fieldset>
	  <p><br>
	      <a href="listadousuarios.php">REGRESAR</a></p>
	  <p>
	      <input name="registrar" type="button" class="btn"  onclick="registrar_usuario();" value="Registrar" />
	      <a href="listado_usuarios.php"></a>	      </p>
	</form>
	
	<?php }?>	</td>
  </tr>
</table>
<script src="../javascript/valida.js">  </script>
<script language="javascript">

function registrar_usuario()
{



	
	if (document.forms.form1.nombres.value=="")
	{ 
	 document.forms.form1.nombres.focus();
	 alert("Ingresar Nombres");
	 return false; 
	}

	if (document.forms.form1.apellidos.value=="")
	{ 
	 document.forms.form1.apellidos.focus();
	 alert("Ingresar Apellidos");
	 return false; 
	}
	


	



	if (document.forms.form1.dni.value!=="")
	{ 
			if (!Esnum(document.forms.form1.dni.value))
			{
				document.forms.form1.dni.focus();
	 			alert("Ingrese un valor numerico para el DNI");
	 			return false;
			}
	
	}	
			
	if (document.forms.form1.email.value=="")
	{ 
	 document.forms.form1.email.focus();
	 alert("Ingresar Email ");
	 return false; 
	}
  	if (document.forms.form1.clave.value=="")
	{ 
	 document.forms.form1.clave.focus();
	 alert("Clave en blanco");
	 return false; 
	}
		
	if (document.forms.form1.clave.value!= document.forms.form1.clave2.value)
	{
     document.forms.form1.clave.focus();
	 alert("Claves no coinciden");
	 return false;

     }
	 

	
document.forms.form1.id.value='1';
document.forms.form1.action='usuario.php';
document.forms.form1.method='post';
document.forms.form1.submit();


}

function ver_estado()
{
   document.forms.form1.action='usuario.php';
   document.forms.form1.method='post';
   document.forms.form1.submit();
}
</script>
</body>
</html>
<?php $usuario->con->cerrar();  
?>
