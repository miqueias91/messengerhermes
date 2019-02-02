<?php
    include_once("./verifica.php");
	include_once("./config/config.php");
    include_once("$base/class/class.messenger.php");

    $msn = new Messenger();
	$arrayMessenger = $msn->buscaMessenger($id_messenger, null, null, null, null, null, $token_user);

	$msn->excluiMessenger($id_messenger, $token_user);
	unlink(".".$arrayMessenger[0]['mensagem']);

	echo "<script>alert('Registro excluido com sucesso.'); window.location.href = './form_config_messenger.php';</script>";

	die;