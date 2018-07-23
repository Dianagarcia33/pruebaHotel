<?php 
	
	include_once("config.php");

	$conexion = new Config();
	switch ($_POST['accion']) {
		
		case 'buscarCiudad':
			$result = $conexion->consultarDestino($_POST['valor']);
			break;
		
		case 'buscarHotel':
			echo "<h1>Resultado</h1>";
			$result = $conexion->consultarHotel();
			break;
	}
	

	echo $result;

?>