<?php

class zonaenvio_data
{

	var $descripcion='';

	function zonaenvio_data()
	{
		$this->util = new  utildata();	
		$this->con=new conexion();
		$this->util->cn=$this->con->conectar();		
	} 

	function listar_zonaenvio_masivo()
	{
		$query="SELECT ze_id,ze_descripcion,ze_eliminado FROM zona_envio WHERE ze_eliminado='0' ORDER BY ze_descripcion ASC";
		$rs=$this->util->query($query,'','5');
		return $rs;
	}
	
	function generar_select_zonaenvio_masivo($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_zonaenvio_masivo();
		$this->util->genera_select_seleccionar($nombre,$metodo,'ze_id','ze_descripcion',$rsp,$cero,$cero_desc);
	}


	function devuelve_zonaenvio($codigo)
	{
		$query="SELECT ze_id,ze_descripcion FROM zona_envio WHERE ze_id='".$codigo."' AND ze_eliminado='0'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		return $campo['ze_descripcion'];	
	}


}

?>