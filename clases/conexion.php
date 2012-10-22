<?php
 class conexion
{

		 var $data='bdcourier';
		 var $servidor='localhost';
		 var $usuario='root';
		 var  $clave= 'karambol27';
		//numero de error y texto del error */
		 var $Erno=0;
		 var $Error="";

	function conectar()
		{ 
	
		$this->cn = @mysql_connect($this->servidor,$this->usuario,$this->clave,$this->data);
		mysql_select_db($this->data);
		if (!($this->cn))
  		{ 
	    $this->Error="Ha fallado la conexion.";
		return 0;
 		}
    	if  (!mysql_select_db($this->data))
  		{ 
	    $this->Error="Imposible abrir Base de datos.";
		return 0;
 		} 
		return $this->cn;
	
	}   
	
		function cerrar()
		{
		mysql_close($this->cn);
		}
	

		
}	
	?>