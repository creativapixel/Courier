<?php
require_once "util_data.php";


class Mensajero
{
	public $_util;
	
	public function __construct()
	{
		$this->_util = new  utildata();	
		$this->con=new conexion();
		$this->_util->cn=$this->con->conectar();
		
		}
	
	public function mensajero_listar($paginado=0)
	{
		$query ="SELECT men_id,men_nombres,men_dni,men_direccion,men_telefono,men_email,men_apellidos,men_eliminado, CONCAT(men_nombres,' ',men_apellidos) AS nombre_completo FROM mensajeros WHERE men_eliminado='0' ORDER BY men_nombres ASC";
		
		if($paginado==1)
		{
			return $query;
		}
		else
		{
			$rs = $this->_util->query($query,'','5');
			return $rs;
		}
		
	}
	
	public function generar_select_mensajero($nombre,$metodo,$cero='',$cero_desc='')
	{
		$rs= $this->mensajero_listar();
		$this->_util->genera_select($nombre,$metodo,'men_id','nombre_completo',$rs,$cero,$cero_desc);
	}
		
//$chofer_data->chofer_insertar($_POST['nombres'],$_POST['brevete'],$_POST['direccion'],$_POST['telefono'],$_POST['email'],$_POST['apellidos']);	
	public function mensajero_insertar($nombres,$dni,$direccion,$telefono,$email,$apellidos)
	{
		$nombres = strtoupper($nombres);
		$apellidos = strtoupper($apellidos);		
		$direccion = strtoupper($direccion);
		
		$query="SELECT men_id,men_nombres,men_dni,men_eliminado,men_apellidos FROM mensajeros WHERE (men_nombres='".$nombres."' AND men_apellidos='".$apellidos."') OR men_dni='".$dni."' AND men_eliminado='0'";
		$rs = $this->_util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		
		if ($campo['men_id'])
		{
 			$this->_util->mensaje('El mensajero o nro. de DNI  ya se encuetra registrado. Verifique por favor!!','4');
		}
		else
		{ 
			$query = "INSERT INTO mensajeros(men_nombres,men_dni,men_direccion,men_telefono,men_email,men_apellidos,men_eliminado) VALUES ('$nombres','$dni','$direccion','$telefono','$email','$apellidos','0')";
			$rs = $this->_util->query($query,'MENSAJERO','1');
			
			$_SESSION['mensajero_id']=mysql_insert_id();
			return $rs;
		}
	}	
	

	public function mensajero_borrar($datos)
	{
  		$aLista=array_keys($datos); 
		$query="UPDATE mensajeros SET men_eliminado='1' WHERE men_id IN (".implode(',',$aLista).")";  	
		$rs = $this->_util->query($query,'','5');
		return $rs;
	}

	public function mensajero_ver($codigo)
	{
		$query ="SELECT men_id,men_nombres,men_dni,men_direccion,men_telefono,men_email,men_apellidos,men_eliminado FROM mensajeros WHERE men_eliminado='0' AND men_id='".$codigo."'";
		$rs = $this->_util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		$this->_men_id = $campo['men_id'];
		$this->_men_nombres = $campo['men_nombres'];
		$this->_men_dni = $campo['men_dni'];
		$this->_men_direccion = $campo['men_direccion'];
		$this->_men_telefono = $campo['men_telefono'];
		$this->_men_email = $campo['men_email'];
		$this->_men_apellidos = $campo['men_apellidos'];		
		
		return $this->_men_id;

		
	}		


	public function mensajero_editar($codigo,$nombres,$dni,$direccion,$email,$telefono,$apellidos)
	{
		$query="UPDATE mensajeros SET men_nombres='".$nombres."',men_dni='".$dni."',men_email='".$email."',men_direccion='".$direccion."',men_telefono='".$telefono."',men_apellidos='".$apellidos."' WHERE men_id='".$codigo."'";  	
		$rs = $this->_util->query($query,'DATOS EDITADOS','3');
		return $rs;
	}


	
}


?>