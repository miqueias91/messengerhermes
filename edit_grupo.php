<?php
    include_once("./verifica.php");
    include_once("./config/config.php");
    include_once("./class/class.grupo.php");
    include_once("./menu.php");

    $gpo = new Grupo();

    $grupos = $gpo->buscaGrupo($id_grupo, null, $token_user);
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

    <link rel="stylesheet" href="css/jquery-ui.css">

    <!-- Optional Google Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">

    <!-- Optional JavaScript -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script type="text/javascript">
        $( document ).ready(function() {

            $('#salvar').click(function(){
                if ($('#nome_grupo').val() == '') {
                    $('#nome_grupo').css('border-color','red');
                    alert('Preencha o nome do grupo!');
                }
                else{
                    if(confirm('Deseja realmente salvar?')){
                        $("#form").submit();
                        return true;
                    }
                    return false;
                }
            });
        });
    </script>


    <title>MESSENGER HERMES</title>
  </head>
  <body>
    <div id="cabecalho_titulo">
        <div id="titulos">            
            EDITAR&nbsp;GRUPO
        </div>            
    </div>
    <br>

    <div id="conteudo_sistema">
        <form method=post name='form' id='form' enctype='multipart/form-data' action="update_grupo.php">
            <input type="hidden" name="token_user" value="<?=$token_user?>">
            <input type="hidden" name="id_grupo" value="<?=$id_grupo?>">

            <div class="form-group">
                <label for="nome_grupo"><a class="minimo">Nome</a></label>
                <input name="nome_grupo" type="text" class="form-control" id="nome_grupo" placeholder="Nome do grupo..." value="<?=$grupos[0]['nome_grupo']?>">
            </div>

            <center>                
                <button style="margin-top: 10px" title="Salvar Alteração" id="salvar" class="pequeno_botao" type="button"><i class="fas fa-check-circle"></i> Salvar Alteração</button>
            </center>

        </form>             
    </div>
    <br>
    <br>
    <br>




  </body>
</html>