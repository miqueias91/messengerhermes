<?php
    include_once("./verifica.php");
	include_once("./config/config.php");
    include_once("./class/class.destinatario.php");

    $des = new Destinatario();

    $destinatarios = $des->buscaDestinatario(null, null, null, null, $_SESSION["token_user"]);
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Página Inicio">
    <meta name="author" content="Miqueias Matias Caetano">
    <meta name="keywords" content="Página Inicio">
    <meta content="pt-br, pt, en" http-equiv="Content-Language">
    <meta name="revised" content="2019-01-28">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="fontawesome-free-5.6.3-web/css/all.css">

    <!-- Optional Google Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">

    <!-- Optional JavaScript -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script type="text/javascript">
        function removeDestinatario(id_destinatario) {
            if(confirm('Deseja realmente excluir?')){
                $("#form").attr('action','delete_contato.php?id_destinatario='+id_destinatario);
                $("#form").submit();
                return true;
            }
            return false;
        }
        function editDestinatario(id_destinatario) {
            $("#form").attr('action','edit_contato.php?id_destinatario='+id_destinatario+'&token_user=<?=$_SESSION["token_user"]?>');
            $("#form").submit();
            return true;
        }
        $( document ).ready(function() {
            $('#inserir').click(function(){
                $("#form").attr('action','insert_contato.php');
                $("#form").submit();
                return true;
            });
        });
    </script>

    <title>MESSENGER HERMES</title>
  </head>
  <body>
    <?php include_once("./menu.php");?>
    <div class="main container">
        <h1>|&nbsp;GERENCIAR&nbsp;CONTATOS<button style="cursor:pointer; float: right;" title="Incluir Contato" class="btn btn-outline-secondary" id="inserir" type="button"><i class="fas fa-plus-square"></i> Incluir Contato</button></h1>

        <form method=post name='form' id='form' enctype='multipart/form-data' action="form_config_contato.php">
            <input type="hidden" name="token_user" value="<?=$_SESSION['token_user']?>">
        <?php
            if ($destinatarios) {
        ?>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center" scope="col">AÇÃO</th>
                            <th scope="col">CÓDIGO CONTATO</th>
                            <th scope="col">NOME</th>
                            <th scope="col">E-MAIL</th>
                            <th scope="col">TELEFONE</th>
                        </tr>
                      </thead>
                    <tbody>
        <?php
                    foreach ($destinatarios as $row) {
        ?>    
                        <tr>
                          <th scope="row">
                            <button onClick="removeDestinatario('<?=$row["id_destinatario"]?>')" style="cursor:pointer" title="Excluir" class="btn btn-outline-secondary" type="button"><i class="fas fa-trash-alt"></i> Excluir</button> 
                            <button onClick="editDestinatario('<?=$row["id_destinatario"]?>')" style="cursor:pointer" title="Editar" class="btn btn-outline-secondary" type="button"><i class="fas fa-pen-square"></i> Editar</button></th>
                          <td title="<?= str_pad($row['id_destinatario'],7,'0', STR_PAD_LEFT)?>"><?= str_pad($row['id_destinatario'],7,'0', STR_PAD_LEFT)?></td>

                          <td title="<?=$row['nome_destinatario']?>"><?=$row['nome_destinatario']?></td>
                          
                          <td title="<?=$row['email_destinatario']?>"><?=$row['email_destinatario']?></td>
                          <td title="<?=$row['telefone']?>"><?=$row['telefone']?></td>
                        </tr>                      
        <?php
          
                    }
        ?>
                    </tbody>
                </table>
        <?php
          
            }else{

        ?>
	    <div style="margin-top:50px" class="alert alert-danger" role="alert">
	    	<center>	    		
				Nenhum contato cadastrado! Deseja <a href="./insert_contato.php">cadastrar?</a>
	    	</center>
		</div>
        <?php
          
            }           
        ?>
    	
        </form>
    </div>


  </body>
</html>