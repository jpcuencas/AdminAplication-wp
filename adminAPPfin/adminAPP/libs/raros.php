
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
?>
