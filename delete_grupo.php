<?php
	include_once("./config/config.php");
	include_once("./class/class.grupo.php");

  	$grp = new Grupo();

	$grp->excluirGrupo($token_user, $id_grupo);
	die;