<?php
include("../libs/conn.php"); 
try
{
$id = (int) $_GET['id']; 

	$query = "DELETE FROM `tipopagina` WHERE `id` = '$id' ";
	$result = $mysqli->query($query);

		
	// Liberar resultados
	//$result->free();
	//Cerrar conexion
	$mysqli->close();
	
header("Location:index.php?error=false&flash=Se ha borrado correctamente a las ".date("H:i:s"));
}
catch(Exception $e)
{
	echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	header("Location:index.php?error=true&flash=Se ha producido una excepcion: Error");
}
?> 
