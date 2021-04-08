<?php
include_once("enviarGet.php");
include_once("mandarCorreoSwift.php");
include_once("../libs/mandarMail.class.php");
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

		if((isset($_GET['ser'])) and (isset($_GET['dom'])))
		{
			include("conn.php");
			
			$query = "SELECT nombre,idioma FROM dominio WHERE ID = '" . $id . "'";
			$result = $mysqli->query($query);
			$row=$result->fetch_array(MYSQLI_ASSOC);
			$nombre=$row["nombre"];
			$idioma=$row["idioma"];
				
			$query1 = "SELECT ip FROM servidor WHERE ID = '" . $ser . "'";
			$result1 = $mysqli->query($query1);
			$row1=$result1->fetch_array(MYSQLI_ASSOC);
		
			$host=$row1["ip"];
			// Liberar resultados
			$result1->free();
			$mysqli->close();
		}
		else
		{
			header("Location:../dominios/index.php?error=true&flash=Se ha producido en los parametros");
		}
		$url="http://".$host."/admin/borrarDominio.php?dom={$nombre}";
		file_get_contents_curl($url);
		
	if(file_exists("../../{$nombre}"))
	{
		header("Location:../dominios/index.php?error=false&flash=no se ha borrado");
	}
	else
	{
		include("conn.php");
		$sql= "UPDATE  `dominio` SET 
		 `estado` =  'Pendiente'
		WHERE  `ID` = $id ;";

		 mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli)); 
		 $mysqli->close();
		 
		$contenido_html =  "<p>El dominio <em><strong>$nombre</strong></em> ha sido borrado </p>";


	//mandar_mail("Servidor " . $nombre . "Borrado",$contenido_html,"tech@fivedoorsnetwork.com","tech@fivedoorsnetwork.com","");
		/*		
		$email = new email();
		if ($email->enviar('becainfor@fivedoorsnetwork.es', 'Becainfor', 'Servidor Borrado',  $contenido_html))
		   echo 'Mensaje enviado';
		else
		{
		   echo 'El mensaje no se pudo enviar ' . $email->ErrorInfo;
		   header("Location:index.php?error=false&flash=Se ha borrado correctamente el mensaje no se ha enviado por: " . $email->ErrorInfo);
		}
		*/
		header("Location:../dominios/index.php?error=false&flash=borrado correctamente");
	}
}
catch(Exception $e)
{
	//echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	header("Location:../dominios/index.php?error=true&flash=Se ha producido una excepcion: Error:" . $e->getMessage());
}	
?>