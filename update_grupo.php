<?php
    include_once("./verifica.php");
	include_once("./config/config.php");
    include_once("./class/class.grupo.php");

    $gpo = new Grupo();

    $gpo->alterarGrupo($id_grupo, $nome_grupo, $token_user);

	echo "<script>alert('Grupo alterado com sucesso.'); window.location.href = './form_config_grupo.php';</script>";
	die;