<?php session_start();
 require_once('../clases/auxiliares_data.php');
$igv= new auxiliaresdata();
if(!isset($_SESSION['usu_id']))
 	{
	die("No tiene acceso  a esta seccion");
 	}



		


 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MANTENIMIENTO</title>
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php 


?>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php  include("menu.php");?></td>
  </tr>
  <tr>
    <td><form  id="form1" name="form1">
      <table width="797" border="0" align="center" cellpadding="0" cellspacing="2">
        <tr>
          <td width="31">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td width="229" colspan="-2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" align="center"><h5>
            <input name="prove_codigo" type="hidden" id="prove_codigo" />
            <input name="id" type="hidden" id="id" />
            I.G.V.</h5></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="238" align="left">&nbsp;</td>
          <td width="222">&nbsp;</td>
          <td colspan="-2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" align="center"><table width="29%" border="0">
            <tr align="center" class="fondonegro">
              <td width="64%"><span class="Estilo2">IGV (Valor decimal) </span></td>
              <td width="36%"><span class="Estilo2">Opci&oacute;n</span></td>
            </tr>
            <?php  
			  $rs=$igv->listar_igv();
			  
			 if($rs)
			 
			 {$j=1;
			  while($campo =mysql_fetch_array($rs)) { ?>
            <tr align="center" bgcolor="#F3F4F8" onMouseOver="bgColor='#ffffff'" onMouseOut ="bgColor='#F3F4F8'" style="cursor: hand" >
              <td><?php echo $campo['igv_valor'] ?></td>
              <td><a href="editarigv.php?igv_id=<?php echo $campo['igv_id']; ?>" target="_self">Editar</a></td>
              </tr>
            <?php 
			  $j=$j+1;
			 } 
			 } ?>
            <tr>
              <td colspan="2">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2" align="center"><?php
								//echo $proveedor->util->devuelve_paginado($proveedor->query); 
				?></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>

<?php  $igv->con->cerrar(); ?>