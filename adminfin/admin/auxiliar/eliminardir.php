<?php
function eliminarDir($carpeta)
{
	foreach(glob($carpeta . "/*") as $archivos_carpeta)
	{
		
		if(file_exists($archivos_carpeta))	
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
	if(file_exists($carpeta . "/.htaccess"))
		unlink($carpeta . "/.htaccess");
	else
		echo "no hay fichero=" . $carpeta . "/.htaccess";	
		
		if(file_exists($dir . "/.htaccess.mant"))
			unlink($dir . "/.htaccess.mant");
			
	if(file_exists($carpeta))	
	{		
		rmdir($carpeta);
	}
	else
	{
		echo $carpeta . " No existe <br/>";
	}
}

function eliminarContenidoDir($carpeta)
{
	if(file_exists($carpeta))	
	{
		foreach(glob($carpeta . "/*") as $archivos_carpeta)
		{
			if(file_exists($archivos_carpeta))	
			{
				echo $archivos_carpeta;
				 
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
		if(file_exists($carpeta . "/.htaccess"))
			unlink($carpeta . "/.htaccess");
		else
			echo "no hay fichero=" . $carpeta . "/.htaccess";	
		if(file_exists($dir . "/.htaccess.mant"))
			unlink($dir . "/.htaccess.mant");
		
	}
	else
	{
		echo $carpeta . " No existe <br/>";
	} 
	
	//rmdir($carpeta);
}
?>