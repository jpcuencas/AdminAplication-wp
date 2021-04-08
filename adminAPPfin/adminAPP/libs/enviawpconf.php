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
	if(isset($_GET['lan']))
	{
		$lan=$_GET['lan'];
	}
function enviawpconf($id,$ser,$lan)
{
try
{
		include("conn.php");
		
		$query = "SELECT ID,nombre,title,keywords,descripcion,id_plantilla,valores,idioma FROM dominio WHERE ID = '" . $id . "'";
		$result = $mysqli->query($query);
		$row=$result->fetch_array(MYSQLI_ASSOC);
		$nombre=$row["nombre"];
		$title=$row["title"];
		$keywords=$row["keywords"];
		$descripcion=$row["descripcion"];
		$idplantilla=$row["id_plantilla"];
		$valores=$row["valores"];
		$arr=json_decode($valores, true);
		$usuario = $arr['usuario_wp'];
		$pass=MD5($arr["contrasenya_wp"]);
		//$prefijoTabla = $arr['prefijo_wp'];
		$titulo = $arr['titulo'];
		$subtitulo = $arr['subtitulo'];
		$idioma=$row["idioma"];
		
		$query = "SELECT ID,id_tipo,prefijo FROM plantilla WHERE ID = '" . $idplantilla . "'";
		$result = $mysqli->query($query);
		$row=$result->fetch_array(MYSQLI_ASSOC);
		$prefijoTabla=$row["prefijo"];
		
		$query1 = "SELECT ID,ip FROM servidor WHERE ID = '" . $ser . "'";
		$result1 = $mysqli->query($query1);
		$row1=$result1->fetch_array(MYSQLI_ASSOC);
	
		$host=$row1["ip"];
		$mysqli->close();
			
		$snoopy = new Snoopy;

		$submit_url = "http://".$host."/admin/generawpconf.php";
		$submit_vars["dom"] = $nombre;
		$submit_vars["lan"] = $lan;
		$submit_vars["us"] = $usuario;
		$submit_vars["pas"] = $pass;
		$submit_vars["prefijo"] =$prefijoTabla;
		$submit_vars["title"] = $title;
		$submit_vars["titulo"] = $titulo;
		$submit_vars["subtitulo"] = $subtitulo;
		$submit_vars["keywords"] = $keywords;
		$submit_vars["descripcion"] = $descripcion;
		$snoopy->submit($submit_url,$submit_vars);
	$valor = $snoopy->results;
	if($valor =="Error")
	{
		$error=true;
		//echo $valor;
		header("Location:../dominios/index.php?error=false&flash=No se ha configurado");
	}
	else
	{

		
		$contenido_html =  "<p>El dominio <em><strong>$nombre</strong></em> ha sido configurado con el siguiente usuario y contraseña: </p>
		<p>usr: " . $arr["usuario_wp"] . "</p><p>pass: " . $arr["contrasenya_wp"] . "</p>";


		//mandar_mail("Servidor " . $nombre . " Configurado",$contenido_html,"tech@fivedoorsnetwork.com","tech@fivedoorsnetwork.com","");
		/*		
		$email = new email();
		if ($email->enviar('becainfor@fivedoorsnetwork.es', 'Becainfor', 'Servidor Configurado',  $contenido_html))
		{
		   echo 'Mensaje enviado';
		}
		else
		{
		   echo 'El mensaje no se pudo enviar ' . $email->ErrorInfo;
		   header("Location:index.php?error=false&flash=Se ha configurado correctamente el mensaje no se ha enviado por: " . $email->ErrorInfo);
		}
		*/
		/*****************************/
		
		header("Location:../dominios/index.php?error=false&flash=Configurado correctamente");
	
		/*****************************/
	}
}
catch(Exception $e)
{
	echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	header("Location:../dominios/index.php?error=true&flash=Se ha producido una excepcion: Error:" . $e->getMessage());
}
}
if((isset($_GET['ser'])) and (isset($_GET['dom'])) and (isset($_GET['lan'])))
{	
	enviawpconf($id,$ser,$lan);
}
?>