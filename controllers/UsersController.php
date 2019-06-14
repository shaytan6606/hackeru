<?php

class UsersController extends Controller
{
    public static $users;

    public function __construct(){

        $modelsName = array('model1'=>'users');
        
        self::getModel($modelsName);
        self::$users = new Users;
    }

    public function actionLogin()
    {
        self::$pageName = 'Вход';
        // Подключение вьюхи
        self::$renderName = 'login';
        self::renderLayout(); 

        if(isset($_POST['Submit'])){
            // Получаем данные от  пользователя
            $login = $_POST['user'];
            $pass = $_POST['pass'];
            // Сравниваем
            self::$users->login($login, $pass);
        }
    }
    public function actionLogout()
    {
        self::$pageName = 'Выход';
        // удаляем токен из бд
        self::$users->logout();
        // удаляем куки
        unset($_COOKIE['token']);
        setcookie('token', null, -1, '/');
        // убиваем сессию
        $_SESSION = array();

    }
    public function actionAdduser()
    {
        self::$pageName = 'Добавление пользователя';
        if(isset($_SESSION['privileges'])) {
            if($_SESSION['privileges'] === '1'){
                // подключение вьюхи
                self::$renderName = 'adduser';
                self::renderLayout();
                // Добавляем пользователя

                if(isset($_POST['Submit'])){
                    // Получаем данные от  пользователя
                    $login = $_POST['user'];
                    $email = $_POST['email'];
                    $pass = $_POST['pass'];
                    $privileges = (int)$_POST['privileges'];
                    // self::$users->login($login, $pass);
                    
                    self::$users->adduser($login, $email, $pass, $privileges);
                    
                }
            } else { echo 'нет доступа';}
        } else { echo 'нет доступа';}
    }
}