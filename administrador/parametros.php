<?php
	session_start();
	
	require_once "../clases/parametros_data.php";
	$parametro =  new Parametros;
	//$empresa = new Empresa;
	
	
	if (!isset($_SESSION['usu_id']))
	{
		die("Usted no tiene acceso a esta area");
	}
	
	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../javascript/eventos.js"></script>
<title>PM Express v1.0 - SISTEMA DE REGISTRO DE CARGOS POR COURIER</title>

<link href="../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0">
  <tr>
    <td><?php include('menu.php');?></td>
  </tr>
</table>
 <h5 align="center">CONFIGURAR PARAMETROS</h5>
 <form id="form1" name="form1" >



   <table width="600" border="0" align="center">
     <tr class="fondonegro">
       <td colspan="2" align="center">Factura</td>
       <td align="center">&nbsp;</td>
     </tr>
     <tr class="fondo_celda_form">
       <td width="11%" align="center" class="fondonegro">Serie</td>
       <td width="12%" align="center" class="fondonegro">Número</td>
       <td width="11%" align="center" class="fondonegro">Editar</td>
     </tr>
     <?php 
  $rs=$parametro->parametros_listar();
  while($campo =mysql_fetch_array($rs)) { 
  ?>
     <tr bgcolor="#FFFFFF" style="cursor: hand" onmouseover="bgColor='#FFDBB7'" onmouseout ="bgColor='#FFFFFF'">
       <td align="center"><?php echo $campo['pard_serie_fact'];?></td>
       <td align="center"><?php echo $campo['pard_nro_fact'];?></td>
       <td align="center"><a href="parametro_editar.php?cod=<?php echo $campo['pard_id'];?>"><img src="../imagenes/icono_editar.gif" width="14" height="14" border="0" /></a></td>
     </tr>
     <?php } ?>
   </table>
   <p>&nbsp;</p>
 </form>
 <p>&nbsp;</p>
</body>
</html>
<?php $parametro->con->cerrar();?>
