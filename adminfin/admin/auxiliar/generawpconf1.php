<?php
	if(isset($_GET['dom']))
	{
		$nombre=$_GET['dom'];
	}
/*	if(isset($_GET['us']))
	{	
		$usuario=$_GET['us'];
	}
	if(isset($_GET['pas']))
	{
		$pass=$_GET['pas'];
	}
*/
	if(isset($_GET['lan']))
	{
		$idioma=$_GET['lan'];
	}
echo "dom=" . $nombre . "<br/>";
echo "lan=" . $idioma . "<br/>";
	
	include_once("conn.php");	
	$patron="/[^a-zA-Z0-9]/";
	$sustitucion='_';
	$bd=preg_replace($patron, $sustitucion, $nombre);
	
	$fichero="wp-config.php";
	$carpeta="/var/www/" . $nombre;
echo "carpeta=" . $carpeta . "<br/>";
  if(file_exists($carpeta . "/" . $fichero))
  {
	unlink($carpeta . "/" . $fichero);
  }
	$file=trim($carpeta . "/" . $fichero);
	if(file_exists($carpeta))
	{
	  $ar=fopen($carpeta . "/" . $fichero,"w+") or die("Problemas en la creacion\n");
	  
	  switch (trim(strtoupper ($idioma))) {
		case "ES_ES":
		$cadena='<?php
/** 
 * Configuracion basica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener mas informacion,
 * visita la pagina del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionar tu proveedor de alojamiento web.
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

/** Codificacion de caracteres para la base de datos. */
define(\'DB_CHARSET\', \'utf8\');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define(\'DB_COLLATE\', \'\');

/**#@+
 * Claves tecnicas de autentificacion.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzar a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define(\'AUTH_KEY\', \'pon aqui qwqtu frase aleatoria\'); // Cambia esto por tu frase aleatoria.
define(\'SECURE_AUTH_KEY\', \'pon aqui tu frewewse aleatoria\'); // Cambia esto por tu frase aleatoria.
define(\'LOGGED_IN_KEY\', \'pon aqdsfwuiu frase awleatoria\'); // Cambia esto por tu frase aleatoria.
define(\'NONCE_KEY\', \'pon eeaqui tu frase aleqatoria\'); // Cambia esto por tu frase aleatoria.
define(\'AUTH_SALT\', \'pon aqui teu frase aelweatoria\'); // Cambia esto por tu frase aleatoria.
define(\'SECURE_AUTH_SALT\', \'pon aqeeui tu wfrase aleatoria\'); // Cambia esto por tu frase aleatoria.
define(\'LOGGED_IN_SALT\', \'pon aqui tu frewease alewwatoria\'); // Cambia esto por tu frase aleatoria.
define(\'NONCE_SALT\', \'pon aqui tu frase awleatoria\'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo numeros, letras y guion bajo.
 */
$table_prefix  = \'we_\';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiandolo a wp-content/languages y define WPLANG como ca_ES
 * para traducir WordPress al catalan.
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

/* Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined(\'ABSPATH\') )
	define(\'ABSPATH\', dirname(__FILE__) . \'/\');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . \'wp-settings.php\');

';
	  	break;
		case "DE_DE":	
	  
	  $cadena='<?php
/**
 * In dieser Datei werden die Grundeinstellungen for WordPress vorgenommen.
 *
 * Zu diesen Einstellungen gehren: MySQL-Zugangsdaten, Tabellenprfix,
 * Secret-Keys, Sprache und ABSPATH. Mehr Informationen zur wp-config.php gibt es auf der {@link http://codex.wordpress.org/Editing_wp-config.php
 * wp-config.php editieren} Seite im Codex. Die Informationen for die MySQL-Datenbank bekommst du von deinem Webhoster.
 *
 * Diese Datei wird von der wp-config.php-Erzeugungsroutine verwendet. Sie wird ausgefhrt, wenn noch keine wp-config.php (aber eine wp-config-sample.php) vorhanden ist,
 * und die Installationsroutine (/wp-admin/install.php) aufgerufen wird.
 * Man kann aber auch direkt in dieser Datei alle Eingaben vornehmen und sie von wp-config-sample.php in wp-config.php umbenennen und die Installation starten.
 *
 * @package WordPress
 */

/**  MySQL Einstellungen - diese Angaben bekommst du von deinem Webhoster. */
/**  Ersetze database_name_here mit dem Namen der Datenbank, die du verwenden machtest. */
define(\'DB_NAME\', \'' . $bd . '\');

/** Ersetze username_here mit deinem MySQL-Datenbank-Benutzernamen */
define(\'DB_USER\', \'' . $sqluser . '\');

/** Ersetze password_here mit deinem MySQL-Passwort */
define(\'DB_PASSWORD\', \'' . $sqlpass . '\');

/** Ersetze localhost mit der MySQL-Serveradresse */
define(\'DB_HOST\', \'localhost\');

/** Der Datenbankzeichensatz der beim Erstellen der Datenbanktabellen verwendet werden soll */
define(\'DB_CHARSET\', \'utf8\');

/** Der collate type sollte nicht gendert werden */
define(\'DB_COLLATE\', \'\');

/**#@+
 * Sicherheitsschlssel
 *
 * ndere jeden KEY in eine beliebige, mglichst einzigartige Phrase. 
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service} kannst du dir alle KEYS generieren lassen.
 * Bitte trage for jeden KEY eine eigene Phrase ein. Du kannst die Schlssel jederzeit wieder ndern, alle angemeldeten Benutzer massen sich danach erneut anmelden.
 *
 * @seit 2.6.0
 */
define(\'AUTH_KEY\',         \'put ysour unique phrase here\');
define(\'SECURE_AUTH_KEY\',  \'put your uniqsue phasrase here\');
define(\'LOGGED_IN_KEY\',    \'put ysour unique phrase here\');
define(\'NONCE_KEY\',        \'put your cv bvxxxzunique phrase here\');
define(\'AUTH_SALT\',        \'put your xunique phrase here\');
define(\'SECURE_AUTH_SALT\', \'put your unixque phrase sdfdhere\');
define(\'LOGGED_IN_SALT\',   \'put your unixque phrase here\');
define(\'NONCE_SALT\',       \'put your sunique pshrase here\');

/**#@-*/

/**
 * WordPress Datenbanktabellen-Prefix
 *
 *  Wenn du verschiedene Prefixe benutzt, kannst du innerhalb einer Datenbank
 *  verschiedene WordPress-Installationen betreiben. Nur Zahlen, Buchstaben und Unterstriche bitte!
 */
$table_prefix  = \'df_\';

/**
 * WordPress Sprachdatei
 *
 * Hier kannst du einstellen, welche Sprachdatei benutzt werden soll. Die entsprechende
 * Sprachdatei muss im Ordner wp-content/languages vorhanden sein, beispielsweise de_DE.mo
 * Wenn du nichts eintrigst, wird Englisch genommen.
 */
define(\'WPLANG\', \'de_DE\');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define(\'WP_DEBUG\', false);

/* That s all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined(\'ABSPATH\') )
	define(\'ABSPATH\', dirname(__FILE__) . \'/\');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . \'wp-settings.php\');
';
	  	break;
		case "EN_EN":	
		$cadena='<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don t have to use the web site, you can just copy this file
 * to wp-config.php and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define(\'DB_NAME\', \'' . $bd . '\');

/** MySQL database username */
define(\'DB_USER\', \'' . $sqluser . '\');

/** MySQL database password */
define(\'DB_PASSWORD\', \'' . $sqlpass . '\');

/** MySQL hostname */
define(\'DB_HOST\', \'localhost\');

/** Database Charset to use in creating database tables. */
define(\'DB_CHARSET\', \'utf8\');

/** The Database Collate type. Don t change this if in doubt. */
define(\'DB_COLLATE\', \' \');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define(\'AUTH_KEY\',         \'put yodur unsdfique phrase hered\');
define(\'SECURE_AUTH_KEY\',  \'putdd your usaaaxniqudfs phrase here\');
define(\'LOGGED_IN_KEY\',    \'put your unidque phraddsdssse here\');
define(\'NONCE_KEY\',        \'put your uniddque phrase here\');
define(\'AUTH_SALT\',        \'put ydddour xxxbguniqueddddphraseddd here\');
define(\'SECURE_AUTH_SALT\', \'put your unique pddssdfhrase here\');
define(\'LOGGED_IN_SALT\',   \'put youdr udddnique dddphrase hddere\');
define(\'NONCE_SALT\',       \'put yodur uniqude phrade here\');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = \'jk_\';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to de_DE to enable German
 * language support.
 */
define(\'WPLANG\', \'\');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define(\'WP_DEBUG\', false);

/* That s all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined(\'ABSPATH\') )
	define(\'ABSPATH\', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . \'wp-settings.php\');

';
			  	break;
		case "FR_FR":	
		$cadena='<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les rages de configuration suivants : rages MySQL,
 * prefixe de table, clefs secrs, langue utilis et ABSPATH.
 * Vous pouvez en savoir plus leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C est votre hbergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilis par le script de creation de wp-config.php pendant
 * le processus d installation. Vous n avez pas utiliser le site web, vous
 * pouvez simplement renommer ce fichier en wp-config.php et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Reglages MySQL - Votre habergeur doit vous fournir ces informations. ** //
/** Nom de la base de donnes de WordPress. */
define(\'DB_NAME\', \'' . $bd . '\');

/** Utilisateur de la base de donnes MySQL. */
define(\'DB_USER\', \'' . $sqluser . '\');

/** Mot de passe de la base de donnes MySQL. */
define(\'DB_PASSWORD\', \'' . $sqlpass . '\');

/** Adresse de l habergement MySQL. */
define(\'DB_HOST\', \'localhost\');

/** Jeu de caracteres utiliser par la base de donnes lors de la creation des tables. */
define(\'DB_CHARSET\', \'utf8\');

/** Type de collation de la base de donnes. 
  * N y touchez que si vous savez ce que vous faites. 
  */
define(\'DB_COLLATE\', \'\');

/**#@+
 * Clefs uniques d authentification et salage.
 *
 * Remplacez les valeurs par defaut par des phrases uniques !
 * Vous pouvez genarer des phrases aleatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrates de WordPress.org}.
 * Vous pouvez modifier ces phrases n importe quel moment, afin d invalider tous les cookies existants.
 * Cela forcera egalement tous les utilisateurs se reconnecter.
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
 * Prefixe de base de donnes pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de donnes
 * si vous leur donnez chacune un prefixe unique. 
 * N utilisez que des chiffres, des lettres non-accentues, et des caractres soulignes!
 */
$table_prefix  = \'yu_\';

/**
 * Langue de localisation de WordPress, par dwfaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit tre install dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction franaise, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et reglez l option ci-dessous fr_FR.
 */
define(\'WPLANG\', \'fr_FR\');

/** 
 * Pour les developpeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante true, vous activez l affichage des
 * notifications d erreurs pendant votre essais.
 * Il est fortemment recommando que les developpeurs d extensions et
 * de themes se servent de WP_DEBUG dans leur environnement de 
 * developpement.
 */ 
define(\'WP_DEBUG\', false); 

/* C est tout, ne touchez pas ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined(\'ABSPATH\') )
	define(\'ABSPATH\', dirname(__FILE__) . \'/\');

/** Reglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . \'wp-settings.php\');
';
			  	break;
		case "IT_IT":
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
 * di creazione di wp-config.php. Non necessario utilizzarlo solo via
 * web, anche possibile copiare questo file in wp-config.php e
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
 * E possibile cambiare queste chiavi in qualsiasi momento, per invalidare tuttii cookie esistenti. Cio forzer tutti gli utenti ad effettuare nuovamente il login.
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
 * Tale valore gi impostato per la lingua italiana
 */
define(\'WPLANG\', \'it_IT\');

/**
 * Per gli sviluppatori: modalit di debug di WordPress.
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
			  	break;
		case "PT_PT":	
		$cadena='<?php
/** 
 * A configurano de base do WordPress
 *
 * Este ficheiro define os seguintes parametros: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, e ABSPATH. Pode obter mais informacio
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} no Codex. As definites de MySQL so-lhe fornecidas pelo seu servico de alojamento.
 *
 * Este ficheiro usado para criar o script  wp-config.php, durante
 * a instalao, mas no tem que usar essa funcionalidade se no quiser. 
 * Salve este ficheiro como wp-config.php e preencha os valores.
 *
 * @package WordPress
 */

// ** Definites de MySQL - obtenha estes dados do seu servio de alojamento** //
/** O nome da base de dados do WordPress */
define(\'DB_NAME\', \'' . $bd . '\');

/** O nome do utilizador de MySQL */
define(\'DB_USER\', \'' . $sqluser . '\');

/** A password do utilizador de MySQL  */
define(\'DB_PASSWORD\', \'' . $sqlpass . '\');

/** O nome do serviddor de  MySQL  */
define(\'DB_HOST\', \'localhost\');

/** O Database Charset a usar na criao das tabelas. */
define(\'DB_CHARSET\', \'utf8\');

/** O Database Collate type. Se tem devidas no mude. */
define(\'DB_COLLATE\', \'\');

/**#@+
 * Chaves tenicas de Autenticacio.
 *
 * Mude para frases tenicas e diferentes!
 * Pode gerar frases automaticamente em {@link https://api.wordpress.org/secret-key/1.1/salt/ Servicio de chaves secretas de WordPress.org}
 * Pode mudar estes valores em qualquer altura para invalidar todos os cookies existentes o que ter como resultado obrigar todos os utilizadores a voltarem a fazer login
 *
 * @since 2.6.0
 */
define(\'AUTH_KEY\',         \'put yourddddd unigqgue phgrase here\');
define(\'SECURE_AUTH_KEY\',  \'put your unique phgrase here\');
define(\'LOGGED_IN_KEY\',    \'put yodddddur unidddddque phrase hfere\');
define(\'NONCE_KEY\',        \'put your unique phrase ghere\');
define(\'AUTH_SALT\',        \'put your uniddque dddphrase here\');
define(\'SECURE_AUTH_SALT\', \'put your uddddniqueddd phrasde here\');
define(\'LOGGED_IN_SALT\',   \'put your undddique phrase hdsere\');
define(\'NONCE_SALT\',       \'put youdr unidque phrase hesdre\');

/**#@-*/

/**
 * Prefixo das tabelas de WordPress.
 *
 * Pode suportar multiplas instalaciones numa si base de dados, ao dar a cada
 * instalacio um prefixo tecnico. Si algarismos, letras e underscores, por favor!
 */
$table_prefix  = \'hl_\';

/**
 * Idioma de Localizacio do WordPress, Ingles por omisso.
 *
 * Mude isto para localizar o WordPress. Um ficheiro MO correspondendo ao idioma
 * escolhido dever existir na directoria wp-content/languages. Instale por exemplo
 * pt_PT.mo em wp-content/languages e defina WPLANG como pt_PT para activar o
 * suporte para a lengua portuguesa.
 */
define(\'WPLANG\', \'pt_PT\');

/**
 * Para developers: WordPress em modo debugging.
 *
 * Mude isto para true para mostrar avisos enquanto estiver a testar.
 * vivamente recomendado aos autores de temas e plugins usarem WP_DEBUG
 * no seu ambiente de desenvolvimento.
 */
define(\'WP_DEBUG\', false);

/* E tudo. Pare de editar! */

/** Caminho absoluto para a pasta do WordPress. */
if ( !defined(\'ABSPATH\') )
	define(\'ABSPATH\', dirname(__FILE__) . \'/\');

/** Define as variveis do WordPress e ficheiros a incluir. */
require_once(ABSPATH . \'wp-settings.php\');

';
			break;
	}	
	echo "cadena=" . $cadena . "<br/>";
		  fputs($ar,  $cadena);
		  fclose($ar);
		  

	 
		$site='http://localhost/' . $nombre;
		//$home='';
		if(isset($site))
		{				
		$mysqli->select_db($bd);
		 switch (trim(strtoupper ($idioma))) {
			case "DE_DE":

				$sql= "UPDATE  `df_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='siteurl';";

			
				$sql1= "UPDATE  `df_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='home';";
			break;
			case "EN_EN":
				$sql= "UPDATE  `jk_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='siteurl';";
				
				
				$sql1= "UPDATE  `jk_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='home';";
			break;
			case "ES_ES":
				$sql= "UPDATE  `we_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='siteurl';";
				
				$sql1= "UPDATE  `we_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='home';";
			break;
			case "FR_FR":
				$sql= "UPDATE  `yu_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='siteurl';";	
				
				$sql1= "UPDATE  `yu_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='home';";
			
			break;
			case "IT_IT":
				$sql= "UPDATE  `hj_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='siteurl';";
				
				$sql1= "UPDATE  `hj_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='home';";
			break;
			case "PT_PT":
				$sql= "UPDATE  `hl_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='siteurl';";
				
				$sql1= "UPDATE  `hl_options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='home';";
			break;			
		}
		
			mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));	
			
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


  ?>