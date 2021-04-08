<?php
include_once("redireccion.php");
	$sqluser="root";
	$sqlpass="123654";
	$mysqli = new mysqli("localhost", $sqluser, $sqlpass);

	/* verificar la conexion */
	if (mysqli_connect_errno()) 
	{
		printf("Conexion fallida: %s\n", mysqli_connect_error());
		exit();
	}
	/*mysql_query("SET NAMES utf8");*/
	/* cambiar el conjunto de caracteres a utf8 */
	if (!$mysqli->set_charset("utf8")) 
	{
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
	}
?>