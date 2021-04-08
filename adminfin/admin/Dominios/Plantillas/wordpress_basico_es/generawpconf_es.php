<?php
	if(isset($_GET['dom']))
	{
		$id=$_GET['dom'];
	}
	if(isset($_GET['ser']))
	{	
		$ser=$_GET['ser'];
	}

try
{	
	if((isset($_GET['ser'])) and (isset($_GET['dom'])))
	{
			include("../../../libs/conn.php");
			
			$query = "SELECT nombre,usuario_wp,contrasenya_wp,idioma FROM dominio WHERE ID = '" . $id . "'";
			$result = $mysqli->query($query);
			$row=$result->fetch_array(MYSQLI_ASSOC);
			$nombre=$row["nombre"];
			$usuario=$row["usuario_wp"];
			$pass=$row["contrasenya_wp"];
			$idioma=$row["idioma"];
			
		$query1 = "SELECT ip FROM servidor WHERE ID = '" . $ser . "'";
		$result1 = $mysqli->query($query1);
		$row1=$result1->fetch_array(MYSQLI_ASSOC);
	
		$host=$row1["ip"];
		$mysqli->close();
	}
	$patron="/[^a-zA-Z0-9]/";
	$sustitucion='_';
	$bd=preg_replace($patron, $sustitucion, $nombre);
	
	$fichero="wp-config.php";
	$carpeta="/var/www/" . $nombre;
	echo $carpeta;
  if(file_exists($carpeta . "/" . $fichero))
  {
	unlink($carpeta . "/" . $fichero);
  }
		$file=trim($carpeta . "/" . $fichero);
if(file_exists($carpeta))
  {
	  $ar=fopen($carpeta . "/" . $fichero,"c+") or die("Problemas en la creacion\n");
	  $cadena='<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don t have to use the web site, you can just copy this file
 * to wp-config.php and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define(\'DB_NAME\', \'' . $bd . '\');

/** Tu nombre de usuario de MySQL */
define(\'DB_USER\', \'' . $sqluser . '\');

/** Tu contraseña de MySQL */
define(\'DB_PASSWORD\', \'' . $sqlpass . '\');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define(\'DB_HOST\', \'localhost\');

/** Codificación de caracteres para la base de datos. */
define(\'DB_CHARSET\', \'utf8\');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define(\'DB_COLLATE\', \'\');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define(\'AUTH_KEY\', \'pon aquí qwqtu frase aleatoria\'); // Cambia esto por tu frase aleatoria.
define(\'SECURE_AUTH_KEY\', \'pon aquí tu frewewse aleatoria\'); // Cambia esto por tu frase aleatoria.
define(\'LOGGED_IN_KEY\', \'pon aqdsfwuí tu frase awleatoria\'); // Cambia esto por tu frase aleatoria.
define(\'NONCE_KEY\', \'pon eeaquí tu frase aleqatoria\'); // Cambia esto por tu frase aleatoria.
define(\'AUTH_SALT\', \'pon aquí teu frase aelweatoria\'); // Cambia esto por tu frase aleatoria.
define(\'SECURE_AUTH_SALT\', \'pon aqeeuí tu wfrase aleatoria\'); // Cambia esto por tu frase aleatoria.
define(\'LOGGED_IN_SALT\', \'pon aquí tu frewease alewwatoria\'); // Cambia esto por tu frase aleatoria.
define(\'NONCE_SALT\', \'pon aquí tu frase awleatoria\'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = \'we_\';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como ca_ES
 * para traducir WordPress al catalán.
 */
define(\'WPLANG\', \'es_ES\');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define(\'WP_DEBUG\', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined(\'ABSPATH\') )
	define(\'ABSPATH\', dirname(__FILE__) . \'/\');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . \'wp-settings.php\');

';
		  fputs($ar,  $cadena);
		  fclose($ar);
		  
	$mysqli = new mysqli("localhost", "$usuario", "$pass", "$bd");

	/* verificar la conexión */
	if (mysqli_connect_errno()) 
	{
		printf("Conexión fallida: %s\n", mysqli_connect_error());
		exit();
	}
		$site='http://localhost/' . $nombre;
		//$home='';
		if(isset($site))
		{
			$sql= "UPDATE  `we_options` SET 
			`option_value` =  '{$site}'
			WHERE  `option_name` ='siteurl';";
			
			mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));	
			
			$sql1= "UPDATE  `we_options` SET 
			`option_value` =  '{$site}'
			WHERE  `option_name` ='home';";
			
			mysqli_query($mysqli,$sql1) or die(mysqli_error($mysqli)); 
		}
		else
		{
			echo "Error: parametro no existe";
			header("Location:../../index.php?error=true&flash=Se ha producido un error parametro incorrecto");
		}
}
else
{
	echo "El directorio no existe";
			header("Location:../../index.php?error=true&flash=Se ha producido un error el directorio no existe");
}
	  }
	  catch (Exception $e)
	  {
		echo "<br/>-------------\n<br/>Hubo error al generar los datos. " .  $e->getMessage() . "<br/>\n------------";
	  }

  ?>