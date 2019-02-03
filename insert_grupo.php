<?php
    include_once("./verifica.php");
    include_once("./config/config.php");
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
    <?php include_once("./menu.php");?>
    <div class="main container">
        <h1>|&nbsp;CADASTRAR GRUPO</h1>
        <form method=post name='form' id='form' enctype='multipart/form-data' action="register_grupo.php">
            <input type="hidden" name="token_user" value="<?=$_SESSION['token_user']?>">

            <div class="form-group">
                <label for="nome_grupo">Nome</label>
                <input name="nome_grupo" type="text" class="form-control" id="nome_grupo" placeholder="Nome do grupo...">
            </div>

            <button title="Salvar" id="salvar" class="btn btn-outline-secondary" type="button"><i class="fas fa-check-circle"></i> Salvar</button>
        </form>             
    </div>
    <br>
    <br>
    <br>



  </body>
</html>