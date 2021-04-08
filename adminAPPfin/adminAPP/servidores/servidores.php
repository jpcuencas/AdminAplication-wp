<?php
		include('../libs/conn.php'); 
		include('../libs/comprobar.php'); 
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
$titulo="Administracion de servidores";
if($mode=="new")
{
	$titulo1="Crear - Servidor";
}
else
{
	$titulo1="Editar - Servidor";
}
include_once("../descrip_auto/arribaDA.php");

if (isset($_POST['submitted'])) 
{ 
	if (isset($_GET['id']))
	{
		$id=$_GET['id'];
	}
	$hosting = $_POST['txthosting'];
	$proveedor = $_POST['txtproveedor'];
	$ip = $_POST['txtip'];
	$usuarioweb = $_POST['txtusuarioweb'];
	$contrasenyaweb = $_POST['txtcontrasenyaweb'];
	$servidorftp = $_POST['txtservidorftp'];
	$usuarioftp = $_POST['txtusuarioftp'];
	$contrasenyaftp = $_POST['txtcontrasenyaftp'];

	if($mode == "new" )
	{
	
		$sql = "INSERT INTO `servidor` 
			(`nombre`, `proveedor`, `ip`,`usuario_web`, `contrasenya_web`,`servidor_ftp`,`usuario_ftp`,`contrasenya_ftp`) 
			VALUES 
			('{$hosting}','{$proveedor}','{$ip}','{$usuarioweb}','{$contrasenyaweb}','{$servidorftp}','{$usuarioftp}','{$contrasenyaftp}');"; 
		mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli)); 
		$id = mysqli_insert_id($mysqli);

	}
	else  //mode = edit
	{
		if(isset($id))
		{
		
			$sql= "UPDATE  `servidor` SET 
				`nombre` =  '{$hosting}',
				`proveedor` =  '{$proveedor}',
				`ip` =  '{$ip}',
				`usuario_web` =  '{$usuarioweb}',
				`contrasenya_web` =  '{$contrasenyaweb}',
				`servidor_ftp` =  '{$servidorftp}',
				`usuario_ftp` =  '{$usuarioftp}',
				`contrasenya_ftp` =  '{$contrasenyaftp}'
				WHERE  `ID` =$id;";
				//echo "sql=".$sql."<br/>";
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
	
	$query = "SELECT * FROM servidor WHERE id= '" . $id . "'";
	$result = $mysqli->query($query);
		
	$row=$result->fetch_array(MYSQLI_ASSOC);
	
	$hosting=$row["nombre"];
	$proveedor=$row["proveedor"];
	$ip=$row["ip"];
	$usuarioweb=$row["usuario_web"];
	$contrasenyaweb=$row["contrasenya_web"];
	$servidorftp = $row['servidor_ftp'];
	$usuarioftp=$row["usuario_ftp"];
	$contrasenyaftp=$row["contrasenya_ftp"];
	// Liberar resultados
	$result->free();
	//Cerrar conexion
	$mysqli->close();
}
else
{	//valores en caso de sea modo new y que no exista el id 
	$hosting="";
	$proveedor="";
	$ip="";
	$usuarioweb="";
	$contrasenyaweb="";
	$usuarioftp="";
	$servidorftp="";
	$contrasenyaftp="";
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
			function IP_onfocus(id)
			{
				$('#'+id+'msg').hide();
			}
			function comprobarCampoIP(id)
			{
				$('#'+id+'msg').hide();
				var ip=$('#'+id).val();
				if(/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/.test(ip))
				{
					console.log("valid IP");
					$('#'+id+'msg').hide();
				} else 
				{
					console.log("invalid IP");
					$('#'+id+'msg').show();
				}
			}
			

	</script>
<div class="form">
	<form action='' method='POST' name="formulario" id="formulario" class="formulario">
		<label form="txthosting">Nombre (*):</label>
		<p><input type='text' name='txthosting' id='txthosting' required value="<?php echo ((isset($hosting)) ? "$hosting" : ""); ?>"/></p>
		<label form="txtip">Proveedor:</label>
		<p><input type='text' name='txtproveedor' id='txtproveedor' value="<?php echo ((isset($proveedor)) ? "$proveedor" : ""); ?>"/></p>
		<label form="txtip">ip (*):</label>
		<p><input type='text' name='txtip' id='txtip' required onfocus="javascript:IP_onfocus(this.id)" onblur="javascript:comprobarCampoIP(this.id)" onchange="javascript:comprobarCampoIP(this.id)" value="<?php echo ((isset($ip)) ? "$ip" : ""); ?>"/></p>
		<div style='display:none;width:396px;' id='txtipmsg' ><p class='mensajeer' width='400' style='width:400;'>Campo incorrecto</p></div>
		<label form="txtusuarioweb">Usuario web:</label>
		<p><input type='text' name='txtusuarioweb' id='txtusuarioweb' value="<?php echo ((isset($usuarioweb)) ? "$usuarioweb" : ""); ?>"/></p>
		<label form="txtcontrasenyaweb">Contrase&ntilde;a:</label>
		<p><input type='text' name='txtcontrasenyaweb' id='txtcontrasenyaweb' value="<?php echo ((isset($contrasenyaweb)) ? "$contrasenyaweb" : ""); ?>"/></p>
		<label form="txtusuario">Servidor FTP (*):</label>
		<p><input type='text' name='txtservidorftp' required id='txtservidorftp' value="<?php echo ((isset($servidorftp)) ? "$servidorftp" : ""); ?>"/></p>
		<label form="txtusuario">Usuario FTP (*):</label>
		<p><input type='text' name='txtusuarioftp' required id='txtusuarioftp' value="<?php echo ((isset($usuarioftp)) ? "$usuarioftp" : ""); ?>"/></p>
		<label form="txtcontrasenya">Contrase&ntilde;a (*):</label>
		<p><input type='text' name='txtcontrasenyaftp' required id='txtcontrasenyaftp' value="<?php echo ((isset($contrasenyaftp)) ? "$contrasenyaftp" : ""); ?>"/></p>
	
		<p><input type='submit' value='Guardar' /><input type='hidden' value='1' name='submitted' /> &oacute;&nbsp;&nbsp;&nbsp;<a href='index.php' class="button">Volver</a></p>
	</form>
<div>
<?php
}
	include_once("../descrip_auto/abajoDA.php");
?>
