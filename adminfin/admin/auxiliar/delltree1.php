<?php
function eliminarDir($dir) {
	echo "dentro".$dir."<br/>";
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
		echo "Directorio<br/>";
		rmdir( $dir );
	}
   
}

function eliminarContenidoDir($carpeta) {
	if(file_exists($carpeta . "/.htaccess"))
			unlink($carpeta . "/.htaccess");
	else
		echo "no hay fichero=" . $carpeta . "/.htaccess";
	if(file_exists($dir . "/.htaccess.mant"))
		unlink($dir . "/.htaccess.mant");
    $files = glob( $carpeta . '*', GLOB_MARK );
    foreach( $files as $file ){
		if($file!=$carpeta)
		{
			if( substr( $file, -1 ) == '/' )
				eliminarDir( $file );
			else
				unlink( $file );

		}
	}

    //if (is_dir($dir)) rmdir( $dir );
   
}

?>