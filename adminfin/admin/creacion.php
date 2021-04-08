<?php
include_once("redireccion.php");
  if(!(file_exists($_POST["txtnomdominio"])))
  {
	$dominio=trim($_POST["txtnomdominio"]);
	
	try
	{
	//fichero de configuracion de apache
	  $ar=fopen("/etc/apache2/sites-available/" . $dominio,"w") or die("Problemas en la creacion\n");
	  $cadena='<VirtualHost *:80>
	ServerAdmin webmaster@localhost
	DocumentRoot /var/www/' . $dominio . '
	ServerName www.' . $dominio . '
	ServerAlias ' . $dominio . '
	AccessFileName .htaccess
	<Directory />
		Options FollowSymLinks
		AllowOverride None
	</Directory>
	<Directory /var/www/' . $dominio . '>
		# Options Indexes FollowSymLinks MultiViews
		Options All
		AllowOverride All
		# AllowOverride None
		Order allow,deny
		allow from all
	</Directory>
	ScriptAlias /cgi-bin/ /usr/lib/cgi-bin/
	<Directory "/usr/lib/cgi-bin">
		AllowOverride None
		Options +ExecCGI -MultiViews +SymLinksIfOwnerMatch
		Order allow,deny
		Allow from all
	</Directory>
	ErrorLog ${APACHE_LOG_DIR}/error.log
	# Possible values include: debug, info, notice, warn, error, crit,
	# alert, emerg.
	LogLevel warn
	CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>';
  
		  fputs($ar,  $cadena);
		  fclose($ar);
		  
		  //permisos de la carpeta del dominio
		if(!file_exists("/var/www/" . $dominio))
		{  	if(!mkdir( "/var/www/" . $dominio, 0777, true)) 
			{
				die('Fallo al crear las carpetas...\n<br/>');
			}
		}
			//activamos el sitio web
			shell_exec("chmod 777 -R /var/www/" . $dominio);
			//echo "Ejecutando el script...\n<br/>";
			shell_exec("sudo /usr/local/bin/myDominioScript.sh " . $dominio) . "\n<br/>";
			//echo "Script ejecutado.\n<br/>";
			if(file_exists("/etc/apache2/sites-enabled/" . $dominio))
			{			
				//configuramos los permisos
				//cambio de grupo
				 //chgrp("/var/www/$dominio", "ftp");
				 shell_exec("sudo /usr/local/bin/cambiarFichero.sh /var/www/" . $dominio);
				//permisos de fichero				
				 chmod("/var/www/$dominio", 0777);
				
				//reiniciamos apache
				 shell_exec("sudo /usr/local/bin/reloadapache.sh");
				//para comprobar en el origen que todo fue bien
				echo "ok";
			}
			else
			{
				echo "Error al habilitar el dominio\n<br/>";
			}
		
	}
	catch (Exception $e)
	{
		echo "<br/>-------------\n<br/>Hubo error al generar los datos. " .  $e->getMessage() . "<br/>\n------------";
	}
  }
  else
  {
	 	  echo "El dominio ya existe.<br/>";
  }
  ?>
  
