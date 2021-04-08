<?php
function eliminarDir($carpeta)
{
	foreach(glob($carpeta . "/*") as $archivos_carpeta)
	{ 
		if (is_dir($archivos_carpeta))
		{
			eliminarDir($archivos_carpeta);
		}
		else
		{
			unlink($archivos_carpeta);
		}
	}
	 
	rmdir($carpeta);
}

function eliminarContenidoDir($carpeta)
{
	foreach(glob($carpeta . "/*") as $archivos_carpeta)
	{		 
		if (is_dir($archivos_carpeta))
		{
			eliminarDir($archivos_carpeta);
		}
		else
		{
			unlink($archivos_carpeta);
		}
	}
}
?>