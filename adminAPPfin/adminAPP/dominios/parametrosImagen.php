<?php
if (isset($_GET['plan']))
{
	$plantilla=$_GET['plan'];
	
	include('../libs/conn.php');
	
	$query = "SELECT nombre FROM plantilla WHERE id= '" . $plantilla . "'";
	$result = $mysqli->query($query);
		
	$row=$result->fetch_array(MYSQLI_ASSOC);
	echo "Plantillas/" . $row['nombre'] . "/imagen.jpg";
}
else
{
	if (isset($_GET['ele']))
	{
		$tipo=$_GET['ele'];
		include('../libs/conn.php');
		
		$query = "SELECT id,nombre,id_tipo FROM plantilla WHERE id_tipo= '" . $tipo . "'";
		$result = $mysqli->query($query);
			
		$row=$result->fetch_array(MYSQLI_ASSOC);
		echo "Plantillas/" . $row['nombre'] . "/imagen.jpg";
	}
}
$result->free();
$mysqli->close();
?>