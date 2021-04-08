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
	$carpeta="/var/www/" . $nombre;
	
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
 * A configuração de base do WordPress
 *
 * Este ficheiro define os seguintes parâmetros: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, e ABSPATH. Pode obter mais informação
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} no Codex. As definições de MySQL são-lhe fornecidas pelo seu serviço de alojamento.
 *
 * Este ficheiro é usado para criar o script  wp-config.php, durante
 * a instalação, mas não tem que usar essa funcionalidade se não quiser. 
 * Salve este ficheiro como wp-config.php e preencha os valores.
 *
 * @package WordPress
 */

// ** Definições de MySQL - obtenha estes dados do seu serviço de alojamento** //
/** O nome da base de dados do WordPress */
define(\'DB_NAME\', \'' . $bd . '\');

/** O nome do utilizador de MySQL */
define(\'DB_USER\', \'' . $sqluser . '\');

/** A password do utilizador de MySQL  */
define(\'DB_PASSWORD\', \'' . $sqlpass . '\');

/** O nome do serviddor de  MySQL  */
define(\'DB_HOST\', \'localhost\');

/** O Database Charset a usar na criação das tabelas. */
define(\'DB_CHARSET\', \'utf8\');

/** O Database Collate type. Se tem dúvidas não mude. */
define(\'DB_COLLATE\', \'\');

/**#@+
 * Chaves Únicas de Autenticação.
 *
 * Mude para frases únicas e diferentes!
 * Pode gerar frases automáticamente em {@link https://api.wordpress.org/secret-key/1.1/salt/ Serviço de chaves secretas de WordPress.org}
 * Pode mudar estes valores em qualquer altura para invalidar todos os cookies existentes o que terá como resultado obrigar todos os utilizadores a voltarem a fazer login
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
 * Pode suportar múltiplas instalações numa só base de dados, ao dar a cada
 * instalação um prefixo único. Só algarismos, letras e underscores, por favor!
 */
$table_prefix  = \'hl_\';

/**
 * Idioma de Localização do WordPress, Inglês por omissão.
 *
 * Mude isto para localizar o WordPress. Um ficheiro MO correspondendo ao idioma
 * escolhido deverá existir na directoria wp-content/languages. Instale por exemplo
 * pt_PT.mo em wp-content/languages e defina WPLANG como pt_PT para activar o
 * suporte para a língua portuguesa.
 */
define(\'WPLANG\', \'pt_PT\');

/**
 * Para developers: WordPress em modo debugging.
 *
 * Mude isto para true para mostrar avisos enquanto estiver a testar.
 * É vivamente recomendado aos autores de temas e plugins usarem WP_DEBUG
 * no seu ambiente de desenvolvimento.
 */
define(\'WP_DEBUG\', false);

/* E é tudo. Pare de editar! */

/** Caminho absoluto para a pasta do WordPress. */
if ( !defined(\'ABSPATH\') )
	define(\'ABSPATH\', dirname(__FILE__) . \'/\');

/** Define as variáveis do WordPress e ficheiros a incluir. */
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
			$sql= "UPDATE  `hl_options` SET 
			`option_value` =  '{$site}'
			WHERE  `option_name` ='siteurl';";
			
			mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));	
			
			$sql1= "UPDATE  `hl_options` SET 
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