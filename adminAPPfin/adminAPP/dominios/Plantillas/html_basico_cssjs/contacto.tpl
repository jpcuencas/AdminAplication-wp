<!DOCTYPE html>
<HTML lang="es">
<HEAD>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="description" content="{descripcion}"/>
	<meta name="keywords" content="{keywords}"/>
	<meta name="author" content="FiveDoorsNetwork">
	
	<TITLE>{title}</TITLE>
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css"/>
</HEAD>
<BODY style="background-color:{colortxt};">

	<h1style="font-family:{fuentetxt};">{titulo}</h1>
esto es contacto
	<p>
	{texto}
	</p>

	<span id="imgventa" name="imgventa">
		<img alt="imagen" src="{imagen}.jpg" />
	</span>

	<form action="" method="POST" id="frmcomp" name="frmcomp">
		<h2>Este dominio esta en venta</h2>
		
		<fieldset>
			<label form="txtprecio">Precio: </label> <input type="text" readonly class="" id="txtprecio" name="txtprecio" value="{precio}" />
			<label form="txtemail">Su email: </label> <input type="text" class="" id="txtemail" name="txtemail" />
		</fieldset>	
		
		<input type="submit" class="" id="btncomprar" name="btncomprar" value="Comprar" /> 
	</form>
		<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
</BODY>
</HTML>
