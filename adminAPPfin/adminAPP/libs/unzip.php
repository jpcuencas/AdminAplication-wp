<?php
include_once("enviarGet.php");
function enviarzip($host,$carpeta,$fichero)
{
	$submit_url = "http://".$host."/admin/unzip.php?carpeta={$carpeta}&permalink={$fichero}";
	//echo $submit_url;
	file_get_contents_curl($submit_url);
}

?>
