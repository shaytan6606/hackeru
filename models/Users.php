<?php

class Users extends Model
{
    // подключение к бд
    public function __construct()
	{
        parent::__construct();
    }
    
    public function login($login, $pass)
    {
        // получаем данные пользователя по логину
        $sql = 'SELECT username, pass FROM orders.users WHERE username= :username ';
        $result = self::$db->prepare($sql);
        $result->execute(array('username' => $login));
        $dataFromDataBase = $result->fetch();

        // сравниваем
        if($login === $dataFromDataBase['username']){
            echo ' login accepted';
            if($pass === $dataFromDataBase['pass']){

                //успешная авторизация

                //кладем токен в куки
                $token = $this->getToken();
                setcookie('token', $token);

                //кладем токен в базу
                $setTokenToBase = 0;
                $sql = 'UPDATE `users` SET `token` = :token WHERE `users`.`username` = :username';
                $setTokenToBase = self::$db->prepare($sql);
                $setTokenToBase->execute(array('username' => $login,
                                                'token' => $token));
                //отправляем к заказам
                header("Location:/orders");
                
            } else {
                echo ' wrong password';
            };
        } else {
                echo ' wrong login';
        }
    }

    public function logout()
    {
        if(isset($_COOKIE['token'])){$token = $_COOKIE['token'];
        $sql = "UPDATE `users` SET `token` = '' WHERE `users`.`token` = :token";
        $setTokenToBase = self::$db->prepare($sql);
        $setTokenToBase->execute(array('token' => $token));
        }
        echo 'вы вышли из системы';
    }

    public function adduser($login, $email, $pass, $privileges)
    {
        $sql = "INSERT INTO `users` (`id`, `username`, `email`, `pass`, `privileges`) 
                VALUES (:id, :username, :email, :pass, :privileges)";
        $addUserToBase = self::$db->prepare($sql);
        $addUserToBase->execute(array('id' => NULL,
                                    'username' => $login,
                                    'email' => $email,
                                    'pass'=> $pass,
                                    'privileges' => $privileges));
       // echo $login . '---' . $email . '---' . $pass . '---' .  $privileges;
        
    }
    private function getToken($length = 30) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
    
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
    
        return $string;
    }
}
