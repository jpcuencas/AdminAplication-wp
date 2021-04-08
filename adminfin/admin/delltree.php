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
		
		if(file_exists($dir . "/.htaccess.mant"))
			unlink($dir . "/.htaccess.mant");
		//ficheros de autoblog
		//////////////////////
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.buildpath"))
			unlink($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.buildpath");
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.project"))
			unlink($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.project");
			
			
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.settings/.jsdtscope"))
			unlink($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.settings/.jsdtscope");
			
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.settings/org.eclipse.php.core.prefs"))
			unlink($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.settings/org.eclipse.php.core.prefs");
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.settings/org.eclipse.wst.jsdt.ui.superType.container"))
			unlink($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.settings/org.eclipse.wst.jsdt.ui.superType.container");
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.settings/org.eclipse.wst.jsdt.ui.superType.name"))
			unlink($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.settings/org.eclipse.wst.jsdt.ui.superType.name");
			
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.settings"))
			rmdir($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/.settings");
			
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/www/.htpasswd"))
			unlink($dir . "/wp-content/plugins/wp-rss-multi-importer/www/.htpasswd");	
		
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/www/"))
			rmdir($dir . "/wp-content/plugins/wp-rss-multi-importer/www/");
		
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/"))
			rmdir($dir . "/wp-content/plugins/wp-rss-multi-importer/wp-auto-spinner/");
		if(file_exists($dir . "/wp-content/plugins/wp-rss-multi-importer/"))
			rmdir($dir . "/wp-content/plugins/wp-rss-multi-importer/");	
		//////////////////////////	
		if(file_exists($dir . "/wp-content/plugins/wp-auto-spinner/.buildpath"))
			unlink($dir . "/wp-content/plugins/wp-auto-spinner/.buildpath");
		if(file_exists($dir . "/wp-content/plugins/wp-auto-spinner/.project"))
			unlink($dir . "/wp-content/plugins/wp-auto-spinner/.project");	
		if(file_exists($dir . "/wp-content/plugins/wp-auto-spinner/.settings/.jsdtscope"))
			unlink($dir . "/wp-content/plugins/wp-auto-spinner/.settings/.jsdtscope");
			
		if(file_exists($dir . "/wp-content/plugins/wp-auto-spinner/.settings/org.eclipse.php.core.prefs"))
			unlink($dir . "/wp-content/plugins/wp-auto-spinner/.settings/org.eclipse.php.core.prefs");
		if(file_exists($dir . "/wp-content/plugins/wp-auto-spinner/.settings/org.eclipse.wst.jsdt.ui.superType.container"))
			unlink($dir . "/wp-content/plugins/wp-auto-spinner/.settings/org.eclipse.wst.jsdt.ui.superType.container");
		if(file_exists($dir . "/wp-content/plugins/wp-auto-spinner/.settings/org.eclipse.wst.jsdt.ui.superType.name"))
			unlink($dir . "/wp-content/plugins/wp-auto-spinner/.settings/org.eclipse.wst.jsdt.ui.superType.name");	
		if(file_exists($dir . "/wp-content/plugins/wp-auto-spinner/.settings"))
			rmdir($dir . "/wp-content/plugins/wp-auto-spinner/.settings");
		if(file_exists($dir . "/wp-content/plugins/wp-auto-spinner/"))
			rmdir($dir . "/wp-content/plugins/wp-auto-spinner/");
		///////////////////////
		
		if(file_exists($dir . "/wp-content/plugins/"))
			rmdir($dir . "/wp-content/plugins/");
		if(file_exists($dir . "/wp-content/"))
			rmdir($dir . "/wp-content/");
		
    if(is_dir($dir))
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