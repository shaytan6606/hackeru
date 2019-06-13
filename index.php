<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
// print_r($_POST);
// 2. Подключение файлов системы

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Db.php');
require_once(ROOT.'/core/model.php');
require_once(ROOT.'/core/controller.php');
// echo '<pre>';
// echo $_COOKIE['token'];
// 4. Вызор Router
// header("HTTP/1.0 404 Not Found");

$router = new Router();
$router->run();
// ROOT.'/config/routes.php'