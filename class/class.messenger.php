<?php
	class Messenger extends Conexao {
		public static $instance;

		public function __construct(){}

		public static function getInstance() {
	        self::$instance = new Messenger();
	        return self::$instance;
	    }

		public function cadastraMessenger($data_inicio, $data_final, $horario, $assunto, $mensagem, $token_user, $destinatario_grupo){
			try {
	            $sql = "INSERT INTO messenger (
	                id_messenger, 
	                data_inicio,
					data_final,
					horario,
					assunto,
					mensagem,
					token_user
					)
					VALUES (
	                :id_messenger, 
	                :data_inicio,
					:data_final,
					:horario,
					:assunto,
					:mensagem,
					:token_user
					)

	                ";
	            $pdo = Conexao::getInstance()->prepare($sql);
	            $pdo->bindValue(":id_messenger", null, PDO::PARAM_INT);
	            $pdo->bindValue(":data_inicio", $data_inicio, PDO::PARAM_STR);
	            $pdo->bindValue(":data_final", $data_final, PDO::PARAM_STR);
	            $pdo->bindValue(":horario", $horario, PDO::PARAM_STR);
	            $pdo->bindValue(":assunto", $assunto, PDO::PARAM_STR);
	            $pdo->bindValue(":mensagem", $mensagem, PDO::PARAM_STR);
	            $pdo->bindValue(":token_user", $token_user, PDO::PARAM_STR);
	            $pdo->execute();

	            $ultimo_id = Conexao::ultimoID();
				foreach ($destinatario_grupo as $row) {
				    $this->cadastraMessengerDestinatario($ultimo_id, $row);
				}
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
		}

		public function alteraMessenger($id_messenger, $data_inicio, $data_final, $horario, $assunto, $mensagem, $token_user, $destinatario_grupo, $status){
			try {
	            $sql = "UPDATE messenger
	            	SET
		                data_inicio = :data_inicio,
						data_final 	= :data_final,
						horario 	= :horario,
						assunto 	= :assunto,
						mensagem 	= :mensagem,
						token_user 	= :token_user,
						status 		= :status
					WHERE id_messenger = :id_messenger
	                ";
	            $pdo = Conexao::getInstance()->prepare($sql);
	            $pdo->bindValue(":id_messenger", $id_messenger, PDO::PARAM_INT);
	            $pdo->bindValue(":data_inicio", $data_inicio, PDO::PARAM_STR);
	            $pdo->bindValue(":data_final", $data_final, PDO::PARAM_STR);
	            $pdo->bindValue(":horario", $horario, PDO::PARAM_STR);
	            $pdo->bindValue(":assunto", $assunto, PDO::PARAM_STR);
	            $pdo->bindValue(":mensagem", $mensagem, PDO::PARAM_STR);
	            $pdo->bindValue(":token_user", $token_user, PDO::PARAM_STR);
	            $pdo->bindValue(":status", $status, PDO::PARAM_STR);
	            $pdo->execute();

				foreach ($destinatario_grupo as $row) {
				    $this->cadastraMessengerDestinatario($id_messenger, $row);
				}
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
		}

		public function excluiMessenger($id_messenger, $token_user) {
	        try {
		            $sql = "DELETE 
		            		FROM messenger 
		            		WHERE id_messenger = :id_messenger AND token_user = :token_user ";
		            $pdo = Conexao::getInstance()->prepare($sql);
			        $pdo->bindValue(':id_messenger', $id_messenger, PDO::PARAM_INT);
			        $pdo->bindValue(':token_user', $token_user, PDO::PARAM_INT);
			        $pdo->execute();
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
	    }

		public function buscaMessenger($idmessenger = null, $data_inicio = null, $data_final = null, $horario = null, $assunto = null, $mensagem = null, $token_user = null){
			$filtro = "";
			$filtro .= isset($idmessenger) ? " AND id_messenger = :idmessenger" : "";
			$filtro .= isset($data_inicio) ? " AND data_inicio = :data_inicio" : "";
			$filtro .= isset($data_final) ? " AND data_final = :data_final" : "";
			$filtro .= isset($horario) ? " AND horario = :horario" : "";
			$filtro .= isset($assunto) ? " AND assunto = :assunto" : "";
			$filtro .= isset($mensagem) ? " AND mensagem = :mensagem" : "";
			$filtro .= isset($token_user) ? " AND token_user = :token_user" : "";			

			try {
	            $sql = "SELECT *

	                FROM messenger	                             
	                WHERE id_messenger > :id_messenger
	                $filtro
	                group by id_messenger
					ORDER BY id_messenger
	            ";
	            $pdo = Conexao::getInstance()->prepare($sql);
				
	            $pdo->bindValue(':id_messenger', 0, PDO::PARAM_INT);
	            if ($idmessenger) {
		            $pdo->bindValue(':idmessenger', $idmessenger, PDO::PARAM_INT);
	            }     
	            if ($data_inicio) {
		            $pdo->bindValue(':data_inicio', $data_inicio, PDO::PARAM_STR);
	            }
	           	if ($data_final) {
		            $pdo->bindValue(':data_final', $data_final, PDO::PARAM_STR);
	            }
	           	if ($horario) {
		            $pdo->bindValue(':horario', $horario, PDO::PARAM_STR);
	            }
	            if ($assunto) {
		            $pdo->bindValue(':assunto', $assunto, PDO::PARAM_STR);
	            }
	            if ($mensagem) {
		            $pdo->bindValue(':mensagem', $mensagem, PDO::PARAM_STR);
	            }
	           	if ($token_user) {
		            $pdo->bindValue(':token_user', $token_user, PDO::PARAM_STR);
	            }
	         
	            $pdo->execute();
	            return $pdo->fetchAll(PDO::FETCH_BOTH);
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
		}


		public function buscaPeriodoMessenger($idmessenger = null, $data_inicio = null, $data_final = null, $periodo_data = null, $horario = null, $assunto = null, $mensagem = null, $token_user = null, $status = 'ativo'){
			
			$status = $status == 'todos' ? null : $status;

			$filtro = "";
			$filtro .= isset($idmessenger) ? " AND msn.id_messenger = :idmessenger" : "";
			$filtro .= isset($data_inicio) ? " AND msn.data_inicio = :data_inicio" : "";
			$filtro .= isset($data_final) ? " AND msn.data_final = :data_final" : "";
			$filtro .= isset($periodo_data) ? " AND ( :periodo_data >= msn.data_inicio AND :periodo_data <= msn.data_final ) " : "";
			$filtro .= isset($horario) ? " AND msn.horario = :horario" : "";
			$filtro .= isset($assunto) ? " AND msn.assunto = :assunto" : "";
			$filtro .= isset($mensagem) ? " AND msn.mensagem = :mensagem" : "";
			$filtro .= isset($token_user) ? " AND msn.token_user = :token_user" : "";			
			$filtro .= isset($status) ? " AND msn.status = :status" : "";			

			try {
	            $sql = "SELECT *

	                FROM messenger msn	         
	                INNER JOIN acess_user user ON user.token_user = msn.token_user             
	                WHERE msn.id_messenger > :id_messenger
	                $filtro
					ORDER BY msn.data_final desc
	            ";

	            $pdo = Conexao::getInstance()->prepare($sql);
				
	            $pdo->bindValue(':id_messenger', 0, PDO::PARAM_INT);
	            if ($idmessenger) {
		            $pdo->bindValue(':idmessenger', $idmessenger, PDO::PARAM_INT);
	            }     
	            if ($data_inicio) {
		            $pdo->bindValue(':data_inicio', $data_inicio, PDO::PARAM_STR);
	            }
	           	if ($data_final) {
		            $pdo->bindValue(':data_final', $data_final, PDO::PARAM_STR);
	            }     	
	            if ($periodo_data) {
		            $pdo->bindValue(':periodo_data', $periodo_data."%", PDO::PARAM_STR);
	            }
	           	if ($horario) {
		            $pdo->bindValue(':horario', $horario, PDO::PARAM_STR);
	            }
	            if ($assunto) {
		            $pdo->bindValue(':assunto', $assunto, PDO::PARAM_STR);
	            }
	            if ($mensagem) {
		            $pdo->bindValue(':mensagem', $mensagem, PDO::PARAM_STR);
	            }
	           	if ($token_user) {
		            $pdo->bindValue(':token_user', $token_user, PDO::PARAM_STR);
	            }
	            if ($status) {
		            $pdo->bindValue(':status', $status, PDO::PARAM_STR);
	            }
	         
	            $pdo->execute();
	            return $pdo->fetchAll(PDO::FETCH_BOTH);
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
		}

		public function inativaMessengerAutomatico($data_final = null, $horario = null, $status = 'ativo'){
			

			$filtro = "";
			$filtro .= isset($data_final) ? " AND data_final < :data_final " : "";
			$filtro .= isset($horario) ? " AND horario < :horario " : "";
			$filtro .= isset($status) ? " AND status = :status " : "";			

			try {
	            $sql = "UPDATE messenger
	            	SET status = :status_inativo
	                WHERE id_messenger > :id_messenger
	                $filtro
	            ";

	            $pdo = Conexao::getInstance()->prepare($sql);
				
	            $pdo->bindValue(':id_messenger', 0, PDO::PARAM_INT);
	            $pdo->bindValue(":status_inativo", "inativo", PDO::PARAM_STR);
	           	if ($data_final) {
		            $pdo->bindValue(':data_final', $data_final, PDO::PARAM_STR);
	            }     	
	           	if ($horario) {
		            $pdo->bindValue(':horario', $horario, PDO::PARAM_STR);
	            }
	            if ($status) {
	            	$pdo->bindValue(":status", $status, PDO::PARAM_STR);
	            }	         
	            $pdo->execute();
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
		}

		public function cadastraMessengerDestinatario($id_messenger, $id_destinatario){
			try {
	            $sql = "INSERT INTO messenger_destinatario (
	                id_messenger_destinatario, 
	                id_destinatario,
					id_messenger
					)
					VALUES (
	                :id_messenger_destinatario, 
	                :id_destinatario,
					:id_messenger
					)

	                ";
	            $pdo = Conexao::getInstance()->prepare($sql);
	            $pdo->bindValue(":id_messenger_destinatario", null, PDO::PARAM_INT);
	            $pdo->bindValue(":id_destinatario", $id_destinatario, PDO::PARAM_STR);
	            $pdo->bindValue(":id_messenger", $id_messenger, PDO::PARAM_STR);
	            $pdo->execute();
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
		}

		public function excluiMessengerDestinatario($id_messenger) {
	        try {
		            $sql = "DELETE 
		            		FROM messenger_destinatario 
		            		WHERE id_messenger = :id_messenger";
		            $pdo = Conexao::getInstance()->prepare($sql);
			        $pdo->bindValue(':id_messenger', $id_messenger, PDO::PARAM_INT);
			        $pdo->execute();
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
	    }

		public function buscaMessengerDestinatario($id_messenger = null){
			$filtro = "";
			$filtro .= isset($id_messenger) ? " AND md.id_messenger = :id_messenger" : "";

			try {
	            $sql = "SELECT *

	                FROM messenger_destinatario md 
	                INNER JOIN destinatario de ON de.id_destinatario = md.id_destinatario                           
	                WHERE md.id_messenger_destinatario > :id_messenger_destinatario
	                $filtro
	                group by md.id_messenger_destinatario
					ORDER BY md.id_messenger_destinatario
	            ";

	            $pdo = Conexao::getInstance()->prepare($sql);
				
	            $pdo->bindValue(':id_messenger_destinatario', 0, PDO::PARAM_INT);
	            if ($id_messenger) {
		            $pdo->bindValue(':id_messenger', $id_messenger, PDO::PARAM_INT);
	            }
	         
	            $pdo->execute();
	            return $pdo->fetchAll(PDO::FETCH_BOTH);
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
		}

















	}