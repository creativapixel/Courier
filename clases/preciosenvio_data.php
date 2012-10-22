<?php   

require_once('util_data.php');
require_once('empresas_data.php');
require_once('zonaenvio_data.php');
require_once('ubigeo_data.php');
require_once('plazoentrega_data.php');

class preciosenviodata
	{
	var $util='';	
	var $query='';
	var $query2='';
	var $ruta='';
	

	function preciosenviodata()
	{
		$this->util = new  utildata();	
		$this->con=new conexion();
		$this->util->cn=$this->con->conectar();
		//$this->empresas->util->cn=$this->con->cn;	
		//$this->auxiliares->util->cn=$this->con->cn;	
	}

	function precioenviomasivo_nuevo($zona,$empresa,$minimo,$preciominimo,$preciomaxima)
	{ 
	
 		$query="select emprem_id,ze_id,ce_eliminado from costo_envio_masivo where ze_id='".$zona."' AND emprem_id='".$empresa."' AND  ce_eliminado='0'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		
		if ($campo['emprem_id'])
		{
 			$this->util->mensaje('El precio ya esta registrado en la zona seleccionada','3');
		}
		else
		{   

			$query="insert into costo_envio_masivo(emprem_id,ze_id,ce_cantminima,ce_preciominima,ce_preciomaxima,ce_eliminado) values ('$empresa','$zona','$minimo','$preciominimo','$preciomaxima','0')";
    	
		 	$rs = $this->util->query($query,'COSTO DE ENVIO','5');	
			return $rs;
		}

   	}
	
	function precioenviomasivo_listar($empresa)
	{   

			$query="SELECT ce.ce_id,ce.emprem_id, ce.ze_id, ce.ce_cantminima,ce.ce_preciominima,ce.ce_preciomaxima, ce.ce_eliminado, er.emprem_razonsocial,ze.ze_id,ze.ze_descripcion from  costo_envio_masivo ce, empresa_remitente er, zona_envio ze WHERE ce.emprem_id=er.emprem_id AND ce.ze_id=ze.ze_id AND ce.emprem_id='".$empresa."' AND ce_eliminado='0'";
    	
		 	$rs = $this->util->query($query,'','5');	
			return $rs;

   	}
	
	function devuelve_precio_envio_masivo($empresa,$ciudad,$cantidad)
	{
		$query="SELECT ce.ce_id,ce.emprem_id,ce.ze_id,ce.ce_cantminima, ce.ce_preciominima,ce.ce_preciomaxima,ce.ce_eliminado,ze.ze_id,ze.ze_descripcion,ze.ze_eliminado,u.ze_id,u.codprov,u.coddist,u.Nombre FROM costo_envio_masivo ce, zona_envio ze, ubigeo u WHERE u.ze_id = ze.ze_id AND ze.ze_id = ce.ze_id AND u.nombre='".$ciudad."' AND ce.ce_eliminado='0' AND ce.emprem_id='".$empresa."'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		
		if ($campo['ce_cantidad']<=$cantidad)
		{
			$this->precio = $campo['ce_preciomaxima'];	
			$this->ce_id = $campo['ce_id'];			
			}
		else
		{
			$this->precio = $campo['ce_preciominima'];	
			$this->ce_id = $campo['ce_id'];				
			}		
		
	}


	function precioenviomasivo_borrar($codigo)
	{
	
  		$aLista=array_keys($codigo); 
 		
		$query="UPDATE costo_envio_masivo SET  ce_eliminado='1'  WHERE  ce_id IN (".implode(',',$aLista).")";  
		
		$rs = $this->util->query($query,'COSTO MASIVO','5');
		
		return $rs;
	}
	
}

?>