<?php   

require_once('util_data.php');
require_once('empresas_data.php');
require_once('auxiliares_data.php');
require_once('zonaenvio_data.php');
require_once('ubigeo_data.php');
require_once('plazoentrega_data.php');
require_once 'preciosenvio_data.php';

class cargomasivodata
	{
	var $util='';	
	var $query='';
	var $query2='';
	var $ruta='';



	function cargomasivodata()
	{
		$this->util = new  utildata();	
		$this->con=new conexion();
		$this->precioenvio = new preciosenviodata();
		$this->util->cn=$this->con->conectar();
		$this->empresas->util->cn=$this->con->cn;	
		$this->auxiliares->util->cn=$this->con->cn;	
	}

	function cargocourier_editar($codigo,$vol_excesivo,$tiposervicio,$tipoenvio,$formapago,$ciudaddestino,$empresa,$courier,$fecha,$consignadoa,$distrito,$direccion,$cargo,$contacto,$autorizadopor,$peso,$recibidopor,$recepcionadopor,$dni,$fecharecepcion,$hora,$observaciones,$eliminado,$ciudadorigen,$cantidad,$costoservicio,$centrocosto,$costovolumen,$embalaje,$fragilidad,$costoembalaje,$costofragilidad,$subtotal,$igv,$total,$costokg,$primerkg,$kgadicional,$zona,$volumen_maximo,$volumen_simple,$cant_vexcesivo,$cant_vmaximo,$cant_vsimple,$costo_vexcesivo,$costo_vmaximo,$costo_vsimple,$cant_embalaje,$cant_fragilidad,$incluye_igv)
 	{
	
		$fecha= $this->util->conviertefecha($fecha);
		$fecharecepcion= $this->util->conviertefecha($fecharecepcion);
	
		$query="update CARGOS_COURIER set
		
		vol_excesivo='$vol_excesivo',tiposerv_id='$tiposervicio',tipoenv_id='$tipoenvio',formpago_id='$formapago',ciu_id='$ciudaddestino',emprem_id='$empresa',empcou_id='$courier',carcou_fecha='$fecha',carcou_consignadoa='$consignadoa',carcou_distrito='$distrito',carcou_direccion='$direccion',area_id='$cargo',carcou_contacto='$contacto',carcou_autorizadopor='$autorizadopor',carcou_peso='$peso',carcou_recibidopor='$recibidopor',carcou_recepcionadopor='$recepcionadopor',carcou_dni='$dni',carcou_fecharecepcion='$fecharecepcion',carcou_hora='$hora',carcou_observaciones='$observaciones', carcou_eliminado='0',carcou_ciudadorigen='$ciudadorigen',carcou_cantidad='$cantidad',carcou_costoservicio='$costoservicio',carcou_centrocosto='$centrocosto',carcou_costovolumen='$costovolumen',emb_id='$embalaje',fra_id='$fragilidad',carcou_costoembalaje='$costoembalaje',carcou_costofragilidad='$costofragilidad',carcou_subtotal='$subtotal',carcou_igv='$igv',carcou_total='$total',carcou_costokg='$costokg',carcou_costoprimerkg='$primerkg',carcou_costokgadicional='$kgadicional',zon_id='$zona',vol_maximo='$volumen_maximo',vol_simple='$volumen_simple',cant_vexcesivo='$cant_vexcesivo',cant_vmaximo='$cant_vmaximo',cant_vsimple='$cant_vsimple',costo_vexcesivo='$costo_vexcesivo',costo_vmaximo='$costo_vmaximo',costo_vsimple='$costo_vsimple',cant_embalaje='$cant_embalaje',cant_fragilidad='$cant_fragilidad',carcou_incluyeigv='$incluye_igv'
		
where carcou_id='$codigo' ";
 		$rs= $this->util->query($query,'DATOS ACTUALIZADOS','1');
 		return $rs;
 	}



//	$rs= $cargo->cargomasivo_nuevo($_REQUEST['ciudad_destino'],$_REQUEST['zona'],$_REQUEST['empresa_remite'],$_REQUEST['fecha'],$_REQUEST['consignadoa'],$_REQUEST['area'],$_REQUEST['distritoconsignado'],$_REQUEST['direccionconsignado'],$_REQUEST['recepcionadopor'],$_REQUEST['dni'],$_REQUEST['parentesco'],'0');
	function cargomasivo_nuevo($ciudaddestino,$zona,$empresa,$fecha,$consignadoa,$area,$distrito,$direccion,$recepcionadopor,$dni,$parentesto,$eliminado,$telefono)
	{   
	
			$fecha= $this->util->conviertefecha($fecha);

			$query="insert into CARGOS_MASIVOS(ciu_id,zon_id,emprem_id,area_id,cmas_fecha,cmas_destinatario,cmas_direccion,cmas_nombrerecibe,cmas_parentescorecibe,cmas_dnirecibe,cmas_eliminado,cmas_distrito,cmas_telefono,def_id) values ('$ciudaddestino','$zona','$empresa','$area','$fecha','$consignadoa','$direccion','$recepcionadopor','$parentesco','$dni','0','$distrito','$telefono','10')";
    	
		 	$rs = $this->util->query($query,'CARGO MASIVO','1');
			//$cargomasivo_id =mysql_insert_id(); 
			//$_SESSION['cargomasivo_id']=$cargomasivo_id;		
			return $rs;

   	}	
//			$cargo->masivo_importar($_REQUEST['fecha'],$_REQUEST['empresa_remite'],$_REQUEST['area'],'0',$ruta,$_REQUEST['igv_incluye'],$_REQUEST['tipoenvio'],$_REQUEST['plazoentrega'],$_REQUEST['costocaserio'],$_REQUEST['cantidad']);
	function masivo_importar($fecha,$empresa,$area,$eliminado,$ruta,$incluye_igv,$tipoenvio,$plazoentrega,$costo_caserio,$cantidad)
	{ 	
	
	

		$fecha= $this->util->conviertefecha($fecha);

		$row = 1; 
		$fp = fopen ($ruta,"r"); 
		
		$linea=1;
		
		while ($data = fgetcsv ($fp, 1000, ";")) 
		{
		
		
			$num = count($data); 
			print " <br>"; 
			$row++; 
			$destinatario=$data[0];
			$direccion=$data[1];
			$ciudad=$data[2];
			$caserio=$data[3];
			$telefono=$data[4]; 	
			
			$this->precioenvio->devuelve_precio_envio_masivo($empresa,$ciudad,$cantidad);
			
//	function masivo_importar($fecha,$zona,$distrito,$empresa,$area,$eliminado,$ruta,$incluye_igv,$tipoenvio,$plazoentrega,$costo_caserio,$precio_masivo)			
			
			if($caserio!='')
			{
				$costocaserio=$costo_caserio;
				$costocargo=$this->precioenvio->precio+$costo_caserio;

			}
			else
			{
				$costocargo=$this->precioenvio->precio;
				$costocaserio=0;
		
			}
			
			$query="INSERT INTO cargos_masivos (plaent_id,def_id,tipoenvm_id,tipedif_id,emprem_id,area_id,cmas_fecha,cmas_destinatario,cmas_direccion,cmas_nombrerecibe,cmas_parentescorecibe,cmas_dnirecibe,cmas_eliminado,cmas_costoenvio,cmas_incluyeigv,cmas_colorfachada,cmas_cantpisos,cmas_telefono,cmas_caserio,cmas_costocaserio,cmas_costocargo,cmas_ciudad,ce_id) VALUES ('$plazoentrega','10','$tipoenvio','','$empresa','$area','$fecha','$destinatario','$direccion','','','','0','$precioenvio','$incluye_igv','','','$telefono','$caserio','$costocaserio','$costocargo','$ciudad','".$this->precioenvio->ce_id."')"; 
			
			$rs = $this->util->query($query,'CARGO','5');
			
			
			//$costocargo='';
			//$costocaserio='';
			/*if (!$rs)
			{
				echo $linea;
			}
			$linea=$linea+1;
			*/
		} 

		fclose ($fp);
		
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
		    return  $this->carcou_id;
		 	}
	}	
	
	
	
	//$rs=$cargo->cargomasivo_listar('1',$_REQUEST['empresa_remite'],$_REQUEST['fecha']);
	function cargomasivo_listar($reporte,$valor1,$valor2,$valor3,$valor4)
	{
	
		$query="select
		
							cm.cmas_id,cm.def_id,cm.emprem_id,d.def_descripcion,cm.cmas_fecha,cm.cmas_destinatario,cm.cmas_direccion,cm.cmas_nombrerecibe,cm.cmas_parentescorecibe,cm.cmas_dnirecibe,cm.cmas_eliminado,cm.cmas_telefono,cm.cmas_caserio,cm.cmas_ciudad,cm.ce_id,ce.ce_id,ce.ze_id,z.ze_descripcion,er.emprem_razonsocial,a.area_descripcion,er.emprem_id,z.ze_id,a.area_id,te.tipoenvm_id,te.tipoenvm_descripcion,cm.cmas_costocargo
							
		from 
		
		CARGOS_MASIVOS cm, EMPRESA_REMITENTE er, AREA a,costo_envio_masivo ce, zona_envio z, deficientes_masivos d, tipo_envio_masivo te  
							
							
		where 
		
		cm.emprem_id=er.emprem_id AND cm.area_id=a.area_id AND cm.ce_id=ce.ce_id AND ce.ze_id=z.ze_id AND  cm.def_id=d.def_id AND cm.tipoenvm_id=te.tipoenvm_id AND cm.cmas_eliminado='0' ";
		
		if ($reporte=='1') //listar cargos masivos por fecha y empresa
		{
		
			$valor2= $this->util->conviertefecha($valor2);
			$query2= " and cm.emprem_id='".$valor1."' and cm.cmas_fecha='".$valor2."'";

		}
		
		if ($reporte=='2')// listar cargos masivos por codigo
		{
		
			$query2= " and cm.cmas_id='".$valor1."'";
			
		}		

		if ($reporte=='3')//listar cargos por empresa, fecha y estado de deficiencia
		{
		
			$valor2= $this->util->conviertefecha($valor2);
			
			if ($valor1!='0')//cargos por empresa
			{
				$query_empresa= " and cm.emprem_id='".$valor1."'";
			}
			if ($valor3=='2')//cargos sin deficiencia
			{			
				$query_estado= " and cm.def_id='10'";
			}
			if ($valor3=='3')//cargos con deficiencia
			{			
				$query_estado= " and cm.def_id!='10'";
			}
			
			$query2= " and cm.cmas_fecha='".$valor2."'";
			
			$query2=$query_empresa.$query_estado.$query2;		
		}
			
		
		$query00=" order by cm.cmas_id desc";
		
		$query=$query.$query2.$query00;
		
		/*$rs= mysql_query($query,$this->con->cn);
		return $rs;*/
		return  $query;


		
		
	}



	function cargomasivo_listar_impresion($reporte,$valor1,$valor2,$valor3,$valor4)
	{
	
		$query="select
		
							cm.cmas_id,cm.def_id,cm.emprem_id,d.def_descripcion,cm.cmas_fecha,cm.cmas_destinatario,cm.cmas_direccion,cm.cmas_nombrerecibe,cm.cmas_parentescorecibe,cm.cmas_dnirecibe,cm.cmas_eliminado,cm.cmas_telefono,cm.cmas_caserio,cm.cmas_ciudad,cm.ce_id,ce.ce_id,ce.ze_id,z.ze_descripcion,er.emprem_razonsocial,a.area_descripcion,er.emprem_id,z.ze_id,a.area_id,te.tipoenvm_id,te.tipoenvm_descripcion,cm.cmas_costocargo
							
		from 
		
		CARGOS_MASIVOS cm, EMPRESA_REMITENTE er, AREA a,costo_envio_masivo ce, zona_envio z, deficientes_masivos d, tipo_envio_masivo te  
							
							
		where 

		cm.emprem_id=er.emprem_id AND cm.area_id=a.area_id AND cm.ce_id=ce.ce_id AND ce.ze_id=z.ze_id AND  cm.def_id=d.def_id AND cm.tipoenvm_id=te.tipoenvm_id AND cm.cmas_eliminado='0' ";
	
		
		if ($reporte=='1') //listar cargos masivos por fecha y empresa
		{
		
			$valor2= $this->util->conviertefecha($valor2);
			$query2= " and cm.emprem_id='".$valor1."' and cm.cmas_fecha='".$valor2."'";

		}
		
		if ($reporte=='2')// listar cargos masivos por codigo
		{
		
			$query2= " and cm.cmas_id='".$valor1."'";
			
		}		

		if ($reporte=='3')//listar cargos por empresa, fecha y estado de deficiencia
		{
		
			$valor2= $this->util->conviertefecha($valor2);
			
			if ($valor1!='0')//cargos por empresa
			{
				$query_empresa= " and cm.emprem_id='".$valor1."'";
			}
			if ($valor3=='2')//cargos sin deficiencia
			{			
				$query_estado= " and cm.def_id='10'";
			}
			if ($valor3=='3')//cargos con deficiencia
			{			
				$query_estado= " and cm.def_id!='10'";
			}
			
			$query2= " and cm.cmas_fecha='".$valor2."'";
			
			$query2=$query_empresa.$query_estado.$query2;		
		}	
		
		if ($reporte=='4')//listar cargos por empresa, fecha inicio y fin y estado de deficiencia
		{
		
			$valor2= $this->util->conviertefecha($valor2);
			$valor3= $this->util->conviertefecha($valor3);			
			
			if ($valor1!='0')//cargos por empresa
			{
				$query_empresa= " and cm.emprem_id='".$valor1."'";
			}
			if ($valor4=='2')//cargos sin deficiencia
			{			
				$query_estado= " and cm.def_id='10'";
			}
			if ($valor4=='3')//cargos con deficiencia
			{			
				$query_estado= " and cm.def_id!='10'";
			}
			
			$query2= " and cm.cmas_fecha BETWEEN '".$valor2."' AND '".$valor3."'";
			
			$query2=$query_empresa.$query_estado.$query2;		
		}	
		
		$query00=" order by cm.cmas_id desc";
		
		$query=$query.$query2.$query00;
		
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
		
	}






	function cargomasivo_borrar($codigo)
	{
	
  		$aLista=array_keys($_POST['campos']); 
 		
		$query="update CARGOS_MASIVOS set  cmas_eliminado='1'  where  cmas_id IN (".implode(',',$aLista).")";  
		
		$rs = $this->util->query($query,'CARGO','5');
		
		return $rs;
	}

	function listar_deficientes()
	{

		$query="select * from deficientes_masivos where def_eliminado='0' order by def_descripcion asc";
		$rs= mysql_query($query,$this->con->cn);
		return $rs;
	}
	
	function generar_select_deficientes($nombre,$metodo,$rsp,$cero='',$cero_desc='')
	{
		if ($rsp==='')
		$rsp= $this->listar_deficientes();
		$this->util->genera_select($nombre,$metodo,'def_id','def_descripcion',$rsp,$cero,$cero_desc);
	}


	function editar_deficiencia($codigo,$deficiencia)
 	{	
		$query="update cargos_masivos set def_id='$deficiencia' where cmas_id='$codigo' ";
 		$rs= $this->util->query($query,'DEFICIENCIA','1');
 		return $rs;
 	}

	
}

?>