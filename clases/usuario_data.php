<?php require_once( 'conexion.php');
require_once( 'util_data.php');
//require_once('ubigeo_data.php');

class usuariodata
	{
		var 	$usu_id;
		var  	$usu_nombres='';
		var     $usu_apellidos='';
		var  	$usu_direccion='';
		var		$usu_clave='';
		var		$usu_email='';
		var		$usu_dni='';
		var		$usu_telefono='';
		var     $usu_tipo=''; 
		var 	$con='';
		var     $util='';
		var     $sistema='';

	function usuariodata()
	{
		$this->con= new conexion();
		$this->util = new utildata();
		//$this->ubigeo = new ubigeodata();
		$this->util->cn=$this->con->conectar();
		//$this->ubigeo->util->cn=$this->con->cn;
	}	
  function inicializar_variables($usu_id,$nombres,$apellidos,$dni,$direccion,$telefono,$tipo,$fechaing,$fechasal,$email)
	{ 
	  		

			$_SESSION['usu_id']=$usu_id;
			 $_SESSION['usu_email']=$email;
 			  $_SESSION['usu_nombres'] =$nombres;
			  $_SESSION['usu_apellidos'] =$apellidos;
			  $_SESSION['usu_direccion']=$direccion;
			  $_SESSION['usu_dni']=$dni;
			  $_SESSION['usu_telefono']=$telefono;
			  $_SESSION['usu_tipo']=$tipo;
	}
	
	
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
   function usuario_editar($usu_codigo,$pais,$estadopais,$codpostal,$nombres,$apellidos,$ciudad,$direccion,$telefono,$tipodoc,$nrodoc,$profesion,$razonsoc,$ruc,$ciudadfact,$direccionfact,$estado,$fechanac,$sexo,$paisfact,$email,$idioma)
   {
   				if($estado==='0')
     			 $estado='0';
	  			else 
	  			$estado='1';
		    if ($idioma==='1')
			  $fechanac=$this->util->conviertefecha($fechanac); 
			    if ($idioma==='2')
			  $fechanac=$this->util->conviertefechaing($fechanac); 
			  
		  $query="update usuario set ub_codigo='$pais',ub_estado='$estadopais',usu_codigopostal='$codpostal',usu_nombres='$nombres',usu_apellidos='$apellidos',usu_ciudad='$ciudad',usu_direccion='$direccion',usu_movil='$telefono',usu_tipo_documento='$tipodoc',usu_doc_identidad='$nrodoc',usu_profesion='$profesion',usu_razonsoc='$razonsoc',usu_ruc='$ruc',usu_ciudadfact='$ciudadfact',usu_direccionfact='$direccionfact',usu_estado='$estado',usu_fechanac='$fechanac',usu_sexo='$sexo',ub_codigofact='$paisfact' where usu_codigo='$usu_codigo'";
  		  if ($idioma==='1')
		  	{
 			$rs= $this->util->query($query,'USUARIO: DATOS ACTUALIZADOS','1');
 			}
 		else{
 			$rs= $this->util->query($query,'USER: UPDATE DATA','2');
 			}
 		if($rs)
 			$this->inicializar_variables($usu_codigo,$pais,$estadopais,$codpostal,$nombres,$apellidos,$ciudad,$direccion,$telefono,$tipodoc,$nrodoc,$profesion,$razonsoc,$ruc,$ciudadfact,$direccionfact,$fechanac,$sexo,$paisfact,$email);
 			return $rs;

     } 
	
	function  usuario_cambiarclave($clavea,$clave,$codigo_id)
	{
	
	    $query="select  usu_clave  from  usuarios  where usu_clave='".md5($clavea)."' and usu_eliminado='0'";
	 	$rs= $this->util->query($query,'CLAVE ANTIGUA','5');
		 $campo =mysql_fetch_array($rs);
		 if($campo['usu_clave'])
		 {
			 	
			 $query="update usuarios set usu_clave='".md5(trim($clave))."' where usu_id='$codigo_id'";
			

			
				$rs= $this->util->query($query,'USUARIO: CLAVE CAMBIADA','1');
				echo "<h5> Nueva Clave: $clave </h5>";

				return $rs;

	
			
		} 
		else
		{
		

				 echo "<script>alert('LA CLAVE ANTERIOR NO EXISTE EN LA BASE DE DATOS');</script>";


		 }

	}

	function ver_datos_usuario($fechanac,$ub_estado,$sexo,$referencia,$td)
	{
	echo "<center><h3>FELICITACIONES!!! Su cuenta ha  sido registrada satisfactoriamente.</h3><br></center>";
						echo "<table  align='center' ><tr><td colspan=3>&nbsp;<br></td><tr>";
		 				echo "<table  align='center' ><tr><td colspan=3>Sus Datos Personales  Son:  <br><br></td><tr>";
						echo "<tr  align='left' ><td>Nombre</td><td>:</td><td>".$_REQUEST['nombres']."</td></tr>";
		 				echo "<tr  align='left' ><td>Apellidos</td><td>:</td><td>".$_REQUEST['apellidos']."<br></td></tr>";
						echo "<tr  align='left' ><td>Fecha Nacimiento</td><td>:</td><td>".$this->util->obtienefecha($fechanac)."<br></td></tr>";
						echo "<tr  align='left' ><td>Sexo</td><td>:</td><td>".$this->devuelve_sexo($sexo,'1')."<br></td></tr>";
						echo "<tr  align='left' ><td>Pa&iacute;s</td><td>:</td><td>".$this->ubigeo->ver_datospais($_REQUEST['pais'])."</td></tr>";
						echo "<tr  align='left' ><td>Codigo Postal</td><td>:</td><td>".$_REQUEST['codpostal']."<br></td></tr>";
						echo "<tr  align='left' ><td>Estado/Regi&oacute;n</td><td>:</td><td>".$_REQUEST['ub_estado']."</td></tr>";
		 				echo "<tr  align='left' ><td>Ciudad</td><td>:</td><td>".$_REQUEST['ciudad']."</td></tr>";
						echo "<tr  align='left' ><td>Domicilio</td><td>:</td><td>".$_REQUEST['direccion']."</td></tr>";
		 				echo "<tr  align='left' ><td>Tel&eacute;fono/Movil</td><td>:</td><td>".$_REQUEST['telefono']."</td></tr>";
						echo "<tr  align='left' ><td>Profesi&oacute;n</td><td>:</td><td>".$_REQUEST['profesion']."</td></tr>";
						echo "<tr  align='left' ><td>Tipo de Documento</td><td>:</td><td>".$td."</td></tr>";
						echo "<tr  align='left' ><td>Nro. de Documento</td><td>:</td><td>".$_REQUEST['nrodoc']."</td></tr>";
						echo "<tr  align='left' ><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;<br></td></tr>";
						echo "<tr  align='left' ><td>DATOS DE FACTURACION</td><td>&nbsp;</td><td>&nbsp;<br></td></tr>";
						echo "<tr  align='left' ><td>Raz&oacute;n Social/Empresa </td><td>:</td><td>".$_REQUEST['razon']."<br></td></tr>";
						echo "<tr  align='left' ><td>RUC / RUT / RFC </td><td>:</td><td>".$_REQUEST['ruc']."</td></tr>";
						echo "<tr  align='left' ><td>Direcci&oacute;n facturaci&oacute;n</td><td>:</td><td>".$_REQUEST['direccionfact']."</td></tr>";
						echo "<tr  align='left' ><td>Pais de Facturacion </td><td>:</td><td>".$this->ubigeo->ver_datospais($_REQUEST['paisfact'])."</td></tr>";
						echo "<tr  align='left' ><td>Ciudad de  facturaci&oacute;n</td><td>:</td><td>".$_REQUEST['ciudadfact']."</td></tr>";
			 			echo "<tr  align='left' ><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;<br></td></tr>";
						echo "<tr  align='left' ><td colspan=3>Estos son los datos de su cuenta personal para acceder a los pedidos.<br><br></td></tr>";	
			 			echo "<tr  align='left' ><td>Email</td><td>:</td><td>".$_REQUEST['email']."</td></tr>";
			  			echo "<tr  align='left' ><td>Contrase&ntilde;a</td><td>:</td><td>".$_REQUEST['clave']."</td></tr>";
			 			echo "<tr  align='left' ><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;<br></td></tr>";						
		  				echo "<tr  align='left' ><td colspan=3> <a href='".$referencia."'  >Registrar otro Usuario </a></td></tr>
		  				</table>";

	
	}

function usuario_nuevocliente($tipo,$nombres,$apellidos,$pais,$codpostal,$ciudad,$direccion,$telefono,$tipodoc,$nrodoc,$email,$clave,$ub_estado,$profesion,$fechanac,$sexo,$idioma)
	{

		$query="select usu_codigo,usu_estado from usuario where usu_email='$email' and usu_estado='1'";
		$rsval=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rsval);
		if ($campo['usu_codigo'])
			{
					if ($idioma==='1')
		 			$mensaje=  $email." Ya existe en la base de datos, Registre otro correo para crear una cuenta de usuario ";
					else 
					$mensaje=  $email." Already exists in  data base, Registers another email to create a user account";		
				    $this->util->mensaje($mensaje,'3');
				
			}
		else 
			{    if ($idioma==='1')
			  		$fechanac=$this->util->conviertefecha($fechanac); 
				
				$fecha= date('Y-m-d');
				$email=trim($email);
  				$clave= md5($clave);
				$td=$this->devuelve_documento($tipodoc);
				$query="insert into usuario(usu_tipo,usu_nombres,usu_apellidos,ub_codigo,usu_codigopostal,usu_ciudad,usu_direccion,usu_movil,usu_tipo_documento,usu_doc_identidad,usu_email,usu_clave,usu_estado,ub_estado,usu_profesion,usu_sexo,usu_fechanac,usu_fecha) values('$tipo','$nombres','$apellidos','$pais','$codpostal','$ciudad','$direccion','$telefono','$tipodoc','$nrodoc','$email','$clave','1','$ub_estado','$profesion','$sexo','$fechanac','$fecha')";
				$rs= $this->util->query($query,'','5'); 
	 			if ($rs)
 	   			
				{
				    $usu_codigo=mysql_insert_id();
					return $usu_codigo;
				
 				}
			}	
						
						
	}




function usuario_editardatosfact($codigo,$idioma)
{
	$query = sprintf("update usuario set usu_razonsoc=%s,usu_ruc=%s,ub_codigofact=%s,usu_direccionfact=%s,usu_ciudadfact=%s  where usu_codigo=%s",
                       $this->GetSQLValueString($_POST['razonsoc'], "text"),
                       $this->GetSQLValueString($_POST['ruc'], "text"),
                       $this->GetSQLValueString($_POST['paisfact'], "text"),
                       $this->GetSQLValueString($_POST['direccionfact'], "text"),
                       $this->GetSQLValueString($_POST['ciudadfact'], "text"),
                       $this->GetSQLValueString($codigo, "int"));

	$rs= $this->util->query($query,'USUARIO','5');

	if ($rs)
	{
	
	return $rs;
	}

}
function  ver_usuario($email)
{

	$query="select u.*, p.ub_descripcion from usuario u , ubigeo p  where usu_email='$email' and u.ub_codigo= p.ub_codigo and usu_estado='1'";		
	$rs= $this->util->query($query,'','5');
	
		if (!($rs))
 	    	{
			Echo "Hay problemas en la consulta";
	    	}
		 	else 
			{
			 $campo=mysql_fetch_array($rs);
		 	 $this->usu_codigo= $campo['usu_codigo'];
			 $this->usu_nombres= $campo['usu_nombres'];
 			 $this->usu_direccion=$campo['usu_direccion'];
			 $this->usu_apellidos= $campo['usu_apellidos'];
			 $this->usu_clave=$campo['usu_clave'];
			 $this->usu_email=$campo['usu_email'];
			 $this->usu_ciudad=$campo['usu_ciudad'];
			 $this->usu_postal=$campo['usu_codigopostal'];			 
//lineas para filtrar pais
			 $this->ub_pais=$campo['ub_codigo'];
 			 $this->ub_descripcion=$campo['ub_descripcion'];
//termina linea para filtrar pais
			 $this->ub_estado=$campo['ub_estado'];			 
			 $this->usu_movil=$campo['usu_movil']; 
			 $this->doc_identidad=$campo['usu_doc_identidad']; 			 
			 $this->tipo_documento=$campo['usu_tipo_documento']; 
			 $this->usu_profesion=$campo['usu_profesion']; 
			 $this->usu_razonsocial=$campo['usu_razonsoc']; 
			 $this->usu_ruc=$campo['usu_ruc']; 
			 $this->usu_direccionfact=$campo['usu_direccionfact'];
  			 $this->usu_ciudadfact=$campo['usu_ciudadfact']; 
 			 $this->usu_ciudadfact=$campo['usu_ciudadfact']; 	
			 $this->usu_codpostal=$campo['usu_codigopostal']; 
			 $this->usu_sexo=$campo['usu_sexo']; 			 			 
 			 $this->usu_fechanac=$campo['usu_fechanac']; 
			 $this->ub_paisfact=$campo['ub_codigofact'];
			 $this->sistema=$campo['usu_tipo']; 
		     return  $this->usu_email;

		 	}
}
	

function  ver_usuario_codigo($codigo)
	{

 	  $query="select * from usuarios  where usu_id='$codigo' and usu_eliminado='0'";
		$rs= $this->util->query($query,'','5');
		if (!($rs))
 	    	{
			
	    	}
		 	else 
			{
			 $campo=mysql_fetch_array($rs);
		 	 $this->usu_id= $campo['usu_id'];
			 $this->usu_tipo= $campo['usu_tipo'];
			 $this->usu_nombres= $campo['usu_nombres'];
			 $this->usu_apellidos= $campo['usu_apellidos'];
 			 $this->usu_direccion=$campo['usu_direccion'];
 			 $this->tipo_dni=$campo['usu_dni']; 
			 $this->usu_email=$campo['usu_email'];
			 $this->usu_clave=$campo['usu_clave'];
			 $this->usu_movil=$campo['usu_eliminado'];  
		     return  $this->usu_id;
		 	}
		 }



function recuperar_datos($email,$idioma)
{
	$email= trim($email);


	
$query="select  usu_codigo,usu_nombres,usu_apellidos,usu_email,usu_clave  from usuario where usu_email='$email' and usu_estado='1'";
	$rs=mysql_query($query,$this->cn);
	$campo= mysql_fetch_array($rs);
	if ($campo['usu_codigo']>0)
		{
			$clavegenerada0=$this->util->generaclave(5);
			
	
			
			 $correo=$email;
			 if ($idioma==='1')
			 {
			 $cabeceras= "Content-type: text/html; charset=iso-8859-1\r\n"; 
 		 	 $cabeceras.="From: sales@peruvianart.com"; 
		  
	    	$asunto ="Solicitud de contrase&ntilde;a nueva: PERUVIAN ART SRL"; 
    		$cuerpo.= "";
		    $cuerpo.= "Recordatorio de contraseña \r\n";
			
			$cuerpo.="Nombres: ".$campo['usu_nombres']."\r\n";
			$cuerpo.="Apellidos: ".$campo['usu_apellidos']."\r\n"; 
			$cuerpo.="Email: ".trim($email)."\n"; 
			$cuerpo.="Contraseña: ".$clavegenerada0."\r\n";
			}
			if ($idioma==='2'){
 		 	 $cabeceras.="From: sales@peruvianart.com"; 
		  
	    	$asunto ="Request of new password: PERUVIAN ART SRL"; 
    		$cuerpo.= "";
		    $cuerpo.= "Reminder of password \r\n";
			
			$cuerpo.="Name: ".$campo['usu_nombres']."\r\n";
			$cuerpo.="Last Name: ".$campo['usu_apellidos']."\r\n"; 
			$cuerpo.="Email: ".trim($email)."\n"; 
			$cuerpo.="Password: ".$clavegenerada0."\n";			
			}
	   		mail($correo,$asunto,$cuerpo,$cabeceras); 
			
			
			$clavegenerada0=md5($clavegenerada0);
			$query="update usuario set usu_clave='$clavegenerada0'  where usu_email='$email'";
			$rs2=mysql_query($query,$this->cn);
			
			if ($idioma==='1'){
			
	   		echo " <h4>Su nueva  contrase&ntilde;a  ha sido enviada al correo: ".$email."</h4><br><br><a href=micuenta.php>Ingresar a mi cuenta</a><br>";
				
			}
			if ($idioma==='2')
			{
			echo " <h4>Its new password has been sent to the mail:".$email."</h4><br><br><a href=micuenta.php>To enter my account</a><br>";
				
			}
			
			
			
      	}
		else
		{ 
		
		if ($idioma==='1')
		{
		 echo " <h3>No existe la cuenta de correo ".$email." registrada en nuestra Base de Datos  </h3>"; 
		}
		if ($idioma==='2')
		{
		
		
		
		 echo " <h3> Email account does not exist ".$email." registered in our data base</h3>"; 
		}
		 }

 	}


		
	function usu_validar($email,$clave)
	{ 
		
		 $clave=md5($clave);
	 
		echo $query="select usu_id,usu_nombres,usu_apellidos,usu_direccion,usu_telefono,usu_email,usu_clave from usuarios where usu_usuario='$email' and  usu_clave='$clave' and usu_eliminado='0'";
		
		$rs= $this->util->query($query,'','5');
	
		$campo=mysql_fetch_array($rs);
	
		if (!($campo['usu_email']))
		{
			
			echo "<script> alert('Nombre de Usuario o Clave Incorrecta') </script>";
 		
		}
		
		else
		{

			 $this->usu_id= $campo['usu_id'];
			 $this->usu_nombres= $campo['usu_nombres'];
 			 $this->usu_direccion=$campo['usu_direccion'];
			 $this->usu_apellidos= $campo['usu_apellidos'];
			 $this->usu_email=$campo['usu_email'];
			 $this->usu_telefono=$campo['usu_telefono']; 


			 return $this->usu_id;
				}
	 


		}






	function usuario_borrar($codigo)
 	{
 		$query="update usuarios set usu_eliminado='1' where usu_id=$codigo";
 		$rs= $this->util->query($query,'DATOS ELIMINADOS','5');
 		return $rs;
 	}


	function existe_email($email)
	{
		$query="select usu_id,usu_eliminado,usu_email from usuarios where usu_email='$email' and usu_eliminado='0'";
		$rsval=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rsval);
		 
		if ($campo['usu_id'])
		{
		 			$mensaje=  $email." Ya existe en la base de datos, Registre otro correo para crear una cuenta de usuario ";
				    $this->util->mensaje($mensaje,'3');	

		}
			
		return $campo['usu_id'];

	}




	function usuario_nuevo($tipo,$nombres,$apellidos,$direccion,$telefono,$dni,$email,$clave,$eliminado)
	{

		 
		if ($this->existe_email($email))
			{

		 			$mensaje=  $email." Ya existe en la base de datos, Registre otro correo para crear una cuenta de usuario ";

				    $this->util->mensaje($mensaje,'5');
							
			}
		else 
			{  


				$email=trim($email);
  				$clave= md5($clave);
				$query="insert into usuarios(usu_tipo,usu_nombres,usu_apellidos,usu_direccion,usu_telefono,usu_dni,usu_email,usu_clave,usu_eliminado) values('$tipo','$nombres','$apellidos','$direccion','$telefono','$dni','$email','$clave','$eliminado')";
				$this->util->query($query,'USUARIO','1');
	 			

			}	
						
						
	}


	function area_nuevo($descripcion,$estado)
	{   

 		$query="select area_descripcion from areas where area_descripcion='".$descripcion."' and area_eliminado='0'";
		$rs=$this->util->query($query,'','5');
		$campo=mysql_fetch_array($rs);
		if ($campo['area_descripcion'])
		{
 			$this->util->mensaje('El nombre de Area '.$descripcion.' ya existe','3');
		}
		else
		{ 
		 	$query="insert into areas(area_descripcion,area_eliminado)  values ('$descripcion','$estado')";
    	 	$this->util->query($query,'AREA','1');
		}

   	}	


	function  area_ver($area)
	{
 	  	$query="select * from areas where area_id='$area' and area_eliminado='0'";
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




	function area_listar($n)
	{
		 $query="select * from areas where area_eliminado='0' ";
		
		switch ($n)
		{
	  	  	case '1':
			{
			$query1=" and area_id!='1' order by area_descripcion asc";
				 break;
			 }
	  	  	case '2':
			{
		$query2=" order by area_descripcion asc";
				 break;
			 }			 
		}
		
		$queryi=$query.$query1.$query2;			 
		
		$rs= mysql_query($queryi,$this->con->cn);
		return $rs;
	}



	function area_borrar($codigo)
 	{
 		$query="update areas set area_eliminado='1' where area_id=$codigo";
 		$rs= $this->util->query($query,'AREA: DATOS ELIMINADOS','1');
 		return $rs;
 	}


	function generar_select_area($nombre,$metodo,$modelo,$n,$cero='',$cero_desc='')
	{
  		$rs2= $this->area_listar($n);
		$this->util->genera_select($nombre,$metodo,'area_id','area_descripcion',$rs2,$cero,$cero_desc);
	}
	
	function usuario_listar()
	{
 
 		$regxpag=25;
 	 	$query="select usu_id,CONCAT(usu_nombres,', ', usu_apellidos) as nombres,usu_direccion,usu_dni,usu_email,usu_clave,usu_eliminado,usu_telefono,usu_tipo from usuarios where usu_eliminado='0'  order by usu_tipo,nombres asc ";
	
		//$this->query=$query;
		$rs= $this->util->query($query,'','5');
		return $rs;
	}

	function area_editar($codigo,$descripcion,$eliminado)
 	{
 		$query="update areas set area_descripcion='$descripcion', area_eliminado='$eliminado' where area_id='$codigo' ";
 		$rs= $this->util->query($query,'AREA: DATOS ACTUALIZADOS','1');
 		return $rs;
 	}

	function generar_select_usuario($nombre,$metodo,$modelo,$cero='',$cero_desc='')
	{
  		$rs2= $this->usuario_listar();
		$this->util->genera_select($nombre,$metodo,'usu_id','nombres',$rs2,$cero,$cero_desc);
	}

	function  devuelve_usuario($usuario)
	{
		$query="select usu_id,CONCAT(usu_nombres,', ', usu_apellidos) as nombres from usuarios where usu_id='$usuario'";
		$rs= mysql_query($query,$this->con->cn);
		$campo =mysql_fetch_array($rs);
		return $campo['nombres'];
	}


	


}

?>
