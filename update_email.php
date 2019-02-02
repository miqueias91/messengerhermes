<?php
    include_once("./verifica.php");
	include_once("./config/config.php");
	include_once("./class/class.destinatario.php");

  	$des = new Destinatario();

  	$grupo = array_unique ($grupo);
  	$grupo = array_filter ($grupo);  

	$des->alterarDestinatario($id_destinatario, $nome_destinatario, $email_destinatario, $grupo, $token_user);

	echo "<script>alert('Dados alterados com sucesso.'); window.location.href = './form_config_email.php';</script>";
	die;