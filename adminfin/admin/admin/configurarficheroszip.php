<?php
include_once("redireccion.php");
	if(isset($_GET['nom']))
	{
		$carpeta=$_GET['nom'];
	}
	if(isset($_GET['perm']))
	{	
		$permisos=$_GET['perm'];
	}
//editar los permisos de un directorio
function cambiarDir($dir,$perm) {
    $files = glob( $dir . '*', GLOB_MARK );
    foreach( $files as $file ){
		//chgrp($file, "ftp"); 
		//chown ($file, "descuentoftpu");
		chmod($file, $perm);

		if(substr($file,-1)=='/')
		{
			cambiarDir($file);
		}
    }
   
}	
if(isset($carpeta) and isset($permisos))
	cambiarDir($carpeta, $permisos);

?>