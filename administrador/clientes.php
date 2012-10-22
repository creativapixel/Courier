<?php
	session_start();
	
	require_once "../clases/cliente_data.php";

	require_once "../clases/PHPPaging.lib.php";
	
	$paging = new PHPPaging;	
	$cliente = new Cliente;
	
	if (!isset($_SESSION['usu_id']))
	{
		die("Usted no tiene acceso a esta area");
	}

	if (!isset($_REQUEST['npaginas'])){
		$_REQUEST['npaginas']=20;
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

	if($_POST['id']=='1')
	{
		$rs = $cliente->cliente_insertar($_POST['razonsocial'],$_POST['ruc'],$_POST['direccion'],$_POST['telefono'],$_POST['email'],$_POST['contacto']);
	}
	
if($_REQUEST['id']=='2')
{
	
	$cliente->cliente_borrar($_POST['campos']);
	
	}


?>

<body>
<table width="100%" border="0">
  <tr>
    <td><?php include('menu.php');?></td>
  </tr>
</table>
<form id="form1" name="form1" method="post" action="">
  <table width="843" border="0">
    <tr align="center">
      <td colspan="6" class="fondo_celda_form"><h5><span class="titulo">CLIENTES</span></h5></td>
    </tr>
    <tr>
      <td width="86" align="right" class="color_celda">Razón Social</td>
      <td width="22" align="center" class="color_celda">:</td>
      <td width="275"><input name="razonsocial" type="text" id="razonsocial" size="40" />
      <input type="hidden" name="id" id="id" /></td>
      <td width="55" align="right" class="color_celda">RUC</td>
      <td width="22" align="center" class="color_celda">:</td>
      <td width="357"><input type="text" name="ruc" id="ruc" /></td>
    </tr>
    <tr>
      <td align="right" class="color_celda">Dirección</td>
      <td align="center" class="color_celda">:</td>
      <td><input name="direccion" type="text" id="direccion" size="40" /></td>
      <td align="right" class="color_celda">Teléfono</td>
      <td align="center" class="color_celda">:</td>
      <td><input name="telefono" type="text" id="telefono" size="40" /></td>
    </tr>
    <tr>
      <td align="right" class="color_celda">Email</td>
      <td align="center" class="color_celda">:</td>
      <td><input name="email" type="text" id="email" size="40" /></td>
      <td align="right" class="color_celda">Contacto</td>
      <td align="center" class="color_celda">:</td>
      <td><input name="contacto" type="text" id="contacto" size="40" /></td>
    </tr>
    <tr>
      <td align="right" class="color_celda">&nbsp;</td>
      <td align="center" class="color_celda">&nbsp;</td>
      <td><input name="button" type="button" class="btn" id="button"  onclick="registrar()" value="Registrar Cliente"/></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="100%" border="0">
    <tr>
      <td colspan="5"><span class="textoblanco">LISTADO DE CLIENTES</span></td>
      <td colspan="3" align="right"><input name="Submit2" type="button" class="btn" value="Eliminar seleccionados"  onClick="validar_checkbox_seleccionados(1)"/></td>
    </tr>
    <tr class="fondonegro">
      <td width="21%" align="center">Razón Social</td>
      <td width="8%" align="center">RUC</td>
      <td width="15%" align="center">Dirección</td>
      <td width="14%" align="center">Teléfono</td>
      <td width="9%" align="center">Email</td>
      <td width="24%" align="center">Contacto</td>
      <td width="5%" align="center">Editar</td>
      <td width="4%" align="center"><input name="grupo" type="checkbox" id="grupo" value="1" onclick="marcar_todos(this.form,this.checked)" /></td>
    </tr>
    <?php 
  	$rs=$cliente->cliente_listar('1');
  
	$paging->porPagina($_REQUEST['npaginas']);
	$paging->mostrarAnterior("< Anterior");
	$paging->mostrarSiguiente("Siguiente >");		  
	$paging->agregarConsulta($rs);
	$paging->ejecutar(); 
	
	while($campo = $paging->fetchResultado()) {

  ?>
    <tr bgcolor="#FFFFFF" style="cursor: hand" onmouseover="bgColor='#FFDBB7'" onmouseout ="bgColor='#FFFFFF'">
      <td align="center"><?php echo $campo['cli_razonsocial'];?></td>
      <td align="center"><?php echo $campo['cli_ruc'];?></td>
      <td align="center"><?php echo $campo['cli_direccion'];?></td>
      <td align="center"><?php echo $campo['cli_telefono'];?></td>
      <td align="center"><?php echo $campo['cli_email'];?></td>
      <td align="center"><?php echo $campo['cli_contacto'];?></td>
      <td align="center"><a href="cliente_editar.php?cod=<?php echo $campo['cli_id'];?>"><img src="../imagenes/icono_editar.gif" width="14" height="14" border="0" /></a></td>
      <td align="center"><input name="campos[<?php echo $campo['cli_id'];?>]" type="checkbox" /></td>
    </tr>
 <?php } ?>
    <tr>
      <td colspan="8" bgcolor="#FFFFFF"><table width="100%" border="0">
        <tr>
          <td width="19%">Listar
            <input name="npaginas" type="text" id="npaginas" size="2" onblur="enviar_form('GET','clientes.php','')" value="<?php echo $_REQUEST['npaginas']?>"/>
            registros</td>
          <td width="27%"><?php 
			  		$links = $paging->fetchNavegacion();
					echo $links;
				?></td>
          <td width="38%" align="center"><?php echo "Mostrando ".$num_registros_aqui = $paging->numRegistrosMostrados()." registros. Desde ".$primer_elemento = $paging->numPrimerRegistro()." al ".$ultimo_elemento = $paging->numUltimoRegistro()."
 de un total de ".$total_registros = $paging->numTotalRegistros();
?></td>
          <td width="16%" align="center"><?php echo "P&aacute;gina ".$pagina_actual = $paging->numEstaPagina()." de ".$num_paginas = $paging->numTotalPaginas();?></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <p class="titulo">&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>
<script language="javascript">

	function registrar()
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

		document.forms.form1.action='clientes.php';
		document.forms.form1.method='post';
		document.forms.form1.id.value='1'
		document.forms.form1.submit();		
	}

function validar_checkbox_seleccionados(f){

	todos=document.getElementsByTagName('input');
	
	for(x=0;x<todos.length;x++){
		if(todos[x].type=="checkbox" && todos[x].checked){
			return borrar();
		}
	}

	alert("Seleccione al menos 1 elemento a eliminar");
	return false;
}

function  borrar()
{
	if (confirm("¿Seguro que desea eliminar los registros seleccionados?"))
	{
		document.forms.form1.id.value='2';
		document.forms.form1.action='clientes.php';
		document.forms.form1.method='POST';
		document.forms.form1.submit();
	}
	else
	{
		return false; 
	} 
}

</script>
<?php $cliente->con->cerrar(); ?>