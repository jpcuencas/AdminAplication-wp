<?php

	include_once("../libs/mandarCorreoSwift.php");
	include_once("../libs/snoopy.class.php");
	include_once("../libs/mandarMail.class.php");

	if(isset($_GET['dom']))
	{
		$id=$_GET['dom'];
	}
	if(isset($_GET['ser']))
	{	
		$ser=$_GET['ser'];
	}
function configurarDominio($id,$ser)
{
try
{
		include("../libs/conn.php");
		
		$query = "SELECT ID,nombre FROM dominio WHERE ID = '" . $id . "'";
			$result = $mysqli->query($query);
			$row=$result->fetch_array(MYSQLI_ASSOC);
			$dominio=$row["nombre"];

		
		$query1 = "SELECT ID,ip FROM servidor WHERE ID = '" . $ser . "'";
				$result1 = $mysqli->query($query1);
				$row1=$result1->fetch_array(MYSQLI_ASSOC);
		
		$ip=$row1["ip"];
		$url = "http://" . $ip ."/admin/creacion.php"; 
		
		$snoopy = new Snoopy;
		$submit_vars["txtnomdominio"] = $dominio;
		$snoopy->httpmethod = "POST";
		$snoopy->submit($url,$submit_vars);
		
	//echo $snoopy->results;
		
		if(trim($snoopy->results) == "ok")
		{
			$sql= "UPDATE  `dominio` SET 
			 `estado` =  'Configurado'
			WHERE  `ID` = $id ;";

			 mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli)); 
			
			$contenido_html =  "<p>El dominio <em><strong>$dominio</strong></em> ha sido instalado </p>";
			
			$result->free();
			$result1->free();
			$mysqli->close();
			//mandar_mail("Servidor " . $nombre . " Instaldo",$contenido_html,"tech@fivedoorsnetwork.com","tech@fivedoorsnetwork.com","");
			/*		
			$email = new email();
			if ($email->enviar('becainfor@fivedoorsnetwork.es', 'Becainfor', 'Servidor Instalado',  $contenido_html))
			   echo 'Mensaje enviado';
			else
			{
			   echo 'El mensaje no se pudo enviar ' . $email->ErrorInfo;
			   header("Location:index.php?error=false&flash=Se ha instalado correctamente el mensaje no se ha enviado por: " . $email->ErrorInfo);
			}
			*/
			//header("Location:index.php?error=false&flash=Se ha instalado correctamente a las ".date("H:i:s"));
			
		}
		else
		{
			$error=true;
			header("Location:index.php?error=true&flash=Se ha producido un error");
		}

	
}
catch(Exception $e)
{
	//echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	$error=true;
	header("Location:index.php?error=true&flash=Se ha producido una excepcion: Error:" . $e->getMessage());
}
}

if((isset($_GET['ser'])) and (isset($_GET['dom'])))
{
	configurarDominio($id,$ser);
}
?>