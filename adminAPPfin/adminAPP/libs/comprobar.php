<?php
function raros_a_html($cadena){
 
    $cadena = iconv("UTF-8", "CP1252", $cadena);
    $_characters  = array( '/á/','/é/','/í/','/ó/','/ú/' );
    $_replacement = array( '&aacute;','&eacute;','&iacute;','&oacute;','&uacute;' );
     $cadena = preg_replace($_characters, $_replacement, $cadena);
 
    $_characters  = array( '/Á/','/É/','/Í/','/Ó/','/Ú/' );
    $_replacement = array( '&Aacute;','&Eacute;','&Iacute;','&Oacute;','&Uacute;' );
     $cadena = preg_replace($_characters, $_replacement, $cadena);
 
     $_characters  = array( '/à/','/è/','/ì/','/ò/','/ù/' );
    $_replacement = array( '&agrave;','&egrave;','&igrave;','&ograve;','&ugrave;' );
     $cadena = preg_replace($_characters, $_replacement, $cadena);
   
    $_characters  = array( '/À/','/È/','/Ì/','/Ò/','/Ù/' );
    $_replacement = array( '&Agrave;','&Egrave;','&Igrave;','&Ograve;','&Ugrave;' );
     $cadena = preg_replace($_characters, $_replacement, $cadena);
 
    $_characters  = array( '/â/','/ê/','/î/','/ô/','/û/' );
    $_replacement = array( '&acirc;','&ecirc;','&icirc;','&ocirc;','&ucirc;' );
     $cadena = preg_replace($_characters, $_replacement, $cadena);
 
    $_characters  = array( '/Â/','/Ê/','/Î/','/Ô/','/Û/' );
    $_replacement = array( '&Acirc;','&Ecirc;','&Icirc;','&Ocirc;','&Ucirc;' );
     $cadena = preg_replace($_characters, $_replacement, $cadena);
   
    $_characters  = array( '/ä/','/ë/','/ï/','/ö/','/ü/' );
    $_replacement = array( '&auml;','&euml;','&iuml;','&ouml;','&uuml;' );
     $cadena = preg_replace($_characters, $_replacement, $cadena);
 
    $_characters  = array( '/Ä/','/Ë/','/Ï/','/Ö/','/Ü/' );
    $_replacement = array( '&Auml;','&Euml;','&Iuml;','&Ouml;','&Uuml;' );
     $cadena = preg_replace($_characters, $_replacement, $cadena);
   
    $_characters  = array( '/ã/','/Ã/','/õ/','/Õ/','/ª/','/º/','/œ/','/Œ/');
 
    $_replacement = array( '&atilde;','&Atilde;','&otilde;','&Otilde;','&ordf;','&ordm;', '&#339;','&#338;');
 
     $cadena = preg_replace($_characters, $_replacement, $cadena);
    $_characters  = array( '/’/','/\'/','/€/','/-/','/ç/','/Ç/','/ñ/','/Ñ/','/¿/',"/¡/",'/£/');
    $_replacement = array( '&#8217;','&#39;','&euro;','&#45;', '&ccedil;', '&Ccedil;' ,"&ntilde;","&Ntilde;","&iquest;","&iexcl;","&pound;");
     $cadena = preg_replace($_characters, $_replacement, $cadena);
 
   
    $_characters  = array( '/‘/','/‚/','/“/','/”/','/„/','/…/','/¹/','/º/', '/»/', '/²/', '/³/' , '/«/', '/»/' );
 
    $_replacement = array( '&#8216;','&#8218;','&#8220;','&#8221;', '&#8222;', '&#8230;', '&#185;' , '&#186;', '&raquo;', '&sup2;', '&sup3;', '&laquo;', '&raquo;');
 
     $cadena = preg_replace($_characters, $_replacement, $cadena);
            
    return $cadena;
} 

function testString($string)
{
	$encoding = "UTF-8";

	/* test 2 mb_check_encoding (test for bad byte stream) */

	if (true != mb_check_encoding($string, $encoding))
	{
		$string = utf8_decode($string);
	}
	
	/* filtrar SQL */
	//$string = mysql_real_escape_string($string);
	
	return $string;
}

function limpiarPostYGet()
{
	$input_arr = array(); 
	foreach ($_POST as $key => $input_arr) 
	{ 
		$_POST[$key] = addslashes(limpiarCadena(strtoupper($input_arr))); 
	}
	 
	$input_arr = array(); 
	foreach ($_GET as $key => $input_arr) 
	{ 
		$_GET[$key] = addslashes(limpiarCadena(strtoupper($input_arr))); 
	}
	//igual que:
	//array_walk($_POST, 'limpiarCadena');
	//array_walk($_GET, 'limpiarCadena');
}

function limpiarCadena($valor)
{
	$valor = str_ireplace("SELECT","", strtoupper($valor));
	$valor = str_ireplace("COPY","",strtoupper($valor));
	$valor = str_ireplace("UPDATE","",strtoupper($valor));
	$valor = str_ireplace("CREATE","",strtoupper($valor));
	$valor = str_ireplace("DELETE","",strtoupper($valor));
	$valor = str_ireplace("DROP","",strtoupper($valor));
	$valor = str_ireplace("DUMP","",strtoupper($valor));
	$valor = str_ireplace(" OR ","",strtoupper($valor));
	$valor = str_ireplace("%","",strtoupper($valor));
	$valor = str_ireplace("LIKE","",strtoupper($valor));
	$valor = str_ireplace("--","",strtoupper($valor));
	$valor = str_ireplace("^","",strtoupper($valor));
	$valor = str_ireplace("[","",strtoupper($valor));
	$valor = str_ireplace("]","",strtoupper($valor));
	$valor = str_ireplace("\\","",strtoupper($valor));
	$valor = str_ireplace("!","",strtoupper($valor));
	$valor = str_ireplace("¡","",strtoupper($valor));
	$valor = str_ireplace("?","",strtoupper($valor));
	$valor = str_ireplace("=","",strtoupper($valor));
	$valor = str_ireplace("&","",strtoupper($valor));
	return $valor;
}


?>
