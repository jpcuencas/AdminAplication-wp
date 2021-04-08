<?php
if (isset($_GET['tipo']))
{
	$tipo=$_GET['tipo'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Seleciona tu plantilla</title>

<style>
*{
	font-size:17px;
	font-weight:bold;
}
li
{
	float:right;
	margin-left: -20px;
	margin-right: 10px;
	list-style:none;
}
</style>
<!-- Lastly, call the galleryView() function on your unordered list(s) -->
<script type="text/javascript">	
	function selecinarPlantilla(id)
	{
		var idPlantilla=id;
		
		document.getElementById('id_plan').value=id;
		opener.document.forms["formulario"].txtplant.value = document.forms["form"].id_plan.value;
		document.getElementById('form').submit();
		opener.cambiarTipo(<?php echo ((isset($tipo)) ? "$tipo" : ""); ?>,id);
		window.close();
	}
</script>

</head>

<body>
<form name="form" id="form">
	<ul>
<?php
	include('../libs/conn.php'); 
	$query = "SELECT id,nombre,id_tipo,descripcion FROM plantilla WHERE id_tipo='" . $tipo . "'";
		$result = $mysqli->query($query);
		while ($line = $result->fetch_array(MYSQLI_ASSOC)) {
			echo "<li>
			<a href='#' onclick='javascript:selecinarPlantilla(" . $line["id"] . ");return false;'><img id='" . $line["id"] . "' name='imagenes' data-frame='Plantillas/" . $line["nombre"] . "/small.jpg' alt='plantilla' src='Plantillas/" . $line["nombre"] . "/imagen.jpg' title='" . $line["nombre"] . "' data-description='" . $line["descripcion"] ."' />
			<h5 style='text-align:center;'>" . $line["nombre"] . "</h5></a>
			</li>";
		}
?>
	   </ul>
	   <input type='hidden' name='id_plan' id='id_plan' value="" />
	   <input type='hidden' name='tipo' id='tipo' value="<?php echo ((isset($tipo)) ? "$tipo" : ""); ?>" />
</form>
	<!--<p>Selecciona tu plantilla. 
	<input type='button' name="Seleccionar" class="buttom" id="Seleccionar" value='Seleccionar' onclick="selecinarPlantilla();" /> </p>-->
</body>
</html>
