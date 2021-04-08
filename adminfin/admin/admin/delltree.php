<?php
include_once("redireccion.php");
function eliminarDir($dir) {
    $files = glob( $dir . '*', GLOB_MARK );
    foreach( $files as $file ){
        if( substr( $file, -1 ) == '/' )
            eliminarDir( $file );
        else
            unlink( $file );
		

    }
		if(file_exists($dir . "/.htaccess"))
			unlink($dir . "/.htaccess");
		else
			echo "no hay fichero=" . $dir . "/.htaccess";	
		if(file_exists($dir . "/.htaccess.mant"))
			unlink($dir . "/.htaccess.mant");
    if (is_dir($dir))
	{
		rmdir( $dir );
	}
   
}
function eliminarContenidoDir($carpeta)
{
	if(file_exists($carpeta))	
	{
		if(file_exists($carpeta . "/.htaccess"))
			unlink($carpeta . "/.htaccess");
		if(file_exists($dir . "/.htaccess.mant"))
			unlink($dir . "/.htaccess.mant");
		//else
		//	echo "no hay fichero=" . $carpeta . "/.htaccess";	
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
	}
	else
	{
		echo $carpeta . " No existe <br/>";
	} 
}
?>