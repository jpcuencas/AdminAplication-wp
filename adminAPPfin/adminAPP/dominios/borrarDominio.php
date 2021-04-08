<?php
	//system("borrarDominio.sh $dominio");
	include("../libs/eliminardir.php");
try
{	
	if (isset($_GET['dom'])){
		$dominio=$_GET['dom'];
	}
	
	eliminarDir($dominio);
	shell_exec("/usr/local/bin/dellmyDominioScript.sh " . $dominio);
	shell_exec("/usr/local/bin/reloadapache.sh");
	include("../libs/conn.php");
	$patron="/[^a-zA-Z0-9]/";
	$sustitucion='_';
	$baseDatos=preg_replace($patron, $sustitucion, $BD);
	
	if(!($mysqli->query("drop database " . $baseDatos)))
	{
	   echo "<br/>Fallo borrando la base de datos: ".$mysqli->connect_errno();
		die();
	}
}
catch(Exception $e)
{
	//echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	header("Location:../Dominios/index.php?error=true&flash=Se ha producido una excepcion: Error:" . $e->getMessage());
}
?>