<?php
require_once('../clases/cargocourier_data.php');

$cargo = new  cargocourierdata();
$empresas = new  empresasdata();
$auxiliares = new  auxiliaresdata();

if($_REQUEST['operacion']==1)
{
	echo $auxiliares->devuelve_preciokg($_REQUEST['zona']);
}

if($_REQUEST['operacion']==2)
{
	echo $cargo->calcula_kgadicional($_REQUEST['peso'],$_REQUEST['costo_kg'],$_REQUEST['cantidad']);
}
?>