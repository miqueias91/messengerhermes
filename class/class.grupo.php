<?php
	class Grupo extends Conexao {
		public static $instance;

		public function __construct(){}

		public static function getInstance() {
	        self::$instance = new Grupo();
	        return self::$instance;
	    }

	    public function buscaGrupo($idgrupo = null, $nome_grupo = null){			    
			$filtro = "";
			$filtro .= isset($idgrupo) ? " AND id_grupo = :idgrupo" : "";
			$filtro .= isset($nome_grupo) ? " AND nome_grupo LIKE :nome_grupo" : "";			

			try {
	            $sql = "SELECT *

	                FROM grupo	                             
	                WHERE id_grupo > :id_grupo
	                $filtro
	                group by id_grupo
					ORDER BY id_grupo
	            ";

	            $pdo = Conexao::getInstance()->prepare($sql);
				
	            $pdo->bindValue(':id_grupo', 0, PDO::PARAM_INT);
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
}