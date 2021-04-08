<?php
include('../libs/conn.php'); 
include_once('../libs/tiposDatos.php');
include_once('../libs/navegador.php');
if(isset($_GET['ele']))
{
	$item=$_GET['ele'];
}
if(isset($_GET['plan']))
{
	$plantilla=$_GET['plan'];
}
if(isset($_GET['dom']))
{
	$dom=$_GET['dom'];
}
else
	$dom=-1;
$query = "SELECT id,nombre,formato FROM tipopagina WHERE id='" . $item . "'";
$result = $mysqli->query($query);
$line = $result->fetch_array(MYSQLI_ASSOC); 
$formato=$line["formato"];

$user_agent = $_SERVER['HTTP_USER_AGENT'];
$posicion = strrpos($user_agent, "MSIE");
$ie='';
if ($posicion === false) {
$ie = false;
} else {
$ie = true;
}
/*echo "<script type='text/javascript'>
		function txt_onfocus(id)
		{	
			$('#'+id).parent().next().hide();
		}
		function validarCampo(id)
		{
			var type=$('#'+id).attr('type')
			switch(type) {
				case 'number':
				
					break;
				case 'date':
				
					break;
				case 'email':
				
					break;
				case 'url':
				
					break;
				case 'tel':
				
					break;
				case 'file':
				
					break;
				default:

			}
		}
		
	</script>";*/
	if(isset($formato) and ($formato!=''))
	{
		$lineas=split("\n",$formato);
		foreach($lineas as $linea)
		{

			$cadena=split(",",$linea);
			if(count($cadena)==3)
			{
				$cadena=split(",",$linea, 3);
				
				$nombre=trim($cadena[0]);
				$label=trim($cadena[1]);
				$tipo=trim($cadena[2]);

				if(!(preg_match("/^[a-zA-Z_ 0-9]+$/", $nombre)))
					echo "formato de nombre incorrecto";
				else
				{
					$noesta=true;
					for($i=0;$i < count($vectorTipos) and $noesta;$i++)
					{
						if($vectorTipos[$i]==$tipo)
						{
							$noesta=false;
						}
					}
					if($noesta)
					{
						echo "formato de tipo incorrecto";
					}
					else
					{
						$query1 = "SELECT id,nombre,valores FROM dominio WHERE id='" . $dom . "'";
						$result1 = $mysqli->query($query1);
						$line1 = $result1->fetch_array(MYSQLI_ASSOC);
						$valores=json_decode($line1["valores"],true);
						if(isset($valores['feed_wp']) and $valores['feed_wp']!="")
						{
							$valores['feed_wp']= str_replace("<br/>", "\n", $valores['feed_wp']);
						}
						echo '<label form="' . $nombre . '">' . $label . ':</label>';
						
						switch($tipo)
						{
							case 'vartexto':
								echo "<p><textarea type='text' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)' name='" . $nombre . "' id='" . $nombre . "'>"; echo ((isset($valores["$nombre"])) ? $valores["$nombre"] : "");
								echo "</textarea></p><span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>";
								break;
							case 'numero':
								echo "<p><input type='number' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)' name='" . $nombre . "' id='" . $nombre . "' value='"; echo ((isset($valores["$nombre"])) ? $valores["$nombre"] : ""); 
								echo "'/></p><span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>\n";
								break;
							case 'fecha':
								echo "<p><input type='date' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)' row='4' colum='50' name='" . $nombre . "' id='" . $nombre . "' value='"; echo ((isset($valores["$nombre"])) ? $valores["$nombre"] : ""); 
								echo "'/></p><span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>\n";
								break;
							
							case 'email':
								echo "<p><input type='email' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)' name='" . $nombre . "' id='" . $nombre . "' value='"; echo ((isset($valores["$nombre"])) ? $valores["$nombre"] : ""); 
								echo "'/></p><span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>\n";
								break;
							case 'url':
								echo "<p><input type='url' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)' name='" . $nombre . "' id='" . $nombre . "' value='"; echo ((isset($valores["$nombre"])) ? $valores["$nombre"] : ""); 
								echo "'/></p><span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>\n";
								break;
							case 'telf':
								echo "<p><input type='tel' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)' name='" . $nombre . "' id='" . $nombre . "' value='"; echo ((isset($valores["$nombre"])) ? $valores["$nombre"] : ""); 
								echo"'/></p><span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>\n";
								break;
							case 'imagen':
								echo "<p><input type='file' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)' name='" . $nombre . "' id='image_file' onchange='fileSelected();'/>
								<input type='button' value='Upload' onclick='startUploading()'/></p>
								<span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>
								<div id='fileinfo'>
									<div id='filename'></div>
									<div id='filesize'></div>
									<div id='filetype'></div>
									<div id='filedim'></div>
								</div>
								<div id='error'>You should select valid image files only!</div>
								<div id='error2'>An error occurred while uploading the file</div>
								<div id='abort'>The upload has been canceled by the user or the browser dropped the connection</div>
								<div id='warnsize'>Your file is very big. We can't accept it. Please select more small file</div>

								<div id='progress_info'>
									<div id='progress'></div>
									<div id='progress_percent'>&nbsp;</div>
									<div class='clear_both'></div>
									<div>
										<div id='speed'>&nbsp;</div>
										<div id='remaining'>&nbsp;</div>
										<div id='b_transfered'>&nbsp;</div>
										<div class='clear_both'></div>
									</div>
									<div id='upload_response'></div>
								</div>
								<img id='preview'>\n";
								break;
							case 'fuente':
								echo "<p><select id='" . $nombre . "' name='" . $nombre . "' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)' style='width:200px;'>
									<optgroup style='font-family:Arial'>
										<option " .(($valores["$nombre"] == 'Arial') ? "selected" : "") . " value='Arial'> Arial </option>
									</optgroup>
									<optgroup style='font-family:Verdana'>
										<option " .(($valores["$nombre"] == 'Verdana') ? "selected" : "") . " value='Verdana'> Verdana </option>
									</optgroup>
									<optgroup style='font-family:Palatino'>
										<option " .(($valores["$nombre"] == 'Palatino') ? "selected" : "") . " value='Palatino'> Palatino </option>
									</optgroup>
									<optgroup style='font-family:Charcoal'>
										<option " .(($valores["$nombre"] == 'Charcoal') ? "selected" : "") . " value='Charcoal'> Charcoal </option>
									</optgroup>
									<optgroup style='font-family:Impact'>
										<option " .(($valores["$nombre"] == 'Impact') ? "selected" : "") . " value='Impact'> Impact </option>
									</optgroup> 
									<optgroup style='font-family:Helvetica'>
										<option " .(($valores["$nombre"] == 'Helvetica') ? "selected" : "") . " value='Helvetica'> Helvetica </option>
									</optgroup>
									<optgroup style='font-family:Times New Roman'>
										<option " .(($valores["$nombre"] == 'Times New Roman') ? "selected" : "") . " value='Times New Roman'> Times New Roman </option>
									</optgroup> 
									<optgroup style='font-family:Courier'>
										<option " .(($valores["$nombre"] == 'Courier') ? "selected" : "") . " value='Courier'> Courier </option>
									</optgroup>
									<optgroup style='font-family:Univers'>
										<option " .(($valores["$nombre"] == 'Univers') ? "selected" : "") . " value='Univers'> Univers </option>
									</optgroup>
								</select></p>\n<span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>";
								break;
							case 'tiempoAutoblog':
								echo "<p><select id='" . $nombre . "' name='" . $nombre . "' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)'>
									<option value='2' " .(($valores["$nombre"] == '2') ? "selected" : "") . ">Cada 10 Min.</option>
									<option value='3' " .(($valores["$nombre"] == '3') ? "selected" : "") . ">Cada 15 Min.</option>
									<option value='4' " .(($valores["$nombre"] == '4') ? "selected" : "") . ">Cada 20 Min.</option>
									<option value='5' " .(($valores["$nombre"] == '5') ? "selected" : "") . ">Cada 30 Min.</option>
									<option value='1' " .(($valores["$nombre"] == '1') ? "selected" : "") . ">Cada hora</option>
									<option value='6' " .(($valores["$nombre"] == '6') ? "selected" : "") . ">Cada dos horas</option>
									<option value='7' " .(($valores["$nombre"] == '7') ? "selected" : "") . ">Cada cuatro horas</option>
									<option value='12' " .(($valores["$nombre"] == '12') ? "selected" : "") . ">Dos veces al día</option>
									<option value='24' " .(($valores["$nombre"] == '24') ? "selected" : "") . ">Diariamente</option>
									<option value='168' " .(($valores["$nombre"] == '168') ? "selected" : "") . ">Semanalmente</option>
									</select></p><span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>";
								break;
							case 'maxfeed':
								echo "<p><select id='" . $nombre . "' name='" . $nombre . "' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)'>
									<option value='1' " .(($valores["$nombre"] == '1') ? "selected" : "") . ">1</option>
									<option value='2' " .(($valores["$nombre"] == '2') ? "selected" : "") . ">2</option>
									<option value='3' " .(($valores["$nombre"] == '3') ? "selected" : "") . ">3</option>
									<option value='4' " .(($valores["$nombre"] == '4') ? "selected" : "") . ">4</option>
									<option value='5' " .(($valores["$nombre"] == '5') ? "selected" : "") . ">5</option>
									<option value='10' " .(($valores["$nombre"] == '10') ? "selected" : "") . ">10</option>
									<option value='15' " .(($valores["$nombre"] == '15') ? "selected" : "") . ">15</option>
									<option value='20' " .(($valores["$nombre"] == '20') ? "selected" : "") . ">20</option>
									<option value='30' " .(($valores["$nombre"] == '30') ? "selected" : "") . ">30</option>
									<option value='40' " .(($valores["$nombre"] == '40') ? "selected" : "") . ">40</option>
									<option value='50' " .(($valores["$nombre"] == '50') ? "selected" : "") . ">50</option>
									<option value='60' " .(($valores["$nombre"] == '60') ? "selected" : "") . ">60</option>
									<option value='70' " .(($valores["$nombre"] == '70') ? "selected" : "") . ">70</option>
									<option value='80' " .(($valores["$nombre"] == '80') ? "selected" : "") . ">80</option>
									<option value='100' " .(($valores["$nombre"] == '100') ? "selected" : "") . ">100</option>
									</select></p><span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>";
								break;
							case 'maxperfetch':
							echo "<p><select id='" . $nombre . "' name='" . $nombre . "' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)'>
									<option value='1' " .(($valores["$nombre"] == '1') ? "selected" : "") . ">1</option>
									<option value='2' " .(($valores["$nombre"] == '2') ? "selected" : "") . ">2</option>
									<option value='3' " .(($valores["$nombre"] == '3') ? "selected" : "") . ">3</option>
									<option value='4' " .(($valores["$nombre"] == '4') ? "selected" : "") . ">4</option>
									<option value='5' " .(($valores["$nombre"] == '5') ? "selected" : "") . ">5</option>
									<option value='10' " .(($valores["$nombre"] == '10') ? "selected" : "") . ">10</option>
									<option value='15' " .(($valores["$nombre"] == '15') ? "selected" : "") . ">15</option>
									<option value='20' " .(($valores["$nombre"] == '20') ? "selected" : "") . ">20</option>
									<option value='30' " .(($valores["$nombre"] == '30') ? "selected" : "") . ">30</option>
									<option value='40' " .(($valores["$nombre"] == '40') ? "selected" : "") . ">40</option>
									<option value='50' " .(($valores["$nombre"] == '50') ? "selected" : "") . ">50</option>
									<option value='100' " .(($valores["$nombre"] == '100') ? "selected" : "") . ">100</option>
									<option value='200' " .(($valores["$nombre"] == '200') ? "selected" : "") . ">200</option>
									<option value='300' " .(($valores["$nombre"] == '300') ? "selected" : "") . ">300</option>
									<option value='400' " .(($valores["$nombre"] == '400') ? "selected" : "") . ">400</option>
									<option value='500' " .(($valores["$nombre"] == '500') ? "selected" : "") . ">500</option>
									<option value='600' " .(($valores["$nombre"] == '600') ? "selected" : "") . ">600</option>
									<option value='700' " .(($valores["$nombre"] == '700') ? "selected" : "") . ">700</option>
									<option value='800' " .(($valores["$nombre"] == '800') ? "selected" : "") . ">800</option>
									</select></p><span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>";
								break;
							case 'idioma':
							echo "<p><select id='" . $nombre . "' name='" . $nombre . "' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)'>
									<option value='en' " .(($valores["$nombre"] == 'en') ? "selected" : "") . ">Inglés</option>
									<option value='du' " .(($valores["$nombre"] == 'du') ? "selected" : "") . ">Holandes</option>
									<option value='ge' " .(($valores["$nombre"] == 'ge') ? "selected" : "") . ">Alemán</option>
									<option value='fr' " .(($valores["$nombre"] == 'fr') ? "selected" : "") . ">Francés</option>
									<option value='sp' " .(($valores["$nombre"] == 'sp') ? "selected" : "") . ">Español</option>
									<option value='po' " .(($valores["$nombre"] == 'po') ? "selected" : "") . ">Portugués</option>
									<option value='ro' " .(($valores["$nombre"] == 'ro') ? "selected" : "") . ">Rumano</option>
									<option value='tr' " .(($valores["$nombre"] == 'tr') ? "selected" : "") . ">Turco</option>
									</select></p><span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>";			
								break;
							case 'color':
								echo "<p>";
								//echo "<input type='color' id='" . $nombre . "' name='" . $nombre . "' onchange='javascript:cambiarcolor(this.id)' value='"; 
								//echo ((isset($valores["$nombre"])) ?$valores["$nombre"] : ""); 
								//echo "'/>";
								
								if (getBrowser()=="Internet Explorer") 
								{ 
									echo "<input class=\"color\" onfocus='txt_onfocus(this.id)' id='" . $nombre . "' name='" . $nombre . "' onchange=\"javascript:cambiarcolor(this.id)\" value='";
									echo ((isset($valores["$nombre"])) ?$valores["$nombre"] : "");
									echo "'> El color seleccionado es: <span width='90' height='250' id='divColor" . $nombre . "'>"; 
									echo ((isset($valores["$nombre"])) ?$valores["$nombre"] : "");echo "</span></p>\n<!--<span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p><span>-->";  
								}
								else if(getBrowser()=="Apple Safari")
								{
									echo "<input class=\"color\" onfocus='txt_onfocus(this.id)' id='" . $nombre . "' name='" . $nombre . "' onchange=\"javascript:cambiarcolor(this.id)\" value='";
									echo ((isset($valores["$nombre"])) ?$valores["$nombre"] : "");
									echo "'> El color seleccionado es: <span width='90' height='250' id='divColor" . $nombre . "'>"; 
									echo ((isset($valores["$nombre"])) ?$valores["$nombre"] : "");echo "</span></p>\n<!--<span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p><span>-->";  
								}
								else 
								{
									echo "<p><input type='color' onfocus='txt_onfocus(this.id)' id='" . $nombre . "' name='" . $nombre . "' onchange='javascript:cambiarcolor(this.id)' value='"; echo ((isset($valores["$nombre"])) ?$valores["$nombre"] : ""); 
									echo "'> El color seleccionado es: <span width='90' height='250' id='divColor" . $nombre . "'>"; 
									echo ((isset($valores["$nombre"])) ?$valores["$nombre"] : "");echo "</span></p>\n<span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>";
									
									
								}
								break;
							case 'password':
								echo "<p><input type='password' onchange='txt_onchange(this.id)' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)' name='" . $nombre . "' id='" . $nombre . "' value='"; echo ((isset($valores["$nombre"])) ?$valores["$nombre"] : ""); 
								echo "'/></p>\n<span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>";
								echo '<label form="' . $nombre . '2">Repita ' . $label . ':</label>';
								echo "<p><input type='password' name='" . $nombre . "2' id='" . $nombre . "2' value='"; echo ((isset($valores["$nombre"])) ?$valores["$nombre"] : ""); 
								echo "'/></p>";
								break;
							default:
								echo "<p><input type='text' onblur='validarCampo(this.id);' onchange='validarCampo(this.id);' onfocus='txt_onfocus(this.id)' name='" . $nombre . "' id='" . $nombre . "' value='"; echo ((isset($valores["$nombre"])) ?$valores["$nombre"] : ""); 
								echo "'/></p>\n<span style='display:none;' id='" . $nombre . "msg' ><p class='mensajeer'>Campo incorrecto</p></span>";
						}
						$result1->free();
					}
				}
			}
		}
	
	}
	$result->free();

	$mysqli->close();
?>