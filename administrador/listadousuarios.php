<?php session_start();
require_once('../clases/usuario_data.php');
$usuario = new usuariodata();

 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PM Express v1.0 - SISTEMA DE REGISTRO DE CARGOS POR COURIER</title>
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
<link href="../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php  include("menu.php");?></td>
  </tr>
  <tr>
    <td><form  id="form1" name="form1">
      <table width="900" border="0" align="center" cellpadding="0" cellspacing="2">
        <tr>
          <td width="31">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td width="229" colspan="-2">&nbsp;</td>
        </tr>
        <tr align="center">
          <td colspan="4"><input name="Submit" type="button" class="btn" onclick="nuevo();" value="Nuevo Usuario" />
            <input name="id" type="hidden" id="id" /></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="238" align="left">&nbsp;</td>
          <td width="222">&nbsp;</td>
          <td colspan="-2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4"><table width="100%" border="0">
            <tr class="fondonegro">
              <td width="17%" align="center"><span class="fondonegro">Email</span></td>
              <td width="47%" align="center"><span class="fondonegro">Nombre</span></td>
              <td width="18%" align="center">Tipo de Usuario </td>
              <td colspan="2" align="center"><span class="fondonegro">Opci&oacute;n</span></td>
              </tr>
            <?php  
			  //metodo para el paginado de productos por  subcategorias
			  //if ($_REQUEST['id']==='2')
			  if (isset($_REQUEST['usu_codigo']))
				{
			  $usuario->usuario_borrar($_REQUEST['usu_codigo']);
			  }
			 $rs= $usuario->usuario_listar('');
			 if($rs)
			 
			 {$j=1;
			  while($campo =mysql_fetch_array($rs)) { ?>
            <tr bgcolor="#FFFFFF" style="cursor: hand" onMouseOver="bgColor='#FFDBB7'" onMouseOut ="bgColor='#FFFFFF'">
              <td align="center"><?php echo $campo['usu_email']; ?></td>
              <td align="center"><?php echo strtoupper($campo['nombres']); ?></td>
              <td align="center"><?php  if($campo['usu_tipo']=='1')  echo "ADMINISTRADOR"; else echo "USUARIO DE APOYO"; ?></td>
              <td width="10%" align="center">&nbsp;<a href="cambiarclave.php?usu_codigo=<?php echo $campo['usu_id'];   ?>&nombres=<?php echo $campo['nombres'];?>" target="_blank">Cambiar Clave</a> </td>
              <td width="8%" align="center" valign="top"><a href="asignarpermisos.php?usu_codigo=<?php  echo $campo['usu_id']; ?>"></a> <a href="listadousuarios.php?usu_codigo=<?php echo $campo['usu_id'];?>">Eliminar</a></td>
            </tr>
            <?php 
			  $j=$j+1;
			  } 
			  } ?>
            <tr>
              <td colspan="5"><?php   ?></td>
            </tr>
          </table></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>

<script language="javascript">


function nuevo()
{


   document.forms.form1.action='usuario.php';
   document.forms.form1.method='post';
   document.forms.form1.submit();
}


</script>