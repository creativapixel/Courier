<?php
	session_start();
	
	require_once "../clases/ventas_data.php";
	require_once "../clases/PHPPaging.lib.php";
	
	$paging = new PHPPaging;
	$venta = new Ventas;
	$comprobante = new Comprobante;
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
<p class="titulo">CONSULTA DE VENTAS</p>
<form id="form1" name="form1" method="post" action="">
  <table width="90%" border="0" align="center">
    <tr>
      <td width="96" align="right" class="color_celda">Cliente</td>
      <td width="13" align="center" class="color_celda">:</td>
      <td width="322"><?php $cliente->generar_select_cliente("cliente","","","0","TODOS","1"); ?></td>
      <td width="85" align="right" class="color_celda">Comprobante</td>
      <td width="14" align="center" class="color_celda">:</td>
      <td width="337"><?php $comprobante->generar_select_tipocomprobante("tipocomprobante","","","0","TODOS","1"); ?>
      <input type="hidden" name="id" id="id" /></td>
    </tr>
    <tr>
      <td align="right" class="color_celda">Fecha desde</td>
      <td align="center" class="color_celda">:</td>
      <td><input name="fecha" type="text" id="fecha" value="<?php echo $_REQUEST['fecha']; ?>" size="10"   />
        <a style='cursor:hand;' onclick='document.form1.fecha.oldValue=document.form1.fecha.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fecha, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a> </td>
      <td align="right" class="color_celda">hasta</td>
      <td align="center" class="color_celda">:</td>
      <td><input name="fechaf" type="text" id="fechaf" value="<?php echo $_REQUEST['fechaf']; ?>" size="10"/>
            <a style='cursor:hand;' onclick='document.form1.fechaf.oldValue=document.form1.fechaf.value;PopCalendar.selectWeekendHoliday(1,1);PopCalendar.show(document.form1.fechaf, &quot;dd/mm/yyyy&quot;, null, &quot;&quot;, &quot;&quot;);'><img src="imagen/calendar.gif" width="23" height="21" /></a></td>
    </tr>
    <tr>
      <td align="right" class="fondo_celda_form">&nbsp;</td>
      <td align="center" class="fondo_celda_form">&nbsp;</td>
      <td><input name="button" type="button" class="btn" id="button" onclick="listar()" value="Consultar" />
      <input name="button2" type="button" class="btn" id="button2" onclick="imprimir()" value="Imprimir" /></td>
      <td align="right">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="95%" border="0" align="center">
    <tr>
      <td colspan="11"><p><span class="textoblanco">LISTADO DE COMPROBANTES</span></p></td>
    </tr>
    <tr class="fondonegro">
      <td align="center">Cliente</td>
      <td align="center">Tipo</td>
      <td align="center">Nro Comprobante</td>
      <td align="center">Fecha</td>
      <td align="center">Subtotal.</td>
      <td align="center">Igv</td>
      <td align="center">Total</td>
      <td align="center">Estado</td>
      <td align="center">Incluye Igv </td>
      <td colspan="2" align="center">Imprimir</td>
    </tr>
    <?php 
  $rs=$venta->venta_consulta($_REQUEST['cliente'],$_REQUEST['tipocomprobante'],$_REQUEST['fecha'],$_REQUEST['fechaf']);

	$paging->porPagina($_REQUEST['npaginas']);
	$paging->mostrarAnterior("< Anterior");
	$paging->mostrarSiguiente("Siguiente >");		  
	$paging->agregarConsulta($rs);
	$paging->ejecutar(); 
	
	while($campo = $paging->fetchResultado()) { 
	
  //while($campo =mysql_fetch_array($rs)) { 
  ?>
    <tr bgcolor="#FFFFFF" style="cursor: hand" onmouseover="bgColor='#FFDBB7'" onmouseout ="bgColor='#FFFFFF'">
      <td align="center"><?php echo $campo['cli_razonsocial'];?></td>
      <td align="center"><?php echo $campo['tipc_descripcion'];?></td>
      <td align="center"><?php echo $venta->_util->ceros_izquierda($campo['ven_serie_doc'],3);?> - <?php echo $venta->_util->ceros_izquierda($campo['ven_nro_doc'],5);?></td>
      <td align="center"><?php echo $venta->_util->obtienefecha($campo['ven_fecha'])?></td>
      <td align="center"><?php
      $suma_importe=$venta->sumaimporte_detalleventa($campo['ven_id']);
	  
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
	  
	  ?>        <?php echo $campo['tipm_descripcion']?><?php echo number_format($subtotal,2);?></td>
      <td align="center"><?php echo $campo['tipm_descripcion']?><?php echo number_format($igv,2);?></td>
      <td align="center"><?php echo $campo['tipm_descripcion']?> <?php echo number_format($total,2);?></td>
      <td align="center"><?php if($campo['ven_anulado']=='1'){ ?>
        <font color="#FF0000">Anulado</font>
        <?php } else { ?>
        		&nbsp;
		<?php } ?>
      </td>
      <td align="center"><?php
			if($campo['ven_incluyeigv']=='0')
			{
				echo "No";
			}
			
			if($campo['ven_incluyeigv']=='1')
			{
				echo "S&iacute;";
			}			
		
		?></td>
      <td colspan="2" align="center">
      <?php 
	  if($_SESSION['sesion_id_empresa']=='1'){//facturas para CSM
		  $tipo='1';
	  }
	  if($_SESSION['sesion_id_empresa']=='2'){//facturas para CSCH
		  $tipo='2';
	  }	  
	  ?>      
      <?php if($campo['tipc_id']=='2'){?>
      <a href="#" onclick="imprimir_comprobante(<?php echo $campo['ven_id']?>)">
      	<img src="../imagenes/imprimir.png" alt="Imprimir" width="18" height="16" border="0" />
      </a>
      <?php } ?>
      </td>
    </tr>    <?php } ?>
    <tr bgcolor="#FFFFFF">
      <td colspan="11"><table width="100%" border="0">
        <tr>
          <td width="19%">Listar
            <input name="npaginas" type="text" id="npaginas" size="2" onblur="enviar_form('GET','ventas_consultar.php','')" value="<?php echo $_REQUEST['npaginas']?>"/>
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
<p class="titulo">&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
<script language="javascript">

	function listar()
	{
		document.forms.form1.action='comprobante_consultar.php';
		document.forms.form1.method='GET';
		document.forms.form1.submit();
	}
	
	function imprimir()
	{

		window.open("comprobante_impresion.php?cliente=<?php echo $_REQUEST['cliente']?>&tipocomprobante=<?php echo $_REQUEST['tipocomprobante']?>&fecha=<?php echo $_REQUEST['fecha']?>&fechaf=<?php echo $_REQUEST['fechaf']?>", "_blank", "resizable,height=600,width=800");		
	}

	function imprimir_comprobante(codigo)
	{
			window.open("factura_impresion.php?codigo="+codigo, "_blank", "resizable,height=600,width=800");
		
	}

</script>
<?php $venta->con->cerrar();?>