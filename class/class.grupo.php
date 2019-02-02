<?php
	class Grupo extends Conexao {
		public static $instance;

		public function __construct(){}

		public static function getInstance() {
	        self::$instance = new Grupo();
	        return self::$instance;
	    }

	    public function buscaGrupo($idgrupo = null, $nome_grupo = null, $token_user){			    
			$filtro = "";
			$filtro .= isset($idgrupo) ? " AND id_grupo = :idgrupo" : "";
			$filtro .= isset($nome_grupo) ? " AND nome_grupo LIKE :nome_grupo" : "";			

			try {
	            $sql = "SELECT *

	                FROM grupo	                             
	                WHERE token_user = :token_user
	                $filtro
	                group by id_grupo
					ORDER BY id_grupo
	            ";

	            $pdo = Conexao::getInstance()->prepare($sql);
				
	            $pdo->bindValue(':token_user',$token_user, PDO::PARAM_STR);
	            if ($idgrupo) {
		            $pdo->bindValue(':idgrupo', $idgrupo, PDO::PARAM_INT);
	            }
	           	if ($nome_grupo) {
		            $pdo->bindValue(':nome_grupo', $nome_grupo, PDO::PARAM_STR);
	            }
	            $pdo->execute();
	            return $pdo->fetchAll(PDO::FETCH_BOTH);
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
		}

		public function excluirGrupo($token_user, $id_grupo) {
	        try {
		            $sql = "DELETE 
		            		FROM grupo 
		            		WHERE token_user = :token_user
		            		AND id_grupo = :id_grupo";
		            $pdo = Conexao::getInstance()->prepare($sql);
			        $pdo->bindValue(':token_user', $token_user, PDO::PARAM_INT);
			        $pdo->bindValue(':id_grupo', $id_grupo, PDO::PARAM_INT);
			        $pdo->execute();
			       	echo "<script>alert('Grupo excluido com sucesso.'); window.location.href = './form_config_grupo.php';</script>";

	        } 
	        catch (Exception $e) {
	        	echo "<script>alert('Não foi possível excluir o grupo.'); window.location.href = './form_config_grupo.php';</script>";

	            echo "<br>".$e->getMessage();
	        }
	    }

		public function cadastraGrupo($nome_grupo, $token_user){
			try {
	            $sql = "INSERT INTO grupo (
	                id_grupo, 
	                nome_grupo,
					token_user
					)
					VALUES (
	                :id_grupo, 
	                :nome_grupo,
					:token_user
					)

	                ";
	            $pdo = Conexao::getInstance()->prepare($sql);
	            $pdo->bindValue(":id_grupo", null, PDO::PARAM_INT);
	            $pdo->bindValue(":nome_grupo", $nome_grupo, PDO::PARAM_STR);
	            $pdo->bindValue(":token_user", $token_user, PDO::PARAM_STR);
	            $pdo->execute();
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
		}

	    public function alterarGrupo($id_grupo, $nome_grupo, $token_user){

			try {
	            $sql = "UPDATE grupo 
	            	SET
	                nome_grupo		= :nome_grupo
	                WHERE id_grupo 	= :id_grupo
	                AND token_user 	= :token_user";

	            $pdo = Conexao::getInstance()->prepare($sql);
	            $pdo->bindValue(':id_grupo', $id_grupo, PDO::PARAM_INT);
	            $pdo->bindValue(':nome_grupo', $nome_grupo, PDO::PARAM_STR);
	            $pdo->bindValue(':token_user', $token_user, PDO::PARAM_INT);
	            $pdo->execute();
	        } 
	        catch (Exception $e) {
	            echo "<br>".$e->getMessage();
	        }
		}




	}