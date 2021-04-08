<?php
include_once("redireccion.php");

	include_once("delltree.php");
	if (isset($_GET['dom'])){
		$dominio=$_GET['dom'];
	}
	//evitar echo para la hora de producion en servidor
	//ob_start();
	eliminarContenidoDir("/var/www/" . $dominio);
	if(file_exists("/var/www/" . $dominio))
		$is_empty = (bool) (count(scandir("/var/www/" . $dominio)) == 2);
	else
		$is_empty = false;
	if($is_empty)	
	{
		echo "ok";	
	}
	else
	{
		echo "<br/>la carpeta /var/www/$dominio se no ha podido borrar<br/>";
	}
	include("conn.php");
	$patron="/[^a-zA-Z0-9]/";
	$sustitucion='_';
	$baseDatos=preg_replace($patron, $sustitucion, $dominio);

	if(!($mysqli->query("drop database IF EXISTS " . $baseDatos)))
	{
	   "<br/>Fallo borrando la base de datos: ".$mysqli->connect_errno();
		die();
	}
	
	$mysqli->close();
	//$salida1 = ob_get_contents();
	//ob_end_clean();
	//var_dump($salida1);
?>