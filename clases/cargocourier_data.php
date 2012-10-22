<?php   

require_once('util_data.php');
require_once('empresas_data.php');
require_once('auxiliares_data.php');

class cargocourierdata
	{
	var $util='';	
	var $query='';
	var $query2='';
	var $ruta='';



	function cargocourierdata()
	{
		$this->util = new  utildata();	
		$this->con=new conexion();
		$this->util->cn=$this->con->conectar();
		$this->empresas->util->cn=$this->con->cn;	
		$this->auxiliares->util->cn=$this->con->cn;	
	}

	function cargocourier_editar($codigo,$vol_excesivo,$tiposervicio,$tipoenvio,$formapago,$ciudaddestino,$empresa,$courier,$fecha,$consignadoa,$distrito,$direccion,$cargo,$contacto,$autorizadopor,$peso,$recibidopor,$recepcionadopor,$dni,$fecharecepcion,$hora,$observaciones,$eliminado,$ciudadorigen,$cantidad,$costoservicio,$centrocosto,$costovolumen,$embalaje,$fragilidad,$costoembalaje,$costofragilidad,$subtotal,$igv,$total,$costokg,$primerkg,$kgadicional,$zona,$volumen_maximo,$volumen_simple,$cant_vexcesivo,$cant_vmaximo,$cant_vsimple,$costo_vexcesivo,$costo_vmaximo,$costo_vsimple,$cant_embalaje,$cant_fragilidad,$incluye_igv,$volumen_estandar,$cant_vestandar,$costo_vestandar,$costo_zona)
 	{
	
		$fecha= $this->util->conviertefecha($fecha);
		$fecharecepcion= $this->util->conviertefecha($fecharecepcion);
		$costoservicio=$this->util->quitar_formato_numero($costoservicio);
		$kgadicional=$this->util->quitar_formato_numero($kgadicional);
		$subtotal=$this->util->quitar_formato_numero($subtotal);			
		$igv=$this->util->quitar_formato_numero($igv);			
		$total=$this->util->quitar_formato_numero($total);		
	
		$query="update CARGOS_COURIER set
		
		vol_excesivo='$vol_excesivo',tiposerv_id='$tiposervicio',tipoenv_id='$tipoenvio',formpago_id='$formapago',ciu_id='$ciudaddestino',emprem_id='$empresa',empcou_id='$courier',carcou_fecha='$fecha',carcou_consignadoa='$consignadoa',carcou_distrito='$distrito',carcou_direccion='$direccion',area_id='$cargo',carcou_contacto='$contacto',carcou_autorizadopor='$autorizadopor',carcou_peso='$peso',carcou_recibidopor='$recibidopor',carcou_recepcionadopor='$recepcionadopor',carcou_dni='$dni',carcou_fecharecepcion='$fecharecepcion',carcou_hora='$hora',carcou_observaciones='$observaciones', carcou_eliminado='0',carcou_ciudadorigen='$ciudadorigen',carcou_cantidad='$cantidad',carcou_costoservicio='$costoservicio',carcou_centrocosto='$centrocosto',carcou_costovolumen='$costovolumen',emb_id='$embalaje',fra_id='$fragilidad',carcou_costoembalaje='$costoembalaje',carcou_costofragilidad='$costofragilidad',carcou_subtotal='$subtotal',carcou_igv='$igv',carcou_total='$total',carcou_costokg='$costokg',carcou_costoprimerkg='$primerkg',carcou_costokgadicional='$kgadicional',zon_id='$zona',vol_maximo='$volumen_maximo',vol_simple='$volumen_simple',cant_vexcesivo='$cant_vexcesivo',cant_vmaximo='$cant_vmaximo',cant_vsimple='$cant_vsimple',costo_vexcesivo='$costo_vexcesivo',costo_vmaximo='$costo_vmaximo',costo_vsimple='$costo_vsimple',cant_embalaje='$cant_embalaje',cant_fragilidad='$cant_fragilidad',carcou_incluyeigv='$incluye_igv',vol_estandar='$volumen_estandar',cant_vestandar='$cant_vestandar',costo_vestandar='$costo_vestandar',carcou_costo_alternativo_zona='$costo_zona'
		
where carcou_id='$codigo' ";
 		$rs= $this->util->query($query,'DATOS ACTUALIZADOS','1');
 		return $rs;
 	}




	function cargocourier_nuevo($volumen_excesivo,$tiposervicio,$tipoenvio,$formapago,$ciudaddestino,$empresa,$courier,$fecha,$consignadoa,$distrito,$direccion,$cargo,$contacto,$autorizadopor,$peso,$recibidopor,$recepcionadopor,$dni,$fecharecepcion,$hora,$observaciones,$eliminado,$ciudadorigen,$cantidad,$costoservicio,$centrocosto,$costovolumen,$embalaje,$fragilidad,$costoembalaje,$costofragilidad,$subtotal,$igv,$total,$costokg,$primerkg,$kgadicional,$zona,$volumen_maximo,$volumen_simple,$cant_vexcesivo,$cant_vmaximo,$cant_vsimple,$costo_vexcesivo,$costo_vmaximo,$costo_vsimple,$cant_embalaje,$cant_fragilidad,$incluye_igv,$volumen_estandar,$cant_vestandar,$costo_vestandar,$costo_zona)
	{   
	
			$fecha= $this->util->conviertefecha($fecha);
			$fecharecepcion= $this->util->conviertefecha($fecharecepcion);
			$costoservicio=$this->util->quitar_formato_numero($costoservicio);
			$kgadicional=$this->util->quitar_formato_numero($kgadicional);
			$subtotal=$this->util->quitar_formato_numero($subtotal);			
			$igv=$this->util->quitar_formato_numero($igv);			
			$total=$this->util->quitar_formato_numero($total);			

			$query="insert into CARGOS_COURIER(vol_excesivo,tiposerv_id,tipoenv_id,formpago_id,ciu_id,emprem_id,empcou_id,carcou_fecha,carcou_consignadoa,carcou_distrito,carcou_direccion,area_id,carcou_contacto,carcou_autorizadopor,carcou_peso,carcou_recibidopor,carcou_recepcionadopor,carcou_dni,carcou_fecharecepcion,carcou_hora,carcou_observaciones, carcou_eliminado,carcou_ciudadorigen,carcou_cantidad,carcou_costoservicio,carcou_centrocosto,carcou_costovolumen,emb_id,fra_id,carcou_costoembalaje,carcou_costofragilidad,carcou_subtotal,carcou_igv,carcou_total,carcou_costokg,carcou_costoprimerkg,carcou_costokgadicional,zon_id,vol_maximo,vol_simple,cant_vexcesivo,cant_vmaximo,cant_vsimple,costo_vexcesivo,costo_vmaximo,costo_vsimple,cant_embalaje,cant_fragilidad,carcou_incluyeigv,vol_estandar,cant_vestandar,costo_vestandar,carcou_costo_alternativo_zona)  values ('$volumen_excesivo','$tiposervicio','$tipoenvio','$formapago','$ciudaddestino','$empresa','$courier','$fecha','$consignadoa','$distrito','$direccion','$cargo','$contacto','$autorizadopor','$peso','$recibidopor','$recepcionadopor','$dni','$fecharecepcion','$hora','$observaciones','0','$ciudadorigen','$cantidad','$costoservicio','$centrocosto','$costovolumen','$embalaje','$fragilidad','$costoembalaje','$costofragilidad','$subtotal','$igv','$total','$costokg','$primerkg','$kgadicional','$zona','$volumen_maximo','$volumen_simple','$cant_vexcesivo','$cant_vmaximo','$cant_vsimple','$costo_vexcesivo','$costo_vmaximo','$costo_vsimple','$cant_embalaje','$cant_fragilidad','$incluye_igv','$volumen_estandar','$cant_vestandar','$costo_vestandar','$costo_zona')";
    	
		 	$rs = $this->util->query($query,'CARGO','1');
			$cargocourier_id =mysql_insert_id(); 
			$_SESSION['cargocourier_id']=$cargocourier_id;		
			return $rs;

   	}	
	
	
	function  cargocourier_ver($codigo)
	{
 	  	$query="select * from CARGOS_COURIER where carcou_id='$codigo' and carcou_eliminado='0'";
		$rs= mysql_query($query,$this->con->cn);
		if (!($rs))
 	    	{
			Echo "Hay problemas en la consulta";
	    	}
		else 
			{
			$campo=mysql_fetch_array($rs);
		 	$this->carcou_id= $campo['carcou_id'];
		 	$this->zon_id= $campo['zon_id'];
		 	$this->fra_id= $campo['fra_id'];
		 	$this->emb_id= $campo['emb_id'];
		 	$this->area_id= $campo['area_id'];
		 	$this->vol_excesivo= $campo['vol_excesivo'];
		 	$this->tiposerv_id= $campo['tiposerv_id'];
		 	$this->tipoenv_id= $campo['tipoenv_id'];
		 	$this->formpago_id= $campo['formpago_id'];
		 	$this->ciu_id= $campo['ciu_id'];
		 	$this->emprem_id= $campo['emprem_id'];
		 	$this->empcou_id= $campo['empcou_id'];
		 	$this->carcou_fecha= $campo['carcou_fecha'];
		 	$this->carcou_consignadoa= $campo['carcou_consignadoa'];
		 	$this->carcou_distrito= $campo['carcou_distrito'];
		 	$this->carcou_direccion= $campo['carcou_direccion'];																							
		 	$this->carcou_contacto= $campo['carcou_contacto'];
		 	$this->carcou_autorizadopor= $campo['carcou_autorizadopor'];
		 	$this->carcou_peso= $campo['carcou_peso'];
		 	$this->carcou_recibidopor= $campo['carcou_recibidopor'];
		 	$this->carcou_recepcionadopor= $campo['carcou_recepcionadopor'];
		 	$this->carcou_dni= $campo['carcou_dni'];
		 	$this->carcou_fecharecepcion= $campo['carcou_fecharecepcion'];
		 	$this->carcou_hora= $campo['carcou_hora'];
		 	$this->carcou_observaciones= $campo['carcou_observaciones'];
		 	$this->carcou_eliminado= $campo['carcou_eliminado'];
		 	$this->carcou_ciudadorigen= $campo['carcou_ciudadorigen'];
		 	$this->carcou_cantidad= $campo['carcou_cantidad'];
		 	$this->carcou_costoservicio= $campo['carcou_costoservicio'];
		 	$this->carcou_centrocosto= $campo['carcou_centrocosto'];
		 	$this->carcou_costovolumen= $campo['carcou_costovolumen'];
		 	$this->carcou_costoembalaje= $campo['carcou_costoembalaje'];	
		 	$this->carcou_costofragilidad= $campo['carcou_costofragilidad'];	
		 	$this->carcou_costoprimerkg= $campo['carcou_costoprimerkg'];	
		 	$this->carcou_costokgadicional= $campo['carcou_costokgadicional'];	
		 	$this->carcou_igv= $campo['carcou_igv'];	
		 	$this->carcou_subtotal= $campo['carcou_subtotal'];	
		 	$this->carcou_total= $campo['carcou_total'];	
		 	$this->carcou_costokg= $campo['carcou_costokg'];
		 	$this->cant_embalaje= $campo['cant_embalaje'];
		 	$this->cant_fragilidad= $campo['cant_fragilidad'];
		 	$this->cant_vexcesivo= $campo['cant_vexcesivo'];
		 	$this->cant_vmaximo= $campo['cant_vmaximo'];
		 	$this->cant_vsimple= $campo['cant_vsimple'];
		 	$this->costo_vmaximo= $campo['costo_vmaximo'];
		 	$this->costo_vexcesivo= $campo['costo_vexcesivo'];
		 	$this->costo_vsimple= $campo['costo_vsimple'];						
		 	$this->vol_maximo= $campo['vol_maximo'];
		 	$this->vol_simple= $campo['vol_simple'];
		 	$this->carcou_incluyeigv= $campo['carcou_incluyeigv'];

		 	$this->cant_vestandar= $campo['cant_vestandar'];
		 	$this->costo_vestandar= $campo['costo_vestandar'];
		 	$this->vol_estandar= $campo['vol_estandar'];
			
			$this->costo_zona = $campo['carcou_costo_alternativo_zona'];

																																																	
		    return  $this->carcou_id;
		 	}
	}	
	
	
	
//			 $rs= $cargo->cargocourier_listar($_REQUEST['courier_destino'],'','','','','1','');
	function cargocourier_listar($courier,$codigo,$empresa,$fechai,$fechaf,$reporte,$centrocosto)
	{
	
		$query="select cc.carcou_id,cc.vol_excesivo,v.vol_descripcion,cc.tiposerv_id,ts.tiposerv_descripcion,cc.tipoenv_id,te.tipoenv_descripcion,cc.formpago_id,fp.formpago_descripcion,cc.ciu_id,cc.emprem_id, er.emprem_razonsocial,cc.empcou_id,ec.empcou_razonsocial,cc.carcou_fecha,cc.carcou_centrocosto,cc.carcou_consignadoa,cc.carcou_distrito,cc.carcou_direccion,cc.area_id,a.area_descripcion,cc.carcou_contacto,cc.carcou_autorizadopor,cc.carcou_peso,cc.carcou_recibidopor,cc.carcou_recepcionadopor,cc.carcou_dni,cc.carcou_fecharecepcion,cc.carcou_hora,cc.carcou_observaciones,cc.carcou_eliminado,cc.carcou_ciudadorigen,cc.carcou_cantidad,z.zon_descripcion,cc.carcou_costoprimerkg,cc.carcou_costokgadicional,cc.carcou_costovolumen,cc.carcou_costofragilidad,cc.carcou_costoembalaje,cc.carcou_subtotal,cc.carcou_igv,cc.carcou_total,cc.carcou_costo_alternativo_zona,f.fra_descripcion,e.emb_descripcion,cc.carcou_centrocosto,cc.vol_maximo,cc.vol_simple,cc.cant_vexcesivo,cc.cant_vmaximo,cc.cant_vsimple,cc.costo_vexcesivo,cc.costo_vmaximo,cc.costo_vsimple,cc.carcou_incluyeigv,cc.vol_estandar ,cc.cant_vestandar,cc.costo_vestandar,cc.carcou_costoservicio
							
		from 
		
		CARGOS_COURIER cc, EMPRESA_COURIER ec, EMPRESA_REMITENTE er, FORMA_PAGO fp, TIPO_ENVIO te, TIPO_SERVICIO ts, VOLUMEN v, AREA a, ZONA z, FRAGILIDAD f, EMBALAJE e  
							
							
		where 
		
		cc.vol_excesivo=v.vol_id and cc.tiposerv_id=ts.tiposerv_id and cc.tipoenv_id=te.tipoenv_id and cc.formpago_id=fp.formpago_id and cc.emprem_id=er.emprem_id and cc.empcou_id=ec.empcou_id and cc.area_id=a.area_id and cc.zon_id=z.zon_id and cc.fra_id=f.fra_id and cc.emb_id=e.emb_id and cc.carcou_eliminado='0' ";
		
		if ($reporte=='1') //listar cargos por courier
		{
		
			if ($courier=='0')
			{
				$query2=" ";
			}
			else
			{
				$query2= " and cc.empcou_id='".$courier."'";
			}
		}
		
		if ($reporte=='2')// filtrar cargo por codigo
		{
		
			$query2= " and cc.carcou_id='".$codigo."'";
			
		}		

		if ($reporte=='3')//listar cargos por courier y fecha - manifiesto diario
		{
		
			$fechai= $this->util->conviertefecha($fechai);
  			$fechaf= $this->util->conviertefecha($fechaf);
			
			if ($courier=='0')
			{
				$query2=" and cc.carcou_fecha between '".$fechai."' and '".$fechaf."'";
			}
			else
			{			
				$query2= " and cc.empcou_id='".$courier."' and cc.carcou_fecha between '".$fechai."' and '".$fechaf."'";
			}
		}
		
		if ($reporte=='4')//listar cargos por empresa y fecha - reporte mensual
		{
		
			$fechai= $this->util->conviertefecha($fechai);
  			$fechaf= $this->util->conviertefecha($fechaf);
			
			if ($empresa=='0')
			{
				$query2=" and cc.carcou_fecha between '".$fechai."' and '".$fechaf."'";
			}
			else
			{			
				$query2= " and cc.emprem_id='".$empresa."' and cc.carcou_fecha between '".$fechai."' and '".$fechaf."'";
			}
		}
		

		if ($reporte=='5')//listar cargos por empresa y centro de costo - resumen centro de costo
		{
			$fechai= $this->util->conviertefecha($fechai);
  			$fechaf= $this->util->conviertefecha($fechaf);

			if ($empresa=='0')
			{
				$query2=" and cc.carcou_centrocosto!=''";
			}
			else
			{	
				if ($centrocosto=='')
				{
					$query2= " and cc.emprem_id='".$empresa."' and cc.carcou_centrocosto!=''";
				}
				else
				{
					$query2= " and cc.emprem_id='".$empresa."' and cc.carcou_centrocosto='".$centrocosto."'";				
				}
			}
			$query2=$query2." and cc.carcou_fecha between '".$fechai."' and '".$fechaf."'";
		}							
		
		$query00=" order by cc.carcou_id desc";
		
		$query=$query.$query2.$query00;
		
		/*$rs= mysql_query($query,$this->con->cn);
		return $rs;*/
		return  $query;


		
		
	}

	function cargocourier_borrar($codigo)
	{
	
  		$aLista=array_keys($_POST['campos']); 
 		
		$query="update CARGOS_COURIER set  carcou_eliminado='1'  where  carcou_id IN (".implode(',',$aLista).")";  
		
		$rs = $this->util->query($query,'CARGO','5');
		
		return $rs;
	}

	function calcula_primerkg($peso,$costokg)
	{

		$total_primerkg = $peso * $costokg;
		return $total_primerkg;

	}
	
	function calcula_kgadicional($peso,$costokg,$cantidad)
	{
		

		if ($peso>$cantidad)
		{

			//con explode indicamos el caracter separador "."
			$valor = explode(".",$peso);
			//recuperamos la parte decimal con el indice 1
			$peso = $valor[0];
			$decimal_peso =$valor[1];
			
			
			
			//evaluamos si la parte decimal supera  a cero para obtener los kg adicionales
			if ($decimal_peso>0)
			{

			$peso = $peso + 1;
			
			}

			

			$valor=$peso-$cantidad;
			
			$total_kgadicional = $valor * $costokg;
			

		}

		
			return $total_kgadicional;
		

	}	

	function calcula_subtotal($volumen,$primerkg,$kgadicional,$servicio,$embalaje,$fragilidad)
	{
		$subtotal = $volumen + $primerkg + $kgadicional + $servicio + $embalaje + $fragilidad;
		return $subtotal;

	}
	
	function nuevo_manifiestodiario($numero,$courier,$fechai,$fechaf)
	{   

		$fechai= $this->util->conviertefecha($fechai);
  		$fechaf= $this->util->conviertefecha($fechaf);

		$query="insert into MANIFIESTO_DIARIO(man_nroreporte,empcou_id,man_fechai,man_fechaf) values('$numero','$courier','$fechai','$fechaf')";
   	 	$rs = $this->util->query($query,'MANIFIESTO DIARIO','5');
		return $rs;
		
	}

	function nuevo_reportemensual($numero,$empresa,$fechai,$fechaf)
	{   
		$fechai= $this->util->conviertefecha($fechai);
  		$fechaf= $this->util->conviertefecha($fechaf);
		
		$query="insert into REPORTE_MENSUAL(rep_nroreporte,emprem_id,rep_fechai,rep_fechaf) values('$numero','$empresa','$fechai','$fechaf')";
   	 	$rs = $this->util->query($query,'REPORTE MENSUAL','5');
		return $rs;
		
	}	
	
	function nuevo_resumencentrocosto($numero,$empresa,$centrocosto)
	{   
		$query="insert into  RESUMEN_CENTROCOSTO(res_nroresumen,emprem_id,res_centrocosto) values('$numero','$empresa','$centrocosto')";
   	 	$rs = $this->util->query($query,'RESUMEN','5');
		return $rs;
		
	}
	
	function reporte_buscar($nro,$reporte)
	{
		//indicamos que reporte buscar
		if ($reporte=='1')//reporte manifiesto diario
		{
			$query="select * from MANIFIESTO_DIARIO where man_nroreporte='".$nro."'";
			$rs=$this->util->query($query,'','5');
			$campo=mysql_fetch_array($rs);
			
			$courier=$campo['empcou_id'];
			$fechai=$campo['man_fechai'];
			$fechaf=$campo['man_fechaf'];
			
			$fechai=$this->util->obtienefecha($fechai);
			$fechaf=$this->util->obtienefecha($fechaf);
			$rsr = $this->cargocourier_listar($courier,'','',$fechai,$fechaf,'3','');
			return $rsr;			
						
			
		}
		if ($reporte=='2')//reporte mensual
		{
			$query="select * from REPORTE_MENSUAL where rep_nroreporte='".$nro."'";
			$rs=$this->util->query($query,'','5');
			$campo=mysql_fetch_array($rs);
			
			$empresa=$campo['emprem_id'];
			$fechai=$campo['rep_fechai'];
			$fechaf=$campo['rep_fechaf'];	

			$fechai=$this->util->obtienefecha($fechai);
			$fechaf=$this->util->obtienefecha($fechaf);
			$rsr= $this->cargocourier_listar('','',$empresa,$fechai,$fechaf,'4','');			
			return $rsr;		
			
		}
		if ($reporte=='3')//resumen centro de costo
		{
			$query="select * from RESUMEN_CENTROCOSTO where res_nroresumen='".$nro."'";
			$rs=$this->util->query($query,'','5');
			$campo=mysql_fetch_array($rs);
			
			$empresa=$campo['emprem_id'];
			$centrocosto=$campo['res_centrocosto'];
			
			$rsr= $this->cargocourier_listar('','',$empresa,'','','5',$centrocosto);
			return $rsr;			
		}		
				
		
	}
	
	function ver_incluyeigv($n)
	{
		if ($n=='1')
		{
			$n="Sí";
		}
		if ($n=='0')
		{
			$n="No";
		}
		return $n;
	}
	

	
}

?>