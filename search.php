<?php 
	
	echo "<h1>Resultado</h1>";

	include_once("config.php");

	$conexion = new Config();

	$result = $conexion->consultar();

	echo $result;

?>