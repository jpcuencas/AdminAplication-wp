<?php
include_once("redireccion.php");
	if(isset($_GET['nom']))
	{
		$carpeta=$_GET['nom'];
	}
/*	if(isset($_GET['per']))
	{
		$permisos=$_GET['per'];
	}
*/	
	$dominio="/var/www/" . $carpeta;
	//modifica los permisos de ficheros de forma efectiva
	shell_exec("sudo /usr/local/bin/cambiarFichero.sh " . $dominio);
	shell_exec("chmod 777 -R /var/www/" . $carpeta);
	//shell_exec("chmod " . $permisos . " -R /var/www/" . $carpeta . "/*");
?>