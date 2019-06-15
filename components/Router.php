<?php

class Router
{
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run()
    {
        // получаем ссылку
        $uri = $this->getURI();

        // создаем массив из кусков адреса
        $segments = explode('/', $uri);

        // получаем  имя контроллера
        $controllerName = array_shift($segments).'Controller';
        $controllerName = ucfirst($controllerName);

        // получаем имя контроллера
        $actionName = 'action'.ucfirst(array_shift($segments));

        if(!isset($_SESSION['id'])){
            $controllerName = 'UsersController';
            $actionName = 'actionLogin';
        }
        // получаем параметры из ссылки
        $parameters = $segments;

        // подключаем файл контроллера
        $controllerFile = ROOT . '/controllers/' .$controllerName. '.php';
        try{
            if (file_exists($controllerFile)) {
                include_once($controllerFile);
                $controllerObject = new $controllerName;
                if(!method_exists($controllerObject,$actionName)){
                    throw new Exception('Action not found');
                }
            } else {
                
                
                throw new Exception('/404 страница не найдена');
                
            }
        } catch (Exception $e) {
            $controllerFile = ROOT . '/controllers/PagenotfoundController.php';
            $controllerName = 'PagenotfoundController';
            $actionName = 'actionNotfound';
            include_once($controllerFile);
            $controllerObject = new $controllerName;
            // var_dump($e);
            // $parameters = ['arg' => $e->getMessage()];
            $_SESSION['err'] = $e->getMessage();
            //$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
        }

        // Инициализируем контроллер
        //$controllerObject = new $controllerName;
        // var_dump(method_exists($controllerName,$actionName));
/*
        if(!method_exists($controllerObject,$actionName)){
            $controllerFile = ROOT . '/controllers/PagenotfoundController.php';
            include_once($controllerFile);
            $controllerName = 'PagenotfoundController';
            $controllerObject = new $controllerName;
            $actionName = 'actionNotfound';
            
        }
*/
        $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
    }
}

