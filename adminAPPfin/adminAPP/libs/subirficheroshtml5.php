<?php
function subirficherosHTML5($files,$directorio)
{

	if (is_uploaded_file($_FILES["$files"]['tmp_name']))
	{
		if(!file_exists($directorio))
		{
			mkdir($directorio, 0777, true);
			chgrp($directorio, "ftp"); 
			chown ($directorio, "descuentoftpu");
			chmod($directorio, 0777);
		}
		 $nombreDirectorio = $directorio;
		 //$nombreFichero = $_FILES["$files"]['name'];
	switch($files)
	{
		case 'ficherotpl':
			$nombreFichero="index.tpl";
		break;
		case 'ficherozip':
			$nombreFichero="ficheros.zip";
		break;
		case 'ficherosql':
			$nombreFichero="esquema.sql";
		break;
		case 'ficherojpg':
			$nombreFichero="imagen.jpg";
		break;
		default:
			$nombreFichero = $_FILES["$files"]['name'];
	}
		
		$nombreCompleto = $nombreDirectorio . "/" . $nombreFichero;
		
		//renombrar ficheros iguales
		/*
		 if(is_file($nombreCompleto))
		 {
			 $idUnico = time();
			 $nombreFichero = $idUnico . "-" . $nombreFichero;
		 }
		 */
		move_uploaded_file($_FILES["$files"]['tmp_name'], $nombreDirectorio . "/" . $nombreFichero);
	}
} 

function descargarFicheroHTML5($archivo, $downloadfilename = null) {

    if (file_exists($archivo)) {
        $downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $downloadfilename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($archivo));

        ob_clean();
        flush();
        readfile($archivo);
        exit;
    }
}
?>