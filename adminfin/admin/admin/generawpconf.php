<?php
include_once("redireccion.php");
	if(isset($_POST['dom']))
	{
		$nombre=$_POST['dom'];
	}
	if(isset($_POST['lan']))
	{
		$idioma=$_POST['lan'];
	}
	if(isset($_POST['us']))
	{
		$user =$_POST['us'];
	}
	if(isset($_POST['pas']))
	{
		$pass = $_POST['pas'];
	}
	if(isset($_POST['prefijo']))
	{
		$prefijo = $_POST['prefijo'];
	}
	if(isset($_POST['title']))
	{
		$title = $_POST['title'];
	}
	if(isset($_POST['keywords']))
	{
		$keywords = $_POST['keywords'];
	}
	if(isset($_POST['descripcion']))
	{
		$descripcion = $_POST['descripcion'];
	}	

	$patron="/[^a-zA-Z0-9]/";
	$sustitucion='_';
	$bd=preg_replace($patron, $sustitucion, $nombre);
include("conn.php");
	$objetoJSON='a:32:{s:9:"aiosp_can";s:2:"on";s:12:"aiosp_donate";N;s:16:"aiosp_home_title";s:' . strlen($title) . ':"' . $title . '";s:22:"aiosp_home_description";s:' . strlen($descripcion) . ':"' . $descripcion . '";s:19:"aiosp_home_keywords";s:' . strlen($keywords) . ':"' . $keywords . '";s:23:"aiosp_max_words_excerpt";N;s:20:"aiosp_rewrite_titles";s:2:"on";s:23:"aiosp_post_title_format";s:27:"%post_title% | %blog_title%";s:23:"aiosp_page_title_format";s:27:"%page_title% | %blog_title%";s:27:"aiosp_category_title_format";s:31:"%category_title% | %blog_title%";s:26:"aiosp_archive_title_format";s:21:"%date% | %blog_title%";s:22:"aiosp_tag_title_format";s:20:"%tag% | %blog_title%";s:25:"aiosp_search_title_format";s:23:"%search% | %blog_title%";s:24:"aiosp_description_format";s:13:"%description%";s:22:"aiosp_404_title_format";s:33:"Nothing found for %request_words%";s:18:"aiosp_paged_format";s:14:" - Part %page%";s:20:"aiosp_use_categories";N;s:32:"aiosp_dynamic_postspage_keywords";s:2:"on";s:22:"aiosp_category_noindex";s:2:"on";s:21:"aiosp_archive_noindex";s:2:"on";s:18:"aiosp_tags_noindex";N;s:14:"aiosp_cap_cats";s:2:"on";s:27:"aiosp_generate_descriptions";N;s:16:"aiosp_debug_info";N;s:20:"aiosp_post_meta_tags";s:0:"";s:20:"aiosp_page_meta_tags";s:0:"";s:20:"aiosp_home_meta_tags";s:0:"";s:13:"aiosp_enabled";s:1:"1";s:17:"aiosp_enablecpost";N;s:26:"aiosp_use_tags_as_keywords";s:2:"on";s:12:"aiosp_do_log";N;s:14:"aiosp_ex_pages";s:0:"";}';	
	
	$fichero="wp-config.php";
	$carpeta="/var/www/" . $nombre;

  if(file_exists($carpeta . "/" . $fichero))
  {
	unlink($carpeta . "/" . $fichero);
  }
	$file=trim($carpeta . "/" . $fichero);
	if(file_exists($carpeta))
	{

	  
		$cadena1='<?php
define(\'DB_NAME\', \'' . $bd . '\');
define(\'DB_USER\', \'' . $sqluser . '\');
define(\'DB_PASSWORD\', \'' . $sqlpass . '\');
define(\'DB_HOST\', \'localhost\');
define(\'DB_CHARSET\', \'utf8\');

define(\'DB_COLLATE\', \'\');

define(\'AUTH_KEY\', \'podn asdqdf fdgdfwqtudhfcv ffaleafria\'); // Cambia esto por tu frase aleatoria.
define(\'SECURE_AUTH_KEY\', \'pon aqui tuj ffwse aleatoria\'); // Cambia esto por tu frase aleatoria.
define(\'LOGGED_IN_KEY\', \'pon aqdfwui jtu fjrase awleatoria\'); // Cambia esto por tu frase aleatoria.
define(\'NONCE_KEY\', \'pon eeaqui tju frasdse aleqatsdoria\'); // Cambia esto por tu frase aleatoria.
define(\'AUTH_SALT\', \'pon adfg teufgsedrfg aelweatoridfga\'); // Cambia esto por tu frase aleatoria.
define(\'SECURE_AUTH_SALT\', \'pon aqeddeudi tu wfrase aledssatoria\'); // Cambia esto por tu frase aleatoria.
define(\'LOGGED_IN_SALT\', \'pon aqui tu frewdsse alefxdwdatordsia\'); // Cambia esto por tu frase aleatoria.
define(\'NONCE_SALT\', \'pon aqui tfu frajse dsdfgawleatdfgoria\'); // Cambia esto por tu frase aleatoria.

$table_prefix  = \'' . $prefijo . '\';
';

	  switch (trim(strtoupper ($idioma))) {
		case "ES_ES":

$cadena2='
define(\'WPLANG\', \'es_ES\');
';
  	break;
		case "DE_DE":

$cadena2='
define(\'WPLANG\', \'de_DE\');
';
  	break;
		case "EN_EN":

$cadena2='
define(\'WPLANG\', \'\');
';
  	break;
		case "FR_FR":

$cadena2='
define(\'WPLANG\', \'fr_FR\');
';
  	break;
		case "IT_IT":
$cadena2='
define(\'WPLANG\', \'it_IT\');
';
  	break;
		case "PT_PT":
		
$cadena2='
define(\'WPLANG\', \'pt_PT\');
';
  	break;
	default:
$cadena2='
define(\'WPLANG\', \'es_ES\');
';
}	

$cadena3='define(\'WP_DEBUG\', false);

if ( !defined(\'ABSPATH\') )
	define(\'ABSPATH\', dirname(__FILE__) . \'/\');

require_once(ABSPATH . \'wp-settings.php\');
';

$cadena= $cadena1 . $cadena2 . $cadena3;		
$fichero1=".htaccess";
$contenido="# BEGIN WPCache
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_METHOD} !POST
RewriteCond %{QUERY_STRING} !.*=.*
RewriteCond %{HTTP:Cookie} !^.*(comment_author_|wordpress_logged_in|wp-postpass_).*$
RewriteCond %{HTTP:X-Wap-Profile} !^[a-z0-9\"]+ [NC]
RewriteCond %{HTTP:Profile} !^[a-z0-9\"]+ [NC]
</IfModule>
# END WPCache

# BEGIN WordPress
<IfModule mod_rewrite.c>
RewriteEngine On
RewriteBase /" . $nombre . "/
RewriteRule ^index\.php$ - [L]
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule . /" . $nombre . "/index.php [L]
</IfModule>

# END WordPress";
if(file_exists($carpeta . "/" . $fichero1))
{
	unlink($carpeta . "/" . $fichero1);
}
	$ar=fopen($carpeta . "/" . $fichero,"w") or die("Problemas en la creacion\n");
	fputs($ar,  $cadena);
	fclose($ar);
	$ar=fopen($carpeta . "/" . $fichero1,"w") or die("Problemas en la creacion\n");
	fputs($ar,  $contenido);
	fclose($ar);

	 if(file_exists($carpeta . "/" . $fichero))
	 {
		$site='http://www.' . $nombre;
		//$home='';
		
		$mysqli->select_db($bd);
		if (!$mysqli->query("START TRANSACTION")) {
			die(sprintf("[%d] %s\n", $mysqli->errno, $mysqli->error));
		}
		/* disable autocommit */
		$mysqli->autocommit(FALSE);	
				$sql= "UPDATE  `" . $prefijo . "options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='siteurl';";

				$sql1= "UPDATE  `" . $prefijo . "options` SET 
				`option_value` =  '{$site}'
				WHERE  `option_name` ='home';";
				
				$phpdate=date("Y-m-d H:i:s");
				//mysql: date('Y-m-d H:i:s', $phpdate)
				$sql2="INSERT INTO " . $prefijo . "users (user_login, user_pass,user_nicename, user_email, user_registered, user_activation_key, user_status, display_name)
				VALUES ('{$user}', '{$pass}','{$user}','antonio@fivedoorsnetwork.com','" . $phpdate . "','','0','{$user}')";

				$sql4= "UPDATE  `" . $prefijo . "options` SET 
				`option_value` =  '{$title}'
				WHERE  `option_name` ='blogname';";
				
				$sql5= "UPDATE  `" . $prefijo . "options` SET 
				`option_value` =  '{$objetoJSON}'
				WHERE  `option_name` ='aioseop_options';";
				
				$sql6="UPDATE `" . $prefijo . "options` SET 
				`option_value` = '{$site}/wp-content/uploads' 
				WHERE `option_name` = 'upload_url_path'";
				
				$sql7="UPDATE `" . $prefijo . "options` SET 
				`option_value` = '{$site}/sitemap.xml' 
				WHERE `option_name` = 'sitemap_url'";
				
				$sql8="UPDATE `" . $prefijo . "options` SET 
				`option_value` = '{$site}/contact' 
				WHERE `option_name` = 'contact_url'";
				
				$sql9="UPDATE `" . $prefijo . "options` SET 
				`option_value` = '{$site}/' 
				WHERE `option_name` = 'imagestorage_link'";
				
				$sql10="UPDATE `" . $prefijo . "options` SET 
				`option_value` = '{$nombre}' 
				WHERE `option_name` = 'copyright'";
				
			$sql11="INSERT INTO `" . $prefijo . "usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) 
			VALUES (NULL, (Select max(ID) FROM "  . $prefijo . "users), 'wp_capabilities', 'a:1:{s:13:\"administrator\";s:1:\"1\";}');";

			$sql12="INSERT INTO `" . $prefijo . "usermeta` (`umeta_id`, `user_id`, `meta_key`, `meta_value`) 
			VALUES (NULL, (Select max(ID) FROM "  . $prefijo . "users), 'wp_user_level', '10');";
				
				$sql13="UPDATE `" . $prefijo . "options` SET 
				`option_value` = '{$site}/my-account/' 
				WHERE `option_name` = 'dashboard_url'";
				
				$sql14="UPDATE `" . $prefijo . "options` SET 
				`option_value` = '{$site}/manage/' 
				WHERE `option_name` = 'manage_url'";
				
				$sql15="UPDATE `" . $prefijo . "options` SET 
				`option_value` = '{$site}/submit/' 
				WHERE `option_name` = 'submit_url'";
				
				$sql16="UPDATE `" . $prefijo . "options` SET 
				`recently_edited` = 'a:5:" . '{i:0;s:"' . (count($site)+55) . '":"/var/www/' . $site . '/wp-content/themes/CouponPress-v7.x/header.php";i:2;s:92:"/var/www/' . $site . '/wp-content/themes/CouponPress-v7.x/template_couponpress/_single.php";i:3;s:68:"/var/' . $site . '/wp-content/themes/CouponPress-v7.x/page.php";i:4;s:69:"/var/www/' . $site . '/wp-content/themes/CouponPress-v7.x/style.css";i:5;s:87:"/var/www/' . $site . '/wp-content/plugins/all-in-one-seo-pack/all_in_one_seo_pack.php";}' . "
				' WHERE `option_name` = 'recently_edited'";
		
				$sql17="UPDATE `" . $prefijo . "options` SET 
				`option_value` = '{$site}/messages/' 
				WHERE `option_name` = 'messages_url'";
				
				$sql18="UPDATE `" . $prefijo . "options` SET 
				`option_value` = '/home/kmxgodxf/public_html/{$site}/wp-content/themes/couponpress/thumbs/'
				WHERE `option_name` = 'imagestorage_path'";
				
				$sql19="UPDATE `" . $prefijo . "options` SET 
				`option_value` = 'http://{$site}/callback/'
				WHERE `option_name` = 'paypal_return'";
				
				$sql20="UPDATE `" . $prefijo . "options` SET 
				`option_value` = 'http://{$site}/callback/'
				WHERE `option_name` = 'paypal_cancel'";
				
				$sql21="UPDATE `" . $prefijo . "options` SET 
				`option_value` = 'http://{$site}/callback/'
				WHERE `option_name` = 'paypal_notify'";
				
			mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli));	
			
			mysqli_query($mysqli,$sql1) or die(mysqli_error($mysqli)); 
			
			mysqli_query($mysqli,$sql2) or die(mysqli_error($mysqli)); 
			
			//mysqli_query($mysqli,$sql3) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql4) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql5) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql6) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql7) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql8) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql9) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql10) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql11) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql12) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql13) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql14) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql15) or die(mysqli_error($mysqli));
			
			//mysqli_query($mysqli,$sql16) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql17) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql18) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql19) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql20) or die(mysqli_error($mysqli));
			
			mysqli_query($mysqli,$sql21) or die(mysqli_error($mysqli));
			
			if (!$mysqli->commit()) {
				die("Error al hacer el commit");
			}
			$mysqli->autocommit(TRUE);
			$mysqli->close();
			

			 copy("/var/www/admin/ficherosAcopiarWP/wp-admin/auto-login.php", $carpeta . "/wp-admin/auto-login.php"); 
			 //shell_exec("cp /var/www/admin/ficherosAcopiarWP/wp-admin/auto-login.php ", $carpeta . "/wp-admin/auto-login.php");
			 copy("/var/www/admin/ficherosAcopiarWP/wp-admin/loginauto.php", $carpeta . "/wp-admin/loginauto.php"); 
			 //shell_exec("cp /var/www/admin/ficherosAcopiarWP/wp-admin/loginauto.php ", $carpeta . "/wp-admin/loginauto.php");
			
			
			shell_exec("sudo /usr/local/bin/cambiarFichero.sh " . $carpeta);

			shell_exec("chmod 777 -R " . $carpeta . "/*");
			//chmod("/var/www/$dominio/loginauto.php", 0777);
			//chmod("/var/www/$dominio/auto-login.php", 0777);
			//chmod("/var/www/$dominio/wp-config.php", 0777);
			//full_copy($source,$target);
		}
		else
		{
			echo "Error";
		}
}
else
{
	echo "Error";
}
  ?>