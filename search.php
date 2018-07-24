<?php 
	error_reporting(E_ALL ^ E_NOTICE);
	include_once("config.php");

//print_r($_POST);

	$conexion = new Config();
	switch ($_POST['accion']) {
		
		case 'buscarCiudad':
			$result = $conexion->consultarDestino($_POST['valor']);
			break;
		
		case 'buscarHotel':
			
			$result = $conexion->consultarHotel($_POST['txtCodigoDestino']);
		//	$result = $conexion->consultarHotel();
			break;
	}
	
	echo $result;

?>