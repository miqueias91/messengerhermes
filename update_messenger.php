<?php
	include_once("./config/config.php");
	include_once("./class/class.messenger.php");
    include_once("./class/class.destinatario.php");

  	$msn = new Messenger();
    $des = new Destinatario();

	if (empty($data_inicio)) {
		echo "<script>alert('Não foi possível enviar a mensagem, dado(s) incompleto(s).'); window.location.href = './edit_messenger.php?id_messenger=$id_messenger&token_user=$token_user';</script>";
		die;
	}
	else if (empty($data_final)) {
		echo "<script>alert('Não foi possível enviar a mensagem, dado(s) incompleto(s).'); window.location.href = './edit_messenger.php?id_messenger=$id_messenger&token_user=$token_user';</script>";
		die;
	}
	else if (empty($assunto)) {
		echo "<script>alert('Não foi possível enviar a mensagem, dado(s) incompleto(s).'); window.location.href = './edit_messenger.php?id_messenger=$id_messenger&token_user=$token_user';</script>";
		die;
	}
	else if (empty($destinatario[0]) && empty($grupo[0])) {
		echo "<script>alert('Não foi possível enviar a mensagem, dado(s) incompleto(s).'); window.location.href = './edit_messenger.php?id_messenger=$id_messenger&token_user=$token_user';</script>";
		die;
	}
	else if (empty($mensagem)) {
		echo "<script>alert('Não foi possível enviar a mensagem, dado(s) incompleto(s).'); window.location.href = './edit_messenger.php?id_messenger=$id_messenger&token_user=$token_user';</script>";
		die;
	}
	else{

		if (!empty($destinatario[0]) && !empty($grupo[0])) {
			foreach ($grupo as $row) {
				$destinatarios[] = $des->buscaGrupoDestinatario(null, null, $row, $token_user);
			}

			foreach ($destinatarios as $cada) {
				foreach ($cada as $value) {
					$arrayDestinatarioGrupo[] = $value['id_destinatario'];
				}		
			}

			$arrayDestinatario = array_merge($arrayDestinatarioGrupo, $destinatario);
			$arrayDestinatario = array_unique ($arrayDestinatario);
	  		$arrayDestinatario = array_filter ($arrayDestinatario);
		}
		else if (!empty($destinatario[0]) && empty($grupo[0])){
			$arrayDestinatario = array_unique ($destinatario);
	  		$arrayDestinatario = array_filter ($arrayDestinatario);
		}
		else if (empty($destinatario[0]) && !empty($grupo[0])){
			foreach ($grupo as $row) {
				$destinatarios[] = $des->buscaGrupoDestinatario(null, null, $row, $token_user);
			}

			foreach ($destinatarios as $cada) {
				foreach ($cada as $value) {
					$arrayDestinatarioGrupo[] = $value['id_destinatario'];
				}		
			}

			$arrayDestinatario = array_unique ($arrayDestinatarioGrupo);
	  		$arrayDestinatario = array_filter ($arrayDestinatario);

		}

		unlink(".".$caminho);
  		$data_inicio = explode("/", $data_inicio);
  		$data_inicio = $data_inicio[2]."-".$data_inicio[1]."-".$data_inicio[0];

  		$data_final = explode("/", $data_final);
  		$data_final = $data_final[2]."-".$data_final[1]."-".$data_final[0];

  		$horario = $hora.":".$minuto.":00";

		$caminho_mensagem = "/tmp/messenger_$token_user"."_".date('YmdHis').".html";
		$msn->excluiMessengerDestinatario($id_messenger);
  		$msn->alteraMessenger($id_messenger, $data_inicio, $data_final, $horario, $assunto, $caminho_mensagem, $token_user, $arrayDestinatario);

		$fp = fopen("./".$caminho_mensagem, 'a');
		fwrite($fp, $mensagem);
		fclose($fp);

		echo "<script>alert('Mensagem alterada com sucesso.'); window.location.href = './edit_messenger.php?id_messenger=$id_messenger&token_user=$token_user';</script>";
		die;
	}

