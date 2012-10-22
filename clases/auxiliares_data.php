<?php   
	 	require_once('util_data.php');

			
class auxiliaresdata
	{
	var $util='';	
	var $query='';
	var $query2='';
	var $ruta='';



	function auxiliaresdata()
	{
		$this->util = new  utildata();	
		$this->con=new conexion();
		$this->util->cn=$this->con->conectar();
	}

	function zona_nuevo($descripcion,$precio)
	{   

 		$query="select zon_descripcion from ZONA where zon_descripcion='".$descripcion."' and zon_eliminado='0'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		if ($campo['zon_descripcion'])
		{
 			$this->util->mensaje('La Zona '.$descripcion.' ya existe','3');
		}
		else
		{ 
		 	$query="insert into ZONA(zon_descripcion,zon_precio,zon_eliminado)  values ('$descripcion','$precio','0')";
    	 	$rs = $this->util->query($query,'ZONA','1');		
			return $rs;
			
		}

   	}
	
	function  zona_ver($codigo)
	{
 	  	$query="select * from ZONA where ZON_id='$codigo' and ZON_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		if (!($rs))
 	    	{
			Echo "Hay problemas en la consulta";
	    	}
		else 
			{
			$campo=mysql_fetch_array($rs);
		 	$this->zon_id= $campo['zon_id'];
			$this->zon_descripcion= $campo['zon_descripcion'];
			$this->zon_precio= $campo['zon_precio'];
		    return  $this->zon_id;
		 	}
	}	

	function zona_editar($codigo,$descripcion,$precio)
 	{
		$query="update ZONA set zon_descripcion='$descripcion',zon_precio='$precio' where zon_id='$codigo' ";
 		$rs= $this->util->query($query,'DATOS ACTUALIZADOS','1');
 		return $rs;
 	}	

	function zona_borrar($codigo)
	{
		$query="update ZONA set  zon_eliminado='1'  where  zon_id='$codigo'";
		$rs = $this->util->query($query,'ZONA','5');
		return $rs;
	}


	function listar_zona()
	{

		$query="select zon_id,CONCAT(zon_descripcion,' - S/.',zon_precio) as nombre,zon_descripcion,zon_precio from ZONA where zon_eliminado='0' order by zon_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	function generar_select_zona($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_zona();
		$this->util->genera_select_seleccionar($nombre,$metodo,'zon_id','nombre',$rsp,$cero,$cero_desc);
	}
	
	function generar_select_zona_masivo($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_zona();
		$this->util->genera_select_seleccionar($nombre,$metodo,'zon_id','zon_descripcion',$rsp,$cero,$cero_desc);
	}	

	function devuelve_preciokg($codigo)
	{
  		$query="select zon_precio from ZONA where zon_id='$codigo' and zon_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		$campo=mysql_fetch_array($rs);
		return $campo['zon_precio'];
	}
	
	function devuelve_precioembalaje($codigo)
	{
  		$query="select emb_precio from EMBALAJE where emb_id='$codigo' and emb_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		$campo=mysql_fetch_array($rs);
		return $campo['emb_precio'];
	}
	
	function devuelve_preciofragilidad($codigo)
	{
  		$query="select fra_precio from FRAGILIDAD where fra_id='$codigo' and fra_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		$campo=mysql_fetch_array($rs);
		return $campo['fra_precio'];
	}	
	
	function listar_area()
	{

		$query="select * from AREA where area_eliminado='0' order by area_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}

	function area_borrar($codigo)
	{
		$query="update AREA set  area_eliminado='1'  where  area_id='$codigo'";
		$rs = $this->util->query($query,'AREA','5');
		return $rs;
	}

	function generar_select_area($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_area();
		$this->util->genera_select($nombre,$metodo,'area_id','area_descripcion',$rsp,$cero,$cero_desc);
	}	


	function area_nuevo($descripcion)
	{   

 		$query="select area_descripcion from AREA where area_descripcion='".$descripcion."'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		if ($campo['area_descripcion'])
		{
 			$this->util->mensaje('La Area '.$descripcion.' ya existe','3');
		}
		else
		{ 

		
		 	$query="insert into AREA (area_descripcion,area_eliminado)  values('$descripcion','0')";
    	 	$rs = $this->util->query($query,'AREA','5');
		
			$area_id =mysql_insert_id(); 
			$_SESSION['area_id']=$area_id;		
			
			return $rs;
			
		}
	}

	function  area_ver($codigo)
	{
 	  	$query="select * from AREA where area_id='$codigo' and area_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		if (!($rs))
 	    	{
			Echo "Hay problemas en la consulta";
	    	}
		else 
			{
			$campo=mysql_fetch_array($rs);
		 	$this->area_id= $campo['area_id'];
			$this->area_descripcion= $campo['area_descripcion'];
		    return  $this->area_id;
		 	}
	}	

	function area_editar($codigo,$descripcion)
 	{
		$query="update AREA set area_descripcion='$descripcion' where area_id='$codigo' ";
 		$rs= $this->util->query($query,'DATOS ACTUALIZADOS','1');
 		return $rs;
 	}


	function listar_formapago()
	{

		$query="select * from FORMA_PAGO where formpago_eliminado='0' order by formpago_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	function generar_select_formapago($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_formapago();
		$this->util->genera_select($nombre,$metodo,'formpago_id','formpago_descripcion',$rsp,$cero,$cero_desc);
	}
	
	function listar_tipoenvio()
	{

		$query="select * from TIPO_ENVIO where tipoenv_eliminado='0' order by tipoenv_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	
	function listar_tipoenvio_masivo()
	{

		$query="select * from tipo_envio_masivo where tipoenvm_eliminado='0' order by tipoenvm_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	function generar_select_tipoenvio($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_tipoenvio();
		$this->util->genera_select($nombre,$metodo,'tipoenv_id','tipoenv_descripcion',$rsp,$cero,$cero_desc);
	}	
	
	function generar_select_tipoenvio_masivo($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_tipoenvio_masivo();
		$this->util->genera_select($nombre,$metodo,'tipoenvm_id','tipoenvm_descripcion',$rsp,$cero,$cero_desc);
	}
	

	
	function listar_volumen()
	{

		$query="select * from VOLUMEN where vol_eliminado='0' order by vol_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	function generar_select_volumen($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_volumen();
		$this->util->genera_select($nombre,$metodo,'vol_id','vol_descripcion',$rsp,$cero,$cero_desc);
	}	

	function embalaje_nuevo($descripcion,$precio)
	{   

 		$query="select emb_descripcion from EMBALAJE where emb_descripcion='".$descripcion."' and emb_eliminado='0'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		if ($campo['emb_descripcion'])
		{
 			$this->util->mensaje('El embalaje '.$descripcion.' ya existe','3');
		}
		else
		{ 
		 	$query="insert into EMBALAJE(emb_descripcion,emb_precio,emb_eliminado)  values ('$descripcion','$precio','0')";
    	 	$rs = $this->util->query($query,'EMBALAJE','1');		
			return $rs;
			
		}

   	}

	function  embalaje_ver($codigo)
	{
 	  	$query="select * from EMBALAJE where emb_id='$codigo' and emb_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		if (!($rs))
 	    	{
			Echo "Hay problemas en la consulta";
	    	}
		else 
			{
			$campo=mysql_fetch_array($rs);
		 	$this->emb_id= $campo['emb_id'];
			$this->emb_descripcion= $campo['emb_descripcion'];
			$this->emb_precio= $campo['emb_precio'];
		    return  $this->emb_id;
		 	}
	}	

	function embalaje_editar($codigo,$descripcion,$precio)
 	{
		$query="update EMBALAJE set emb_descripcion='$descripcion',emb_precio='$precio' where emb_id='$codigo' ";
 		$rs= $this->util->query($query,'DATOS ACTUALIZADOS','1');
 		return $rs;
 	}


	function embalaje_borrar($codigo)
	{
		$query="update EMBALAJE set  emb_eliminado='1'  where  emb_id='$codigo'";
		$rs = $this->util->query($query,'EMBALAJE','5');
		return $rs;
	}
	
	function listar_embalaje()
	{

		$query="select emb_id,CONCAT(emb_descripcion,' - S/.',emb_precio) as nombre,emb_descripcion,emb_precio from EMBALAJE where emb_eliminado='0' order by emb_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	function generar_select_embalaje($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_embalaje();
		$this->util->genera_select($nombre,$metodo,'emb_id','nombre',$rsp,$cero,$cero_desc);
	}

	function fragilidad_nuevo($descripcion,$precio)
	{   

 		$query="select fra_descripcion from FRAGILIDAD where fra_descripcion='".$descripcion."' and fra_eliminado='0'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		if ($campo['fra_descripcion'])
		{
 			$this->util->mensaje('La fragilidad '.$descripcion.' ya existe','3');
		}
		else
		{ 
		 	$query="insert into FRAGILIDAD(fra_descripcion,fra_precio,fra_eliminado)  values ('$descripcion','$precio','0')";
    	 	$rs = $this->util->query($query,'FRAGILIDAD','1');		
			return $rs;
			
		}

   	}

	function  fragilidad_ver($codigo)
	{
 	  	$query="select * from FRAGILIDAD where fra_id='$codigo' and fra_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		if (!($rs))
 	    	{
			Echo "Hay problemas en la consulta";
	    	}
		else 
			{
			$campo=mysql_fetch_array($rs);
		 	$this->fra_id= $campo['fra_id'];
			$this->fra_descripcion= $campo['fra_descripcion'];
			$this->fra_precio= $campo['fra_precio'];
		    return  $this->fra_id;
		 	}
	}	

	function fragilidad_editar($codigo,$descripcion,$precio)
 	{
		$query="update FRAGILIDAD set fra_descripcion='$descripcion',fra_precio='$precio' where fra_id='$codigo' ";
 		$rs= $this->util->query($query,'DATOS ACTUALIZADOS','1');
 		return $rs;
 	}

	function fragilidad_borrar($codigo)
	{
		$query="update FRAGILIDAD set  fra_eliminado='1'  where  fra_id='$codigo'";
		$rs = $this->util->query($query,'FRAGILIDAD','5');
		return $rs;
	}
	
	function listar_fragilidad()
	{

		$query="select fra_id,CONCAT(fra_descripcion,' - S/.',fra_precio) as nombre,fra_descripcion,fra_precio from FRAGILIDAD where fra_eliminado='0' order by fra_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	function generar_select_fragilidad($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_fragilidad();
		$this->util->genera_select($nombre,$metodo,'fra_id','nombre',$rsp,$cero,$cero_desc);
	}	
	
	function listar_tiposervicio()
	{

		$query="select * from TIPO_SERVICIO where tiposerv_eliminado='0' order by tiposerv_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	function generar_select_tiposervicio($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_tiposervicio();
		$this->util->genera_select($nombre,$metodo,'tiposerv_id','tiposerv_descripcion',$rsp,$cero,$cero_desc);
	}	
	
	function listar_ciudad()
	{

		$query="select * from CIUDAD where ciu_eliminado='0' order by ciu_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	function generar_select_ciudad($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_ciudad();
		$this->util->genera_select($nombre,$metodo,'ciu_id','ciu_descripcion',$rsp,$cero,$cero_desc);
	}
	
	function ciudad_nuevo($descripcion)
	{   

 		$query="select ciu_descripcion from CIUDAD where ciu_descripcion='".$descripcion."'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		if ($campo['ciu_descripcion'])
		{
 			$this->util->mensaje('La Ciudad '.$descripcion.' ya existe','3');
		}
		else
		{ 
		 	$query="insert into CIUDAD(ciu_descripcion,ciu_eliminado)  values ('$descripcion','0')";
    	 	$rs = $this->util->query($query,'CIUDAD','5');
		
			$ciudad_id =mysql_insert_id(); 
			$_SESSION['ciudad_id']=$ciudad_id;		
			
			return $rs;
			
		}

   	}
	
	function  ciudad_ver($codigo)
	{
 	  	$query="select * from CIUDAD where ciu_id='$codigo' and ciu_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		if (!($rs))
 	    	{
			Echo "Hay problemas en la consulta";
	    	}
		else 
			{
			$campo=mysql_fetch_array($rs);
		 	$this->ciu_id= $campo['ciu_id'];
			$this->ciu_descripcion= $campo['ciu_descripcion'];
		    return  $this->ciu_id;
		 	}
	}	

	function ciudad_editar($codigo,$descripcion)
 	{
		$query="update CIUDAD set ciu_descripcion='$descripcion' where ciu_id='$codigo' ";
 		$rs= $this->util->query($query,'DATOS ACTUALIZADOS','1');
 		return $rs;
 	}	

	function ciudad_borrar($codigo)
	{
		$query="update CIUDAD set  ciu_eliminado='1'  where  ciu_id='$codigo'";
		$rs = $this->util->query($query,'CIUDAD','5');
		return $rs;
	}
	
	
	function devuelve_ciudad($codigo)
	{
  		$query="select ciu_descripcion from CIUDAD where ciu_id='$codigo' and ciu_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		$campo=mysql_fetch_array($rs);
		return $campo['ciu_descripcion'];
	}
	
	
	function numeromanifiestodiario_nuevo()
	{   
		$query="update CONTROL_REPORTES set  rep_manifiestodiario=rep_manifiestodiario+1";
		$rs = $this->util->query($query,'REPORTE','5');

  		$query="select rep_manifiestodiario from CONTROL_REPORTES";
		$rs= mysql_query($query,$this->con->cn);

		$campo=mysql_fetch_array($rs);
		return $campo['rep_manifiestodiario'];
	
	}
	

	function numeroreportemensual_nuevo()
	{   
		$query="update CONTROL_REPORTES set  rep_reportemensual=rep_reportemensual+1";
		$rs = $this->util->query($query,'REPORTE','5');

  		$query="select rep_reportemensual from CONTROL_REPORTES";
		$rs= mysql_query($query,$this->con->cn);

		$campo=mysql_fetch_array($rs);
		return $campo['rep_reportemensual'];
	
	}
	
	function numeroresumen_nuevo()
	{   
		$query="update CONTROL_REPORTES set  rep_resumen=rep_resumen+1";
		$rs = $this->util->query($query,'REPORTE','5');

  		$query="select rep_resumen from CONTROL_REPORTES";
		$rs= mysql_query($query,$this->con->cn);

		$campo=mysql_fetch_array($rs);
		return $campo['rep_resumen'];
	
	}
	

	function numero_reporte_masivo_nuevo($columna)
	{   
	
		/*
		funcion mejorada de el control de reportes. Se puede 
		implementar tambien para las funciones
		numeroresumen_nuevo()
		numeroreportemensual_nuevo()
		numeromanifiestodiario_nuevo()
		*/
	
		$query="update CONTROL_REPORTES set  ".$columna."=".$columna."+1";
		$rs = $this->util->query($query,'REPORTE','5');

  		$query="select ".$columna." from CONTROL_REPORTES";
		$rs= mysql_query($query,$this->con->cn);

		$campo=mysql_fetch_array($rs);
		return $campo[''.$columna.''];
	
	}	
	
	function devuelve_igv()
	{
  		$query="select igv_valor from IGV";
		$rs= mysql_query($query,$this->con->cn);
		$campo=mysql_fetch_array($rs);
		return $campo['igv_valor'];
	}	
	
	function  listar_igv()
	{
		$query="select * from IGV";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
		
	}


	function igv_editar($codigo,$valor)
 	{
		$query="update IGV set igv_valor='$valor' where igv_id='$codigo' ";
 		$rs= $this->util->query($query,'IGV: DATOS ACTUALIZADOS','1');
 		return $rs;
 	}
	
	function devuelve_volumen($codigo)
	{
  		$query="select vol_descripcion from VOLUMEN where vol_id='$codigo' and vol_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		$campo=mysql_fetch_array($rs);
		return $campo['vol_descripcion'];
	}	
}

?>