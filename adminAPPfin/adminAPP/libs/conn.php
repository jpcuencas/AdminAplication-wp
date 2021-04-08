<?php
	$mysqli = new mysqli("localhost", "Usuario1", "123654", "gestionDominios");

	/* verificar la conexion */
	if (mysqli_connect_errno()) 
	{
		printf("Conexion fallida: %s\n", mysqli_connect_error());
		exit();
	}
	mysqli_query ($mysqli, "SET NAMES 'utf8'");
	//mysql_query("SET NAMES utf8");
	/* cambiar el conjunto de caracteres a utf8 */
	if (!$mysqli->set_charset("utf8")) 
	{
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
	}
	
	$sqluser="Usuario1";
	$sqlpass="123654";
?>
