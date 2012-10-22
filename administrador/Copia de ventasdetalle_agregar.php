<?php
	session_start();
	
	require_once "../clases/ventas_data.php";
	//require_once "../clases/productos_data.php";
	
	//$producto =  new Producto;
	$venta = new Ventas;

	
	if (!isset($_SESSION['sesion_id_usuario']))
	{
		die("Usted no tiene acceso a esta area");
	}
	



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DETALLE VENTA</title>

<link href="../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
<script src="../javascript/eventos.js"></script>
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
</head>
<?php
if($_REQUEST['id']=='1')
{

	$venta->detalleventa_insertar($_REQUEST['codigo'],$_REQUEST['descripcion'],$_REQUEST['cantidad'],$_REQUEST['precio']);
}
	
if($_REQUEST['id']=='2')
{

		$venta->detalleventa_borrar($_POST['campos']);

}
	
	$venta->ventas_ver($_REQUEST['venta']);
	

?>
<body>
<form id="form1" name="form1" >
  <table width="100%" border="0">
    <tr>
      <td colspan="3" bgcolor="#FFFFEC"><table width="100%" border="0">
        <tr>
          <td colspan="4"><?php echo $venta->_tipc_descripcion;?> : <?php echo $venta->_util->ceros_izquierda($venta->_ven_serie_doc,3);?> - <?php echo $venta->_util->ceros_izquierda($venta->_ven_nro_doc,5);?> &nbsp;&nbsp;<span class="enfasis">CLIENTE</span>:<?php echo $venta->_cli_razonsocial;?></td>
          </tr>
        <tr>
          <td width="10%" class="fondo_celda_form enfasis">Descripción</td>
          <td colspan="3"><input name="descripcion" type="text" id="descripcion" size="70" /></td>
        </tr>
        <tr>
          <td class="fondo_celda_form enfasis">Cantidad</td>
          <td width="21%"><input name="cantidad" type="text" id="cantidad" size="4" />            </td>
          <td width="7%" align="center" class="fondo_celda_form enfasis">Precio</td>
          <td width="62%"><?php echo $venta->_tipm_descripcion;?>
            <input name="precio" type="text" id="precio" size="8" />
            <input type="hidden" name="id" id="id" />
            <input name="codigo" type="hidden" id="codigo" value="<?php echo $_REQUEST['codigo']?>" /></td>
          </tr>
        <tr>
          <td colspan="4"><input name="button" type="button" class="btn" id="button" onclick="agregar()" value="Agregar Producto" /></td>
          </tr>
      </table></td>
    </tr>
    <tr>
      <td width="51%">&nbsp;</td>
      <td width="2%">&nbsp;</td>
      <td width="47%">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input name="button2" type="button" class="btn" id="button2" onclick="cerrar()" value="Cerrar Ventana" /></td>
    </tr>
  </table>
  <table width="100%" border="0">
    <tr>
      <td colspan="2">&nbsp;</td>
      <td colspan="4" align="right">

      
      <?php if($venta->_tipc_id=='2'){?>
      <input name="button3" type="button" class="btn" id="button3" onclick="imprimir_comprobante(<?php echo $_REQUEST['codigo']?>)" value="Imprimir" />
      <?php }?>
      
      <input name="button4" type="button" class="btn" id="button4" onclick="validar_checkbox_seleccionados(1)" value="Quitar Seleccionados" /></td>
    </tr>
    <tr class="fondonegro">
      <td colspan="2" align="center">Descripci&oacute;n</td>
      <td width="10%" align="center">Cantidad</td>
      <td width="12%" align="center">Precio</td>
      <td width="13%" align="center">Importe</td>
      <td width="12%" align="center"><input name="grupo" type="checkbox" id="grupo" value="1" onclick="marcar_todos(this.form,this.checked)" /></td>
    </tr>
    <?php 
	
	$j='1';
	$suma_importe=0;
  	$rs=$venta->detalleventa_listar($_REQUEST['codigo']);
  	while($campo =mysql_fetch_array($rs)) { 
  	
	?>
    <tr bgcolor="#FFFFFF" style="cursor: hand" onmouseover="bgColor='#FFDBB7'" onmouseout ="bgColor='#FFFFFF'">
      <td width="3%" align="center"><?php echo $j;?></td>
      <td width="50%" align="center">
	  
	  <?php echo $campo['detv_descripcion'];?>
	  <input name="dcompra[<?php echo $j;?>]" type="hidden" value="<?php echo $campo['detv_id'];?>" size="5"  /></td>
      <td align="center"><?php echo $campo['detv_cantidad'];?> <?php echo $campo['uni_descripcion'];?></td>
      <td align="center"><?php echo $venta->_tipm_descripcion;?> <?php echo $campo['detv_precio'];?></td>
      <td align="center"><?php echo $venta->_tipm_descripcion;?> <?php echo $campo['detv_importe'];?></td>
      <td align="center"><input name="campos[<?php echo $campo['detv_id'];?>]" type="checkbox" /></td>
    </tr>
    <?php 
  $j=$j+1;
  $suma_importe=$suma_importe+$campo['detv_importe'];
  }
  
  $total=$suma_importe;
  $subtotal=$total/1.19;
  $igv=$total-$subtotal;
  
  ?>
    <tr>
      <td align="center"><input name="total" type="hidden" id="total" value="<?php echo $j-1;?>" /></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF"><em><strong>Subtotal</strong></em></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $venta->_tipm_descripcion;?> <?php echo number_format($subtotal,2);?></td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF"><em><strong>IGV</strong></em></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $_REQUEST['moneda'];?> <?php echo number_format($igv,2);?></td>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center" bgcolor="#FFFFFF"><em><strong>Total</strong></em></td>
      <td align="center" bgcolor="#FFFFFF"><?php echo $_REQUEST['moneda'];?> <?php echo number_format($total,2);?></td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
</form>
</body>
</html>
<script language="javascript">

	
	function validar_checkbox_seleccionados(f){

	todos=document.getElementsByTagName('input');
	
	for(x=0;x<todos.length;x++){
		if(todos[x].type=="checkbox" && todos[x].checked){
			return quitar();
		}
	}

	alert("Seleccione al menos 1 elemento a quitar");
	return false;
}

function agregar()
{
	if(document.forms.form1.descripcion.value=='')
	{
		alert('Ingrese el detalle del comprobante');
		document.forms.form1.descripcion.focus();
		return false;
	}
	
	if(document.forms.form1.cantidad.value=='')
	{
		alert('Ingrese la cantidad del detalle');
		document.forms.form1.cantidad.focus();
		return false;
	}	
	
	if(document.forms.form1.precio.value=='')
	{
		alert('Ingrese el precio del detalle');
		document.forms.form1.precio.focus();
		return false;
	}		
   	
	document.forms.form1.id.value='1';
   	document.forms.form1.action='ventasdetalle_agregar.php';
   	document.forms.form1.method='POST';
   	document.forms.form1.submit();
}



function quitar()
{
		
			if (confirm("¿Seguro que desea quitar los registros seleccionados?"))
			{
   				document.forms.form1.id.value='2';
   				document.forms.form1.action='ventasdetalle_agregar.php';
   				document.forms.form1.method='post';
   				document.forms.form1.submit();
			}
	
			else
			{
				return false; 
			} 
			
}

function cerrar()
{
	window.opener.location.href = 'comprobante_registrar.php?cliente=<?php echo $venta->_cli_id;?>&tipocomprobante=<?php echo $venta->_tipc_id;?>';
	window.close();
}


	function imprimir_comprobante(codigo)
	{
		window.open("factura_impresion.php?codigo="+codigo, "_blank", "resizable,height=600,width=800");
			
	}
</script>