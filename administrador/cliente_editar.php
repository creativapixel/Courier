<?php
	session_start();
	
	require_once "../clases/cliente_data.php";
	$cliente =  new Cliente;
	
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

<title>PM Express v1.0 - SISTEMA DE REGISTRO DE CARGOS POR COURIER</title>

<link href="../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
</head>
<?php
if($_REQUEST['id']=='1')
{


	//proveedor_editar($codigo,$razonsocial,$ruc,$direccion,$email,$telefono,$contacto)
	$cliente->cliente_editar($_REQUEST['codigo'],$_REQUEST['razonsocial'],$_REQUEST['ruc'],$_REQUEST['direccion'],$_REQUEST['email'],$_REQUEST['telefono'],$_REQUEST['contacto']);
	
}

	$cliente->cliente_ver($_REQUEST['codigo']);
?>
<body>
 <table width="100%" border="0">
   <tr>
     <td><?php include('menu.php');?></td>
   </tr>
 </table>
 <p class="titulo">&nbsp;</p>
 <form id="form1" name="form1" >
   <table width="498" border="0" align="center">
     <tr align="center">
       <td colspan="3"><h5>EDITAR CLIENTE</h5></td>
     </tr>
     <tr>
       <td width="128" align="right" class="color_celda">Razón Social</td>
       <td width="20" align="center" class="color_celda">:</td>
       <td width="336"><input name="razonsocial" type="text" id="razonsocial" onkeyup='enter(this.form,this)' value="<?php echo $cliente->_cli_razonsocial;?>" size="50" />
       <input type="hidden" name="codigo" id="codigo" value="<?php echo $cliente->_cli_id;?>" /></td>
     </tr>
     <tr>
       <td align="right" class="color_celda">RUC</td>
       <td align="center" class="color_celda">:</td>
       <td><input name="ruc" type="text" id="ruc" onkeyup='enter(this.form,this)' value="<?php echo $cliente->_cli_ruc;?>" size="15"/>
       <input type="hidden" name="id" id="id" /></td>
     </tr>
     <tr>
       <td align="right" class="color_celda">Dirección</td>
       <td align="center" class="color_celda">:</td>
       <td><input name="direccion" type="text" id="direccion" value="<?php echo $cliente->_cli_direccion;?>" size="50" /></td>
     </tr>
     <tr>
       <td align="right" class="color_celda">Teléfono</td>
       <td align="center" class="color_celda">:</td>
       <td><input name="telefono" type="text" id="telefono" value="<?php echo $cliente->_cli_telefono;?>" /></td>
     </tr>
     <tr>
       <td align="right" class="color_celda">Email</td>
       <td align="center" class="color_celda">:</td>
       <td><input name="email" type="text" id="email" value="<?php echo $cliente->_cli_email;?>" size="50" /></td>
     </tr>
     <tr>
       <td align="right" class="color_celda">Contacto</td>
       <td align="center" class="color_celda">:</td>
       <td><input name="contacto" type="text" id="contacto" value="<?php echo $cliente->_cli_contacto;?>" size="50" /></td>
     </tr>
     <tr>
       <td align="right" class="color_celda"><input name="button2" type="submit" class="btn" id="button2" onclick="regresar()" value="Regresar" /></td>
       <td align="center" class="color_celda">&nbsp;</td>
       <td><input name="button" type="button" class="btn" id="button" onclick="editar()" value="Editar Cliente"/></td>
     </tr>
   </table>
</form>
 <p>&nbsp;</p>
</body>
</html>
<?php $cliente->con->cerrar(); ?>
<script language="javascript">
	function editar()
	{
		if (document.forms.form1.razonsocial.value=="")
		{ 
			document.forms.form1.razonsocial.focus();
			alert("Ingresar la Razon Social o Nombre");
			return false; 
		}

		if (document.forms.form1.ruc.value=="")
		{ 
			document.forms.form1.ruc.focus();
			alert("Ingresar el RUC");
			return false; 
		}
		
		if (document.forms.form1.direccion.value=="")
		{ 
			document.forms.form1.direccion.focus();
			alert("Ingresar la direccion");
			return false; 
		}		

		document.forms.form1.action='cliente_editar.php';
		document.forms.form1.method='post';
		document.forms.form1.id.value='1'
		document.forms.form1.submit();		
	}


	function regresar()
	{
		document.forms.form1.action='clientes.php';
		document.forms.form1.method='post';
		document.forms.form1.submit();		
	}
	
</script>