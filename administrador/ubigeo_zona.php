<?php session_start();
  	
require_once('../clases/ubigeo_data.php');
$ubigeo = new  ubigeo_data();
$zona = new zonaenvio_data;


 ?> 
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>PM Express v1.0 - SISTEMA DE REGISTRO DE CARGOS POR COURIER</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
      <?php  include("menu.php");?></td>
  </tr>
  <tr>
    <td align="center">
	

<?php 



if($_REQUEST['id']==='1')
{
	$ubigeo->ubigeo_agregarzona($_REQUEST['zona']);
}

/*
if ($_REQUEST['id']==='2')
{
	$zona->zona_borrar($_REQUEST['zona_codigo']);
}


*/
		
		
		  
		  ?>

	
	<form name="form1"  id="form1">
        <table width="512" border="0" align="center" cellpadding="0">
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr align="center">
            <td colspan="2"><h5>MANTENIMIENTO DE ZONAS DE DESTINO </h5></td>
          </tr>
          <tr>
            <td colspan="2" align="left" class="enfasis">&nbsp;</td>
          </tr>
          <tr>
            <td align="right" class="color_celda">Departamento: &nbsp; </td>
            <td width="370" align="left" class="enfasis"><?php echo $ubigeo->generar_select_ubigeo('departamento','ver_datos()','coddpto','','1')?></td>
          </tr>
          <tr>
            <td align="right" class="color_celda">Provincia:&nbsp;&nbsp;</td>
            <td align="left" class="enfasis"><?php echo $ubigeo->generar_select_ubigeo('provincia','ver_datos()','codprov',$_REQUEST['departamento'],'2')?></td>
          </tr>
          <tr>
            <td colspan="2" align="left" class="enfasis">&nbsp;</td>
          </tr>
          <tr>
            <td width="136" align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"><table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
              <tr>
                <td width="55" align="center" class="color_celda">Zona :</td>
                <td width="250" align="left"><span class="enfasis"><?php echo $zona->generar_select_zonaenvio_masivo('zona','','')?></span></td>
                <td colspan="2" align="center"><input name="Submit" type="button" class="btn" onclick="validar_checkbox_seleccionados(1)" value="A&ntilde;adir Zona a selecionados">
                  <input type="hidden" name="id" id="id"></td>
                </tr>
              <tr class="fondonegro">
                <td align="center">ORDEN</td>
                <td align="center">DESCRIPCI&Oacute;N</td>
                <td width="252" align="center">ZONA</td>
                <td width="33" align="center"><input name="grupo" type="checkbox" id="grupo" value="1" onclick="marcar_todos(this.form,this.checked)" ></td>
                </tr>
              
			  <?php  
			 // $parametros="&programa=".$_REQUEST['programa'];
			  //metodo para el paginado de productos por  subcategorias
			 $rs= $ubigeo->listar_distrito($_REQUEST['departamento'],$_REQUEST['provincia']);
			 if($rs)
			 
			 {$j=1;
			  while($campo =mysql_fetch_array($rs)) { ?>
			  <tr bgcolor="#FFFFFF" style="cursor: hand" onMouseOver="bgColor='#FFDBB7'" onMouseOut ="bgColor='#FFFFFF'">
                <td align="center"><?php echo $j; ?></td>
                <td align="center"><?php echo strtoupper($campo['nombre']) ?></td>
                <td align="center"><?php echo strtoupper($zona->devuelve_zonaenvio($campo['ze_id'])) ?></td>
                <td align="center"><input name="campos[<?php echo $campo['ub_id'];?>]" type="checkbox" ></td>
                </tr>
			  <?php 
			  $j=$j+1;
			  } 
			  } ?>
              <tr>
                <td colspan="4">&nbsp;</td>
                </tr>
              <tr>
                <td colspan="4" align="center"><?php  // echo $vinculo->util->devuelve_paginado($vinculo->query,$parametros,$idioma='1',$color='#006699');  ?></td>
              </tr>
            </table></td>
          </tr>
        </table>
    </form></td>
  </tr>
</table>
</body>


</html>
<script src="../javascript/valida.js">  </script>
<script language="javascript">

function ver_datos()
{
	document.forms.form1.action='ubigeo_zona.php';
	document.forms.form1.method='post';
	document.forms.form1.submit();
}



function agregar()
{

	document.forms.form1.action='ubigeo_zona.php';
	document.forms.form1.method='post';
	document.forms.form1.id.value='1'
	document.forms.form1.submit();

}


function   borrar(zona_codigo)
{

	if (confirm("¿Seguro que desea eliminar el registro?"))
	{
		document.forms.form1.id.value='2';
		document.forms.form1.zona_codigo.value=zona_codigo;
		document.forms.form1.action='zona.php';
		document.forms.form1.method='post';
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
			return agregar();
		}
	}

	alert("Seleccione al menos 1 elemento a eliminar");
	return false;
}


</script>

