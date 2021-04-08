<?php
include_once("../libsSmarty/Smarty.class.php");
include_once("../libs/classplantilla.php");
include_once("../libs/subirFichero.php");
include_once("../libs/subirFtp.php");

include_once("../libs/variostpl.php");

	if(isset($_GET['dom']))
	{
		$id=$_GET['dom'];
	}
	if(isset($_GET['ser']))
	{	
		$ser=$_GET['ser'];
	}
	
function usarSmarty($id,$ser)
{	
try
{
		include("conn.php");
		
		$query = "SELECT ID,nombre,valores,idioma,id_plantilla,title,keywords,descripcion FROM dominio WHERE ID = '" . $id . "'";
		$result = $mysqli->query($query);
		$row=$result->fetch_array(MYSQLI_ASSOC);
		$valores=$row["valores"];
		$arr=json_decode($valores, true);
		$nombre=$row["nombre"];

		$arr['title']=$row["title"];
		$arr['keywords']=$row["keywords"];
		$arr['descripcion']=$row["descripcion"];
		$idioma=$row["idioma"];
		$idplantilla=$row["id_plantilla"];
			
		$query1 = "SELECT ID,ip FROM servidor WHERE ID = '" . $ser . "'";
		$result1 = $mysqli->query($query1);
		$row1=$result1->fetch_array(MYSQLI_ASSOC);
	
		$host=$row1["ip"];
		
		$query2 = "SELECT ID,nombre FROM plantilla WHERE ID = '" . $idplantilla . "'";
		$result2 = $mysqli->query($query2);
		$row2=$result2->fetch_array(MYSQLI_ASSOC);
	
		$plantilla=$row2["nombre"];
		$mysqli->close();
		if(file_exists("../dominios/Plantillas/" . $plantilla . "/index.tpl"))
		{
			
			if(file_exists("../dominios/Plantillas/" . $plantilla . "/index.php"))
			{
				unlink("../dominios/Plantillas/" . $plantilla . "/index.php");
			}
			$Contenido=new Plantilla("index","../dominios/Plantillas/" . $plantilla);
			$Contenido->asigna_variables($arr);
			 
			//Genera el contenido de la entrada a traves de la plantilla
			$ContenidoString = $Contenido->muestra();
			 $fichero= "../dominios/Plantillas/" . $plantilla . "/index.php";
			 
				$DescriptorFichero = fopen($fichero,"w");   
				fputs($DescriptorFichero,$ContenidoString);
				fclose($DescriptorFichero);
			if(file_exists("../dominios/Plantillas/" . $plantilla . "/index.php"))
			{
				$carpeta="$nombre";
				$nombre_fichero=$carpeta . "/index.php";
				
				include("../libs/conn.php");
				$query3 = "SELECT servidor_ftp,usuario_ftp,contrasenya_ftp FROM servidor WHERE ID = '" . $ser . "'";
					$result3 = $mysqli->query($query3);
					$row3=$result3->fetch_array(MYSQLI_ASSOC);
				
					$ftp=$row3["servidor_ftp"];
					$ftp_user=$row3["usuario_ftp"];
					$ftp_passwd=$row3["contrasenya_ftp"];
				$id_conexion = conectarFTP($ftp,$ftp_user, $ftp_passwd);
				
				 subirImagen($id_conexion ,$fichero,$nombre_fichero);
				 desconectarFTP($id_conexion);
				 
				$url="http://".$host."/admin/permisosFichero.php?nom={$nombre_fichero}";
				echo file_get_contents_curl($url);
				$mysqli->close();
				if(file_exists("../dominios/Plantillas/" . $plantilla . "/index.php"))
				{
					unlink("../dominios/Plantillas/" . $plantilla . "/index.php");
				}
				
				echo comprobartpl($id,$ser,$plantilla,$carpeta,$ftp,$ftp_user,$ftp_passwd,$host);
				
				//header("Location:../dominios/index.php?error=false&flash=Subida plantilla correctamente");
			}
			else
			{
				$error=true;
				header("Location:../dominios/index.php?error=true&flash=No existe el fichero .php");
			}
		}
		else
		{
			$error=true;
			header("Location:../dominios/index.php?error=true&flash=No existe el fichero .tpl");
		}
	
}
catch(Exception $e)
{
	echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	$error=true;
	header("Location:../dominios/index.php?error=true&flash=Se ha producido una excepcion: Error:" . $e->getMessage());
}
}
if((isset($_GET['ser'])) and (isset($_GET['dom'])))
{
	usarSmarty($id,$ser);
}
?>