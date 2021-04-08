<?php
/*
$id_conexion = conectarFTP($ftp,$ftp_user, $ftp_passwd);
subirImagen($id_conexion , $ruta_tmp."$fichero.html","/fichero.html" );
desconectarFTP($id_conexion); 
*/

function conectarFTP($host,$usr,$pwd)
{
    // connect to FTP server (port 21)
    $conn_id = ftp_connect($host, 21,240) or die ("Cannot connect to host");
   
    // send access parameters
    ftp_login($conn_id, $usr, $pwd) or die("<h3>Error al hacer el Login</h3>");
 
    return $conn_id;
}
 
 
function desconectarFTP($conn_id)
{
    // close the FTP stream
    ftp_close($conn_id);
}
 
function subirImagen($id_conexion, $local_file,$ftp_path )
{
    $upload = ftp_put($id_conexion, $ftp_path, $local_file, FTP_BINARY);
    
    print (!$upload) ? 'ERROR al subir el fichero '.$local_file : "" ;
    print "\n";
 
}
?>
   