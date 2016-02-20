<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include 'libs/autoload.php';

App::run(filter_input(INPUT_GET, 'url', FILTER_SANITIZE_STRING));