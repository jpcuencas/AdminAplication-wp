<?php
mb_internal_encoding("UTF-8");
	//include_once("../libs/libJSON/jsonwrapper_inner.php");
	include_once('../libs/jsonlib.php'); 
	 
	include_once('../libs/idiomas.php'); 
	include_once('../libs/tiposDatos.php'); 
	include_once('../libs/comprobar.php');
	include('../libs/conn.php');
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
$titulo0="Administracion de dominios";
if($mode=="new")
{
	$titulo1="Crear - Dominio";
}
else
{
	$titulo1="Editar - Dominio";
}
include_once("../descrip_auto/arribaDA.php");
	

if (isset($_POST['submitted'])) 
{ 

    $elementos=$_POST;
	unset($elementos['txtnombre']);
    unset($elementos['sctservidor']); 
    unset($elementos['scttipo']); 
    unset($elementos['txtregistro']); 
    unset($elementos['txtplantilla']);
	unset($elementos['txttitle']);
	unset($elementos['txtkeywords']);
	unset($elementos['txtdescripcion']);
	unset($elementos['txtidioma']); 
	unset($elementos['txtplant']); 
    unset($elementos['submitted']);
	if(isset($elementos['Guardar']))unset($elementos['Guardar']);
	if(isset($elementos['Guardar2']))unset($elementos['Guardar2']);
	
	if(isset($elementos['titulo']) and $elementos['titulo']!="")
	{
		if(!isset($_POST['txttitle']) or (isset($_POST['txttitle']) and $_POST['txttitle']==""))
		{
			$_POST['txttitle'] = $elementos['titulo'];
		}
	}
	
	if(isset($_POST['txttitle']) and $_POST['txttitle']!="")
	{
		if(!isset($elementos['titulo']) or (isset($elementos['titulo']) and $elementos['titulo']==""))
		{
			$elementos['titulo'] = $_POST['txttitle'];
		}
	}
	if(isset($_POST['feed_wp']) and $_POST['feed_wp']!="")
	{

		$elementos['feed_wp'] = preg_replace('/\r?\n|\r/','<br/>', $_POST['feed_wp']);
	}
	
	$valores=convertirArrayJSON($elementos);
	if(isset($valores['prefijo_wp']))
	{
		if($valores['prefijo_wp']=="")
		{
			$valores['prefijo_wp']="wp_";
		}
	}
	//$valores=json_encode($elementos);

	if (isset($_GET['id']))
	{
		$id=$_GET['id'];
	}

	$nombre = strtolower($_POST['txtnombre']);
	
	$servidor = $_POST['sctservidor'];
	$tipo = $_POST['scttipo'];
	$registro = $_POST['txtregistro'];
	$idioma = $_POST['txtidioma'];
	$plantilla = $_POST['txtplantilla'];
	$title = $_POST['txttitle'];
	$descripcion = $_POST['txtdescripcion'];
	$keywords = $_POST['txtkeywords'];
	//$estado = "Configurado";
	
	if($mode == "new" )
	{

		$sql = "INSERT INTO `dominio` 
			(`nombre`, `id_servidor`,`id_tipo`,`registro_en`,`valores`, `idioma`, `id_plantilla`,`title`, `keywords`, `descripcion`,`estado`) 
			VALUES 
			( '{$nombre}','{$servidor}','{$tipo}','{$registro}','{$valores}','{$idioma}','{$plantilla}','{$title}','{$keywords}','{$descripcion}','P');"; 
		mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli)); 
		$id = mysqli_insert_id($mysqli);

		if(!isset($_POST['Guardar']))
		{
			$_GET['dom']=$id;
			$_GET['ser']=$servidor;
			include_once("instalar.php");
		}
		//echo $sql;
		header("Location:index.php?error=false&mode=new&id=$id&flash=Se ha guardado correctamente a las ".date("H:i:s")) ;
	}
	else  //mode = edit
	{
		if(isset($id))
		{

			$sql= "UPDATE  `dominio` SET 
				`nombre` =  '{$nombre}',
				`id_servidor` =  {$servidor},
				`id_tipo` =  {$tipo},
				`registro_en` =  '{$registro}',
				`valores` =  '{$valores}',
				`idioma` =  '{$idioma}',
				`id_plantilla` =  '{$plantilla}',
				`title` =  '{$title}',
				`keywords` =  '{$keywords}',
				`descripcion` =  '{$descripcion}'
				WHERE  `ID` = $id ;";
				
			mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli)); 
	
			if(!isset($_POST['Guardar']))
			{
				$_GET['dom']=$id;
				$_GET['ser']=$servidor;
				include_once("instalar.php");
			}
			//echo $sql;
			header("Location:index.php?error=false&mode=new&id=$id&flash=Se ha actualizado correctamente a las ".date("H:i:s")) ;
		}
		else
		{
		  header("Location:index.php?error=true&mode=edit&id=$id&flash=Se ha producido un error");
		}
	}
} 
else
{

if($mode=="edit")
{
	/*
	* obtener los valores para editar un registro de la tabla
	*/
	$id=$_GET['id'];
	
	$query = "SELECT * FROM dominio WHERE id= '" . $id . "'";
	$result = $mysqli->query($query);
		
	$row=$result->fetch_array(MYSQLI_ASSOC);
	
	$nombre=$row["nombre"];
	$servidor=$row["id_servidor"];
	$tipo=$row["id_tipo"];
	$registro=$row["registro_en"];
	$idioma=$row["idioma"];
	$plantilla=$row["id_plantilla"];
	$title=$row["title"];
	$keywords=$row["keywords"];
	$descripcion=$row["descripcion"];
	$estado = $row['estado'];
	$valores = $row['valores'];
	
	// Liberar resultados
	$result->free();
	
	$valores=raros_a_html($valores);
	if(isset($valores['feed_wp']) and $valores['feed_wp']!="")
	{

		$elementos['feed_wp'] =  preg_replace("/<br\n\W*\/>/", "\n", $valores['feed_wp']);
	}
}
else 
{	//valores en caso de sea modo new y que no exista el id 
	$nombre="";
	$servidor="";
	$tipo="1";
	$registro="";
	$valores="";
	$idioma="";
	$plantilla="2";
	$title="";
	$descripcion="";
	$keywords="";
	$estado="";
	$id=-1;
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
			var idplan=0;
			//var tipo=0;
			$(function(evt) {
				setTimeout(function() {
					$('#message').css({ 'opacity' : 0.5 });
				}, 8000);
			});
			function txt_onfocus(id)
			{	
				$('#'+id).parent().next().hide();
			}
			function validarCampo(id)
			{
			if(id=='feed_wp')
			{
				comprobarCampoURL('feed_wp');
			}
			else
			{
				if(($('#'+id).attr('required'))&&($('#'+id).val()==""))
				{
					return false;
				}
				if($('#'+id).val()!="")
				{
					var type=$('#'+id).attr('type')
					$('#'+id+'msg').hide();
					switch(type) {
						case 'number':
								if(/^\d+$/.test($('#'+id).val())){
									console.log("valid number");
									return true;
								} else {
									console.log("invalid number");
									return false;
								}
							break;
						case 'date':
						
							break;
						case 'email':
								if(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/.test($('#'+id).val())){
									console.log("valid email");
									return true;
								} else {
									console.log("invalid email");
									return false;
								}
							break;
						case 'url':
								if(!validarURL($('#'+id).val()))
								{
									$('#'+id+'msg').show();
									return false;
								}
								else
								{
									return true;
								}
							break;
						case 'tel':
								if(/^\+?\d{1,3}?[- .]?\(?(?:\d{2,3})\)?[- .]?\d\d\d[- .]?\d\d\d\d$/.test($('#'+id).val())){
									console.log("valid telefono");
									return true;
								} else {
									console.log("invalid telefono");
									return false;
								}
							break;
						case 'file':
								if(/^([0-9a-zA-Z]([_.w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-w]*[0-9a-zA-Z].)+([a-zA-Z]{2,9}.)+[a-zA-Z]{2,3})$/.test($('#'+id).val())){
									console.log("valid telefono");
									return true;
								} else {
									console.log("invalid telefono");
									return false;
								}
							break;
						default:

					}
				}
			}
			}
			function cambiarPlantilla(t)
			{
			var ventana;
				tipo=t;
				var caracteristicasVentana='height=650, ' + 'width=950, ' + 'resizable=0, ' + ' toolbar=no, ' + 'location=no, ' + ' directories=no, ' + 'menubar=no, ' + 'status=no, ' + ' scrollbars=no, ' + 'copyhistory=no';
				if (!ventana || ventana.closed) {
					ventana = window.open("galeriaPlantillas.php?tipo="+tipo,"_blank",caracteristicasVentana);
					
				} else if (ventana.focus) {

					ventana.focus();
				}
			}
			
			function cambiarTipo(item,pla,id)
			{
				
				$.get("parametrosDominio.php", { ele: item, dom: id},
				  function(data){
					var elemento = document.getElementById("parametros");
					elemento.innerHTML="";
					elemento.innerHTML=data;
				  });
				  
				  $.get("parametrosPlantilla.php", { ele: item, plan: pla},
				  function(data){
					var elemento = document.getElementById("txtplantilla");
					elemento.innerHTML="";
					if(data=="")
					{
						document.getElementById("plantillasprf").style.display="none";
					}
					else
					{
						document.getElementById("plantillasprf").style.display="inline";
					}
					elemento.innerHTML=data;
					});
				$.get("parametrosImagen.php", { ele: item,plan: pla},
				  function(data){
					var elemento = document.getElementById("imgPlantilla");
					 elemento.src = '';
					 elemento.src = data;
				  });  
			}
			function cambiarImagen(item,pla)
			{
				$.get("parametrosImagen.php", { ele: item,plan: pla},
				  function(data){
					var elemento = document.getElementById("imgPlantilla");
					 elemento.src = '';
					 elemento.src = data;
				  });
			}
			
			$(document).ready(
			  cambiarTipo(<?php echo ((isset($tipo)) ? "$tipo" : ""); ?>,<?php echo ((isset($plantilla)) ? "$plantilla" : "");?>,<?php echo ((isset($id)) ? "$id" : ""); ?>)
			
			);
			
			function guardarInstalar()
			{
				if(document.getElementById('feed_wp'))
				{
					if(comprobarCampoURL('feed_wp'))
					{
						if(confirm("¿Esta seguro? Guardando e instalando se borrara todo lo anterior"))
						{
							$("#formulario").submit();
							return true;
						}
						else
						{
							return false;
						}
					}
					return false;
				}
				else
				{
					if(confirm("¿Esta seguro? Guardando e instalando se borrara todo lo anterior"))
					{
						$("#formulario").submit();
						return true;
					}
					else
					{
						return false;
					}
				}
			}
			function guardar()
			{
				if(document.getElementById('feed_wp'))
				{
					if(comprobarCampoURL('feed_wp'))
					{
						console.log('enviando...')
						//$("#formulario").submit();
						return true;
					}
					console.log('fallo envio')
					return false;
				}
				else
				{
					$("#formulario").submit();
					return true;
				}
			}
			function comprobarCampoURL(id)
			{
				if($('#'+id).val()!="")
				{
				//console.log('id: '+id)
				//console.log('url: ' + $('#'+id).html())
				$('#'+id+'msg').hide();
				var urls = $('#'+id).val()
				if(urls=="")
					return true;
				console.log(urls)
					
					
					var split = urls.split('\n');
					for(var i=0; i < split.length; i++)
					{
						if(!validarURL(split[i]))
						{
							$('#'+id+'msg').show();
							return false;
						}
					}
				}
				return true;

			}
			function validarURL(url)
			{
			console.log(url)
				//   // /^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi
				//solo (http:) test //  /^http:\/\/[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}([\/\-\.]{1}[a-z0-9]+)*/i
				//  test fail //  /^(https?://)?(([\\w!~*'().&=+$%-]+: )?[\\w!~*'().&=+$%-]+@)?(([0-9]{1,3}\\.){3}[0-9]{1,3}|([\\w!~*'()-]+\\.)*([\\w^-][\\w-]{0,61})?[\\w]\\.[a-z]{2,6})(:[0-9]{1,4})?((/*)|(/+[\\w!~*'().;?:@&=+$,%#-]+)+/*)$/
				//    //   /^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$/ 
				//  funciona mas menos  //   /^(http?:\/\/)+([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$/
				if(/^(http?:\/\/)+([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$/.test(url)){
					console.log("valid URL");
					return true;
				} else {
					console.log("invalid URL");
					return false;
				}
				return false;
			}
			
	</script>

<div class="form">
	<form action='' method='POST' enctype="multipart/form-data" name="formulario" id="formulario" class="formulario" onsubmit="return guardar();">
		<label form="txtnombre">Nombre del dominio (*):</label>
		<p><input type='text' required <?php echo ((isset($mode) and $mode=="edit") ? " readonly " : ""); ?> name='txtnombre' id='txtnombre' value="<?php echo ((isset($nombre)) ? "$nombre" : ""); ?>"/></p>
		<label form="sctServidor">Servidor:</label>
		<p><select name='sctservidor' id='sctservidor' >
		<?php
			//cogemos el resto de registros de la vase de datos y poblamos el select
			$query1 = "SELECT id,nombre FROM servidor";
			$result1 = $mysqli->query($query1);
			while ($line1 = $result1->fetch_array(MYSQLI_ASSOC)) {

					echo "<option value=" . $line1["id"] . ((isset($servidor) and ($line1["id"]==$servidor))? " selected" : "") . ">" . $line1["nombre"] . "</option>";
					echo"\n";

			}
			
			// Liberar resultados
			$result1->free();
		?>
		</select></p>
		<label form="txtregistro">Registrado en (*):</label>
		<p><input type='text' required name='txtregistro' id='txtregistro' value="<?php echo ((isset($registro)) ? "$registro" : ""); ?>"/></p>

		<label form="txtidioma">Idioma:</label>
		<p><!--<input type='text' name='txtidioma' id='txtidioma' value=""/>-->
		<select id="txtidioma" name="txtidioma">
		<?php
		$arr = array('ES_ES', 'DE_DE', 'FR_FR', 'EN_EN', 'IT_IT', 'PT_PT');
		foreach ($arr as &$value) {
			$aux=$vectorIdioma["$value"];

			echo "<option value='" . $value . "' " . ((isset($idioma) and ($value==$idioma))? ' selected' : '') . ">$aux</option>";
		}
		?>	
		</select></p>
		<label form="scttipo">Tipo:</label>
		<p><select name='scttipo' id='scttipo' onchange="cambiarTipo(this.value);return false;">
		<?php 
			//cogemos el resto de registros de la vase de datos y poblamos el select
			$query4 = "SELECT id,nombre,formato FROM tipopagina";
			$result4 = $mysqli->query($query4);
			while ($line = $result4->fetch_array(MYSQLI_ASSOC)) {
					echo "<option value=" . $line["id"] . ((isset($tipo) and ($line["id"]==$tipo))? ' selected' : '') . ">" . $line["nombre"] . "</option>";
					echo"\n";
			}
			// Liberar resultados
			$result4->free();
		?>
		</select></p>
		<span id="plantillasprf">
		<label form="txtplantilla">Plantilla:</label>
		<p><input type='hidden' name='txtplant' id='txtplant' value=""/>
		<select id="txtplantilla" onchange="cambiarImagen(document.getElementById('scttipo').value,this.value);return false;" name="txtplantilla"></select> | <input type='button' name="Cambiar" class="buttom" id="Cambiar" value='Cambiar' onclick="cambiarPlantilla(document.getElementById('scttipo').value);return false;" />
		</p>
		<p><span>
			<img src="" id="imgPlantilla" width="300px" height="200px" name="imgPlantilla" class="imgPlantilla" alt="plantilla" />
		</span></p>
		<label form="txttitle">Title de la pagina(meta)(170 caracteres):</label>
		<p><input type='text' name='txttitle' id='txttitle' maxlength="170" size="170" value="<?php echo ((isset($title)) ? "$title" : ""); ?>"/></p>
		<label form="txtdescripcion">Metaetiqueta Descripcion:</label>
		<p><textarea type='text' row='4' colum='50' name="txtdescripcion" id='txtdescripcion' onchange="javascript:comprobarURL(this.id);return false;"><?php echo ((isset($descripcion)) ? "$descripcion" : ""); ?></textarea></p>
		<label form="txtkeywords">Metaetiqueta Keywords (separado por comas):</label>
		<p><input type='text' name='txtkeywords' id='txtkeywords' maxlength="255" size="255" value="<?php echo ((isset($keywords)) ? "$keywords" : ""); ?>"/></p>
		</span>
		<aside id="parametros" name="parametros" class="parametros"> 
		</aside>
		
		<p><input type='submit' name="Guardar" id="Guardar" value='Guardar' /><input type='button' name="Guardar2" id="Guardar2" style="background-color: #008287;
color: #fff;" onclick="guardarInstalar();" value='Guardar e Instalar' /><input type='hidden' value='1' name='submitted' /> &oacute;&nbsp;&nbsp;&nbsp;<a href='index.php' class="button">Volver</a></p>
	</form>
<div>

<?php
}
	include_once("../descrip_auto/abajoDA.php");
?>
