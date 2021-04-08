<?php
function convertirJSON($var)
{	$res="";
	$strlen_var = count($var);
	$i=1;
	foreach($var as $indice => $valor)
	{
		$res = $res . "\"$indice\":";
		if(is_array($var["$indice"]))
		{	
			$res=$res .'[';
			$arr=$var["$indice"];
			
			$strlen=count($arr);
			
			for ($c = 0; $c < $strlen; $c++) {
				switch (gettype($arr[$c])) {
					case 'boolean':
						if($arr[$c])
							$res = $res .  'true';
						else
							$res = $res .  'false';
					break;
					case 'NULL':
						 'null';
					break;
					case 'integer':
						  $res = $res . (int) $arr[$c];
					break;
					case 'double':
					case 'float':
						  $res = $res . (float) $arr[$c];
					break;
					case 'string':
						$res = $res . "\"" . $arr[$c] . "\"";
				}
				if($strlen>$c+1)
					$res = $res . ',';
			}
			$res = $res . ']';
		}
	
        switch (gettype($var["$indice"])) {
            case 'boolean':
				if($var["$indice"])
					$res = $res .  'true';
				else
					$res = $res .  'false';
			break;
            case 'NULL':
                 'null';
			break;
            case 'integer':
                  $res = $res . (int) $var["$indice"];
			break;
            case 'double':
            case 'float':
                  $res = $res . (float) $var["$indice"];
			break;
            case 'string':
				$res = $res . "\"" . $var["$indice"] . "\"";
			}
			if($strlen_var>$i)
				$res = $res . ',';
			$i++;
	}
	return $res;
}
function convertirArrayJSON($var)
{
	$res="";
	
	if(is_array($var))
	{
		$res='{';
		$res = $res . convertirJSON($var);
		$res = $res . '}';	
	}
	return $res;
}

//sin probar
function convertirJSONArray($var)
{	
	$arr=substr($var,-1, -1);
	
	$arr=split($arr,":");
	$strlen=count($arr);
			
	for ($c = 0; $c < $strlen; $c++)
	{
		$res["$arr[$c]"]=$arr[$c+1];
		$c++;
	}
	return $res;
}
?>