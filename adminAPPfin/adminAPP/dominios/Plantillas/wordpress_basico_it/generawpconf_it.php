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
 * Il file base di configurazione di WordPress.
 *
 * Questo file definisce le seguenti configurazioni: impostazioni MySQL,
 * Prefisso Tabella, Chiavi Segrete, Lingua di WordPress e ABSPATH.
 * E  possibile trovare ultetriori informazioni visitando la pagina: del
 * Codex {@link http://codex.wordpress.org/Editing_wp-config.php
 * Editing wp-config.php}. E  possibile ottenere le impostazioni per
 * MySQL dal proprio fornitore di hosting.
 *
 * Questo file viene utilizzato, durante l installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via
 * web,è anche possibile copiare questo file in wp-config.php e
 * rimepire i valori corretti.
 *
 * @package WordPress
 */

// ** Impostazioni MySQL - E? possibile ottenere questoe informazioni
// ** dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define(\'DB_NAME\', \'' . $bd . '\');

/** Nome utente del database MySQL */
define(\'DB_USER\', \'' . $sqluser . '\');

/** Password del database MySQL */
define(\'DB_PASSWORD\', \'' . $sqlpass . '\');

/** Hostname MySQL  */
define(\'DB_HOST\', \'localhost\');

/** Charset del Database da utilizare nella creazione delle tabelle. */
define(\'DB_CHARSET\', \'utf8\');

/** Il tipo di Collazione del Database. Da non modificare se non si ha
idea di cosa sia. */
define(\'DB_COLLATE\', \'\');

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * E possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 * E possibile cambiare queste chiavi in qualsiasi momento, per invalidare tuttii cookie esistenti. Ciò forzerà tutti gli utenti ad effettuare nuovamente il login.
 *
 * @since 2.6.0
 */
define(\'AUTH_KEY\',         \'put yoccur uniqgue phrase here\');
define(\'SECURE_AUTH_KEY\',  \'put youccr unique phrase here\');
define(\'LOGGED_IN_KEY\',    \'put your uniqcvccue phrase here\');
define(\'NONCE_KEY\',        \'put your unique phrase here\');
define(\'AUTH_SALT\',        \'put your unicccque phrasecv here\');
define(\'SECURE_AUTH_SALT\', \'put your unique phrase here\');
define(\'LOGGED_IN_SALT\',   \'put yourcc unique phrase here\');
define(\'NONCE_SALT\',       \'put your unccique phrase here\');

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress .
 *
 * E  possibile avere installazioni multiple su di un unico database if you give each a unique
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix  = \'hj_\';

/**
 * Lingua di Localizzazione di WordPress, di base Inglese.
 *
 * Modificare questa voce per localizzare WordPress. Occorre che nella cartella
 * wp-content/languages sia installato un file MO corrispondente alla lingua
 * selezionata. Ad esempio, installare de_DE.mo in to wp-content/languages ed
 * impostare WPLANG a de_DE per abilitare il supporto alla lingua tedesca.
 *
 * Tale valore è già impostato per la lingua italiana
 */
define(\'WPLANG\', \'it_IT\');

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi
 * durante lo sviluppo.
 * E fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all interno dei loro ambienti di sviluppo.
 */
define(\'WP_DEBUG\', false);

/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined(\'ABSPATH\') )
	define(\'ABSPATH\', dirname(__FILE__) . \'/\');

/** Imposta lle variabili di WordPress ed include i file. */
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
			$sql= "UPDATE  `hj_options` SET 
			`option_value` =  '{$site}'
			WHERE  `option_name` ='siteurl';";
			
			mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));	
			
			$sql1= "UPDATE  `hj_options` SET 
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