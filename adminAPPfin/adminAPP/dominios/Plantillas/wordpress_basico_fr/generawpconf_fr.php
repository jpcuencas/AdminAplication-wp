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
	$carpeta="../../../../" . $nombre;
	
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
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d installation. Vous n avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en wp-config.php et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define(\'DB_NAME\', \'' . $bd . '\');

/** Utilisateur de la base de données MySQL. */
define(\'DB_USER\', \'' . $sqluser . '\');

/** Mot de passe de la base de données MySQL. */
define(\'DB_PASSWORD\', \'' . $sqlpass . '\');

/** Adresse de l hébergement MySQL. */
define(\'DB_HOST\', \'localhost\');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define(\'DB_CHARSET\', \'utf8\');

/** Type de collation de la base de données. 
  * N y touchez que si vous savez ce que vous faites. 
  */
define(\'DB_COLLATE\', \'\');

/**#@+
 * Clefs uniques d authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n importe quel moment, afin d invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define(\'AUTH_KEY\',         \'put yourdfg unique phrase here\'); 
define(\'SECURE_AUTH_KEY\',  \'put youdfgr unique phradfgse here\'); 
define(\'LOGGED_IN_KEY\',    \'put yodfgur sdfnique phrase here\'); 
define(\'NONCE_KEY\',        \'put your unique pdfghrase hdfgere\'); 
define(\'AUTH_SALT\',        \'put your uniqdfgue phrase here\'); 
define(\'SECURE_AUTH_SALT\', \'put ydfgour udfgfgniquefd phrdfgase here\'); 
define(\'LOGGED_IN_SALT\',   \'put your uniqudfde phrasfe here\'); 
define(\'NONCE_SALT\',       \'put ydfgour gunique phrasfe here\'); 
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = \'yu_\';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l option ci-dessous à fr_FR.
 */
define(\'WPLANG\', \'fr_FR\');

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à true, vous activez l affichage des
 * notifications d erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define(\'WP_DEBUG\', false); 

/* C est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined(\'ABSPATH\') )
	define(\'ABSPATH\', dirname(__FILE__) . \'/\');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . \'wp-settings.php\');
';
		  fputs($ar,  $cadena);
		  fclose($ar);
		  
			$mysqli = new mysqli("localhost", "$usuario", "$pass", "$bd");

	/* verificar la conexion */
	if (mysqli_connect_errno()) 
	{
		printf("Conexion fallida: %s\n", mysqli_connect_error());
		exit();
	}
		$site='http://localhost/' . $nombre;
		//$home='';
		if(isset($site))
		{
			$sql= "UPDATE  `yu_options` SET 
			`option_value` =  '{$site}'
			WHERE  `option_name` ='siteurl';";
			
			mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));	
			
			$sql1= "UPDATE  `yu_options` SET 
			`option_value` =  '{$site}'
			WHERE  `option_name` ='home';";
			
			mysqli_query($mysqli,$sql1) or die(mysqli_error($mysqli)); 
			echo "Todo correcto";
			header("Location:../../index.php?error=false&flash=Configurado correctamente");
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