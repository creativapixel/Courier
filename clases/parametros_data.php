<?php
require_once "util_data.php";
//require_once "empresas_data.php";

class Parametros
{
	public $_util;
	
	public function __construct()
	{
		$this->_util = new  utildata();	
		$this->con=new conexion();
		$this->_util->cn=$this->con->conectar();
	}
	
	public function parametro_ver_codigo($nombre_campo)
	{
		$query = "SELECT ".$nombre_campo." FROM parametros_documentos";
		$rs = $this->_util->query($query,'','5');
		
		$campo= mysql_fetch_array($rs);
		
		$this->_campo = $campo[''.$nombre_campo.''];

		return $this->_campo;
		
	}
	
	public function parametro_actualizar_codigo($nombre_campo,$valor)
	{
		$query="UPDATE parametros_documentos SET ".$nombre_campo."='".$valor."'";
 		$rs= $this->_util->query($query,'','5');
 		return $rs;
	}
	
	public function parametros_listar()
	{
		
		$query ="SELECT pard_id,pard_serie_fact,pard_nro_fact,pard_serie_bol,pard_nro_bol FROM parametros_documentos";
		$rs = $this->_util->query($query,'','5');
		return $rs;
	}
	
	public function parametros_ver($codigo)
	{
		
		$query ="SELECT pard_id,pard_nro_fact,pard_serie_fact,pard_nro_bol,pard_serie_bol FROM parametros_documentos WHERE pard_id='".$codigo."'";
		$rs = $this->_util->query($query,'','5');
		$campo = mysql_fetch_array($rs);
		
		$this->_pard_id=$campo['pard_id'];
		$this->_pard_serie_fact=$campo['pard_serie_fact'];
		$this->_pard_nro_fact=$campo['pard_nro_fact'];
		$this->_pard_nro_bol=$campo['pard_nro_bol'];
		$this->_pard_serie_bol=$campo['pard_serie_bol'];
		
		return $this->_pard_id;
		
	}


	public function parametros_editar($codigo,$serie_fact,$numero_fact,$serie_bol,$numero_bol)
	{
		$query="UPDATE parametros_documentos SET pard_serie_fact='".$serie_fact."', pard_nro_fact='".$numero_fact."',pard_serie_bol='".$serie_bol."', pard_nro_bol='".$numero_bol."' WHERE pard_id=".$codigo."";
 		$rs= $this->_util->query($query,'PARAMETRO','1');
 		return $rs;		
	}


}


?>