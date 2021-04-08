<?php
	include_once("enviarGet.php");
	include_once("snoopy.class.php");
	include_once("md5_php.php");
	include_once("mandarCorreoSwift.php");
	include_once("../libs/mandarMail.class.php");
	
	if(isset($_GET['dom']))
	{
		$id=$_GET['dom'];
	}
	if(isset($_GET['ser']))
	{	
		$ser=$_GET['ser'];
	}
function enviawpconfautoblog($id,$ser)
{
try
{
	include("conn.php");
	$query = "SELECT ID,nombre,id_plantilla,valores,idioma FROM dominio WHERE ID = '" . $id . "'";
	$result = $mysqli->query($query);
	$row=$result->fetch_array(MYSQLI_ASSOC);
	
	$nombre=$row["nombre"];
	$idplantilla=$row["id_plantilla"];
	$idioma=$row["idioma"];
	$valores=$row["valores"];
	
	//$valores=str_replace("\n", "|", $valores);
	
	$arr=json_decode($valores, true);
	
	$tagsWP = split(",",$arr['tag_wp']);
	$feedWP = split("<br/>",$arr['feed_wp']);
	$feedMax = $arr['mun_feed'];
	$maxTotal = $arr['num_max'];
	$frecuenciaRevision = $arr['frec_rss'];
	$idiomaSpinner = $arr['idioma_spinner'];
	
	$query2 = "SELECT ID,prefijo FROM plantilla WHERE ID = '" . $idplantilla . "'";
		$result2 = $mysqli->query($query2);
		$row2=$result2->fetch_array(MYSQLI_ASSOC);
		
		$prefijo=$row2["prefijo"];
		
	$query1 = "SELECT ID,ip FROM servidor WHERE ID = '" . $ser . "'";
		$result1 = $mysqli->query($query1);
		$row1=$result1->fetch_array(MYSQLI_ASSOC);
		
		$ip=$row1["ip"];
		$url = "http://" . $ip ."/admin/configautoblog.php"; 
		
		$snoopy = new Snoopy;
		$submit_vars["nom"] = $nombre;
		$submit_vars["lan"] = $idioma;
		$submit_vars["pre"] = $prefijo;
		$submit_vars["tag_wp"] = $tagsWP;
		$submit_vars["feed_wp"] = $feedWP;
		$submit_vars["feed_max"] = $feedMax;
		$submit_vars["max_total"] = $maxTotal;
		$submit_vars["frec_rss"] = $frecuenciaRevision;
		$submit_vars["idioma_spn"] = $idiomaSpinner;
		$snoopy->httpmethod = "POST";
		$snoopy->submit($url,$submit_vars);
	
		echo $snoopy->results;
		//if(trim($snoopy->results) == "ok")
		//{
		//}

}
catch(Exception $e)
{
	echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	header("Location:../dominios/index.php?error=true&flash=Se ha producido una excepcion: Error:" . $e->getMessage());
}
}

if(isset($_GET['ser']) and (isset($_GET['dom'])))
{	
	enviawpconfautoblog($id,$ser);
}	
	
	
?>