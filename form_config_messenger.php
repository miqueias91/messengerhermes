<?php
    include_once("./verifica.php");

    include_once("./config/config.php");
    include_once("$base/class/class.messenger.php");
    include_once("./menu.php");

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
    <div id="cabecalho_titulo">
        <div id="titulos">            
            GERENCIAR&nbsp;E-MAIL
        </div>            
    </div>
    <br>

    <div id="conteudo_sistema">
        <button style="cursor:pointer; float: right;" title="Incluir E-mail" class="pequeno_botao" id="inserir" type="button"><i class="fas fa-plus-square"></i> Incluir E-mail</button>

        <form method=post name='form' id='form' enctype='multipart/form-data' action="form_config_messenger.php">
            <input type="hidden" name="token_user" value="<?=$_SESSION['token_user']?>">
        <?php
            if ($arrayMessenger) {
        ?>

                <table width="100%" align="center">
                    <tr style="background:grey;">
                        <td align="center"><a class="minimo" style="color:white">AÇÃO</a></td>
                        <td align="center"><a class="minimo" style="color:white">ASSUNTO</a></td>
                        <td align="center"><a class="minimo" style="color:white">DATA DE ENVIO</a></td>
                        <td align="center"><a class="minimo" style="color:white">HORÁRIO DE ENVIO</a></td>
                    </tr>
        <?php
                    foreach ($arrayMessenger as $row) {
        ?>    
                        <tr style="background: white; height: 20px;" >
                          <td width="200px" align="center" style="border: 1px solid #F1F1F1">
                            <button onClick="removeMessenger('<?=$row["id_messenger"]?>')" style="cursor:pointer" title="Excluir" class="pequeno_botao" type="button"><i class="fas fa-trash-alt"></i> Excluir</button> 
                            <button onClick="editMessenger('<?=$row["id_messenger"]?>')" style="cursor:pointer" title="Editar" class="pequeno_botao" type="button"><i class="fas fa-pen-square"></i> Editar</button></td>

                          <td align="center" style="border: 1px solid #F1F1F1" title="<?=$row['assunto']?>"><?=$row['assunto']?></td>

                          <td width="200px" align="center" style="border: 1px solid #F1F1F1" title="<?=date("d/m/Y", strtotime($row['data_inicio']))?>"><?=date("d/m/Y", strtotime($row['data_inicio']))?></td>
                          <td width="200px" align="center" style="border: 1px solid #F1F1F1" title="<?=date("H:i", strtotime($row['horario']))?>"><?=date("H:i", strtotime($row['horario']))?></td>
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
                Nenhuma mensagem de e-mail cadastrada! Deseja <a href="./insert_messenger.php">cadastrar?</a>
            </center>
        </div>
        <?php
          
            }           
        ?>
        
        </form>
    </div>


  </body>
</html>