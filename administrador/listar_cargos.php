<?php 

session_start();
require_once('../clases/cargocourier_data.php');


include_once "../clases/PHPPaging.lib.php";
$paging = new PHPPaging;


$cargo = new  cargocourierdata();
$empresas = new  empresasdata();
$auxiliares = new  auxiliaresdata();

if(!isset($_SESSION['usu_id']))
{
	die("No tiene acceso  a esta seccion");
}

if(!isset($_REQUEST['courier_destino']))
{
	$_REQUEST['courier_destino']='0';
}

if($_REQUEST['id']==='2')
{
	$cargo->cargocourier_borrar('1');
}

if (!isset($_REQUEST['npaginas'])){
	$_REQUEST['npaginas']=50;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>PM Express v1.0 - SISTEMA DE REGISTRO DE CARGOS POR COURIER</title>
<link href="../estilos/css_sistema.css" rel="stylesheet" type="text/css" />
<link href="../imagenes/logo.ico" type="image/x-icon" rel="shortcut icon">

<div ID="waitDiv" style="position:absolute;left:300;top:300;visibility:hidden"> 
<table  border="0" align="center"> 
<tr><td> 
<img src="../imagenes/loading9.gif" border="0"> 
</td> 
</tr></table> 
</div> 
<SCRIPT> 
<!-- 
var DHTML = (document.getElementById || document.all || document.layers); 
function ap_getObj(name) { 
if (document.getElementById) 
{ return document.getElementById(name).style; } 
else if (document.all) 
{ return document.all[name].style; } 
else if (document.layers) 
{ return document.layers[name]; } 
} 
function ap_showWaitMessage(div,flag) { 
if (!DHTML) return; 
var x = ap_getObj(div); x.visibility = (flag) ? 'visible':'hidden' 
if(! document.getElementById) if(document.layers) x.left=280/2; return true; } ap_showWaitMessage('waitDiv', 3); 
//--> 
</SCRIPT> 


</head>

<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php  include("menu.php");?></td>
  </tr>
  <tr>
    <td><form  id="form1" name="form1">
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="31">&nbsp;</td>
          <td colspan="2">&nbsp;</td>
          <td width="214" colspan="-2">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" align="center"><h5>
            <img src="../archivos/titulo_listadocargos.png" width="382" height="36" />
            <input name="paciente_codigo" type="hidden" id="paciente_codigo" />
              <input name="id" type="hidden" id="id" />
          </h5></td>
          </tr>
        <tr>
          <td>&nbsp;</td>
          <td width="87" align="center" class="color_celda">Courier: </td>
          <td width="647"><?php  	
					$empresas->generar_select_courier_todos('courier_destino','listar_cargos()',''); ?>
            <input name="codigo_cargo" type="hidden" id="codigo_cargo" /></td>
          <td colspan="-2"><input name="Submit2" type="button" class="btn" value="Eliminar seleccionados" onClick="validar_checkbox_seleccionados(1)"></td>
        </tr>
        <tr>
          <td colspan="4" align="center"><table width="950" border="0">
            <tr align="center" class="fondonegro">
              <td width="7%">N&ordm; Guia </td>
              <td width="9%">Fecha Emisi&oacute;n </td>
              <td width="27%"><span class="Estilo2">Empresa Remitente </span></td>
              <td width="24%">Consignado</td>
              <td width="13%"><span class="Estilo2">Destino</span></td>
              <td width="10%"><span class="Estilo2">Tipo de Envio </span></td>
              <td width="5%">Editar</td>
              <td width="5%"><input name="grupo" type="checkbox" id="grupo" value="1" onclick="marcar_todos(this.form,this.checked)" ></td>
            </tr>

            <tr>
              <td colspan="8">
			  <div style="position:static;width:950px; height:450px; overflow:scroll; z-index:1;  ">
			  
			  <table width="100%" border="0">
            <?php  
			
			  $rs=$cargo->cargocourier_listar($_REQUEST['courier_destino'],'','','','','1','');
			  
			  $paging->porPagina($_REQUEST['npaginas']);
			  $paging->mostrarAnterior("< Anterior");
			  $paging->mostrarSiguiente("Siguiente >");		  
			  $paging->agregarConsulta($rs);
			  
			  $paging->ejecutar();


			 if($rs)
			 
			 {
			 $j=1;
			 
			  while($campo = $paging->fetchResultado()) { ?>
            <tr bgcolor="#FFFFFF" style="cursor: hand" onMouseOver="bgColor='#FFDBB7'" onMouseOut ="bgColor='#FFFFFF'">
              <td width="7%" align="center"><a href="#" onclick="vista_previa(<?php echo $campo['carcou_id'];?>)"><?php echo $campo['carcou_id'];  ?></a></td>
              <td width="9%" align="center"><?php echo $cargo->util->obtienefecha($campo['carcou_fecha']);  ?></td>
              <td width="27%" align="center"><?php echo strtoupper($campo['emprem_razonsocial']); ?></td>
              <td width="24%" align="center"><?php echo strtoupper($campo['carcou_consignadoa']); ?></td>
              <td width="13%" align="center" ><?php echo strtoupper($auxiliares->devuelve_ciudad($campo['ciu_id']));  ?></td>
              <td width="10%" align="center"><?php echo $campo['carcou_cantidad'];  ?> <?php echo strtoupper($campo['tipoenv_descripcion']); ?></td>
              <td width="5%" align="center"><a href="editar_cargo.php?cargo_id=<?php echo $campo['carcou_id']?>"><img src="../imagenes/icono_editar.gif" alt="Editar Registro" border="0" /></a></td>
              <td width="5%" align="center"><input name="campos[<?php echo $campo['carcou_id'];?>]" type="checkbox" ></td>
            </tr>
            <?php 
			  	$j=$j+1;
  	 
			  } 
			  } ?>
              </table>
			  </div>			  </td>
              </tr>
            <tr>
              <td colspan="8" class="enfasis"><table width="100%" border="0" bgcolor="#FFFFFF">
                <tr>
                  <td><label>
                    Listar 
                    <input name="npaginas" type="text" id="npaginas" size="3" onblur="listar_cargos()" value="<?php echo $_REQUEST['npaginas']?>" onkeyup='fn(this.form,this)' /> 
                    registros
                  </label></td>
                  <td><?php 
			  		$links = $paging->fetchNavegacion();
					echo $links;
				?>
                    </td>
                  <td><?php echo "Mostrando ".$num_registros_aqui = $paging->numRegistrosMostrados()." registros. Desde ".$primer_elemento = $paging->numPrimerRegistro()." al ".$ultimo_elemento = $paging->numUltimoRegistro()."
 de un total de ".$total_registros = $paging->numTotalRegistros();
?></td>
                  <td><?php echo "P&aacute;gina ".$pagina_actual = $paging->numEstaPagina()." de ".$num_paginas = $paging->numTotalPaginas();?></td>
                </tr>
              </table></td>
              </tr>
            <tr>
              <td colspan="8" align="center"></td>
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
<SCRIPT language="javascript">

function vista_previa(guia){
	window.open("cargo_impresion.php?cargo_codigo="+guia, "_blank", "resizable,height=600,width=800");
}

function listar_cargos(){
	document.forms.form1.action='listar_cargos.php';
	document.forms.form1.method='get';
	document.forms.form1.submit();
}

function  borrar()
{

/*	todos=document.getElementsByTagName('input');
	
	for(x=0;x<todos.length;x++){
	
		if(todos[x].type=="checkbox" && todos[x].checked){*/
		
			if (confirm("¿Seguro que desea eliminar los registros seleccionados?"))
			{
   				document.forms.form1.id.value='2';
   				document.forms.form1.action='listar_cargos.php';
   				document.forms.form1.method='post';
   				document.forms.form1.submit();
			}
	
			else
			{
				return false; 
			} 
			
/*		}
	}
	
	alert("Seleccione al menos 1 elemento a eliminar");
	return false;			
	
*/
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


/*function otravalidacion(){
	alert("si");
	return true
}*/




<!--  
ap_showWaitMessage('waitDiv', 0);  
//--> 
</SCRIPT>
<?php  $cargo->con->cerrar(); ?>