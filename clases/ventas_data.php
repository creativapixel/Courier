<?php
require_once "util_data.php";
require_once "comprobante_data.php";
require_once "cliente_data.php";


class Ventas
{
	public $_util;
	
	public function __construct()
	{
		$this->_util = new  utildata();	
		$this->con=new conexion();
		$this->_util->cn=$this->con->conectar();
	}
		
	public function ventas_insertar($cliente,$fecha,$tipocomprobante,$serie,$nro,$guia,$moneda,$anulado,$incluye_igv)
	{
		if($incluye_igv=='')
		{
			$incluye_igv=0;
		}
		
		$fecha=$this->_util->conviertefecha($fecha);
		
		$query="SELECT ven_id,cli_id,ven_nro_doc,ven_serie_doc,tipc_id FROM ventas WHERE cli_id='".$cliente."' AND tipc_id='".$tipocomprobante."' AND ven_nro_doc='".$nro."' AND ven_serie_doc='".$serie."' AND ven_anulado='0'";
		
		$rs = $this->_util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		
		if ($campo['ven_id'])
		{
 			$this->_util->mensaje('El comprobante ya se encuetra registrado. Verifique por favor!!','3');
		}
		else
		{ 
			$query = "INSERT INTO ventas(tipc_id,cli_id,ven_serie_doc,ven_nro_doc,ven_fecha,ven_guia,ven_anulado, tipm_id,ven_incluyeigv) VALUES ('$tipocomprobante','$cliente','$serie','$nro','$fecha','$guia','$anulado','$moneda','$incluye_igv')";
			$rs = $this->_util->query($query,'COMPROBANTE','1');		
	
			return $rs;
		}
	}	
	
	public function ventas_listar($cliente='',$tipo='',$serie='',$nro='',$moneda='')
	{
		
	$query ="SELECT v.ven_id,v.cli_id,v.tipc_id,v.ven_fecha,v.ven_nro_doc,v.ven_serie_doc,v.ven_guia,v.ven_anulado,v.tipm_id,c.cli_razonsocial,tc.tipc_descripcion,mo.tipm_descripcion,v.ven_incluyeigv FROM ventas v, clientes c,tipo_comprobantes tc,tipo_monedas mo WHERE v.cli_id=c.cli_id AND v.tipc_id=tc.tipc_id AND v.tipm_id=mo.tipm_id AND v.cli_id='".$cliente."'";
		
		
		if ($tipo!='')
		{
			$query1=" AND v.tipc_id='".$tipo."' ";	
		}		
			
		$queryn=" ORDER BY v.ven_id DESC";
		
		$query=$query.$query1.$queryn;
		
		return $query;
		
	}
	
	public function ventas_ver($codigo='',$tipo_comprobante='',$serie_comprobante='',$nro_comprobante='')
	{
		$query0 ="SELECT v.ven_id,v.cli_id,v.tipc_id,v.ven_fecha,v.ven_nro_doc,v.ven_serie_doc,v.ven_guia,v.ven_anulado,v.tipm_id,c.cli_razonsocial,c.cli_ruc,c.cli_direccion,tc.tipc_descripcion,mo.tipm_descripcion,v.ven_incluyeigv FROM ventas v, clientes c,tipo_comprobantes tc,tipo_monedas mo WHERE v.cli_id=c.cli_id AND v.tipc_id=tc.tipc_id AND v.tipm_id=mo.tipm_id ";

		if($nro_serie!='')
		{
			$query1=" AND v.ven_serie_doc='".$serie_comprobante."'";
		}

		if($nro_comprobante!='')
		{
			$query2=" AND v.ven_nro_doc='".$nro_comprobante."'";
		}
		
		if($tipo_comprobante!='')
		{		
			$query3=" AND c.tipc_id='".$tipo_comprobante."'";		
		}
		
		if($codigo!='')
		{
			$query5=" AND v.ven_id='".$codigo."'";
		}		

		if($cliente!='')
		{
			$query6=" AND v.cli_id='".$cliente."'";
		}	

		$query=$query0.$query1.$query2.$query3.$query5.$query6;
		
		$rs = $this->_util->query($query,'','5');
		
		$campo= mysql_fetch_array($rs);
		
		$this->_id = $campo['ven_id'];
		$this->_tipc_descripcion = $campo['tipc_descripcion'];
		$this->_tipc_id = $campo['tipc_id'];
		$this->_ven_nro_doc = $campo['ven_nro_doc'];
		$this->_ven_serie_doc = $campo['ven_serie_doc'];
		$this->_ven_fecha = $campo['ven_fecha'];
		$this->_ven_guia = $campo['ven_guia'];
		$this->_tipm_descripcion = $campo['tipm_descripcion'];
		$this->_cli_razonsocial = $campo['cli_razonsocial'];
		$this->_cli_direccion = $campo['cli_direccion'];
		$this->_cli_ruc = $campo['cli_ruc'];
		$this->_tipm_id = $campo['tipm_id'];
		$this->_tipm_descripcion = $campo['tipm_descripcion'];
		$this->_ven_anulado = $campo['ven_anulado'];
		$this->_ven_incluyeigv = $campo['ven_incluyeigv'];		
		$this->_cli_id = $campo['cli_id'];
	}
		


	public function detalleventa_listar($venta)
	{
		$query = "SELECT dv.detv_id,dv.ven_id,dv.detv_descripcion,dv.detv_cantidad,dv.detv_precio,dv.detv_importe from detalle_venta dv WHERE dv.ven_id='".$venta."'";
		$rs = $this->_util->query($query,'','5');	
		return $rs;
		
	}

	public function detalleventa_insertar($venta,$descripcion,$cantidad,$precio)
	{
		$querya="SELECT detv_descripcion FROM detalle_venta WHERE ven_id='".$venta."' AND detv_descripcion='".$descripcion."'";
		$rsa = $this->_util->query($querya,'','5');
		$campo=mysql_fetch_array($rsa);
		
		if($campo['detv_descripcion'])
		{
			$this->_util->mensaje('La descripcion ya se encuentra en la lista. Verifique!!','3');		
		}
		else
		{
			$importe=$precio;
			$query = "INSERT INTO detalle_venta(ven_id,detv_descripcion,detv_cantidad,detv_precio,detv_importe) VALUES ('$venta','$descripcion','$cantidad','$precio','$importe')";
			$rs = $this->_util->query($query,'','5');
			return $rs;
		}
	}
			
/*	public function detalleventa_insertar($venta,$descripcion,$cantidad,$precio)
	{
		$querya="SELECT detv_descripcion FROM detalle_venta WHERE ven_id='".$venta."' AND detv_descripcion='".$descripcion."'";
		$rsa = $this->_util->query($querya,'','5');
		$campo=mysql_fetch_array($rsa);
		
		if($campo['detv_descripcion'])
		{
			$this->_util->mensaje('La descripcion ya se encuentra en la lista. Verifique!!','3');		
		}
		else
		{
			$importe=$cantidad*$precio;
			$query = "INSERT INTO detalle_venta(ven_id,detv_descripcion,detv_cantidad,detv_precio,detv_importe) VALUES ('$venta','$descripcion','$cantidad','$precio','$importe')";
			$rs = $this->_util->query($query,'','5');
			return $rs;
		}
	}
		*/

	public function ventas_anular($datos)
	{
 		$aLista=array_keys($datos); 
		$query="UPDATE ventas SET  ven_anulado='1' WHERE ven_id IN (".implode(',',$aLista).")"; 
	 	$rs = $this->_util->query($query,'','5');
		return $rs;
	}

	public function detalleventa_borrar($datos)
	{
	
  		$aLista=array_keys($datos); 
 		
		$query="DELETE FROM detalle_venta WHERE detv_id IN (".implode(',',$aLista).")";  
		
		$rs = $this->_util->query($query,'','5');
		return $rs;
	}
	
	public function sumaimporte_detalleventa($venta)
	{
		$query="SELECT SUM(detv_importe) AS sumaimporte FROM detalle_venta WHERE ven_id='".$venta."'";
		$rs = $this->_util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		return $campo['sumaimporte'];	
	}
	

	public function venta_consulta($cliente='',$tipo='',$fechai='',$fechaf='',$sin_paginado='')
	{
		
		
		$query ="SELECT v.ven_id,v.cli_id,v.tipc_id,v.ven_fecha,v.ven_nro_doc,v.ven_serie_doc,v.ven_guia,v.ven_anulado,v.tipm_id,c.cli_razonsocial,tc.tipc_descripcion,mo.tipm_descripcion,v.ven_incluyeigv FROM ventas v, clientes c,tipo_comprobantes tc,tipo_monedas mo WHERE v.cli_id=c.cli_id AND v.tipc_id=tc.tipc_id AND v.tipm_id=mo.tipm_id";
		
		if ($cliente > 0)
		{
			$query1=" AND v.cli_id='".$cliente."' ";	
		}
		
		if ($tipo > 0)
		{
			$query3=" AND v.tipc_id='".$tipo."' ";	
		}
		
		if ($fechai!='' && $fechaf!='')
		{
			$fechai=$this->_util->conviertefecha($fechai);
			$fechaf=$this->_util->conviertefecha($fechaf);
			$query4=" AND v.ven_fecha BETWEEN '".$fechai."' AND '".$fechaf."'";	
		}
			
		$queryn=" ORDER BY v.ven_fecha DESC";
		
		$query=$query.$query1.$query2.$query3.$query4.$queryn;

		if($sin_paginado==1)
		{
			$rs = $this->_util->query($query,'','5');
			return $rs;
		}
		else
		{
			return $query;
		}
		
	}


}


?>