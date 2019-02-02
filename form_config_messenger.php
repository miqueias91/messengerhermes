<?php
    include_once("./verifica.php");
	include_once("./config/config.php");
    include_once("$base/class/class.messenger.php");

    $msn = new Messenger();
    $arrayMessenger = $msn->buscaPeriodoMessenger(null, null, null, null, null, null, null, $_SESSION["token_user"]);
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
        function removeMessenger(id_messenger) {
            if(confirm('Deseja realmente excluir?')){
                $("#form").attr('action','delete_messenger.php?id_messenger='+id_messenger+'&token_user=<?=$_SESSION["token_user"]?>');
                $("#form").submit();
                return true;
            }
            return false;
        }
        function editMessenger(id_messenger) {
            $("#form").attr('action','edit_messenger.php?id_messenger='+id_messenger+'&token_user=<?=$_SESSION["token_user"]?>');
            $("#form").submit();
            return true;
        }
        $( document ).ready(function() {
            $('#inserir').click(function(){
                $("#form").attr('action','insert_messenger.php');
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
        <h1>| GERENCIAR MENSAGEM<button style="cursor:pointer; float: right;" title="Incluir Mensagem" class="btn btn-outline-secondary" id="inserir" type="button"><i class="fas fa-plus-square"></i> Incluir Mensagem</button></h1>

        <form method=post name='form' id='form' enctype='multipart/form-data' action="form_config_messenger.php">
            <input type="hidden" name="token_user" value="<?=$_SESSION['token_user']?>">
        <?php
            if ($arrayMessenger) {
        ?>

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center" scope="col">AÇÃO</th>
                            <!--<th scope="col">CÓDIGO MENSAGEM</th>-->
                            <th scope="col">ASSUNTO</th>
                            <th scope="col">DATA INÍCIAL</th>
                            <th scope="col">DATA FINAL</th>
                            <th scope="col">HORÁRIO</th>
                        </tr>
                      </thead>
                    <tbody>
        <?php
                    foreach ($arrayMessenger as $row) {
        ?>    
                        <tr>
                          <th scope="row">
                            <button onClick="removeMessenger('<?=$row["id_messenger"]?>')" style="cursor:pointer" title="Excluir" class="btn btn-outline-secondary" type="button"><i class="fas fa-trash-alt"></i> Excluir</button> 
                            <button onClick="editMessenger('<?=$row["id_messenger"]?>')" style="cursor:pointer" title="Editar" class="btn btn-outline-secondary" type="button"><i class="fas fa-pen-square"></i> Editar</button></th>
                          <!--<td title="<?= str_pad($row['id_messenger'],7,'0', STR_PAD_LEFT)?>"><?= str_pad($row['id_messenger'],7,'0', STR_PAD_LEFT)?></td>-->

                          <td title="<?=$row['assunto']?>"><?=$row['assunto']?></td>

                          <td title="<?=date("d/m/Y", strtotime($row['data_inicio']))?>"><?=date("d/m/Y", strtotime($row['data_inicio']))?></td>

                          <td title="<?=date("d/m/Y", strtotime($row['data_final']))?>"><?=date("d/m/Y", strtotime($row['data_final']))?></td>
                          
                          <td title="<?=date("H:i", strtotime($row['horario']))?>"><?=date("H:i", strtotime($row['horario']))?></td>
                        </tr>                      
        <?php
          
                    }
        ?>
                    </tbody>
                </table>
        <?php
          
            }else{

        ?>
        <div class="alert alert-danger" role="alert">
            <center>                
                Nenhuma mensagem cadastrado! Deseja <a href="./insert_messenger.php">cadastrar?</a>
            </center>
        </div>
        <?php
          
            }           
        ?>
        
        </form>
    </div>


  </body>
</html>