<?php
include_once("redireccion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Administracion de dominio</title>
</head> 
<body>
	<form action="creacion.php" method="post" id="frm1" name="frm1">
	
		<label for="txtnomdominio">Nombre del Dominio</label>
		<input type="text" id="txtnomdominio" name="txtnomdominio" />
		<input type="submit" value="Crear" id="btncrear" name="btncrear"/> 
	</form>
</body>
</html>