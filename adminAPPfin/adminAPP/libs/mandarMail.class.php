<?php

include_once("phpmailer/class.phpmailer.php");
/**
* Clase email que se extiende de PHPMailer
*/
class email  extends PHPMailer{

    //datos de remitente
    var $tu_email = 'becainfor@gmail.com';
    var $tu_nombre = 'becainfor';
    var $tu_password ='900300Paco';

    /**
 * Constructor de clase
 */
    public function __construct()
    {
      //configuracion general
     $this->IsSMTP(); // protocolo de transferencia de correo
     // Servidor GMAIL  smtp.gmail.com		port: 465
	 // Servidor HOTMAIL  smtp.live.com		port: 587
	 // Servidor YAHOO  smtp.mail.yahoo.com port: 25
	 
	 /////Solo Hotmail ////
	 //$this->SMTPSecure = "tls";	 // sets the prefix to the servier
	 //////////////////////
	 
	 $this->Host = 'smtp.gmail.com'; 
     $this->Port = 465; //puerto
     $this->SMTPAuth = true; // Habilitar la autenticacion MTP
     $this->Username = $this->tu_email;
     $this->Password = $this->tu_password;
	 /////Solo gmail y yahoo ////
     $this->SMTPSecure = 'ssl';  //habilita la encriptacion SSL
     ////////////////////////////
	 //remitente
     $this->From = $this->tu_email;
    $this->FromName = $this->tu_nombre;
    }

    /**
 * Metodo encargado del envio del e-mail
 */
    public function enviar( $para, $nombre, $titulo , $contenido)
    {
       $this->AddAddress($para, $nombre);  // Correo y nombre a quien se envia
       $this->WordWrap = 50; // Ajuste de texto
       $this->IsHTML(true); //establece formato HTML para el contenido
       $this->Subject =$titulo;
       $this->Body    =  $contenido; //contenido con etiquetas HTML
       $this->AltBody =  strip_tags($contenido); //Contenido para servidores que no aceptan HTML
       //envio de e-mail y retorno de resultado
       return $this->Send() ;
   }

}
?>
