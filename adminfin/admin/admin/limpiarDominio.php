<?php
include_once("redireccion.php");

	include_once("delltree.php");
	if (isset($_GET['dom'])){
		$dominio=$_GET['dom'];
	}
	//evitar echo para la hora de producion en servidor
	ob_start();
	eliminarContenidoDir("/var/www/" . $dominio);
	
	include("conn.php");
	$patron="/[^a-zA-Z0-9]/";
	$sustitucion='_';
	$baseDatos=preg_replace($patron, $sustitucion, $dominio);

	if(!($mysqli->query("drop database IF EXISTS " . $baseDatos)))
	{
	   "<br/>Fallo borrando la base de datos: ".$mysqli->connect_errno();
		die();
	}
	else
	{
		echo "base de datos borrada";
	}
	$mysqli->close();
	//$salida1 = ob_get_contents();
	//ob_end_clean();
	//var_dump($salida1);
?>