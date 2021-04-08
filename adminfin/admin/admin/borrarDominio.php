<?php
include_once("redireccion.php");

	include_once("delltree.php");
	if (isset($_GET['dom']))
	{
		$dominio=$_GET['dom'];
	}
	//evitar los echos en producion en el servidor
	ob_start();
	eliminarDir("/var/www/" . $dominio);
	
	shell_exec("sudo /usr/local/bin/dellmyDominioScript.sh " . $dominio);
	shell_exec("sudo /usr/local/bin/reloadapache.sh");
	
	if(file_exists("/var/www/" . $dominio))	
	{		
		if(file_exists("/var/www/" . $dominio))	
		{
			echo "<br/>la carpeta /var/www/$dominio no se ha podido borrar<br/>";
		}
		else
		{
			echo "<br/>la carpeta /var/www/$dominio se ha podido borrar<br/>";
		}
	}
	include("conn.php");
	$patron="/[^a-zA-Z0-9]/";
	$sustitucion='_';
	$baseDatos=preg_replace($patron, $sustitucion, $dominio);
	
	if(!($mysqli->query("drop database IF EXISTS " . $baseDatos)))
	{
	  echo "<br/>Fallo borrando la base de datos: ".$mysqli->connect_errno();
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