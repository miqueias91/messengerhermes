<?php
	include_once("./config/config.php");
    include_once("$base/class/class.messenger.php");

    $msn = new Messenger();

	$msn->excluirMessenger($id_messenger, $token_user);

	echo "<script>alert('Registro excluido com sucesso.'); window.location.href = './form_config_messenger.php';</script>";

	die;