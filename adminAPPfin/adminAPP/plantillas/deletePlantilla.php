<?php
include_once("../libs/delltree.php");
include("../libs/conn.php"); 
try
{
	if (isset($_GET['id']))
	{
		$id = (int) $_GET['id']; 

		$query = "SELECT id,nombre FROM plantilla WHERE id= '" . $id . "'";
		$result = $mysqli->query($query);
		$row=$result->fetch_array(MYSQLI_ASSOC);
		
		$nombre=$row["nombre"];

		eliminarDir("../dominios/Plantillas/" . $nombre);
		
		if(file_exists("../dominios/Plantillas/" . $nombre))	
		{		
			unlink("../dominios/Plantillas/" . $nombre);
			if(file_exists("../dominios/Plantillas/" . $nombre))	
			{
				echo "<br/>la carpeta ../dominios/Plantillas/$nombre no se ha podido borrar<br/>";
			}
		}

		$query = "DELETE FROM `plantilla` WHERE `id` = '$id' ";
		$result = $mysqli->query($query);
			
		// Liberar resultados
		//$result->free();

		
	header("Location:index.php?error=false&flash=Se ha borrado correctamente a las ".date("H:i:s"));
	}
	else
	{
		header("Location:index.php?error=false&flash=Se no ha borrado correctamente");
	}
	//Cerrar conexion
	$mysqli->close();
}
catch(Exception $e)
{
	echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	//Cerrar conexion
	$mysqli->close();
	header("Location:index.php?error=true&flash=Se ha producido una excepcion: Error");
}
?> 
