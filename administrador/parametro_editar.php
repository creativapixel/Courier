<?php
	session_start();
	
	require_once "../clases/parametros_data.php";
	$parametro =  new Parametros;
	
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
if($_REQUEST['id']=='2')
{
	
	$parametro->parametros_editar($_REQUEST['codigo'],$_REQUEST['serie_factura'],$_REQUEST['numero_factura'],'','');
	
}

	$parametro->parametros_ver($_REQUEST['codigo']);
?>
<body>
 <table width="100%" border="0">
  <tr>
    <td><?php include('menu.php');?></td>
  </tr>
</table>
 <h5 align="center">EDITAR PARAMETROS</h5>
 <form id="form1" name="form1" >
   <table width="326" border="0" align="center">
     <tr>
       <td width="55" rowspan="2" align="right" class="color_celda">Fctura</td>
       <td width="50" align="right" class="color_celda">Serie</td>
       <td width="15" align="center" class="color_celda">:</td>
       <td width="492"><input name="serie_factura" type="text" id="serie_factura" onkeyup='enter(this.form,this)' value="<?php echo $parametro->_pard_serie_fact;?>" size="5"/>
       <input type="hidden" name="codigo" id="codigo" value="<?php echo $parametro->_pard_id;?>" />
       <input type="hidden" name="id" id="id2" /></td>
     </tr>
     <tr>
       <td align="right" class="color_celda">Número</td>
       <td align="center" class="color_celda">:</td>
       <td><input name="numero_factura" type="text" id="numero_factura" onkeyup='enter(this.form,this)' value="<?php echo $parametro->_pard_nro_fact;?>" size="5"/> 
         (1 menos al generado actual) </td>
     </tr>
     <tr>
       <td colspan="2" align="right" class="fondo_celda_form"><input name="button2" type="submit" class="btn" id="button2" onclick="regresar()" value="Regresar" /></td>
       <td align="center" class="fondo_celda_form">&nbsp;</td>
       <td><input name="button" type="button" class="btn" id="button" onclick="editar()" value="Editar Parametros"/></td>
     </tr>
   </table>
</form>
 <p>&nbsp;</p>
</body>
</html>
<?php $parametro->con->cerrar();?>
<script language="javascript">
	function editar()
	{
		if (document.forms.form1.serie_factura.value=="")
		{ 
			document.forms.form1.serie_factura.focus();
			alert("Ingrese la serie de la factura");
			return false; 
		}

		if (document.forms.form1.numero_factura.value=="")
		{ 
			document.forms.form1.numero_factura.focus();
			alert("Ingresar el numero de la factura");
			return false; 
		}
	

		document.forms.form1.action='parametro_editar.php';
		document.forms.form1.method='post';
		document.forms.form1.id.value='2'
		document.forms.form1.submit();		
	}


	function regresar()
	{
		document.forms.form1.action='parametros.php';
		document.forms.form1.method='post';
		document.forms.form1.submit();		
	}
	
	
</script>