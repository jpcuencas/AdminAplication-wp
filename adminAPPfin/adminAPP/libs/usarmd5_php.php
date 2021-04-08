<?php
include_once('md5_php.php');

$texto = "Son unos corruptos";
 
// Encriptamos el texto
$texto_encriptado = Encrypter::encrypt($texto);
 
// Desencriptamos el texto
$texto_original = Encrypter::decrypt($texto_encriptado);
 
if ($texto == $texto_original) 
	echo 'Encriptacion Desencriptacion realizada correctamente.';
else
	echo 'Algo ha ido mal en la decodificacion';
?>