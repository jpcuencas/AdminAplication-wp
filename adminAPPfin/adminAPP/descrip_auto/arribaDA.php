<?php
ini_set('default_charset','utf8');

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
	<link href="../css/modern.css" rel="stylesheet"/>
	<title><?php echo((isset($titulo0)) ? "$titulo0" : "Administracion de dominios"); ?></title>
	<link rel="icon" type="image/ico" href="../favicon.ico"/>
	<script type="text/javascript" src="../js/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="../js/jquery-migrate-1.2.1.min.js"></script>
	<script type="text/javascript" src="../js/metro-accordion.js"></script>
	<script type="text/javascript" src="../js/metro-button-set.js"></script>
	<script type="text/javascript" src="../js/Scripts/jquery.validate.min.js"></script>
	<script type="text/javascript" src="../js/Scripts/jquery.validate.unobtrusive.min.js"></script>
	<script type="text/javascript" src="../js/Scripts/jquery.validate-vsdoc.js"></script>
	<script type="text/javascript" src="../js/Scripts/MicrosoftAjax.js"></script>
	<script type="text/javascript" src="../js/Scripts/modernizr-2.7.2.js"></script>
	
	<script type="text/javascript" src="../js/Scripts/webforms2/webforms2.js"></script>
	<script type="text/javascript" src="../js/Scripts/webforms2/webforms2_src.js"></script>
	<script type="text/javascript" src="../js/Scripts/webforms2/webforms2-msie.js"></script>
	<script type="text/javascript" src="../js/Scripts/webforms2/webforms2-p.js"></script>
	<link href="../js/Scripts/webforms2/webforms2.css" rel="stylesheet" type="text/css"/>
    <style>
        #icons-list li {
            font-size: 18px;
            line-height: 32px;
        }
    </style>
 <link href="../css/main.css" rel="stylesheet" type="text/css"/>
 <link href="../css/style.css" rel="stylesheet" type="text/css"/>
 <script type="text/javascript" src="../js/scriptControlFile.js"></script>
 <script type="text/javascript" src="../js/scriptControlColor.js"></script>
 <script type="text/javascript" src="../js/usodeModernizr.js"></script>
 
 <script type="text/javascript" src="../js/jscolor/jscolor.js"></script>
 
<?php
	if(isset($enPostBasura)and ($enPostBasura))
	{
?>	
	<!--<script type="text/javascript" src="javascript/ckeditor.js"></script>-->
	<style id="styles" type="text/css">

		.cke_button_myDialogCmd .cke_icon
		{
			display: none !important;
		}
		
		li
		{
			list-style-type: none;	
			list-style: none;
			list-style-image: none;
		}
		.cke_button_myDialogCmd .cke_label
		{
			display: inline !important;
		}
		
	</style>
	
<?php
	}
?>
<script type="text/javascript">
$(document).ready(function()
{
	if(document.forms[0]!=null)
	{
		//compatibilidadFormularios(document.forms[0]);
	}
});
</script>	
</head>


<body class="metrouicss">

<div class="page secondary">
        <div class="page-header">
            <div class="page-header-content">
				<h1><?php echo((isset($titulo1)) ? "$titulo1" : "Administracion de dominios"); ?>
				
				<p>
				<nav class="horizontal-menu">
					<ul style="list-style: none;">
						<li style="float:left;">  <a href="../dominios/index.php">  Dominios </a>&nbsp; | &nbsp;</li>
						<li style="float:left;">  <a href="../servidores/index.php">  Servidores </a>&nbsp; | &nbsp;</li>
						<li style="float:left;">  <a href="../plantillas/index.php">  Plantillas </a>&nbsp; | &nbsp;</li>
						<li> <a href="../tipos/index.php">  Tipos de pagina</a> </li>
					</ul>
				</nav>
				</p>
				<?php 

				?>
					<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../cerrar_session.php" >salir</a>-->
				</h1>
            </div>
        </div>
 
        <div class="page-region">
            <div class="page-region-content">
