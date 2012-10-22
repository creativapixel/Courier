<?php
	session_start();
	
	require_once "../clases/mensajero_data.php";

	require_once "../clases/PHPPaging.lib.php";
	
	$paging = new PHPPaging;	
	$mensajero = new Mensajero;
	
	if (!isset($_SESSION['usu_id']))
	{
		die("Usted no tiene acceso a esta area");
	}

	if (!isset($_REQUEST['npaginas'])){
		$_REQUEST['npaginas']=10;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEMA DE ALMACEN</title>

<link href="../../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
<script src="../../javascript/eventos.js"></script>
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
</head>
<?php

if($_POST['id']=='1')
{
	$rs = $mensajero->mensajero_insertar($_POST['nombres'],$_POST['dni'],$_POST['direccion'],$_POST['telefono'],$_POST['email'],$_POST['apellidos']);
		
	if($rs)
	{
		$_REQUEST['nombres']='';
		$_REQUEST['dni']='';
		$_REQUEST['direccion']='';
		$_REQUEST['telefono']='';
		$_REQUEST['email']='';
		$_REQUEST['apellidos']='';		
	}
}
	
if($_REQUEST['id']=='2')
{
	
	$mensajero->mensajero_borrar($_POST['campos']);
	
	}


?>

<body>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0">
    <tr>
      <td><?php  include("menu.php");?></td>
    </tr>
    <tr>
      <td align="center"><span class="fondo_celda_form"><span class="titulo">Mensajeros</span></span></td>
    </tr>
  </table>
  <table width="90%" border="0" align="center" class="color_form">
    <tr>
      <td width="124" align="right" class="fondo_celda_form">&nbsp;</td>
      <td align="center" class="fondo_celda_form">&nbsp;</td>
      <td>&nbsp;</td>
      <td align="right" class="fondo_celda_form">&nbsp;</td>
      <td align="center" class="fondo_celda_form">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="fondo_celda_form">Nombres</td>
      <td width="15" align="center" class="fondo_celda_form">:</td>
      <td width="207"><input name="nombres" type="text" id="nombres" value="<?php echo $_REQUEST['nombres'];?>" size="30" onChange='mayusculas(this);' />
      <input type="hidden" name="id" id="id" /></td>
      <td width="58" align="right" class="fondo_celda_form">Apellidos</td>
      <td width="11" align="center" class="fondo_celda_form">:</td>
      <td width="258"><input name="apellidos" type="text" id="apellidos" value="<?php echo $_REQUEST['apellidos'];?>" size="40"  onchange='mayusculas(this);' /></td>
    </tr>
    <tr>
      <td align="right" class="fondo_celda_form">DNI</td>
      <td align="center" class="fondo_celda_form">:</td>
      <td><input name="dni" type="text" id="dni" value="<?php echo $_REQUEST['dni'];?>" /></td>
      <td align="right" class="fondo_celda_form">Teléfono</td>
      <td align="center" class="fondo_celda_form">:</td>
      <td><input name="telefono" type="text" id="telefono" value="<?php echo $_REQUEST['telefono'];?>" /></td>
    </tr>
    <tr>
      <td align="right" class="fondo_celda_form">Dirección</td>
      <td align="center" class="fondo_celda_form">:</td>
      <td><input name="direccion" type="text" id="direccion" value="<?php echo $_REQUEST['direccion'];?>" size="30" onChange='mayusculas(this);' /></td>
      <td align="right" class="fondo_celda_form">Email</td>
      <td align="center" class="fondo_celda_form">:</td>
      <td><input name="email" type="text" id="email" value="<?php echo $_REQUEST['email'];?>" size="30" /></td>
    </tr>
    <tr>
      <td align="right" class="fondo_celda_form">&nbsp;</td>
      <td align="center" class="fondo_celda_form">&nbsp;</td>
      <td><input name="button" type="button" class="btn" id="button" value="Grabar Mensajero"  onClick="registrar();" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="fondo_celda_form">&nbsp;</td>
      <td align="center" class="fondo_celda_form">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="90%" border="0" align="center">
    <tr>
      <td colspan="4"><span class="titulo">Listado de Mensajeros</span></td>
      <td colspan="3" align="right"><input name="Submit2" type="button" class="btn" value="Eliminar seleccionados" onclick="eliminar()" /></td>
    </tr>
    <tr class="fondonegro">
      <td width="27%" align="center">Nombres</td>
      <td width="15%" align="center">DNI</td>
      <td width="21%" align="center">Teléfono</td>
      <td colspan="2" align="center">Email</td>
      <td width="5%" align="center">Editar</td>
      <td width="4%" align="center"><input name="grupo" type="checkbox" id="grupo" value="1" onclick="marcar_todos(this.form,this.checked)" /></td>
    </tr>
    <?php 
  	$rs=$mensajero->mensajero_listar('1');
  
	$paging->porPagina($_REQUEST['npaginas']);
	$paging->mostrarAnterior("< Anterior");
	$paging->mostrarSiguiente("Siguiente >");		  
	$paging->agregarConsulta($rs);
	$paging->ejecutar(); 
	
	while($campo = $paging->fetchResultado()) {

  ?>

    <tr bgcolor="#FFFFFF" style="cursor: pointer" onmouseover="bgColor='#E0E0E0'" onmouseout ="bgColor='#FFFFFF'">
      <td align="center"><?php echo $campo['men_nombres'];?> <?php echo $campo['men_apellidos'];?></td>
      <td align="center"><?php echo $campo['men_dni'];?></td>
      <td align="center"><?php echo $campo['men_telefono'];?></td>
      <td colspan="2" align="center"><?php echo $campo['men_email'];?></td>
      <td align="center"><a href="mensajero_editar.php?cod=<?php echo $campo['men_id'];?>"><img src="../imagenes/icono_editar.gif" width="14" height="14" border="0" /></a></td>
      <td align="center"><input name="campos[<?php echo $campo['men_id'];?>]" type="checkbox" /></td>
    </tr>
	<?php } ?>
    <tr>
      <td colspan="7" bgcolor="#FFFFFF"><table width="100%" border="0">
        <tr>
          <td width="19%">Listar
            <input name="npaginas" type="text" id="npaginas" size="2" onblur="enviar_form('GET','mensajeros.php','')" value="<?php echo $_REQUEST['npaginas']?>"/>
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
</form>
</body>
</html>
<script language="javascript" src="../../javascript/valida.js"></script>
<script language="javascript" src="../../javascript/eventos.js"></script>
<script language="javascript">

document.forms.form1.nombres.focus();

	function registrar()
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
				
		document.forms.form1.action = "mensajeros.php";
		document.forms.form1.method = 'POST';
		document.forms.form1.id.value = 1;
		document.forms.form1.submit();

	}

	function eliminar()
	{
		if(validar_checkbox_seleccionados(1)==true)
		{
			if (confirm("¿Seguro que desea eliminar los registros seleccionados?"))
			{
   				enviar_form('POST','mensajeros.php','2');
			}
			else
			{
				return false; 
			} 			
		}
	}

</script>
<?php $mensajero->con->cerrar()?>