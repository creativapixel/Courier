<?php   
	 	require_once('util_data.php');
	 	require_once('auxiliares_data.php');
			
class empresasdata
	{
	var $util='';	
	var $query='';
	var $query2='';
	var $ruta='';



	function empresasdata()
	{
		$this->util = new  utildata();	
		$this->con=new conexion();
		$this->util->cn=$this->con->conectar();
	}

	function listar_courier()
	{
		$query="select c.empcou_id,CONCAT(c.empcou_razonsocial,' - ',ci.ciu_descripcion) as nombre,c.ciu_id,c.empcou_eliminado,ci.ciu_descripcion from EMPRESA_COURIER c, CIUDAD ci where c.ciu_id=ci.ciu_id and c.empcou_eliminado='0' order by c.empcou_razonsocial asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	function listar_courierciudad($codigo)
	{

		$query="select c.empcou_id,CONCAT(c.empcou_razonsocial,' - ',ci.ciu_descripcion) as nombre,c.ciu_id,c.empcou_eliminado,ci.ciu_descripcion,c.empcou_razonsocial from EMPRESA_COURIER c, CIUDAD ci where c.ciu_id=ci.ciu_id and c.empcou_eliminado='0' and c.ciu_id='".$codigo."' order by c.empcou_razonsocial asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	
	function generar_select_courier($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_courier();
		$this->util->genera_select($nombre,$metodo,'empcou_id','nombre',$rsp,$cero,$cero_desc);
	}
	
	function generar_select_courier_todos($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_courier();
		$this->util->genera_select_todos($nombre,$metodo,'empcou_id','nombre',$rsp,$cero,$cero_desc);
	}	
	

	function courier_nuevo($descripcion,$estado,$ciudad)
	{   

 		$query="select empcou_razonsocial from EMPRESA_COURIER where empcou_razonsocial='".$descripcion."' and ciu_id='".$ciudad."'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		if ($campo['empcou_razonsocial'])
		{
 			$this->util->mensaje('El Courier '.$descripcion.' ya existe en la ciudad seleccionada','3');
		}
		else
		{ 
		 	$query="insert into EMPRESA_COURIER(empcou_razonsocial,empcou_eliminado,ciu_id)  values ('$descripcion','$estado','$ciudad')";
    	 	$rs = $this->util->query($query,'COURIER','5');
		
			$courier_id =mysql_insert_id(); 
			$_SESSION['courier_id']=$courier_id;		
			
			return $rs;
			
		}

   	}	

	function  courier_ver($codigo)
	{
 	  	$query="select * from EMPRESA_COURIER where empcou_id='$codigo' and empcou_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		if (!($rs))
 	    	{
			Echo "Hay problemas en la consulta";
	    	}
		else 
			{
			$campo=mysql_fetch_array($rs);
		 	$this->empcou_id= $campo['empcou_id'];
		 	$this->ciu_id= $campo['ciu_id'];			
			$this->empcou_razonsocial= $campo['empcou_razonsocial'];
		    return  $this->empcou_id;
		 	}
	}	

	function courier_editar($codigo,$descripcion,$ciudad)
 	{
		$query="update EMPRESA_COURIER set empcou_razonsocial='$descripcion',ciu_id='$ciudad' where empcou_id='$codigo' ";
 		$rs= $this->util->query($query,'DATOS ACTUALIZADOS','1');
 		return $rs;
 	}

	function courier_borrar($codigo)
	{
		$query="update EMPRESA_COURIER set  empcou_eliminado='1'  where  empcou_id='$codigo'";
		$rs = $this->util->query($query,'EMPRESA','5');
		return $rs;
	}		

	function devuelve_courier($codigo)
	{
  		$query="select c.empcou_id,CONCAT(c.empcou_razonsocial,' - ',ci.ciu_descripcion) as nombre,c.ciu_id,c.empcou_eliminado from EMPRESA_COURIER c, CIUDAD ci where c.ciu_id=ci.ciu_id and c.empcou_eliminado='0' and c.empcou_id='".$codigo."' order by c.empcou_razonsocial asc";
		$rs= mysql_query($query,$this->con->cn);
		$campo=mysql_fetch_array($rs);
		return $campo['nombre'];
	}	
	
	function listar_empresas()
	{

		$query="select * from EMPRESA_REMITENTE where emprem_eliminado='0' order by emprem_razonsocial asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}


	function  empresa_ver($codigo)
	{
 	  	$query="select * from EMPRESA_REMITENTE where emprem_id='$codigo' and emprem_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		if (!($rs))
 	    	{
			Echo "Hay problemas en la consulta";
	    	}
		else 
			{
			$campo=mysql_fetch_array($rs);
		 	$this->emprem_id= $campo['emprem_id'];
			$this->emprem_razonsocial= $campo['emprem_razonsocial'];
		    return  $this->emprem_id;
		 	}
	}	

	function empresa_editar($codigo,$descripcion)
 	{
		$query="update EMPRESA_REMITENTE set emprem_razonsocial='$descripcion' where emprem_id='$codigo' ";
 		$rs= $this->util->query($query,'DATOS ACTUALIZADOS','1');
 		return $rs;
 	}

	
	function empresa_borrar($codigo)
	{
		$query="update EMPRESA_REMITENTE set  emprem_eliminado='1'  where  emprem_id='$codigo'";
		$rs = $this->util->query($query,'EMPRESA','5');
		return $rs;
	}	
	
	function generar_select_empresas($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_empresas();
		$this->util->genera_select($nombre,$metodo,'emprem_id','emprem_razonsocial',$rsp,$cero,$cero_desc);
	}	
	
	function generar_select_empresa_todos($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_empresas();
		$this->util->genera_select_todos($nombre,$metodo,'emprem_id','emprem_razonsocial',$rsp,$cero,$cero_desc);
	}	


	
	function empresa_nuevo($descripcion)
	{   

 		$query="select emprem_razonsocial from EMPRESA_REMITENTE where emprem_razonsocial='".$descripcion."'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		if ($campo['emprem_razonsocial'])
		{
 			$this->util->mensaje('La Empresa '.$descripcion.' ya existe','3');
		}
		else
		{ 
		 	$query="insert into EMPRESA_REMITENTE(emprem_razonsocial,emprem_eliminado)  values ('$descripcion','0')";
    	 	$rs = $this->util->query($query,'EMPRESA','5');
		
			$empresa_id =mysql_insert_id(); 
			$_SESSION['empresa_id']=$empresa_id;		
			
			return $rs;
			
		}

   	}	


	function devuelve_empresaremite($codigo)
	{
  		$query="select * from EMPRESA_REMITENTE where emprem_eliminado='0' and emprem_id='".$codigo."'";
		$rs= mysql_query($query,$this->con->cn);
		$campo=mysql_fetch_array($rs);
		return $campo['emprem_razonsocial'];
	}	
	
	
	
	
	
		

}

?>