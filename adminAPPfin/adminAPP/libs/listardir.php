<?php  
$carpeta='';
function ordenar($a,$b){ 
	global $carpeta; 
	$a = filemtime($carpeta.$a); 
	$b = filemtime($carpeta.$b); 
	
	if ($a == $b) 
	{ 
		return 0; 
	} 
	return ($a < $b) ? -1 : 1; 
} 
function dir($directorio)
{
	
	$dir=opendir($directorio); 
	echo "<b>Directorio actual:</b><br> $directorio<br>"; 
	echo "<b>Archivos:</b><br>"; 
	while($arch=readdir($dir))$ars[]=$arch; 
	closedir($dir); 
	usort($ars, "ordenar"); 
	foreach($ars as $ar)echo "$ar<br>"; 
}
?> 