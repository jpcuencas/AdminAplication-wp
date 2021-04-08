<?php
include_once("redireccion.php");
//descomprimir ficheros en el servidor
	if (isset($_GET['permalink'])){
		$fichero=$_GET['permalink'];
	}

	if (isset($_GET['carpeta'])){
		$carpeta=$_GET['carpeta'];
	}

	$ruta=$carpeta . $fichero;
	if(file_exists($ruta))
	{
		$zip = new ZipArchive;
		$res = $zip->open($carpeta . $fichero);
		
		if ($res === TRUE) {
			$zip->extractTo($carpeta);
			$zip->close();
			//echo "<br/>fichero descomprimido<br/>";
			unlink($carpeta . $fichero);
			//echo "<br/>fichero $carpeta $fichero borrado<br/>";
		} else {
			echo '<br/>failed, code:' . $res;
			$zip->getStatusString();
		}
	}
	else
	{
		echo "<br/>no existe el fichero= $fichero <br/>";
	}
?>