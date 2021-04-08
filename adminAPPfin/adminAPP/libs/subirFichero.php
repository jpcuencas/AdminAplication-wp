<?php
	include_once("snoopy.class.php");
function subirFicheroHttp($host,$carpeta,$nombre_fichero,$fichero)
{
    $snoopy = new Snoopy;
   
    $snoopy->set_submit_multipart();
    $submit_files = array();
    $submit_files['file'] = $fichero;
 

	if(file_exists($fichero))
	{
		$submit_url = "http://".$host."/admin/creaFichero.php";
		$submit_vars["carpeta"] = $carpeta;
		$submit_vars["permalink"] = $nombre_fichero;
		$snoopy->submit($submit_url,$submit_vars,$submit_files);
	 
		echo $snoopy->results;
	}
	else
		 echo "<br/>No existe el fichero:  $fichero <br/>";
}
?>