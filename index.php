<?php
	include_once("./config/config.php");
	
	session_start();
	$_SESSION["id_usuario"] = 1;
    $_SESSION["usuario"] = 'miqueiasm91';
    $_SESSION["email"] = 'miqueiasmcaetano';
    $_SESSION["nome_usuario"] = 'Miqueias Matias';
    $_SESSION["token_user"] = '98f87249998b1a2991d346c96ddc9e1a';
?>
<html  id='fora'>
<head>
    <link rel="stylesheet" href="css/stylesheet.css">
    <title>MESSENGER HERMES</title>
</head>
<frameset cols="*">
	<frame name="messengerhermes" src="<?=$base_http;?>/index_.php"  scrolling="" >
</frameset>
</html>
