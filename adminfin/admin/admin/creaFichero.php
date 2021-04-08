<?php
include_once("redireccion.php");
//aumentar el tiempo de ejecucion
ini_set('max_execution_time', 300); //300 seconds = 5 minutes

if (isset($_POST['permalink'])){
	$permalink=$_POST['permalink'];
}
//aumentar el margen de subida de fichero
$POST_MAX_SIZE = ini_get('post_max_size');
$mul = substr($POST_MAX_SIZE, -1);
$mul = ($mul == 'M' ? 1048576 : ($mul == 'K' ? 1024 : ($mul == 'G' ? 1073741824 : 1)));
if( $_SERVER['CONTENT_LENGTH'] > $mul*(int)$POST_MAX_SIZE && $POST_MAX_SIZE )
{
    $error = true;
	echo "Error en tamanyo ficheros<br/>";
}

$upload_max_filesize = ini_get('upload_max_filesize');

if (isset($_POST['carpeta'])){
	$carpeta=$_POST['carpeta'];
}

if($_FILES['file']['error'] == 0)
{

	$target_path = "/var/www/" . $carpeta . "/".basename( $_FILES['file']['name']); 

	if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) 
	{
		//echo "El fichero ".  basename( $_FILES['file']['name'])." guardado";
	}	 
	else
	{
		echo "Error al subir el fichero";
	}
}
else
{
	echo "Hubo algun error";
}	
?>

