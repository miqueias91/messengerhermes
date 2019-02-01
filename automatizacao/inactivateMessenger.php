<?php
    error_reporting(1);

	include_once("/var/www/html/messengerhermes/config/config.php");
	include_once("$base/class/class.messenger.php");

  	$msn = new Messenger();

    $periodo_data = date("Y-m-d");
    $horario = date("H:i");
    $arrayMessenger = $msn->inativaMessengerAutomatico($periodo_data, $horario);