<?php
	include('../libs/conn.php'); 
	include_once('../libs/comprobar.php'); 
	include_once('../libs/subirficheroshtml5.php'); 
/*
* modo edit y modo new en la misma pagina
*/
if (isset($_GET['mode']))
{
	$mode=$_GET['mode'];
}
else
{
	if (isset($_POST['mode']))
	{
		$mode=$_POST['mode'];
	}
	else
	{	//valor por defecto
		$mode="new";
	}
}


//plantilla maestra de la pagina
$titulo="Administracion Plantillas de pagina";
if($mode=="new")
{
	$titulo1="Crear - Plantilla de pagina";
}
else
{
	$titulo1="Editar - Plantilla de pagina";
}
include_once("../descrip_auto/arribaDA.php");

if (isset($_POST['submitted'])) 
{ 
	if (isset($_GET['id']))
	{
		$id=$_GET['id'];
	}
	$patron="/\s/";
	$sustitucion='_';
	$nombre=preg_replace($patron, $sustitucion, $_POST['txtnombre']);
	
	$descripcion = $_POST['txtdescripcion'];
	$prefijo = $_POST['txtprefijo'];
	$tipo = $_POST['scttipo'];
	
	if(!file_exists("../dominios/Plantillas/" . $_POST['txtnombre']))
	{  	if(!mkdir("../dominios/Plantillas/" . $_POST['txtnombre'], 0777, true)) 
		{
			die('Fallo al crear las carpetas...\n<br/>');
		}
	}
	
	$directorio="../dominios/Plantillas/" . $_POST['txtnombre'];
	if(isset($_FILES['ficherotpl']))
		subirficherosHTML5('ficherotpl',$directorio);
	if(isset($_FILES['ficherozip']))
		subirficherosHTML5('ficherozip',$directorio);
	if(isset($_FILES['ficherosql']))
		subirficherosHTML5('ficherosql',$directorio);
	if(isset($_FILES['ficherojpg']))
		subirficherosHTML5('ficherojpg',$directorio);
	
	if($mode == "new" )
	{	
		$sql = "INSERT INTO `plantilla` 
			(`nombre`, `descripcion`, `id_tipo`,`prefijo`) 
			VALUES 
			( '{$nombre}','{$descripcion}','{$tipo}','{$prefijo}');"; 
		mysqli_query($mysqli,$sql) or die(mysqli_error()); 
		$id = mysqli_insert_id($mysqli);
	
	}
	else  //mode = edit
	{
		if(isset($id))
		{
			$nombre=raros_a_html($nombre);
			$descripcion=raros_a_html($descripcion);
		
			$sql= "UPDATE  `plantilla` SET 
				`nombre` =  '{$nombre}',
				`descripcion` =  '{$descripcion}',
				`id_tipo` =  '{$tipo}',
				`prefijo` = '{$prefijo}'
				WHERE  `ID` =$id;";
			mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli)); 
		}
		else
		{
		 echo "Error: id incorrecrto";
		  header("Location:index.php?error=true&flash=Se ha producido un error") ;
		}
	}
	
	if(!file_exists("../dominios/Plantillas/" . $nombre))
	{
		header("Location:index.php?error=false&flash=Se ha guardado correctamente a las ".date("H:i:s")."<br/>Pero la plantilla no existe") ;
	}
	else
	{
		header("Location:index.php?error=false&flash=Se ha guardado correctamente a las ".date("H:i:s")) ;
	}
} 
else
{
if (isset($_GET['id']))
{
	/*
	* obtener los valores para editar un registro de la tabla
	*/
	$id=$_GET['id'];
	
	$query = "SELECT * FROM plantilla WHERE id= '" . $id . "'";
	$result = $mysqli->query($query);
		
	$row=$result->fetch_array(MYSQLI_ASSOC);
	
	$nombre=$row["nombre"];
	$descripcion=$row["descripcion"];
	$prefijo=$row["prefijo"];
	$tipo=$row["id_tipo"];
	
	$query1 = "SELECT id,nombre FROM tipopagina WHERE id= '" . $tipo . "'";
	$result1 = $mysqli->query($query1);
		
	$row1=$result1->fetch_array(MYSQLI_ASSOC);
	$tiponom=$row1["nombre"];
	// Liberar resultados
	$result->free();
}
else
{	//valores en caso de sea modo new y que no exista el id 
	$nombre="";
	$descripcion="";
	$prefijo="wp_";
	$tipo="1";
}

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
	
}	
	?>
	<script type="text/javascript">
			$(document).ready( function ()
			{
				tipo='<?php echo ((isset($tiponom)) ? "$tiponom" : ""); ?>';
				
				if(tipo.substr(0, 9).toUpperCase()=='WORDPRESS')
				{
					$('#tabla').show();
					document.getElementById('tabla').style.display='inline';
				}
			});
			
			$(function(evt) {
				setTimeout(function() {
					$('#message').css({ 'opacity' : 0.5 });
				}, 8000);
			});
		<?php if(isset($nombre)and $nombre!=""){?>
			function descargarFichero(tipo)
			{
				$.get("descargarFichero.php",{tip:tipo,nom:<?php echo ((isset($nombre)) ? "$nombre" : ""); ?>},
				  function(data){
				  document.getElementById("cosas").innertHTML=data;
				  });
			}
		<?php }?>
			function cambiarTipo1()
			{
				//var elemento=document.getElementById('tabla');
				tipo=document.getElementById('scttipo').options[document.getElementById('scttipo').selectedIndex].text;
				if(tipo.substr(0, 9).toUpperCase()=='WORDPRESS')
				{
					$('#tabla').show();
					document.getElementById('tabla').style.display='inline';
				}
				else
				{
					$('#tabla').hide();
					document.getElementById('tabla').style.display='none';
				}
			
			}
			
	</script>

<div class="form">
	<form action='' method='POST' name="formulario" id="formulario" class="formulario" enctype="multipart/form-data" novalidate>
		<input type="hidden" name="MAX_FILE_SIZE" value="20971520" /> 
		<label form="txtnombre">Nombre (*):</label>
		<p><input type='text' name='txtnombre' id='txtnombre' required value="<?php echo ((isset($nombre)) ? "$nombre" : ""); ?>"/></p>
		<label form="txtdescripcion">Descripci&oacute;n:</label>
		<p><textarea type='text' row='10' colum='200' name='txtdescripcion' id='txtdescripcion'><?php echo ((isset($descripcion)) ? "$descripcion" : ""); ?></textarea></p>
		<label form="scttipo">Tipo:</label>
		<p><select name='scttipo' id='scttipo' onchange="cambiarTipo1();return false;">
		<?php 
			//cogemos el resto de registros de la vase de datos y poblamos el select
			$query1 = "SELECT id,nombre,formato FROM tipopagina";
			$result1 = $mysqli->query($query1);
			while ($line = $result1->fetch_array(MYSQLI_ASSOC)) {
					echo "<option value=" . $line["id"] . ((isset($tipo) and ($line["id"]==$tipo))? ' selected' : '') . ">" . $line["nombre"] . "</option>";
					echo"\n";
			}
		?>
		</select></p>
		<span style="display:none;" id="tabla" >
			<label form="txtprefijo">Prefijo Tabla si es wordpress (*):</label>
			<p><input type='text' name='txtprefijo' id='txtprefijo' required value="<?php echo ((isset($prefijo)) ? "$prefijo" : ""); ?>"/></p>
		</span>
		<label form="ficherotpl">Plantilla php (.tpl):</label>
		<p><input type="file" id="ficherotpl" name="ficherotpl" accept="application/tpl" name="" />
<?php if(file_exists("../dominios/Plantillas/" . $nombre . "/index.tpl")){ ?>		
		| <a href="descargarFichero.php?mode=<?php echo ((isset($mode)) ? "$mode" : ""); ?>&id=<?php echo ((isset($id)) ? "$id" : ""); ?>&nom=<?php echo ((isset($nombre)) ? "$nombre" : ""); ?>&tip=tpl">Bajar ficheros</a>
<?php }?>		
		</p>
		<label form="ficherozip">Ficheros (.zip):</label>
		<p><input type="file" id="ficherozip" name="ficherozip" accept='application/zip,application/rar' name="" />
<?php if(file_exists("../dominios/Plantillas/" . $nombre . "/ficheros.zip")){ ?>	
		| <a href="descargarFichero.php?mode=<?php echo ((isset($mode)) ? "$mode" : ""); ?>&id=<?php echo ((isset($id)) ? "$id" : ""); ?>&nom=<?php echo ((isset($nombre)) ? "$nombre" : ""); ?>&tip=zip">Bajar ficheros</a>
<?php }?>
		</p>
		<label form="ficherosql">Base de datos (.sql):</label>
		<p><input type="file" id="ficherosql" name="ficherosql" accept="application/sql" name="" />
<?php if(file_exists("../dominios/Plantillas/" . $nombre . "/esquema.sql")){ ?>
		| <a href="descargarFichero.php?mode=<?php echo ((isset($mode)) ? "$mode" : ""); ?>&id=<?php echo ((isset($id)) ? "$id" : ""); ?>&nom=<?php echo ((isset($nombre)) ? "$nombre" : ""); ?>&tip=sql">Bajar ficheros</a>
<?php }?>		
		</p>
		<label form="ficherojpg">Imagen plantilla (.jpg):</label>
		<p><input type="file" id="ficherojpg" name="ficherojpg" name="" />
<?php if(file_exists("../dominios/Plantillas/" . $nombre . "/imagen.jpg")){ ?>
		| <a href="descargarFichero.php?mode=<?php echo ((isset($mode)) ? "$mode" : ""); ?>&id=<?php echo ((isset($id)) ? "$id" : ""); ?>&nom=<?php echo ((isset($nombre)) ? "$nombre" : ""); ?>&tip=jpg">Bajar ficheros</a>
<?php }?>
		</p>
		
		<p><input type='submit' value='Guardar' /><input type='hidden' value='1' name='submitted' /> &oacute;&nbsp;&nbsp;&nbsp;<a href='index.php' class="button">Volver</a></p>
		<p id="cosas"></p>
	</form>

<div>
	<?php
		if($mode=="edit" and file_exists("../dominios/Plantillas/" . $nombre . "/imagen.jpg"))
		{
	?>
	<aside id="imagen" name="imagen" style="float:right;margin-top:-400px;margin-right:400px;" class="span6 pull-right">
		<img src="<?php echo "../dominios/Plantillas/" . $nombre . "/imagen.jpg"; ?>" height="200" width="400"/>
	</aside>
	<?php
		}
	?>
<?php
	$result1->free();
}
	//Cerrar conexion
	$mysqli->close();
	include_once("../descrip_auto/abajoDA.php");
?>
