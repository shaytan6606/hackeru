<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
// print_r($_POST);
// 2. Подключение файлов системы

define('ROOT', dirname(__FILE__));

// require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Router2.php');
require_once(ROOT.'/components/Db.php');
require_once(ROOT.'/core/model.php');
require_once(ROOT.'/core/controller.php');
// echo '<pre>';
// echo $_COOKIE['token'];
// 4. Вызор Router
// header("HTTP/1.0 404 Not Found");
session_start();

// if(isset($_COOKIE['token'])){

//     $sql = 'SELECT username, pass, id, privileges FROM orders.users WHERE username= :username ';
//     $result = self::$db->prepare($sql);
//     $result->execute(array('username' => $login));
//     $dataFromDataBase = $result->fetch();


//     if($_COOKIE['token'] === ){
//         echo 'ddd';
//     }
// } else {
//     echo '<p><a href="/login">Войти</a></p>';
// }


$router = new Router();
$router->run();
// ROOT.'/config/routes.php'