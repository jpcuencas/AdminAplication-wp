<?php
try
{
	if(isset($_GET['dom']))
	{
		$id=$_GET['dom'];
	}

		include("../libs/conn.php");
		$sql= "UPDATE  `dominio` SET 
		 `estado` =  'Bloqueado'
		WHERE  `ID` = $id ;";

		 mysqli_query($mysqli,$sql) or die(mysqli_error($mysqli)); 
		 $mysqli->close();
		
		
		header("Location:../dominios/index.php?error=false&flash=bloqueado correctamente");

}
catch(Exception $e)
{
	//echo "<br/>-------------\n<br/>Hubo error al insertar el dato. " .  $e->getMessage() . "<br/>\n------------";
	header("Location:../dominios/index.php?error=true&flash=Se ha producido una excepcion: Error:" . $e->getMessage());
}	
?>