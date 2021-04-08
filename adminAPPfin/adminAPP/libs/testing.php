<?
$dev =true;
function funPrintR($string)
{
	if(global $dev)
	{
		echo "<br/>------<br/> <pre>";
		print_r($string);
		echo "</pre> <br/>------<br/>";
	}
		
}

function funEcho($string)
{
	if(global $dev)
		echo "<br/>------<br/>" . $string . "<br/>------<br/>";
}

function headerLoc($location)
{
	if(!(global $dev))
		header("Location:" . $location);
}
function maxid($conexion,$tabla)
{
	if(global $dev)
	{
		$sql6="select max(id) FROM "  . $tabla;
		$result3 = $mysqli->query($sql6);
		$row3=$result3->fetch_array(MYSQLI_ASSOC);
		echo "<br/> id max: " .$row3['id'];
		
		$rs = $mysqli->query("SELECT @@identity AS id");
		if ($row = rs->fetch_array(MYSQLI_ASSOC)) {
			$id = trim($row[0]);
		}
		echo "<br/> id -- " .$id;*/
		echo "<br/> id = " . mysqli_insert_id($mysqli);
	}
}
function Exception($e,$url)
{
	if(global $dev)
	{
		echo "<br/>-------------\n<br/>Hubo error al generar los datos. " .  $e->getMessage() . "<br/>\n------------";
	}
	else
	{
		header("Location:" . $url);
	}
}

function funvarPHPaJS($name,$php)
{
//$result = compact("event", "nothing_here", $location_vars);
//$result['php']
//$variable
// valor de variable $$variable
?>
<script>
var variablejs = "<?php echo $php; ?>" ;
document.write("<?php echo $name; ?> = " + variablejs);
</script>
<?php
}
?>

<script>
function funvarPHPaJS(name,variablejs)
{
var variablejs = "contenido de la variable javascript" ;

<?php
$result = compact("event", "nothing_here", $location_vars);

$name = " document.write(name)";
$phpvariable = " document.write(variablejs)";
$result[$name]=$phpvariable;
?>
}
</script>