<?php
require_once "util_data.php";


class Cliente
{
	public $_util;
	
	public function __construct()
	{
		$this->_util = new  utildata();	
		$this->con=new conexion();
		$this->_util->cn=$this->con->conectar();
	}
	
	public function cliente_listar($paginado='')
	{
		$query ="SELECT cli_id,cli_razonsocial,cli_ruc,cli_direccion,cli_telefono,cli_email,cli_contacto,cli_eliminado FROM clientes WHERE cli_eliminado='0' ORDER BY cli_razonsocial ASC";
		
		if($paginado=='1')
		{
			return $query;
		}
		else
		{
			$rs = $this->_util->query($query,'','5');
			return $rs;
		}
		
	}
	
	public function generar_select_cliente($nombre,$metodo,$condicion,$cero='',$cero_desc='',$valorini='')
	{
		$rs= $this->cliente_listar();
		if($valorini=='')
		{
			$this->_util->genera_select($nombre,$metodo,'cli_id','cli_razonsocial',$rs,$cero,$cero_desc);
		}
		else
		{
			$this->_util->genera_select_valorini($nombre,$metodo,'cli_id','cli_razonsocial',$rs,$cero,$cero_desc);		
		}
		
	}
		
	
	public function cliente_insertar($razonsocial,$ruc,$direccion,$telefono,$email,$contacto)
	{
		$razonsocial = strtoupper($razonsocial);
		$direccion = strtoupper($direccion);
		
		$query="SELECT cli_id,cli_razonsocial,cli_ruc,cli_eliminado FROM clientes WHERE (cli_razonsocial='".$razonsocial."' OR cli_ruc='".$ruc."') AND cli_eliminado='0'";
		$rs = $this->_util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		
		if ($campo['cli_id'])
		{
 			$this->_util->mensaje('El cliente o RUC  ya se encuetra registrado. Verifique por favor!!','3');
		}
		else
		{ 
			$query = "INSERT INTO clientes(cli_razonsocial,cli_ruc,cli_direccion,cli_telefono,cli_email,cli_contacto,cli_eliminado) VALUES ('$razonsocial','$ruc','$direccion','$telefono','$email','$contacto','0')";
			$rs = $this->_util->query($query,'CLIENTE','1');
			
			$_SESSION['cliente_id']=mysql_insert_id(); 			
	
			return $rs;
		}
	}	
	

	public function cliente_borrar($datos)
	{
  		$aLista=array_keys($datos); 
		$query="UPDATE clientes SET  cli_eliminado='1' WHERE cli_id IN (".implode(',',$aLista).")";  	
		$rs = $this->_util->query($query,'','5');
		return $rs;
	}

	public function cliente_ver($codigo)
	{
		$query ="SELECT cli_id,cli_razonsocial,cli_ruc,cli_direccion,cli_telefono,cli_email,cli_contacto,cli_eliminado FROM clientes WHERE cli_eliminado='0' AND cli_id='".$codigo."'";
		$rs = $this->_util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		$this->_cli_id=$campo['cli_id'];
		$this->_cli_razonsocial=$campo['cli_razonsocial'];
		$this->_cli_ruc=$campo['cli_ruc'];
		$this->_cli_direccion=$campo['cli_direccion'];
		$this->_cli_telefono=$campo['cli_telefono'];
		$this->_cli_email=$campo['cli_email'];
		$this->_cli_contacto=$campo['cli_contacto'];
		
		return $this->_cli_id;

		
	}		


	public function cliente_editar($codigo,$razonsocial,$ruc,$direccion,$email,$telefono,$contacto)
	{
		$query="UPDATE clientes SET  cli_razonsocial='".$razonsocial."',cli_ruc='".$ruc."',cli_email='".$email."',cli_direccion='".$direccion."',cli_telefono='".$telefono."',cli_contacto='".$contacto."' WHERE cli_id='".$codigo."'";  	
		$rs = $this->_util->query($query,'CLIENTE','1');
		return $rs;
	}


	
}


?>