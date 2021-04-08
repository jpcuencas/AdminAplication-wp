<?php
include_once("md5_php.php");
if(isset($_GET['dom']))
	{
		$id=$_GET['dom'];
	}
	if(isset($_GET['ser']))
	{	
		$ser=$_GET['ser'];
	}
	
	include("conn.php");
	$query = "SELECT ID,nombre,valores FROM dominio WHERE ID = '" . $id . "'";
		$result = $mysqli->query($query);
		$row=$result->fetch_array(MYSQLI_ASSOC);

		$valores=$row["valores"];
		$arr=json_decode($valores, true);
		$usuario = Encrypter::encrypt($arr['usuario_wp']);
		$pass =     Encrypter::encrypt($arr["contrasenya_wp"]);		
		$usuario = urlencode($usuario);
		$pass = urlencode($pass);
		//echo $arr['usuario_wp'] . "<br/>";
		//echo $arr['contrasenya_wp'];
		//$_POST['username']=$usuario;
		//$_POST['password']=$pass;
		//header("Location:http://{$row['nombre']}/wp-admin/");

		//echo "Location:http://www." . $row["nombre"] . "/wp-admin/loginauto.php?us=$usuario&pass=$pass&nombre";
if($usuario!="" and $pass!="")
{
	header("Location:http://www." . $row["nombre"] . "/wp-admin/loginauto.php?us=$usuario&pass=$pass&nombre");
}
else
{
	header("Location:index.php?error=false&flash=No se ha podido acceder");
}
 ?>