<?php
include_once("../libsSmarty/Smarty.class.php");
include_once("../libs/classplantilla.php");
include_once("../libs/subirFichero.php");
include_once("../libs/subirFtp.php");

function filtrar($directorio,$extension)
{
	$dir=opendir($directorio); 
	while($arch=readdir($dir))
	{
		$path_info = pathinfo($arch);
		if(isset($path_info['extension']))
		{	
			if($path_info['extension']=='tpl')
				$ars[]=$path_info['filename'];
		}
	}
closedir($dir);
if(isset($ars))
	return $ars;
else
	return null;
}


function comprobartpl($id,$ser,$plantilla,$carpeta,$ftp,$ftp_user, $ftp_passwd,$host)
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
	$mysqli->close();
$ficherosTPL=filtrar("../dominios/Plantillas/" . $plantilla,'tpl');

foreach($ficherosTPL as $file)
{
if($file!='index')
{
	$dir=$carpeta . "/" . $file;
			$url="http://".$host."/admin/crearCarpeta.php?nom={$dir}";
			echo file_get_contents_curl($url);


		if(file_exists("../dominios/Plantillas/" . $plantilla . "/" . $file . ".php"))
		{
			unlink("../dominios/Plantillas/" . $plantilla . "/" . $file . ".php");
		}
		$Contenido=new Plantilla($file,"../dominios/Plantillas/" . $plantilla);
		$Contenido->asigna_variables($arr);
		 
		//Genera el contenido de la entrada a traves de la plantilla
		$ContenidoString = $Contenido->muestra();
		 $fichero= "../dominios/Plantillas/" . $plantilla . "/" . $file . ".php";
		 
			$DescriptorFichero = fopen($fichero,"w");   
			fputs($DescriptorFichero,$ContenidoString);
			fclose($DescriptorFichero);
		if(file_exists("../dominios/Plantillas/" . $plantilla . "/" . $file . ".php"))
		{
			$nombre_fichero=$dir . "/index.php";
	
			$id_conexion = conectarFTP($ftp,$ftp_user, $ftp_passwd);
			
			 subirImagen($id_conexion ,$fichero,$nombre_fichero);
			 desconectarFTP($id_conexion);
			 
			$url="http://".$host."/admin/permisosFichero.php?nom={$nombre_fichero}";
			echo file_get_contents_curl($url);
			
			if(file_exists("../dominios/Plantillas/" . $plantilla . "/" . $file . ".php"))
			{
				unlink("../dominios/Plantillas/" . $plantilla . "/" . $file . ".php");
			}
			
		}
		else
		{
			$error=true;
			header("Location:../dominios/index.php?error=true&flash=No existe el fichero .php");
		}
}
}	
}
catch(Exception $e)
{
	echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	$error=true;
	header("Location:../dominios/index.php?error=true&flash=Se ha producido una excepcion: Error:" . $e->getMessage());
}
}