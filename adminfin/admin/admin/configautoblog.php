<?php
include_once("redireccion.php");
include_once("snoopy.class.php");
	if(isset($_POST['nom']))
	{
		$nombre=$_POST['nom'];
	}
	if(isset($_POST['lan']))
	{
		$idioma=$_POST['lan'];
	}
	if(isset($_POST['tag_wp']))
	{
		$tagsWP =$_POST['tag_wp'];
	}
	if(isset($_POST['feed_wp']))
	{
		$feedWP =$_POST['feed_wp'];
	}
	if(isset($_POST['pre']))
	{
		$prefijo =$_POST['pre'];
	}
	
	$patron="/[^a-zA-Z0-9]/";
	$sustitucion='_';
	$bd=preg_replace($patron, $sustitucion, $nombre);
	include("conn.php");	
	$mysqli->select_db($bd);
	
	if (!$mysqli->query("START TRANSACTION")) {
		die(sprintf("[%d] %s\n", $mysqli->errno, $mysqli->error));
	}
	/* disable autocommit */
	$mysqli->autocommit(FALSE);	
	$phpdate=date("Y-m-d H:i:s");
	$i=0;
	$items=1;
	if(count($tagsWP)>0)
	{
		for($i=0;$i<count($tagsWP);$i++)
		{
		echo "count:" . count($tagsWP);
		echo "$i -- " . $tagsWP[$i] . "<br/>";
		switch(strtoupper($idioma))
		{
			case "ES_ES":
				$engine_params='"http://es.wordpress.com/tag/' . $tagsWP[$i] . '/feed/"';
			break;
			case "DE_DE":
				$engine_params='"http://de.wordpress.com/tag/' . $tagsWP[$i] . '/feed/"';
			break;
			case "EN_EN":
				$engine_params='"http://en.wordpress.com/tag/' . $tagsWP[$i] . '/feed/"';
			break;
			case "FR_FR":
				$engine_params='"http://fr.wordpress.com/tag/' . $tagsWP[$i] . '/feed/"';
			break;
			case "IT_IT":
				$engine_params='"http://it.wordpress.com/tag/' . $tagsWP[$i] . '/feed/"';
			break;
			case "PT_PT":
				$engine_params='"http://pt.wordpress.com/tag/' . $tagsWP[$i] . '/feed/"';
			break;
		}	
			$sql1="INSERT INTO " . $prefijo . "wppipes_items(id, name, published, engine, engine_params, adapter, adapter_params, inherit, inputs, outputs) VALUES (NULL, 'Pipe#" . $i . "', '1', 'rssreader', '{\"feed_url\":" . $engine_params . ",\"limit_items\":\"" . $items . "\",\"mode\":\"0\",\"fix_time\":\"-24\",\"cache\":\"1\",\"cache_time\":\"3600\"}', 'post', '{\"schedule\":\"i5\",\"postformat\":\"0\",\"public\":\"publish\",\"author\":\"1\"}','0', '{\"ip\":[[{\"st\":\"e\",\"of\":\"link\",\"if\":\"url\"},{\"st\":\"\",\"of\":\"\",\"if\":\"html\"}]],\"ia\":[{\"st\":\"e\",\"of\":\"title\",\"if\":\"title\"},{\"st\":\"\",\"of\":\"\",\"if\":\"slug\"},{\"st\":\"\",\"of\":\"\",\"if\":\"excerpt\"},{\"st\":\"0\",\"of\":\"fulltext\",\"if\":\"content\"},{\"st\":\"e\",\"of\":\"date\",\"if\":\"date\"},{\"st\":\"\",\"of\":\"\",\"if\":\"images\"},{\"st\":\"\",\"of\":\"\",\"if\":\"metakey\"}]}', '{\"oe\":[\"title\",\"link\",\"description\",\"author\",\"date\",\"enclosures\"],\"op\":[[\"fulltext\",\"full_html\"]]}');";
				
			mysqli_query($mysqli,$sql1) or die(mysqli_error($mysqli)); 
			//(Select max(id) FROM "  . $prefijo . "wppipes_items)
			/*$sql6="select max(id) FROM "  . $prefijo . "wppipes_items";
				$result3 = $mysqli->query($sql6);
				$row3=$result3->fetch_array(MYSQLI_ASSOC);
				echo "<br/>id max: " .$row3['id'];
			*/	
				/*$rs = $mysqli->query("SELECT @@identity AS id");
				if ($row = rs->fetch_array(MYSQLI_ASSOC)) {
					$id = trim($row[0]);
				}
				echo "<br/> id--" .$id;*/
			//echo "<br/>id=" . mysqli_insert_id($mysqli);
			$ides[$i]=mysqli_insert_id($mysqli);
			$sql2="INSERT INTO " . $prefijo . "wppipes_pipes(id, code, name, item_id, params, ordering) VALUES (NULL, 'get_fulltext', 'Get Fulltext', '" . mysqli_insert_id($mysqli) . "', '{\"input\":\"0\",\"auto_fulltext\":\"1\",\"clear_space\":\"1\",\"atag\":\"0\",\"clear_attribute\":\"id,class,style\",\"origin_site\":\"\",\"code\":\"\",\"curl\":\"1\",\"clear_html_comment\":\"1\",\"clear_tags\":\"script,style\",\"charset\":\"UTF-8\",\"useragent\":\"Mozilla\/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko\/20041001 Firefox\/0.10.1\",\"note\":\"\"}', '0');";
					
			mysqli_query($mysqli,$sql2) or die(mysqli_error($mysqli)); 
			
		}
	}
	
	if(count($feedWP)>0)
	{
		for($j=0;$j<count($feedWP);$j++)
		{	echo "count:" . count($feedWP);
			echo "$j -- " . $feedWP[$j] . "<br/>";
			$k=$i+$j;
			$sql3="INSERT INTO " . $prefijo . "wppipes_items(id, name, published, engine, engine_params, adapter, adapter_params, inherit, inputs, outputs) VALUES (NULL, 'Pipe#" . $i . "', '1', 'rssreader', '{\"feed_url\":\"" . $feedWP[$j] . "\",\"limit_items\":\"" . $items . "\",\"mode\":\"0\",\"fix_time\":\"-24\",\"cache\":\"1\",\"cache_time\":\"3600\"}', 'post', '{\"schedule\":\"i5\",\"postformat\":\"0\",\"public\":\"publish\",\"author\":\"1\"}','0', '{\"ip\":[[{\"st\":\"e\",\"of\":\"link\",\"if\":\"url\"},{\"st\":\"\",\"of\":\"\",\"if\":\"html\"}]],\"ia\":[{\"st\":\"e\",\"of\":\"title\",\"if\":\"title\"},{\"st\":\"\",\"of\":\"\",\"if\":\"slug\"},{\"st\":\"\",\"of\":\"\",\"if\":\"excerpt\"},{\"st\":\"0\",\"of\":\"fulltext\",\"if\":\"content\"},{\"st\":\"e\",\"of\":\"date\",\"if\":\"date\"},{\"st\":\"\",\"of\":\"\",\"if\":\"images\"},{\"st\":\"\",\"of\":\"\",\"if\":\"metakey\"}]}', '{\"oe\":[\"title\",\"link\",\"description\",\"author\",\"date\",\"enclosures\"],\"op\":[[\"fulltext\",\"full_html\"]]}');";
			
			mysqli_query($mysqli,$sql3) or die(mysqli_error($mysqli)); 
			$ides[$k]=mysqli_insert_id($mysqli);
			$sql4="INSERT INTO " . $prefijo . "wppipes_pipes(id, code, name, item_id, params, ordering) VALUES (NULL, 'get_fulltext', 'Get Fulltext', '" . mysqli_insert_id($mysqli) . "', '{\"input\":\"0\",\"auto_fulltext\":\"1\",\"clear_space\":\"1\",\"atag\":\"0\",\"clear_attribute\":\"id,class,style\",\"origin_site\":\"\",\"code\":\"\",\"curl\":\"1\",\"clear_html_comment\":\"1\",\"clear_tags\":\"script,style\",\"charset\":\"UTF-8\",\"useragent\":\"Mozilla\/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko\/20041001 Firefox\/0.10.1\",\"note\":\"\"}', '0');";
			
			mysqli_query($mysqli,$sql4) or die(mysqli_error($mysqli)); 
			
		}

		$url = "http://localhost/admin/llamadas.php"; 
		
		$snoopy = new Snoopy;
		$submit_vars["nom"] = $nombre;
		$submit_vars["lan"] = $idioma;
		$submit_vars["ides"] = $ides;
		$snoopy->httpmethod = "POST";
		$snoopy->submit($url,$submit_vars);

		//echo $snoopy->results;
	}
	/* Rollback */
	//$mysqli->rollback();
	
	if (!$mysqli->commit()) {
		die("Error al hacer el commit");
	}
	$mysqli->autocommit(TRUE);
	$mysqli->close();
	//header("Location: http://" . $nombre . "/wp-admin/admin.php?page=pipes.pipe&task=post&id=4&u=1");
?>