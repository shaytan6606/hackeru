<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Подключение файлов системы

define('ROOT', dirname(__FILE__));

require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Db.php');
require_once(ROOT.'/core/model.php');
require_once(ROOT.'/core/controller.php');


session_start();


$router = new Router();
$router->run();
