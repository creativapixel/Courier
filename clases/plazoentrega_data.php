<?php

class Plazoentrega_data
{

	var $_descripcion;

	function plazoentrega_data()
	{
	
		$this->util = new  utildata();	
		$this->con=new conexion();
		$this->util->cn=$this->con->conectar();	
		
	} 

	function listar_plazoentrega_masivo()
	{
		$query="SELECT plaent_id,plaent_descripcion,plaent_eliminado FROM plazo_entrega WHERE plaent_eliminado='0'";
		$rs=$this->util->query($query,'','5');
		return $rs;
	}
	
	function generar_select_plazoentrega_masivo($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_plazoentrega_masivo();
		$this->util->genera_select_seleccionar($nombre,$metodo,'plaent_id','plaent_descripcion',$rsp,$cero,$cero_desc);
	}


}

?>