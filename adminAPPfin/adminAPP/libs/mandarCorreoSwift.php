<?php

function mandar_mail($asunto,$cuerpo,$origen,$destino,$adjunto)
{ 
	include_once("swift/swift_required.php");
	//include_once("./clasemail/class.phpmailer.php");
	
	$produccion=false;   //cambiar en cada sitio
	if($produccion)
	{
		date_default_timezone_set('Europe/Madrid');
		$transport = Swift_MailTransport::newInstance();  //,'ssl')

		//Creamos el mailer pasandole el transport con la configuracion gmail
		$mailer = Swift_Mailer::newInstance($transport);

		//Creamos el mensaje
		$message = Swift_Message::newInstance($asunto)
		->setFrom(array($origen => 'Gestion dominios'))
		->setTo(array($destino, 'tech@fivedoorsnetwork.com' => 'Tech','becainfor@fivedoorsnetwork.es' => 'Becainfor'))
		->setSubject($asunto)
		->setBody($cuerpo, 'text/html');
		
		//echo "IMAGEN=".$adjunto. " C=".getcwd ( );
		if (file_exists ( $adjunto ) || remoteFileExists($adjunto) )
		{
			//echo "<br/>Fichero si existe".getcwd()."<br>/";
			$message->attach(Swift_Attachment::fromPath($adjunto));
		}
		

		//Enviamos
		$result = $mailer->send($message);
	}
	else{
		$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com',465,'ssl')
		->setUsername('becainfor@gmail.com')
		->setPassword('300900Paco');

		//Creamos el mailer pasandole el transport con la configuracion de gmail
		$mailer = Swift_Mailer::newInstance($transport);

		//Creamos el mensaje
		$message = Swift_Message::newInstance($asunto)
		->setFrom(array($origen => 'Gestion dominios'))
		->setTo(array($destino, 'tech@fivedoorsnetwork.com' => 'Tech','becainfor@fivedoorsnetwork.es' => 'Becainfor'))
		->setSubject($asunto)
		->setBody($cuerpo, 'text/html');
	
		//echo "IMAGEN=".$adjunto. " C=".getcwd ( );
		if ( file_exists( $adjunto ) || remoteFileExists($adjunto) )
		{
			//echo "<br/>Fichero si existe".getcwd()."<br>/";
			$message->attach(Swift_Attachment::fromPath($adjunto));
		}

		//Enviamos
		$result = $mailer->send($message);
	}
	return $result;
}

function remoteFileExists($path){
    return (@fopen($path,"r")==true);
}
?>
