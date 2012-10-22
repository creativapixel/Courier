<?php
	session_start();
	
	require_once "../clases/ventas_data.php";
	require_once "../clases/parametros_data.php";	
	require_once "../clases/PHPPaging.lib.php";
	
	$paging = new PHPPaging;
	$ventas = new Ventas;
	$comprobante = new Comprobante;
	$parametro = new Parametros;	
	$cliente = new Cliente;
	
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
<title>PM Express v1.0 - SISTEMA DE REGISTRO DE CARGOS POR COURIER</title>

<link href="../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
<script src="../javascript/valida.js"></script>
<script language="Javascript" src="../javascript/PopCalendar.js"></script>
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
</head>
<?php

if($_REQUEST['id']=='1'){


	
	$ventas->ventas_insertar($_POST['cliente'],$_POST['fecha'],$_POST['tipocomprobante'],$_POST['serie'],$_POST['nro'],$_POST['guia'],$_POST['moneda'],'0',$_POST['incluye']);

	if($_REQUEST['tipocomprobante']==1)
	{
		$parametro->parametro_actualizar_codigo('pard_nro_bol',$_POST['nro']);
	}
	
	if($_REQUEST['tipocomprobante']==2)
	{
		$parametro->parametro_actualizar_codigo('pard_nro_fact',$_POST['nro']);
	}

}


if($_REQUEST['id']=='2')
{
	
	$ventas->ventas_anular($_POST['campos']);
	
	}
?>

<body>
<script language="JavaScript">
	PopCalendar = getCalendarInstance();
	PopCalendar.initCalendar();
</script>	
<table width="100%" border="0">
  <tr>
    <td><?php include('menu.php');?></td>
  </tr>
</table>
<form id="form1" name="form1">
  <table width="95%" border="0" align="center">
    <tr align="center">
      <td colspan="7" class="fondo_celda_form"><h5>REGISTRO DE COMPROBANTES </h5></td>
    </tr>
    <tr>
      <td align="right" class="fondo_celda_form">&nbsp;</td>
      <td align="center" class="fondo_celda_form">&nbsp;</td>
      <td colspan="5">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" class="color_celda">Comprobante</td>
      <td align="center" class="color_celda">:</td>
      <td colspan="5"><?php $comprobante->generar_select_tipocomprobante("tipocomprobante","listar()",""); ?>
      <?php 
	  if($_REQUEST['tipocomprobante']==1)
	  {
		  $serie=$ventas->_util->ceros_izquierda($parametro->parametro_ver_codigo('pard_serie_bol') + 1,3);
		  $nro=$ventas->_util->ceros_izquierda($parametro->parametro_ver_codigo('pard_nro_bol') + 1,5);
	  }
	  
	  if($_REQUEST['tipocomprobante']==2)
	  {
		  $serie=$ventas->_util->ceros_izquierda($parametro->parametro_ver_codigo('pard_serie_fact') + 1,3);
		  $nro=$ventas->_util->ceros_izquierda($parametro->parametro_ver_codigo('pard_nro_fact') + 1,5);
	  }	  
	  ?>
        <input name="serie" type="text" id="serie" size="5" value="<?php echo $serie ?>" />
        <span class="texto_blanco"> - </span>
<input name="nro" type="text" id="nro" size="12" value="<?php echo $nro; ?>" />      </td>
    </tr>
    <tr>
      <td align="right" class="color_celda">Cliente</td>
      <td align="center" class="color_celda">:</td>
      <td width="346"><?php $cliente->generar_select_cliente("cliente","listar()",""); ?></td>
      <td width="55" align="right" class="color_celda">Fecha </td>
      <td width="11" align="center" class="color_celda">:</td>
      <td width="145"><input name="fecha" type="text" id="fecha" value="<?php echo $_REQUEST['fecha']; ?>" size="8"  onkeyup='fn(this.form,this)'/>
      <a style='cursor:hand;' onclick='document.form1.fecha.oldValue=document.form1.fecha.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fecha, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a>	<input name="id" type="hidden" id="id" /></td>
      <td width="203" rowspan="4" align="center" bgcolor="#FFFFFF"><p>Ingrese los datos de la cabecera del comprobante y posteriormente ingrese el detalle del comprobante en el botón &lt;Agregar&gt;.</p></td>
    </tr>
    <tr>
      <td align="right" class="color_celda">Nº Guia de Remisión</td>
      <td align="center" class="color_celda">:</td>
      <td><input name="guia" type="text" id="guia" size="10" /></td>
      <td align="right" class="color_celda">Moneda</td>
      <td align="center" class="color_celda">:</td>
      <td><?php $comprobante->generar_select_moneda("moneda","",""); ?></td>
    </tr>
    <tr>
      <td align="right" class="color_celda">Incluye IGV </td>
      <td align="center" class="color_celda">:</td>
      <td colspan="4"><input name="incluye" type="checkbox" id="incluye" value="1" /></td>
    </tr>
    <tr>
      <td width="140" align="right" class="color_celda">&nbsp;</td>
      <td width="12" align="center" class="color_celda">&nbsp;</td>
      <td colspan="4"><input name="button" type="button" class="btn" id="button" onclick="registrar()" value="Registrar Comprobante" /></td>
    </tr>
  </table>
  <table width="100%" border="0" align="center">
    <tr>
      <td colspan="9"><p><span class="textoblanco">LISTADO DE COMPROBANTES POR CLIENTE</span></p></td>
      <td colspan="4" align="right"><input name="Submit2" type="button" class="btn" value="Anular seleccionados" onClick="validar_checkbox_seleccionados(1)" /></td>
    </tr>
    <tr class="fondonegro">
      <td align="center">Fecha</td>
      <td align="center">Tipo</td>
      <td align="center">Nro Comprobante</td>
      <td align="center">Mon.</td>
      <td align="center">Nro Guia Rem.</td>
      <td align="center">Subtotal</td>
      <td align="center">Igv</td>
      <td align="center">Total</td>
      <td align="center">Estado</td>
      <td align="center">Inc. IGV </td>
      <td colspan="2" align="center">Detalle de comprobante</td>
      <td align="center"><input name="grupo" type="checkbox" id="grupo" value="1" onclick="marcar_todos(this.form,this.checked)" /></td>
    </tr>
    <?php 
  	
	$rs=$ventas->ventas_listar($_REQUEST['cliente'],$_REQUEST['tipocomprobante']);

	$paging->porPagina($_REQUEST['npaginas']);
	$paging->mostrarAnterior("< Anterior");
	$paging->mostrarSiguiente("Siguiente >");		  
	$paging->agregarConsulta($rs);
	$paging->ejecutar(); 
	
	while($campo = $paging->fetchResultado()) { 
	
  ?>
    <tr bgcolor="#FFFFFF" style="cursor: hand" onmouseover="bgColor='#FFDBB7'" onmouseout ="bgColor='#FFFFFF'">
      <td align="center"><?php echo $ventas->_util->obtienefecha($campo['ven_fecha'])?></td>
      <td align="center"><?php echo $campo['tipc_descripcion']?></td>
      <td align="center"><?php echo $ventas->_util->ceros_izquierda($campo['ven_serie_doc'],3);?> - <?php echo $ventas->_util->ceros_izquierda($campo['ven_nro_doc'],5);?></td>
      <td align="center"><?php echo $campo['tipm_descripcion']?></td>
      <td align="center"><?php echo $campo['ven_guia']?>
      <?php
      $suma_importe=$ventas->sumaimporte_detalleventa($campo['ven_id']);
	  
		if($campo['ven_incluyeigv']==0)
		{
			$subtotal = $suma_importe;	
			$igv = $subtotal * 0.19;
			$total = $subtotal + $igv;			
		}
		
		if($campo['ven_incluyeigv']==1)
		{
			$total=$suma_importe;
			$subtotal=$total/1.19;	
			$igv=$total-$subtotal;		
		}
	  
	  ?>      </td>
      <td align="center"><?php echo $campo['tipm_descripcion']?> <?php echo number_format($subtotal,2);?></td>
      <td align="center"><?php echo $campo['tipm_descripcion']?> <?php echo number_format($igv,2);?></td>
      <td align="center"><?php echo $campo['tipm_descripcion']?> <?php echo number_format($total,2);?></td>
      <td align="center"><?php if($campo['ven_anulado']=='1'){ ?>
        <font color="#FF0000">Anulado</font>
        <?php } else { ?>
        <?php echo "&nbsp;";?>
        <?php } ?></td>
      <td align="center">
      	<?php
			if($campo['ven_incluyeigv']=='0')
			{
				echo "No";
			}
			
			if($campo['ven_incluyeigv']=='1')
			{
				echo "S&iacute;";
			}			
		
		?>
      </td>
      <td width="8%" align="center"><input name="button3" type="button" class="btn" id="button32" onclick="agregar_detalle(<?php echo $campo['ven_id']?>)" value="Agregar" /></td>
      <td width="11%" align="center">      <?php 
	  //if($_SESSION['sesion_id_empresa']=='1'){//facturas para CSM
		 // $tipo='1';
	 //}
	 // if($_SESSION['sesion_id_empresa']=='2'){//facturas para CSCH
		 // $tipo='2';
	  //}	  
	  ?>      
      <?php if($campo['tipc_id']=='2'){?>
      <a href="#" onclick="imprimir_comprobante(<?php echo $campo['ven_id']?>)">
      	<img src="../imagenes/imprimir.png" alt="Imprimir" width="18" height="16" border="0" />
      </a>
      <?php } ?></td>
      <td align="center">
      <?php if($campo['ven_anulado']=='0'){?>
      <input name="campos[<?php echo $campo['ven_id'];?>]" type="checkbox" />
      <?php } ?>
      </td>
    </tr>    <?php } ?>
    <tr bgcolor="#FFFFFF">
      <td colspan="13"><table width="100%" border="0">
        <tr>
          <td width="19%">Listar
            <input name="npaginas" type="text" id="npaginas" size="2" onblur="listar()" value="<?php echo $_REQUEST['npaginas']?>"/>
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
  <p>&nbsp;</p>
</form>

</body>
</html>
<script language="javascript">

	function registrar()
	{
		if (document.forms.form1.fecha.value=="")
		{ 
			document.forms.form1.fecha.focus();
			alert("Ingresar Fecha de Envio");
			return false; 
		}
		
		document.forms.form1.action='comprobante_registrar.php';
		document.forms.form1.method='POST';
		document.forms.form1.id.value='1'
		document.forms.form1.submit();
			
	}

function  borrar()
{
	if (confirm("¿Seguro que desea eliminar los registros seleccionados?"))
	{
		document.forms.form1.id.value='2';
		document.forms.form1.action='comprobante_registrar.php';
		document.forms.form1.method='POST';
		document.forms.form1.submit();
	}
	else
	{
		return false; 
	} 
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

	function listar()
	{
		document.forms.form1.action='comprobante_registrar.php';
		document.forms.form1.method='GET';
		document.forms.form1.submit();
	}

	function agregar_detalle(codigo)
	{
		window.open('comprobantedetalle_agregar.php?codigo='+codigo, "ventana", "resizable,height=500,width=550");
	
		}

	function imprimir_comprobante(codigo)
	{
			window.open("factura_impresion.php?codigo="+codigo, "_blank", "resizable,height=600,width=800");
		
	}
</script>
<?php $ventas->con->cerrar();?>