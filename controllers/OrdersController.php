<?php

class OrdersController extends Controller
{	
	public static $orders;
	public function __construct()
	{
		// подключение модели
		$modelsName = array('model1'=>'orders');
		self::getModel($modelsName);
		self::$orders = new Orders;
	}

	public function actionView($id)
	{
		self::$pageName = 'Заказ';
		if(isset($_SESSION['privileges'])) {
			// вывод 1 товара
			$ordersItemModel = new Orders;
			if ($id) {
				$ordersItem = $ordersItemModel->getOrdersItemByID($id);
				self::$renderData = $ordersItem;
			}
			// Подключение вьюхи
			self::$renderName = 'order';
			self::renderLayout();
		} else {
			echo 'нет доступа';
		}
		return true;

	}

	public function actionIndex($parameters = 0)
	{
		self::$pageName = 'Заказы';
		if(isset($_SESSION['privileges'])) {
			// вывод списка товаров
			$ordersList = array();

			$ordersListClass = new Orders;

			$ordersList = $ordersListClass->getOrdersList();

			self::$renderData = $ordersList;
			self::$renderName = 'orders';
			self::renderLayout(); 
			// self::$renderData = $ordersList;
		} else {
			echo 'нет доступа';
		}
		return true;
	}

	public function actionAddorder()
	{
		self::$pageName = 'Добавление заказа';
		if(isset($_SESSION['privileges'])) {
			self::$renderName = 'addorder';
			self::renderLayout(); 
			if(isset($_POST['Submit'])){
				// Получаем данные от  пользователя
				$customerName = $_POST['customerName'];
				$cost = $_POST['cost'];
				$receiving = $_POST['receiving'];
				$issue = $_POST['issue'];

				self::$orders->addorder($customerName, $cost, $receiving, $issue);
				
			}
		} else {
			echo 'нет доступа';
		}

	}
	public function actionDeleteorder($id)
	{
		if(isset($_SESSION['privileges'])) {
            if($_SESSION['privileges'] === '1'){
				self::$orders->deleteorder($id);

			} else { echo 'нет доступа';}
        } else { echo 'нет доступа';}
	}

}

