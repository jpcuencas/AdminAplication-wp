<?php
include_once("redireccion.php");
	if (isset($_POST['bd'])){
		$BD=$_POST['bd']; 
	}
	if (isset($_POST['script'])){
		$script=$_POST['script'];
	}
try
{	
	include("conn.php");
	$patron="/[^a-zA-Z0-9]/";
	$sustitucion='_';
	$baseDatos=preg_replace($patron, $sustitucion, $BD);

	if(!($mysqli->query("Create database if not exists " . $baseDatos)))
	{
	   "<br/>Fallo creando la base de datos: ".$mysqli->connect_errno();
		die();
	}
	else
	{
		$mysqli = new mysqli("localhost", $sqluser, $sqlpass, $baseDatos);

		/* verificar la conexion */
		if (mysqli_connect_errno()) 
		{
			printf("Conexion fallida: %s\n", mysqli_connect_error());
			echo "Error de conexion " . $baseDatos;
			exit();
		}
		else
		{
			$rutascript= "/var/www/" . $BD . "/" . $script;
			if(!(file_exists($script)))
			{
				echo "<br/>no existe el script";
			}
			else
			{
				system("mysql -u $sqluser -p$sqlpass $baseDatos < $rutascript");

				//echo "<br/>script ejecutado";
				unlink($rutascript);
				//echo "<br/>script borrado";
				$mysqli->select_db($baseDatos);
				if ($result = mysqli_query($mysqli, "SELECT DATABASE()")) 
				{
					$row = mysqli_fetch_row($result);
					if($row[0] != $baseDatos)
					{
						echo "error no hay base de datos";
					}
					mysqli_free_result($result);
				}
			}
		}	
	}
}
catch(Exception $e)
{
	echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
}
//terminar el hilo de conexion a base de datos
//if(is_object($mysqli) && get_class($mysqli) == 'mysqli')
//{
/*
	if($mysqli_connection_thread = mysqli_thread_id($mysqli))
	{
		$mysqli->kill($mysqli_connection_thread);
	}
*/
$mysqli->close();
//}
?>