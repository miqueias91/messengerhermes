<?php
    session_start();
    include_once('./config/config.php');
    include_once('./class/class.acessUsuario.php');
    $acesso = new acessUsuario();

    $usuario = filter_var($usuario, FILTER_SANITIZE_STRING);
    $senha = filter_var(md5($password), FILTER_SANITIZE_STRING);

    if ($usuario && $password) {
        $acess = $acesso->loginSystem($usuario, $senha);
        $tam = count($acess);
        if (($acess && $tam == 1)) {
            $sistema = './inicio.php';
            //Registra os dados do usuário na sessão
            $_SESSION["token_user"] = $acess[0]['token_user'];
            $_SESSION["usuario"] = $acess[0]['usuario'];
            echo "
                <script>window.location.href = '$sistema';</script>
            "; 
        }
        else{
            $sistema = './';
            echo "
                <script>alert('Login incorreto.');
                    window.location.href = '$sistema';
                </script>
            ";
        }
    }
    else {
        $sistema = './';
        if (empty($usuario) && empty($password)) {
            echo "
                <script>
                    alert('Digite Login/Senha!!');
                    window.location.href = '$sistema';
                </script>
            ";
        } 
        else if (empty($usuario)) {
            echo "
                <script>
                    alert('Voce não digitou um usuario!');
                    window.location.href = '$sistema';
                </script>
            ";
        }
        else if (empty($password)) {
            echo "
                <script>
                    alert('Voce não digitou uma senha!');
                    window.location.href = '$sistema';
                </script>
            ";
        }
    }