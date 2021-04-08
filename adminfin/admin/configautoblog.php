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
	if(isset($_POST['feed_max']))
	{
		$feedMax =$_POST['feed_max'];
	}
	if(isset($_POST['max_total']))
	{
		$totalMax =$_POST['max_total'];
	}
	if(isset($_POST['frec_rss']))
	{
		$frecRSS =$_POST['frec_rss'];
	}
	if(isset($_POST['idioma_spn']))
	{
		$idiomaSpinner =$_POST['idioma_spn'];
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
	$total=0;
	
	if(isset($tagsWP[0])and($tagsWP[0]!=""))
	{
		$total=count($tagsWP);
	}
	if(isset($feedWP[0])and($feedWP[0]!=""))
	{
		$total=$total + count($feedWP);
	}
	$total=$total*3;
	$feedsjson="a:$total:{";
$k=1;	
	$ok=false;
if($tagsWP!="")
{	
	if(count($tagsWP)>0)
	{
		$ok=true;
		if(isset($tagsWP))
		{
			if(isset($tagsWP[0])and($tagsWP[0]!=""))
			{	
				for($i=0;$i<count($tagsWP);$i++)
				{	
					$countname="feed_name_$k";
					$counturl="feed_url_$k";
					$countcat="feed_cat_$k";
				
					switch(strtoupper($idioma))
					{
						case "ES_ES":
						$feedsjson = $feedsjson . "s:" . strlen($countname) . ":\"feed_name_$k\";s:" . strlen($tagsWP[$i]) . ":\"" . $tagsWP[$i] . "\";s:" . strlen($counturl) . ":\"feed_url_$k\";s:" .  strlen("http://es.wordpress.com/tag/" . $tagsWP[$i] . "/feed/") . ":\"http://es.wordpress.com/tag/" . $tagsWP[$i] . "/feed/\";s:" . strlen($countcat) . ":\"feed_cat_$k\";s:1:\"0\";";
							
						break;
						case "DE_DE":
						$feedsjson = $feedsjson . "s:" . strlen($countname) . ":\"feed_name_$k\";s:" . strlen($tagsWP[$i]) . ":\"" . $tagsWP[$i] . "\";s:" . strlen($counturl) . ":\"feed_url_$k\";s:" .  strlen("http://de.wordpress.com/tag/" . $tagsWP[$i] . "/feed/") . ":\"http://de.wordpress.com/tag/" . $tagsWP[$i] . "/feed/\";s:" . strlen($countcat) . ":\"feed_cat_$k\";s:1:\"0\"M";
							
						break;
						case "EN_EN":
						$feedsjson = $feedsjson . "s:" . strlen($countname) . ":\"feed_name_$k\";s:" . strlen($tagsWP[$i]) . ":\"" . $tagsWP[$i] . "\";s:" . strlen($counturl) . ":\"feed_url_$k\";s:" . strlen("http://en.wordpress.com/tag/" . $tagsWP[$i] . "/feed/") . ":\"http://en.wordpress.com/tag/" . $tagsWP[$i] . "/feed/\";s:" . strlen($countcat) . ":\"feed_cat_$k\";s:1:\"0\";";
							
						break;
						case "FR_FR":
						$feedsjson = $feedsjson . "s:" . strlen($countname) . ":\"feed_name_$k\";s:" . strlen($tagsWP[$i]) . ":\"" . $tagsWP[$i] . "\";s:" . strlen($counturl) . ":\"feed_url_$k\";s:" . strlen("http://fr.wordpress.com/tag/" . $tagsWP[$i] . "/feed/") . ":\"http://fr.wordpress.com/tag/" . $tagsWP[$i] . "/feed/\";s:" . strlen($countcat) . ":\"feed_cat_$k\";s:1:\"0\";";
						
						break;
						case "IT_IT":
						$feedsjson=$feedsjson . "s:" . strlen($countname) . ":\"feed_name_$k\";s:" . strlen($tagsWP[$i]) . ":\"" . $tagsWP[$i] . "\";s:" . strlen($counturl) . ":\"feed_url_$k\";s:" . strlen("http://it.wordpress.com/tag/" . $tagsWP[$i] . "/feed/") . ":\"http://it.wordpress.com/tag/" . $tagsWP[$i] . "/feed/\";s:" . strlen($countcat) . ":\"feed_cat_$k\";s:1:\"0\";";
						
						break;
						case "PT_PT":
						$feedsjson = $feedsjson . "s:" . strlen($countname) . ":\"feed_name_$k\";s:" . strlen($tagsWP[$i]) . ":\"" . $tagsWP[$i] . "\";s:" . strlen($counturl) . ":\"feed_url_$k\";s:" .  strlen("http://pt.wordpress.com/tag/" . $tagsWP[$i] . "/feed/") . ":\"http://pt.wordpress.com/tag/" . $tagsWP[$i] . "/feed/\";s:" . count($countcat) . ":\"feed_cat_$k\";s:1:\"0\";";
						
						break;
					}
				$k++;					
				}
			}
		}
	}
}
	
if($feedWP!="")
{		
	if(count($feedWP)>0)
	{	
		$ok=true;
		if(isset($feedWP))
		{
			if(isset($feedWP[0])and($feedWP[0]!=""))
			{

				for($j=0;$j<count($feedWP);$j++)
				{
					$countname="feed_name_$k";
					$counturl="feed_url_$k";
					$countcat="feed_cat_$k";
					$feedsjson = $feedsjson . "s:" . strlen($countname) . ":\"feed_name_$k\";s:" . strlen($feedWP[$j]) . ":\"" . $feedWP[$j] . "\";s:" . strlen($counturl) . ":\"feed_url_$k\";s:" . strlen($feedWP[$j]) . ":\"" . $feedWP[$j] . "\";s:" . strlen($countcat) . ":\"feed_cat_$k\";s:1:\"0\";";
					$k++;
				}
			}
		}
	}
}

	$feedsjson = $feedsjson . "}";

	if($ok)
	{
		$sql1= "UPDATE  `" . $prefijo . "options` SET 
			`option_value` =  '{$feedsjson}'
			WHERE  `option_name` ='rss_import_items';";

			mysqli_query($mysqli,$sql1) or die(mysqli_error($mysqli)); 

			$feedsconfig="a:22:{s:6:\"active\";s:1:\"1\";s:14:\"fetch_schedule\";s:" . strlen($frecRSS) . ":\"" . $frecRSS . "\";s:11:\"post_status\";s:7:\"publish\";s:11:\"post_format\";s:8:\"standard\";s:10:\"bloguserid\";s:0:\"\";s:12:\"overridedate\";s:1:\"1\";s:8:\"timezone\";s:0:\"\";s:7:\"maxfeed\";s:" . strlen($feedMax) . ":\"" . $feedMax . "\";s:11:\"maxperfetch\";s:" . strlen($totalMax) . ":\"" . $totalMax . "\";s:12:\"targetWindow\";s:1:\"0\";s:8:\"readmore\";s:0:\"\";s:7:\"descnum\";s:2:\"99\";s:11:\"sourceWords\";s:1:\"1\";s:17:\"sourceWords_Label\";s:0:\"\";s:16:\"sourceAnchorText\";s:1:\"1\";s:8:\"stripAll\";s:1:\"0\";s:9:\"stripSome\";s:1:\"1\";s:11:\"maximgwidth\";s:3:\"150\";s:15:\"RSSdefaultImage\";s:1:\"0\";s:16:\"setFeaturedImage\";s:1:\"0\";s:10:\"expiration\";s:1:\"1\";s:13:\"oldPostStatus\";s:1:\"0\";}";
			
			$sql2= "UPDATE  `" . $prefijo . "options` SET 
				`option_value` =  '{$feedsconfig}'
				WHERE  `option_name` ='rss_post_options';";

			mysqli_query($mysqli,$sql2) or die(mysqli_error($mysqli)); 
			
			
			$sql3
			= "UPDATE  `" . $prefijo . "options` SET 
				`option_value` =  '{$idiomaSpinner}'
				WHERE  `option_name` ='wp_auto_spinner_lang';";

			mysqli_query($mysqli,$sql3) or die(mysqli_error($mysqli)); 

	
		/* Rollback */
		//$mysqli->rollback();
		
		if (!$mysqli->commit()) {
			die("Error al hacer el commit");
		}
	}
	$mysqli->autocommit(TRUE);
	$mysqli->close();
	//header("Location: http://" . $nombre . "/wp-admin/admin.php?page=pipes.pipe&task=post&id=4&u=1");
?>