<?php
	include('../libs/conn.php'); 
	include_once('../libs/tiposDatos.php'); 
	include_once('../libs/comprobar.php'); 
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
$titulo="Administracion tipos de pagina";
if($mode=="new")
{
	$titulo1="Crear - Tipos de pagina";
}
else
{
	$titulo1="Editar - Tipos de pagina";
}
include_once("../descrip_auto/arribaDA.php");

if (isset($_POST['submitted'])) 
{ 
	if (isset($_GET['id']))
	{
		$id=$_GET['id'];
	}
	$nombre = $_POST['txtnombre'];
	$descripcion = $_POST['txtdescripcion'];
	$formato = $_POST['txtformato'];
	
	$cadena=split(",",$formato);
	if(count($cadena)==3)
	{
		$cadena=split(",",$formato, 3);
		$cadena1=trim($cadena[0]);
		$cadena2=trim($cadena[1]);
		$cadena3=trim($cadena[2]);
		
		if(preg_match("/^[a-zA-Z_0-9]+$/", $cadena1))
		{
			echo "Parametro 1 del formato incorrecto";
			unset($_POST['submitted']);
			//header("Location:tipos.php");
		}

		$noesta=true;
		for($i=0;$i < count($vectorTipos) and $noesta;$i++)
		{
			if($vectorTipos[$i]==$cadena3)
			{
				$noesta=false;
			}
		}
		if(!$noesta)
		{
			echo "Parametro 2 del formato incorrecto";
			unset($_POST['submitted']);
		}
	}
	else
	{
		echo "Numero de parametros de formato incorrecto";
		unset($_POST['submitted']);
	}
	if($mode == "new" )
	{
		$nombre=raros_a_html($nombre);
		$descripcion=raros_a_html($descripcion);
		$formato=raros_a_html($formato);
		$sql = "INSERT INTO `tipopagina` 
			(`nombre`, `descripcion`, `formato`) 
			VALUES 
			( '{$nombre}','{$descripcion}','{$formato}');"; 
		mysqli_query($mysqli,$sql) or die(mysqli_error()); 
		$id = mysqli_insert_id($mysqli);
	
	}
	else  //mode = edit
	{
		$nombre=raros_a_html($nombre);
		$descripcion=raros_a_html($descripcion);
		$formato=raros_a_html($formato);
		if(isset($id))
		{
			$sql= "UPDATE  `tipopagina` SET 
				`nombre` =  '{$nombre}',
				`descripcion` =  '{$descripcion}',
				`formato` =  '{$formato}'
				WHERE  `ID` =$id;";
			mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli)); 
		}
		else
		{
		 echo "Error: id incorrecrto";
		  header("Location:index.php?error=true&mode=edit&id=$id&flash=Se ha producido un error") ;
		}
	}
	header("Location:index.php?error=false&mode=edit&id=$id&flash=Se ha guardado correctamente a las ".date("H:i:s")) ;
	

} 
else
{
if (isset($_GET['id']))
{
	/*
	* obtener los valores para editar un registro de la tabla
	*/
	$id=$_GET['id'];
	
	$query = "SELECT * FROM tipopagina WHERE id= '" . $id . "'";
	$result = $mysqli->query($query);
		
	$row=$result->fetch_array(MYSQLI_ASSOC);
	
	$nombre=$row["nombre"];
	$descripcion=$row["descripcion"];
	$formato=$row["formato"];
	// Liberar resultados
	$result->free();
	//Cerrar conexion
	$mysqli->close();	
		$nombre=raros_a_html($nombre);
		$descripcion=raros_a_html($descripcion);
		$formato=raros_a_html($formato);
}
else
{	//valores en caso de sea modo new y que no exista el id 
	$nombre="";
	$descripcion="";
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
?>
<script type="text/javascript">
var vectorTipos = new Array('texto','numero','vartexto','fecha','email','url','telf','password','fuente','imagen','color','idioma','tiempoAutoblog','maxperfetch','maxfeed');
		
		function txt_onfocus(id)
		{	
			$('#'+id).parent().next().hide();
		}
		function validarFormato(id) 
		{
			var campo = document.getElementById(id);
			var formato = document.getElementById(id).value;
			var cadenas = new Array() 
			
			cadenas=formato.split("\n");
			var i=0;
			for(i=0;i < cadenas.length; i++)
			{
				cadena=cadenas[i].split(",",3);
				if(cadena.length==3)
				{
					cadena1=cadena[0].trim();
					cadena2=cadena[1].trim();
					cadena3=cadena[2].trim();
					var RegExPattern = /^[a-zA-Z_0-9]+$/;
					var errorMessage = 'expresion Incorrecta.';
					if (!((cadena1.match(RegExPattern)) && (cadena1!=''))) {
						console.log("Parametro 1 incorrecto javascript");
						campo.focus();
						$('#'+id+'msg').show();
						return false;
					}
					
					
					var noesta=true;
					var j=0;
					for(j=0;j < vectorTipos.length && noesta;j++)
					{
						if(vectorTipos[j]==cadena3)
						{
							noesta=false;
						}
					}
					if(noesta)
					{
						console.log("Parametro 3 incorrecto javascript");
						campo.focus();
						$('#'+id+'msg').show();
						return false;
					}
				}
				else
				{
					console.log("Numero de parametros incorrecto javascript");
					campo.focus();
					$('#'+id+'msg').show();
					return false;
				}
			}
			$('#'+id+'msg').hide();
			return true;
		} 
</script>
<div class="form">
	<form action='' method='POST' name="formulario" id="formulario" class="formulario">
		<label form="txtnombre">Nombre (*):</label>
		<p><input type='text' name='txtnombre' id='txtnombre' required value="<?php echo ((isset($nombre)) ? "$nombre" : ""); ?>"/></p>
		<label form="txtdescripcion">Descripci&oacute;n:</label>
		<p><textarea type='text' row='4' colum='50' name='txtdescripcion' id='txtdescripcion'><?php echo ((isset($descripcion)) ? "$descripcion" : ""); ?></textarea></p>
		<label form="txtformato">Formato:</label>
		<p><textarea type='text' name='txtformato' id='txtformato' onblur='validarFormato(this.id);' onchange='validarFormato(this.id);' onfocus='txt_onfocus(this.id)'><?php echo ((isset($formato)) ? "$formato" : ""); ?></textarea></p>
		<div style='display:none;width:396px;' id='txtformatomsg' ><p class='mensajeer' width='400' style='width:400;'>Campo incorrecto</p></div>
		<p><input type='submit' onclick="validarFormato();" value='Guardar' /><input type='hidden' value='1' name='submitted' /> &oacute;&nbsp;&nbsp;&nbsp;<a href='index.php' class="button">Volver</a></p>
	</form>
<div>
<?php
}

	include_once("../descrip_auto/abajoDA.php");
?>
