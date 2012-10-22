<?php

session_start();
  	
require_once('../clases/auxiliares_data.php');
$auxiliares = new  auxiliaresdata();

if(!isset($_SESSION['usu_id']))
{
	die("No tiene acceso  a esta seccion");
} 

 ?> 	
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>NUEVA CIUDAD</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
<link href="../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
</head>
<?php

		if($_REQUEST['id']==='1')
		{
	  
			$rs=$auxiliares->ciudad_nuevo($_REQUEST['ciudad'],'0');
			if ($rs)
			{

			/*if (!isset($_REQUEST['valor']))
			{*/
				echo "<script  LANGUAGE='JavaScript'> window.opener.location.href = 'generar_cargo.php?fecha=".$_REQUEST['fecha']."&ciudad_origen=".$_SESSION['ciudad_id']."&courier_destino=".$_REQUEST['courier_destino']."&ciudad_destino=".$_REQUEST['ciudad_destino']."&empresa_remite=".$_REQUEST['empresa_remite']."&cargoremitente=".$_REQUEST['cargoremitente']."&consignadoa=".$_REQUEST['consignadoa']."&distritoconsignado=".$_REQUEST['distritoconsignado']."&direccionconsignado=".$_REQUEST['direccionconsignado']."&contacto=".$_REQUEST['contacto']."&forma_pago=".$_REQUEST['forma_pago']."&autorizadopor=".$_REQUEST['autorizadopor']."&tipo_envio=".$_REQUEST['tipo_envio']."&volumen=".$_REQUEST['volumen']."&peso=".$_REQUEST['peso']."&recibidopor=".$_REQUEST['recibidopor']."&tipo_servicio=".$_REQUEST['tipo_servicio']."&recepcionadopor=".$_REQUEST['recepcionadopor']."&dni=".$_REQUEST['dni']."&fecha2=".$_REQUEST['fecha2']."&hora=".$_REQUEST['hora']."&observaciones=".$_REQUEST['observaciones']."&cantidad=".$_REQUEST['cantidad']."';
window.close();  </script>";	
			}
			/*else
			{			
				echo "<script  LANGUAGE='JavaScript'> window.opener.location.href = 'editar_paciente.php?seguro=".$_SESSION['seguro_id']."';
window.close();  </script>";			
			}
			
			}*/
		}

  ?>
<body onload="centrar_pagina()">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;
    </td>
  </tr>
  <tr>
    <td align="center">


	
	<form name="form1"  id="form1">
	  <table width="356" border="0" align="center" cellpadding="0">
          <tr>
            <td colspan="3" align="center">
              <span class="enfasis">
              <input name="pagina" type="hidden" id="pagina">
              </span>
              <input name="id" type="hidden" id="id">
			  <input name="ciudad_codigo" type="hidden" id="ciudad_codigo">		    </td>
          </tr>
          
          <tr>
            <td width="70" align="center" class="color_celda">Ciudad</td>
            <td width="14" align="center" class="color_celda">:</td>
            <td width="264" align="center" valign="top" class="enfasis"><input name="ciudad" type="text" id="ciudad" size="40"  onkeyup='fn(this.form,this)' ></td>
          </tr>
          <tr>
            <td colspan="3" align="left" class="enfasis"><input name="fecha" type="hidden" id="fecha" value="<?php echo $_REQUEST['fecha']?>">
            <input name="ciudad_origen" type="hidden" id="ciudad_origen" value="<?php echo $_REQUEST['ciudad_origen']?>">
            <input name="courier_destino" type="hidden" id="courier_destino" value="<?php echo $_REQUEST['courier_destino']?>">
            <input name="ciudad_destino" type="hidden" id="ciudad_destino" value="<?php echo $_REQUEST['ciudad_destino']?>">
            <input name="empresa_remite" type="hidden" id="empresa_remite" value="<?php echo $_REQUEST['empresa_remite']?>">
            <input name="cargoremitente" type="hidden" id="cargoremitente" value="<?php echo $_REQUEST['cargoremitente']?>">
            <input name="consignadoa" type="hidden" id="consignadoa" value="<?php echo $_REQUEST['consignadoa']?>">
            <input name="distritoconsignado" type="hidden" id="distritoconsignado" value="<?php echo $_REQUEST['distritoconsignado']?>">
            <input name="direccionconsignado" type="hidden" id="direccionconsignado" value="<?php echo $_REQUEST['direccionconsignado']?>">
            <input name="contacto" type="hidden" id="contacto" value="<?php echo $_REQUEST['contacto']?>">
            <input name="forma_pago" type="hidden" id="forma_pago" value="<?php echo $_REQUEST['forma_pago']?>">
            <input name="autorizadopor" type="hidden" id="autorizadopor" value="<?php echo $_REQUEST['autorizadopor']?>">
            <input name="tipo_envio" type="hidden" id="tipo_envio" value="<?php echo $_REQUEST['tipo_envio']?>">
            <input name="volumen" type="hidden" id="volumen" value="<?php echo $_REQUEST['volumen']?>">
            <input name="peso" type="hidden" id="peso" value="<?php echo $_REQUEST['peso']?>">
            <input name="recibidopor" type="hidden" id="recibidopor" value="<?php echo $_REQUEST['recibidopor']?>">
            <input name="tipo_servicio" type="hidden" id="tipo_servicio" value="<?php echo $_REQUEST['tipo_servicio']?>">
            <input name="recepcionadopor" type="hidden" id="recepcionadopor" value="<?php echo $_REQUEST['recepcionadopor']?>">
            <input name="dni" type="hidden" id="dni" value="<?php echo $_REQUEST['dni']?>">
            <input name="fecha2" type="hidden" id="fecha2" value="<?php echo $_REQUEST['fecha2']?>">
            <input name="hora" type="hidden" id="hora" value="<?php echo $_REQUEST['hora']?>">
            <input name="observaciones" type="hidden" id="observaciones" value="<?php echo $_REQUEST['observaciones']?>">
            <input name="cantidad" type="hidden" id="cantidad" value="<?php echo $_REQUEST['cantidad']?>"></td>
          </tr>
	  </table>
      <table width="356" border="0" align="center" cellpadding="0">
      </table>
      <table width="356" border="0" align="center" cellpadding="0">
        <tr>
          <td colspan="3" align="center">
            
            <input name="enviar" type="button" class="btn" onClick="nuevo();" value="Grabar Ciudad">
            &nbsp;&nbsp;
            <label>
              <input name="cerrar" type="button" class="btn" onClick="window.close();" value="Cerrar Ventana">
            </label>			</td>
          </tr>
      </table>
	</form></td>
  </tr>
</table>
</body>


</html>
<script src="../javascript/valida.js">  </script>
<script language="javascript">


function nuevo()
{

	if (document.forms.form1.ciudad.value=="")
	{ 
		document.forms.form1.ciudad.focus();
		alert("Ingresar Ciudad");
		return false; 
	}

document.forms.form1.action='nuevaciudad.php';
document.forms.form1.method='post';
document.forms.form1.id.value='1';
document.forms.form1.submit();
}


</script>

