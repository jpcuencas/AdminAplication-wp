<?php
	include_once('../libs/subirFichero.php');
	include_once('../libs/crearBD.php');
	include_once("../libs/snoopy.class.php");
function enviarBD($id,$ser)
{
try
{
	
	if(isset($_GET['dom']))
	{
		$id=$_GET['dom'];
	}
	if(isset($_GET['ser']))
	{	
		$ser=$_GET['ser'];
	}

		include("../libs/conn.php");
		
		$query = "SELECT nombre,id_plantilla FROM dominio WHERE ID = '" . $id . "'";

		$result = $mysqli->query($query);
		$row=$result->fetch_array(MYSQLI_ASSOC);
		$idplantilla=$row["id_plantilla"];
		$carpeta=$row["nombre"];
			
		$query1 = "SELECT ip FROM servidor WHERE ID = '" . $ser . "'";

		$result1 = $mysqli->query($query1);
		$row1=$result1->fetch_array(MYSQLI_ASSOC);
	
		$host=$row1["ip"];

		$query2 = "SELECT nombre FROM plantilla WHERE ID = '" . $idplantilla . "'";

		$result2 = $mysqli->query($query2);
		$row2=$result2->fetch_array(MYSQLI_ASSOC);
	
		$plantilla=$row2["nombre"];
		
		$result->free();
		$result1->free();
		$result2->free();
		$mysqli->close();	
		
		$nombre_fichero="esquema.sql";
		$fichero="./Plantillas/" . $plantilla . "/esquema.sql";
		if(!file_exists($fichero))
		{
			$error=true;
			header("Location:index.php?error=true&flash=Se ha producido un error el fichero de base de datos no existe");
		}
		else
		{
			subirFicheroHttp($host,$carpeta,$nombre_fichero,$fichero);
			$script="../" . $carpeta . "/" . $nombre_fichero;
			
			//nombre BD --> carpeta
			if(crearBaseDatos($host,$carpeta,$script) != "")
			{
				$error=true;
				header("Location:index.php?error=true&flash=Se ha producido un error al crear la base de datos");
			}
			//header("Location:index.php?error=false&flash=Se ha creado correctamente la base de datos a las ".date("H:i:s"));
		}
				
}
catch(Exception $e)
{
	//echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	$error=true;
	header("Location:index.php?error=true&flash=Se ha producido una excepcion: Error");
}
}
if(isset($_GET['ser']) and isset($_GET['dom']))
{
	enviarBD($id,$ser);
}
	
?>	