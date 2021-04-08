<?php
	include_once('../libs/subirFichero.php');
	include_once('../libs/unzip.php');	
	include_once("../libs/snoopy.class.php");
	
	include_once('../libs/subirFtp.php');
	
	if(isset($_GET['dom']))
	{
		$id=$_GET['dom'];
	}
	if(isset($_GET['ser']))
	{	
		$ser=$_GET['ser'];
	}
function enviarFicheros($id,$ser)
{
try
{
	include("../libs/conn.php");
	
	$query = "SELECT ID,nombre,id_plantilla FROM dominio WHERE ID = '" . $id . "'";
	$result = $mysqli->query($query);
	$row=$result->fetch_array(MYSQLI_ASSOC);
	$idplantilla=$row["id_plantilla"];
	$carpeta=$row["nombre"];
		
	$query1 = "SELECT ID,ip FROM servidor WHERE ID = '" . $ser . "'";
	$result1 = $mysqli->query($query1);
	$row1=$result1->fetch_array(MYSQLI_ASSOC);

	$host=$row1["ip"];
	
	$query2 = "SELECT ID,nombre FROM plantilla WHERE ID = '" . $idplantilla . "'";

	$result2 = $mysqli->query($query2);
	$row2=$result2->fetch_array(MYSQLI_ASSOC);

	$plantilla=$row2["nombre"];

	$archivo="/ficheros.zip";
	$nombre_fichero=$carpeta . "/ficheros.zip";
	$fichero="Plantillas/" . $plantilla . "/ficheros.zip";
	if(file_exists($fichero))
	{
		include("../libs/conn.php");
		$query3 = "SELECT ID,servidor_ftp,usuario_ftp,contrasenya_ftp FROM servidor WHERE ID = '" . $ser . "'";
		$result3 = $mysqli->query($query3);
		$row3=$result3->fetch_array(MYSQLI_ASSOC);
	
		$ftp=$row3["servidor_ftp"];
		$ftp_user=$row3["usuario_ftp"];
		$ftp_passwd=$row3["contrasenya_ftp"];
		
		
		 $id_conexion = conectarFTP($ftp,$ftp_user, $ftp_passwd);
		 subirImagen($id_conexion ,$fichero,$nombre_fichero);
		 desconectarFTP($id_conexion); 
		 
		$result->free();
		$result1->free();
		$result2->free();
		$result3->free();
		$mysqli->close();
	}
	else
	{
		$error=true;
		//echo "<br/>El fichero no existe";
		header("Location:index.php?error=true&flash=Se ha producido un error el fichero no existe");
	}	
	$carpeta1= "/var/www/" . $carpeta;

	echo enviarzip($host,$carpeta1,$archivo);
	if(file_exists("/var/www/{$carpeta}"))
	{
		$is_empty = (bool) (count(scandir("/var/www/{$carpeta}")) == 2);
	}
	else
		$is_empty = false;
	if($is_empty)
	{
		$error=true;
		header("Location:index.php?error=true&flash=Se ha producido un error en la descompresion del fichero");
	}
	else
	{
		//$error=true;
		$url="http://".$host."/admin/permisosFichero.php?nom={$carpeta}/*";
		file_get_contents_curl($url);

		/*****************************/
		
		header("Location:index.php?error=false&flash=Se ha enviado correctamente");
	
		/*****************************/
	}
}
catch(Exception $e)
{
	//echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	$error=true;
	header("Location:../dominios/index.php?error=true&flash=Se ha producido una excepcion: Error:" . $e->getMessage());
}
}
if((isset($_GET['ser'])) and (isset($_GET['dom'])))
{
	enviarFicheros($id,$ser);
}
?>
