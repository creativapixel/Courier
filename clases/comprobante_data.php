<?php
require_once "util_data.php";

class Comprobante
{
	public $_util;
	
	public function __construct()
	{
		$this->_util = new  utildata();	
		$this->con=new conexion();
		$this->_util->cn=$this->con->conectar();
	}
	
	public function tipocomprobante_listar()
	{
		$query ="SELECT tipc_id,tipc_descripcion,tipc_eliminado FROM tipo_comprobantes WHERE tipc_eliminado='0' ORDER BY tipc_descripcion ASC";
		$rs = $this->_util->query($query,'','5');
		return $rs;	
	}
	
	public function generar_select_tipocomprobante($nombre,$metodo,$condicion,$cero='',$cero_desc='',$valorini='')
	{
		$rs= $this->tipocomprobante_listar();
		
		if($valorini=='')
		{
			$this->_util->genera_select($nombre,$metodo,'tipc_id','tipc_descripcion',$rs,$cero,$cero_desc);
		}
		else
		{
			$this->_util->genera_select_valorini($nombre,$metodo,'tipc_id','tipc_descripcion',$rs,$cero,$cero_desc);
		}
	}
	
	
	public function listar_moneda()
	{
		$query ="SELECT tipm_id,tipm_descripcion FROM tipo_monedas ORDER BY tipm_descripcion ASC";
		$rs = $this->_util->query($query,'','5');
		return $rs;
		}

	public function generar_select_moneda($nombre,$metodo,$condicion,$cero='',$cero_desc='')
	{
		$rs= $this->listar_moneda();
		$this->_util->genera_select($nombre,$metodo,'tipm_id','tipm_descripcion',$rs,$cero,$cero_desc);
	}

	
	public function estadocomprobante_listar()
	{
		
		$query ="SELECT estc_id,estc_descripcion FROM estado_comprobantes ORDER BY estc_descripcion ASC";
		$rs = $this->_util->query($query,'','5');
		return $rs;
		
	}
	
	public function generar_select_estadocomprobante($nombre,$metodo,$condicion,$cero='',$cero_desc='')
	{
		$rs= $this->estadocomprobante_listar();
		$this->_util->genera_select($nombre,$metodo,'estc_id','estc_descripcion',$rs,$cero,$cero_desc);
	}
	
	public function modopago_listar()
	{
		
		$query ="SELECT modp_id,modp_descripcion FROM modo_pagos ORDER BY modp_descripcion ASC";
		$rs = $this->_util->query($query,'','5');
		return $rs;
		
	}
	
	public function generar_select_modopago($nombre,$metodo,$condicion,$cero='',$cero_desc='',$valorini='')
	{
		$rs= $this->modopago_listar();
		
		if($valorini=='')
		{
			$this->_util->genera_select($nombre,$metodo,'modp_id','modp_descripcion',$rs,$cero,$cero_desc);
		}
		else
		{
			$this->_util->genera_select_valorini($nombre,$metodo,'modp_id','modp_descripcion',$rs,$cero,$cero_desc);			
		}
	}


}


?>