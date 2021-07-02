<?php
namespace AGENCE_VOYAGE;

use AGENCE_VOYAGE\LIBS\UrlHandler;

session_name("agence_voyage");
session_start();

include_once 'app/config.php';
include_once APP_PATH . '/libs/autoload.php';

$urlHandler = new UrlHandler();

$urlHandler->dispatch();
?>