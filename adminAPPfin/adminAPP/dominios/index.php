<?php
$titulo="Administracion de dominios";
$titulo1="Mostrar dominios";
include_once("../descrip_auto/arribaDA.php");
include_once("../libs/estados.php");
include_once("../libs/idiomas.php");		 
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
			function editarWP(nom,usr,pass)
			{
				$.post("../../" + nom + "/wp-login.php", { testcookie: "1", rememberme: "forever", username:usr, password:pass } );

			}
	</script>

<?php
	
}

	include("../libs/conn.php");
	
	$query = "SELECT ID, nombre, id_servidor, id_tipo, idioma, id_plantilla, estado FROM dominio ORDER BY nombre";
	$result = $mysqli->query($query);

		echo " <p><a href='dominios.php?mode=new'>Crear nuevo dominio</a></p>";
		
		// Imprimir los resultados en HTML
		echo "<table>\n";
		echo "<caption><tr><td>ID</td><td>Nombre</td><td>IP</td><td>Servidor</td><td>Tipo</td><td>Idioma</td><td>Plantilla</td><td>estado</td></tr></caption>";
		$j=0;
		while ($line = $result->fetch_array(MYSQLI_ASSOC)) {
			$i=0;
			if($j % 2==0)
				echo "\t<tr>\n";
			else
				echo "\t<tr style='background-color:Lavender;'>\n";
			foreach ($line as $col_value)
			{
				//$ip="";
				if($i==1)
				{
					echo "\t\t<td><a href='dominios.php?mode=edit&id={$line['ID']}'>$col_value</a></td>";
					echo"\n";
				}
				else if($i==2)
				{
					$query1 = "SELECT nombre,ip FROM servidor WHERE ID = '" . $line["id_servidor"] . "'";
					$result1 = $mysqli->query($query1);
					$row=$result1->fetch_array(MYSQLI_ASSOC);
					$ip=$row["ip"];
					echo "\t\t<td>" . $row["ip"] . "</td>\t\t<td>" . $row["nombre"] . "</td>";
					echo"\n";
				}
				else if($i==3)
				{
					$query2 = "SELECT nombre FROM tipopagina WHERE ID = '" . $line["id_tipo"] . "'";
					$result2 = $mysqli->query($query2);
					$row1=$result2->fetch_array(MYSQLI_ASSOC);
					$tipo=$row1["nombre"];
					echo "\t\t<td>" . $tipo . "</td>";
					echo"\n";
				}
				else if($i==5)
				{
					$query3 = "SELECT nombre FROM plantilla WHERE ID = '" . $line["id_plantilla"] . "'";
					$result3 = $mysqli->query($query3);
					$row2=$result3->fetch_array(MYSQLI_ASSOC);
					$plantilla=$row2["nombre"];
					echo "\t\t<td>" . $row2["nombre"] . "</td>";
					echo"\n";
				}
				else if($i==6)
				{
					echo "\t\t<td>" . $vectorEstado["$col_value"] . "</td>";
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
			if($line['estado'] != 'B')
			{
			//if($line['estado'] == 'P')
			//{
			//	echo "<a href='configurar.php?dom={$line['ID']}&ser={$line['id_servidor']}'>Configurar</a> | ";
			//}
				if(file_exists("../../{$line['nombre']}"))
					$is_empty = (bool) (count(scandir("../../{$line['nombre']}")) == 2);
				else
					$is_empty = false;
			
				if($line['estado'] != 'I')
				{
					echo "<a href='instalar.php?dom={$line['ID']}&ser={$line['id_servidor']}'>Instalar</a> | ";
				}
				if($line['estado'] != 'P')
				{
					//echo "<a href='enviarBD.php?dom={$line['ID']}&ser={$line['id_servidor']}'>EnviarBD</a> | ";
					echo "<a href='enviarFicheros.php?dom={$line['ID']}&ser={$line['id_servidor']}'>ActualizarFicheros</a> | ";
					if(substr(strtoupper($tipo),0,9)=="WORDPRESS")
					{
						if(!$is_empty)
						{
						//if(substr(strtoupper($tipo),0,9) == "WORDPRESS")
						//{
						//echo "<a href='../libs/enviawpconf.php?dom={$line['ID']}&ser={$line['id_servidor']}&lan={$line['idioma']}'>ConfigurarWP</a> | ";
						//}
						//if(substr(strtoupper($tipo),0,17) == "WORDPRESSAUTOBLOG")
						//{
						//echo "<a href='../libs/enviawpconfautoblog.php?dom={$line['ID']}&ser={$line['id_servidor']}&lan={$line['idioma']}'>ConfigurarWP</a> | ";
						//}
						echo "<a href='../libs/editarwpconf.php?dom={$line['ID']}&ser={$line['id_servidor']}' target='_blank'>EditarWP</a> | ";
						}
					}
					//echo "<a href='../libs/usarSmarty.php?dom={$line['ID']}&ser={$line['id_servidor']}'>InstalarTPL</a> | ";
					
					if($line['estado'] == 'I')
					{
						if(!$is_empty)
						{
						echo "<a href='../libs/enviarlimpiarDominio.php?dom={$line['ID']}&ser={$line['id_servidor']}' onclick='if(!confirm(\"Pulsa Aceptar para confirmar limpiar del dominio en servidor\"))return false'>LimpiarCarpeta</a> | ";
						}
					}
					
					echo "<a href='../libs/enviarborrarDominio.php?dom={$line['ID']}&ser={$line['id_servidor']}' onclick='if(!confirm(\"Pulsa Aceptar para confirmar el borrado del dominio en servidor\"))return false'>EliminarConfiguracion</a>";
					
				}
				//echo " | <a href='dominios.php?mode=edit&id={$line['ID']}'>Editar</a>";
				if($line['estado'] == 'P')
				{
					echo "<a href=deleteDominio.php?id={$line['ID']} onclick='if(!confirm(\"Pulsa Aceptar para confirmar el borrado del dominio\"))return false'>Borrar</a>";
				}
				if($line['estado'] == 'I')
				{
					echo " | <a href='bloquearDominio.php?dom={$line['ID']}' onclick='if(!confirm(\"Pulsa Aceptar para confirmar bloquear del dominio en servidor\"))return false'>Bloquear</a>";
					echo " | <a href='http://{$line['nombre']}' target='_blank'>Visitar</a>";
				}
			}
			else
			{
				echo "<a href='desbloquearDominio.php?dom={$line['ID']}' onclick='if(!confirm(\"Pulsa Aceptar para confirmar limpiar del dominio en servidor\"))return false'>Desbloquear</a>";
				if(substr(strtoupper($tipo),0,9)=="WORDPRESS")
				{
					echo " | <a href='../libs/editarwpconf.php?dom={$line['ID']}&ser={$line['id_servidor']}' target='_blank'>EditarWP</a>";
				}
				//http://$ip/{$line['nombre']}
				echo " | <a href='http://{$line['nombre']}' target='_blank'>Visitar</a>";
			}
			echo "</td>";
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
	//echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	header("Location:../dominios/index.php?error=true&flash=Se ha producido una excepcion: Error:" . $e->getMessage());
}


include_once("../descrip_auto/abajoDA.php");
?>