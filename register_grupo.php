<?php
	include_once("./config/config.php");
    include_once("./class/class.grupo.php");

  	$grp = new Grupo();
	$grp->cadastraGrupo($nome_grupo, $token_user);

	echo "<script>alert('Grupo cadastro com sucesso.'); window.location.href = './form_config_grupo.php';</script>";
	die;