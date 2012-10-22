<?php
require_once( 'util_data.php');
require_once 'zonaenvio_data.php';
class ubigeo_data   
{

	var $codigo="";
	var $tipo="";

	public function ubigeo_data()
	{	
	
		$this->util = new  utildata();	
		$this->con=new conexion();
		$this->util->cn=$this->con->conectar();
		
	}
	

	function listar_ubigeo($codigo,$tipo)
	{
		$query="SELECT ub_id,coddpto,codprov,coddist,nombre,ze_id FROM ubigeo WHERE ";
		
		
		if($tipo=='1')//departamento
		{
			$query1=" codprov='00' AND coddist='00'";
			}

		if($tipo=='2')//provincia
		{
			$query1=" coddpto='".$codigo."' AND codprov!='00' AND coddist='00'";
			}
		
		$queryn=" ORDER BY nombre ASC";
		
		$query=$query.$query1.$queryn;
		
		$rs=$this->util->query($query,'','5');
		return $rs;
	}
	
	function generar_select_ubigeo($nombre,$metodo,$campo,$codigo,$tipo)
	{

		$rsp= $this->listar_ubigeo($codigo,$tipo);
		$this->util->genera_select($nombre,$metodo,''.$campo.'','nombre',$rsp,'','');
	}	
	
	function listar_distrito($departamento,$provincia)
	{
		$query="SELECT ub_id,nombre,ze_id FROM ubigeo WHERE coddpto='".$departamento."' AND codprov='".$provincia."' AND coddist!='00' ORDER BY nombre ASC";
		
		$rs=$this->util->query($query,'','5');
		return $rs;
	}
	
	function ubigeo_agregarzona($zona)
	{
	
  		$aLista=array_keys($_POST['campos']); 
 		
		$query="update ubigeo set  ze_id='".$zona."'  where  ub_id IN (".implode(',',$aLista).")";  
		$rs = $this->util->query($query,'','5');
		
		return $rs;
	}


	
}


?>