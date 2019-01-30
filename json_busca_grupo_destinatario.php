<?php
	include_once("./config/config.php");
	include_once("./class/class.destinatario.php");

  	$des = new Destinatario();
    $grupos = $des->buscaGrupoDestinatario(null, null, null, $token_user, $term);

	if($grupos){
		$i = 0;
		foreach ($grupos as $row){
			$dados[$i]['id'] = $row['grupo'];
	        $dados[$i]['value'] = str_pad($row['grupo'],7,'0', STR_PAD_LEFT)." | ".$row['nome_grupo'];
			$i++;
		}
		echo json_encode($dados);
	}	