<?php   

require_once('util_data.php');
require_once('empresas_data.php');
require_once('auxiliares_data.php');
require_once('mensajero_data.php');

class cargo_externo_data
{
	var $util='';	
	var $query='';
	var $query2='';
	var $ruta='';

	function cargo_externo_data()
	{
		$this->util = new  utildata();	
		$this->con=new conexion();
		$this->util->cn=$this->con->conectar();
		$this->empresas->util->cn=$this->con->cn;	
		$this->auxiliares->util->cn=$this->con->cn;	
	}
//cargo_externo_asignar($_REQUEST['fecha'],$_REQUEST['cargo'.$i.''],$_REQUEST['courier_destino'],$_REQUEST['mensajero']);
	function cargo_externo_asignar($fecha,$cargo,$courier,$mensajero)
 	{
	
		$fecha= $this->util->conviertefecha($fecha);		
	
	
		$querye = "SELECT men_id,carex_nro_cargo,empcou_id FROM cargos_externos WHERE carex_nro_cargo='".$cargo."' AND empcou_id='".$courier."'";
		$rse = mysql_query($querye);
		$campoe = mysql_fetch_array($rse);
		
		if($campoe['carex_nro_cargo'])
		{
			$querym = "SELECT men_id,carex_nro_cargo,empcou_id FROM cargos_externos WHERE carex_nro_cargo='".$cargo."' AND empcou_id='".$courier."' AND men_id!='0'";
		
			$rsm = mysql_query($querym);
			$campom = mysql_fetch_array($rsm);
		
			if($campom['carex_nro_cargo'])
			{
				echo "<script> alert('El cargo ".$cargo." ya esta registrado. Clic en aceptar para continuar'); </script>";
			}
			else
			{
		
				$query="UPDATE cargos_externos SET men_id='$mensajero',carex_fecha_salida='$fecha' WHERE empcou_id='$courier' AND carex_nro_cargo='$cargo' ";
		 		$rs= $this->util->query($query,'DATOS ACTUALIZADOS','5');
 				return $rs;
		
			}
		}
		else
		{
			echo "<script> alert('El cargo ".$cargo."' no existe. Clic en aceptar para continuar); </script>";	
		}
 	}

	function cargo_externo_nuevo($fecha,$cargo,$empresa_courier)
	{   
	
			$fecha= $this->util->conviertefecha($fecha);
			
			$queryc = "SELECT empcou_id,carex_nro_cargo FROM cargos_externos WHERE empcou_id='".$empresa_courier."' AND carex_nro_cargo='".$cargo."'";
			$rsc = mysql_query($queryc);
			$campoc = mysql_fetch_array($rsc);
			
			if($campoc['carex_nro_cargo'])
			{
				
			}
			else
			{
				$query="INSERT INTO cargos_externos(empcou_id,carex_fecha,carex_nro_cargo) VALUES('$empresa_courier','$fecha','$cargo')";
    	
			 	$rs = $this->util->query($query,'CARGO','5');	
				return $rs;
			}
   	}
	
	function cargo_externo_listar($paginado=0,$fecha='',$courier='',$mensajero='',$fecha_inicio='',$fecha_final='',$cargo='',$fecha_salida='')
	{
		$query = "SELECT ce.carex_id,ce.empcou_id,ce.men_id,ce.carex_fecha,ce.carex_nro_cargo,ec.empcou_razonsocial FROM cargos_externos ce, empresa_courier ec WHERE ce.empcou_id=ec.empcou_id ";
		
		if($fecha!='')
		{
			$fecha = $this->util->conviertefecha($fecha);
			$query2 = " AND ce.carex_fecha ='".$fecha."'";
		}
		
		if($courier!='')
		{
			$query3 = " AND ce.empcou_id='".$courier."'";
		}
		
		if($mensajero!='')
		{
			$query4 = " AND ce.men_id='".$mensajero."'";	
		}
		
		if($fecha_inicio!='' && $fecha_final!='')
		{
			$fecha_inicio = $this->util->conviertefecha($fecha_inicio);
			$fecha_final = $this->util->conviertefecha($fecha_final);
			
			$query5 = " AND ce.carex_fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_final."'";
		}
		
		if($cargo!='')
		{
			$query6 = " ce.carex_nro_cargo='".$cargo."'";	
		}
		
		if($fecha_salida!='')
		{
			$fecha_salida = $this->util->conviertefecha($fecha_salida);
			$query7 = " AND ce.carex_fecha_salida='".$fecha_salida."'";
		}
		
		$queryn = " ORDER BY ce.carex_id DESC";
		
		$query = $query.$query2.$query3.$query4.$query5.$query6.$query7.$queryn;
		
		if($paginado==0)
		{
			$rs = $this->util->query($query,'','5');	
			return $rs;
		}
		else
		{
			return $query;	
		}
		
	}
	
	function cargo_externo_borrar($campos)
	{
		$id = array_keys($campos);
		
		$query = "DELETE FROM cargos_externos WHERE carex_id IN (".implode(',',$id).")";
		
		$rs = mysql_query($query);
		return $rs;
	}
	
	function cargo_externo_no_asignar($campos)
	{
		$id = array_keys($campos);
		
		$query = "UPDATE cargos_externos SET men_id='0' WHERE carex_id IN (".implode(',',$id).")";
		
		$rs = mysql_query($query);
		return $rs;
	}	
}

?>