<?php
    @ session_start();
    extract($_SESSION);
    include_once("./config/config.php");

    //Verifica se há dados ativos na sessão
    if(isset($_SESSION["token_user"]) && isset($_SESSION["usuario"])){
        echo "<script>window.location.href = './inicio.php';</script>";
    }
    else{
?>

<!doctype html>
<html lang="pt-br">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Pagina Login">
        <meta name="author" content="Miqueias Matias Caetano">
        <meta name="keywords" content="Pagina Login">
        <meta content="pt-br, pt, en" http-equiv="Content-Language">
        <meta name="revised" content="2019-02-15">

        <!-- Bootstrap CSS -->    
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/singin.css">
        <link rel="stylesheet" href="fontawesome-free-5.6.3-web/css/all.css">

        <!-- Optional Google Fonts -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">

            <!-- Optional JavaScript -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <script type="text/javascript">        
            $( document ).ready(function() {
                $('#entrar').click(function(){
                    var retorno = true;

                    if ($('#usuario').val() == '') {
                        $('#usuario').css('border-color','red');
                        retorno = false;
                    }else{
                        $('#usuario').css('border-color','');
                    }

                    if ($('#password').val() == '') {
                        $('#password').css('border-color','red');
                        retorno = false;
                    }else{
                        $('#password').css('border-color','');
                    }

                    if (!retorno) {
                        alert('Existem campos não preenchidos!');
                    }
                    else{
                        $("#form").submit();
                        return true;
                    }
                });
            });
        </script>
    </head>
    <body>
        <div class="wrapper fadeInDown">
          <div id="formContent">
            <div class="fadeIn first">
                <br>
                <h1>ACESSO RESTRITO</h1>
            </div>
            <form method=post name='form' id='form' enctype='multipart/form-data' action="./entra.php">
                <input type="text" id="usuario" class="fadeIn second" name="usuario" placeholder="Digite seu usuário...">
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Digite sua senha...">
                <input type="button" id="entrar" class="fadeIn fourth" value="Entrar" style="cursor: pointer;">
            </form>
            <div id="formFooter">
                <p>Gerenciado por
              <a style="text-decoration: none;" class="underlineHover" target="T_BLANK" href="https://messengerhermes.000webhostapp.com/">MESSENGER HERMES</a></p>
            </div>
          </div>
        </div>
    </body>
</html>











<?php
    }
?>