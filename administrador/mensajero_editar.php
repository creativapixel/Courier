<?php
	session_start();
	
	require_once "../clases/mensajero_data.php";
	$mensajero =  new Mensajero;
	
	if (!isset($_SESSION['usu_id']))
	{
		die("Usted no tiene acceso a esta area");
	}
	
	if(!isset($_REQUEST['id']))
	{
		$_REQUEST['codigo']=$_REQUEST['cod'];	
	}
	



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../../javascript/eventos.js"></script>
<title>SISTEMA DE ALMACEN</title>
<link href="../../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
</head>
<?php
if($_REQUEST['id']=='2')
{
	//proveedor_editar($codigo,$razonsocial,$ruc,$direccion,$email,$telefono,$contacto)
	$rs = $mensajero->mensajero_editar($_REQUEST['codigo'],$_REQUEST['nombres'],$_REQUEST['dni'],$_REQUEST['direccion'],$_REQUEST['email'],$_REQUEST['telefono'],$_REQUEST['apellidos']);

		if($rs)
		{
			echo "<script  LANGUAGE='JavaScript'> document.location.href='mensajeros.php'; </script>";		
		}

}

	$mensajero->mensajero_ver($_REQUEST['codigo']);
?>
<body>
 
 <table width="100%" border="0">
   <tr>
     <td><?php include 'menu.php';?></td>
   </tr>
   <tr>
     <td align="center"><span class="titulo">Editar Mensajero</span></td>
   </tr>
 </table>
 <form id="form1" name="form1" >
   <table width="70%" border="0" align="center" class="color_form">
     <tr>
       <td width="182" align="right" class="fondo_celda_form">&nbsp;</td>
       <td align="center" class="fondo_celda_form">&nbsp;</td>
       <td colspan="2">&nbsp;</td>
     </tr>
     <tr>
       <td align="right" class="fondo_celda_form"> Nombres</td>
       <td width="20" align="center" class="fondo_celda_form">:</td>
       <td colspan="2"><input name="nombres" type="text" id="nombres" onkeyup='enter(this.form,this)' value="<?php echo $mensajero->_men_nombres;?>" size="50" onChange='mayusculas(this);' />
       <input type="hidden" name="codigo" id="codigo" value="<?php echo $mensajero->_men_id;?>" /></td>
    </tr>
     <tr>
       <td align="right" class="fondo_celda_form">Apellidos</td>
       <td align="center" class="fondo_celda_form">:</td>
       <td colspan="2"><input name="apellidos" type="text" id="apellidos" value="<?php echo $mensajero->_men_apellidos;?>" size="50"  onchange='mayusculas(this);' /></td>
     </tr>
     <tr>
       <td align="right" class="fondo_celda_form">DNI</td>
       <td align="center" class="fondo_celda_form">:</td>
       <td colspan="2"><input name="dni" type="text" id="dni" onkeyup='enter(this.form,this)' value="<?php echo $mensajero->_men_dni;?>" size="15"  maxlength="11" />
       <input type="hidden" name="id" id="id" /></td>
    </tr>
     <tr>
       <td align="right" class="fondo_celda_form">Dirección</td>
       <td align="center" class="fondo_celda_form">:</td>
       <td colspan="2"><input name="direccion" type="text" id="direccion" value="<?php echo $mensajero->_men_direccion;?>" size="60" onChange='mayusculas(this);' /></td>
    </tr>
     <tr>
       <td align="right" class="fondo_celda_form">Teléfono</td>
       <td align="center" class="fondo_celda_form">:</td>
       <td colspan="2"><input name="telefono" type="text" id="telefono" value="<?php echo $mensajero->_men_telefono;?>" /></td>
    </tr>
     <tr>
       <td align="right" class="fondo_celda_form">Email</td>
       <td align="center" class="fondo_celda_form">:</td>
       <td colspan="2"><input name="email" type="text" id="email" value="<?php echo $mensajero->_men_email;?>" size="50" onblur="validar_correo(this.value)" /></td>
    </tr>
     <tr>
       <td align="right" class="fondo_celda_form">&nbsp;</td>
       <td align="center" class="fondo_celda_form">&nbsp;</td>
       <td width="156"><input name="button" type="button" class="btn" id="button" value="Editar Mensajero"  onclick="editar();" /></td>
       <td width="342"><input name="button2" type="button" class="btn" id="button2" value="Regresar" onclick="regresar()" /></td>
     </tr>
   </table>
</form>
 <p>&nbsp;</p>
</body>
</html>
<?php $mensajero->con->cerrar()?>
<script language="javascript">
	function editar()
	{


		if(document.forms.form1.nombres.value=='')
		{
			alert('Ingrese el Nombre');
			document.forms.form1.nombres.focus();
			return false;
		}	
		
		if(document.forms.form1.apellidos.value=='')
		{
			alert('Ingrese el apellido');
			document.forms.form1.apellidos.focus();
			return false;
		}			

  	document.forms.form1.action='mensajero_editar.php';
   	document.forms.form1.method='post';
	document.forms.form1.id.value=2;
   	document.forms.form1.submit();	

	}
	
function regresar()
{
  	document.forms.form1.action='mensajeros.php';
   	document.forms.form1.method='post';
   	document.forms.form1.submit();	
}	
</script>