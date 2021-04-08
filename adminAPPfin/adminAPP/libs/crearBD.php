<?php
include_once("snoopy.class.php");

function crearBaseDatos($host,$baseDatos,$script)
{

    $snoopy = new Snoopy;
   
    $snoopy->set_submit_multipart();
    $submit_files = array();
	
    $submit_url = "http://".$host."/admin/crearbd.php";
	$submit_vars["bd"] = $baseDatos;
    $submit_vars["script"] = $script;
    $snoopy->submit($submit_url,$submit_vars);
	
	echo $snoopy->results;
}
?>