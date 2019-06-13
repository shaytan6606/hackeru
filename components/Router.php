<?php

class Router
{

	private $routes;
	public function __construct()
	{
		$routesPath = ROOT.'/config/routes.php';
		$this->routes = include($routesPath);
	}

// Return type

	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
		return trim($_SERVER['REQUEST_URI'], '/');
		}
	
	}

	public function run()
	{
		$uri = $this->getURI();
		try{
			//$isHit = false;
			foreach ($this->routes as $uriPattern => $path) {
			// try{
				//echo $uriPattern . ' ' . $uri.'<br />';
				if(preg_match("~$uriPattern~", $uri)) {
					//$isHit = true;
//die('sdsds');
					// Получаем внутренний путь из внешнего согласно правилу.

					$internalRoute = preg_replace("~$uriPattern~", $path, $uri);

					$segments = explode('/', $internalRoute);

					// print_r($segments);

					$controllerName = array_shift($segments).'Controller';
					$controllerName = ucfirst($controllerName);
					// echo $controllerName;

					$actionName = 'action'.ucfirst(array_shift($segments));

					$parameters = $segments;

					$controllerFile = ROOT . '/controllers/' .$controllerName. '.php';
					// print_r($controllerFile);
					
					if (file_exists($controllerFile)) {
						include_once($controllerFile);
					} else {
						//$isHit  = false;
						throw new Exception('File controller not found');
					}

					$controllerObject = new $controllerName;

					$result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				
					if ($result != null) {
						//$isHit = false;
						throw new Exception('action not found');
						//break;
					} else {
						return;
					}
					//return;
				} 
					// throw new Exception('/404');
				// }
			// } catch (Exception $e){
			// 	echo $e->getMessage() . ' ';
			// 	// include_once ROOT . '/controllers/PagenotfoundController.php';
			// 	// if($_SERVER['REQUEST_URI'] != '/404'){
			// 	// 	header("Location:/404");
			// 	// }
				
			// 	break;
			// 	// header("HTTP/1.0 404 Not Found");
			// }

		}
		//if (!$isHit)
			throw new Exception('/404');
	} catch (Exception $e){
		// header("HTTP/1.0 404 Not Found");
		echo 78787878778;
		return;
	}
	}
}