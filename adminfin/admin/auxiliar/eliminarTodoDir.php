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
   
    if (is_dir($dir))
	{
		echo "Directorio<br/>";
		rmdir( $dir );
	}
}
function eliminarDirYocultos($dir) {
	echo "dentro".$dir."<br/>";
    $files = glob( $dir . '.*', GLOB_MARK );
    foreach( $files as $file ){
		if($file=='.' || $file=='..') continue;
		else
		{
			if( substr( $file, -1 ) == '/' )
				eliminarDir( $file );
			else
				unlink( $file );
		}
	}

    if (is_dir($dir))
	{
		echo "Directorio<br/>";
		rmdir( $dir );
	}
}
function SureRemoveDir($dir, $DeleteMe) {
    if(!$dh = @opendir($dir)) return;
    while (false !== ($obj = readdir($dh))) {
        if($obj=='.' || $obj=='..') continue;
        if (!@unlink($dir.'/'.$obj)) SureRemoveDir($dir.'/'.$obj, true);
    }

    closedir($dh);
    if ($DeleteMe){
        @rmdir($dir);
    }
}
?>