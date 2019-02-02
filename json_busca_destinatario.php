<?php
    include_once("./verifica.php");
	include_once("./config/config.php");
	include_once("./class/class.destinatario.php");

  	$des = new Destinatario();
    $destinatarios = $des->buscaDestinatario(null, null, null, null, $token_user, $term);

	if($destinatarios){
		$i = 0;
		foreach ($destinatarios as $row){
			$dados[$i]['id'] = $row['id_destinatario'];
	        $dados[$i]['value'] = str_pad($row['id_destinatario'],7,'0', STR_PAD_LEFT)." | ".$row['email_destinatario'];
			$i++;
		}
		echo json_encode($dados);
	}	