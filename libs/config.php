<?php
// Inicia as sessões.
session_start();
// Sessões expirarão em duas horas.
session_cache_expire(30);

// Define as constantes do sistema.
define("DIR_BASE", dirname(__DIR__) . '/');
define("DIR_CONTROLLER", DIR_BASE . 'app/controller/');
define("DIR_MODEL", DIR_BASE . 'app/model/');
define("DIR_VIEW", DIR_BASE . 'app/view/');
define("DIR_LIBRARY", DIR_BASE . 'libs/');
define("BASE_SITE", 'http://192.168.1.91/biblioteca/');

// Array de diretorios do sistema.
$dirs = array(
    DIR_CONTROLLER,
    DIR_MODEL,
    DIR_LIBRARY);