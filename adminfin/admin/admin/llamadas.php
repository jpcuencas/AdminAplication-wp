<?php
include_once("snoopy.class.php");
	if(isset($_POST['nom']))
	{
		$nombre=$_POST['nom'];
	}
	if(isset($_POST['ides']))
	{
		$ides=$_POST['ides'];
	}
	
  // open new window
  echo "<script language=\"javascript\">
  for(var i=0;i<" . count($ides) . ";i++)
  {
  window.open(\" http://" . $nombre . "/wp-admin/admin.php?page=pipes.pipe&task=post&id=\"+i+\"&u=1\",\"_blank\");
  }
  </script>";

//header("Location: http://localhost/pruebawp_es/wp-admin/admin.php?page=pipes.pipe&task=post&id=4&u=1");
?>