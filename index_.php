<?php
    @ session_start();
    extract($_SESSION);
    include_once("./config/config.php");

    //Verifica se há dados ativos na sessão
    if(isset($_SESSION["id_usuario"])){
        echo "<script>window.location.href = './inicio.php';</script>";
    }
    else{
        echo "Fazer login";
    }