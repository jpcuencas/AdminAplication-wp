<?php
$titulo0="Administracion plantillas de pagina";
$titulo1="Mostrar plantilla de pagina";
include_once("../descrip_auto/arribaDA.php");

try
{
if (isset($_GET['flash']))
{
	if($_GET['error'])
	{
		echo "<div id='message' class='label alert ' style='display:inline-block;padding:5px;margin-left:20px;'><span class='icon-save'>&nbsp;</span>{$_GET['flash']} </div><br/>";
		echo "<br/>";	
	}
	else
	{
		echo "<div id='message' class='label info ' style='display:inline-block;padding:5px;margin-left:20px;'><span class='icon-save'>&nbsp;</span>{$_GET['flash']} </div><br/>";
		echo "<br/>";
	}
	
?>
	<script type="text/javascript">
			$(function(evt) {
				setTimeout(function() {
					$('#message').css({ 'opacity' : 0.5 });
				}, 8000);
			});
	</script>

<?php
	
}


	include("../libs/conn.php");
	
	$query = "SELECT ID,nombre,id_tipo,descripcion FROM plantilla ORDER BY nombre";
	$result = $mysqli->query($query);

		echo " <p><a href='plantillas.php?mode=new'>Crear nueva plantilla</a></p>";
		
		// Imprimir los resultados en HTML
		echo "<table>\n";
		echo "<caption><tr><td>ID</td><td>Nombre</td><td>Tipo pagina</td><td>Descripcion</td></tr></caption>";
		$j=0;
		while ($line = $result->fetch_array(MYSQLI_ASSOC)) {
			if($j % 2==0)
				echo "\t<tr>\n";
			else
				echo "\t<tr style='background-color:Lavender;'>\n";
			$i=0;
			foreach ($line as $col_value)
			{
				if($i==1)
				{
					echo "\t\t<td><a href='plantillas.php?mode=edit&id={$line['ID']}'>$col_value</a></td>";
					echo"\n";
				}
				elseif($i==2)
				{
					$query2 = "SELECT nombre FROM tipopagina WHERE ID = '" . $line["id_tipo"] . "'";
					$result2 = $mysqli->query($query2);
					$row1=$result2->fetch_array(MYSQLI_ASSOC);
					echo "\t\t<td>" . $row1["nombre"] . "</td>";
					echo"\n";
				}
				else
				{
					echo "\t\t<td>$col_value</td>";
					echo"\n";				
				}
				$i++;
			}
			echo "<td>";
			//echo "<a href='plantilla.php?mode=edit&id={$line['ID']}'>Editar</a> | ";
			echo "<a href=deletePlantilla.php?id={$line['ID']} onclick='if(!confirm(\"Pulsa Aceptar para confirmar el borrado de la plantilla\"))return false'>Borrar</a>\n";
			echo "</td></tr>";
			$j++;
		}
		echo "</table>\n";

		// Liberar resultados
		$result->free();
		//Cerrar conexion
		$mysqli->close();

}
catch(Exception $e)
{
	echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
}

include_once("../descrip_auto/abajoDA.php");
?>