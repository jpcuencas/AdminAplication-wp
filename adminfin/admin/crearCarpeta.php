<?php
include_once("redireccion.php");
	if(isset($_GET['nom']))
	{
		$carpeta=$_GET['nom'];
	}
	
	if(!file_exists("/var/www/" . $carpeta))
	{  	if(!mkdir( "/var/www/" . $carpeta, 0777, true)) 
		{
			die('Fallo al crear las carpetas...\n<br/>');
		}
	}
	//activamos el sitio web
	shell_exec("chmod 777 -R /var/www/" . $carpeta);
	
?>