<?php session_start();
	
		require_once("../clases/session_data.php");
 		$session = new sessiondata(); 
		$session->destruir_sesion('../index.php','');
 		 $session->usuario->con->cerrar(); 

		
?>
