<?php
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
	unset($_GET['ser']);
	unset($_GET['dom']);
	
	include_once("configurar.php");
	include_once("enviarBD.php");
	include_once("enviarFicheros.php");
	include_once("../libs/usarSmarty.php");
	include_once("../libs/enviawpconf.php");
	include_once("../libs/enviawpconfautoblog.php");
	if((isset($ser)) and (isset($id)))
	{
	
		include("../libs/conn.php");
		
		$query = "SELECT ID,nombre,id_tipo,id_plantilla,idioma FROM dominio WHERE ID = '" . $id . "'";
		$result = $mysqli->query($query);
		$row=$result->fetch_array(MYSQLI_ASSOC);

		$idplantilla=$row["id_plantilla"];
		$idtipo=$row["id_tipo"];
		$idioma=$row["idioma"];
		$carpeta=$row["nombre"];
		
		$query1 = "SELECT ID,nombre FROM plantilla WHERE ID = '" . $idplantilla . "'";
		$result1 = $mysqli->query($query1);
		$row1=$result1->fetch_array(MYSQLI_ASSOC);
		
		$plantilla=$row1["nombre"];

		$query2 = "SELECT ID,nombre FROM tipopagina WHERE ID = '" . $idtipo . "'";
		$result2 = $mysqli->query($query2);
		$row2=$result2->fetch_array(MYSQLI_ASSOC);
	
		$tipo=$row2["nombre"];
		
		$result->free();
		$result1->free();
		$result2->free();
		$mysqli->close();	
		$error=false;
		/**
		 * proceso de instalacion
		**/
		//instalar carpeta
		if(!file_exists("/var/www/" . $carpeta))
		{
			configurarDominio($id,$ser);
		}
		//instalar base de datos
		if(file_exists("Plantillas/" . $plantilla . "/esquema.sql"))
		{	
			enviarBD($id,$ser);
		}
		
		//enviar ficheros
		if(file_exists("Plantillas/" . $plantilla . "/ficheros.zip"))
		{	
			enviarFicheros($id,$ser);
			
		}
		
		//configurar tpl
		if(file_exists("Plantillas/" . $plantilla . "/index.tpl"))
		{
			usarSmarty($id,$ser);
		}

		if(substr(strtoupper($tipo),0,9) == "WORDPRESS")
		{
			$lan=$idioma;
			//include_once("../libs/copiarCarpeta.php");

			enviawpconf($id,$ser,$lan);
		}
		if(substr(strtoupper($tipo),0,17) == "WORDPRESSAUTOBLOG")
		{
			enviawpconfautoblog($id,$ser);
		}
		
		if(!$error)
		{
			include("../libs/conn.php");
			$sql= "UPDATE  `dominio` SET 
			 `estado` =  'Instalado'
			WHERE  `ID` = $id ;";
			mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli)); 
			$mysqli->close();
			/*****************************/
			
			header("Location:index.php?error=false&flash=Se ha instalado todo correctamente");
		
			/*****************************/
		}
		else
		{
			header("Location:index.php?error=false&flash=Se ha producido un error");
		}
	}
	else
	{
		header("Location:index.php?error=true&flash=Se ha producido un error de parametrizacion");
	}
}
catch(Exception $e)
{
	//echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	header("Location:index.php?error=true&flash=Se ha producido una excepcion: Error");
}
?>