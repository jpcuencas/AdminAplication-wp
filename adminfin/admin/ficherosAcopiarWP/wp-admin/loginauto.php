<?php
//include_once("../../admin/redireccion.php");
include_once("../../admin/md5_php.php");

	if(isset($_GET['us']))
	{
		$usuario= Encrypter::decrypt(trim($_GET['us']));
	}
	if(isset($_GET['pass']))
	{	
		$password= Encrypter::decrypt(trim($_GET['pass']));
	}

?>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
<script language="javascript"> 
   function DoPost(){
      $.post("./auto-login.php", { username: "<?php echo "$usuario" ?>" , password: "<?php echo "$password";?>" , rememberme: "true" } )
		.done(function( data ) {
			window.location.assign("./");
		});  
   }
</script>

<a style="display:none;" href="javascript:DoPost()">Click Here</a> 

<script>
	$( document ).ready(function() {
		DoPost();
	});
</script>
</body>

</html>