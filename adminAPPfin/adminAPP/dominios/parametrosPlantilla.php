<?php
include('../libs/conn.php');
if(isset($_GET['ele']))
{
	$item=$_GET['ele'];
}
if(isset($_GET['plan']))
{
	$plantilla=$_GET['plan'];
}
if(isset($_GET['dom']))
{
	$dom=$_GET['dom'];
}
		
	$query = "SELECT id,nombre,id_tipo FROM plantilla WHERE id_tipo=" . $item;
	$result = $mysqli->query($query);
	while ($line = $result->fetch_array(MYSQLI_ASSOC)) {

			echo "<option value=" . $line["id"] . ((isset($plantilla) and ($line["id"]==$plantilla))? ' selected' : '') . ">" . $line["nombre"] . "</option>";
			echo"\n";
	}

	$result->free();
	$mysqli->close();
?>