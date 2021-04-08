<?php
include_once('../libs/subirficheroshtml5.php'); 
	if(isset($_GET['mode']))
	{
		$mode=$_GET['mode'];
	}
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
	}
	if(isset($_GET['tip']))
	{
		$tipo=$_GET['tip'];
	}
	if(isset($_GET['nom']))
	{
		$nombre=$_GET['nom'];
	}
try
{

	switch($tipo)
	{
		case 'tpl':
		if(file_exists("../dominios/Plantillas/" . $nombre . "/index.tpl"))
			descargarFicheroHTML5("../dominios/Plantillas/" . $nombre . "/index.tpl");
		else
			header("Location:plantillas.php?mode=$mode&id=$id&error=true&flash=Se ha producido un error");
		break;
		case 'zip':
		if(file_exists("../dominios/Plantillas/" . $nombre . "/ficheros.zip"))
			descargarFicheroHTML5("../dominios/Plantillas/" . $nombre . "/ficheros.zip",$nombre . ".zip");
		else
			header("Location:plantillas.php?mode=$mode&id=$id&error=true&flash=Se ha producido un error");
		break;
		case 'sql':
		if(file_exists("../dominios/Plantillas/" . $nombre . "/esquema.sql"))
			descargarFicheroHTML5("../dominios/Plantillas/" . $nombre . "/esquema.sql",$nombre . ".sql");
		else
			header("Location:plantillas.php?mode=$mode&id=$id&error=true&flash=Se ha producido un error");
		break;
		case 'jpg':
		if(file_exists("../dominios/Plantillas/" . $nombre . "/imagen.jpg"))
			descargarFicheroHTML5("../dominios/Plantillas/" . $nombre . "/imagen.jpg",$nombre . ".jpg");
		else
			header("Location:plantillas.php?mode=$mode&id=$id&error=true&flash=Se ha producido un error");
		break;
	}

	header("Location:plantillas.php?mode=$mode&id=$id");
}
catch(Exception $e)
{
	//echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	header("Location:plantilla.php?error=true&flash=Se ha producido un error" . $e->getMessage());
}
?>
	