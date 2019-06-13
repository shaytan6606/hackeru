<?php

class OrdersController extends Controller
{	
	public function __construct()
	{
		// подключение модели
		$modelsName = array('model1'=>'orders');
		self::getModel($modelsName);
	}

	public function actionView($id)
	{
		// вывод 1 товара
		$ordersItemModel = new Orders;
		if ($id) {
			$ordersItem = $ordersItemModel->getOrdersItemByID($id);
			self::$renderData = $ordersItem;
		}
		// Подключение вьюхи
		self::$renderName = 'order';
		self::renderLayout(); 

		return true;

	}

	public function actionIndex()
	{
		// вывод списка товаров
		$ordersList = array();

		$ordersListClass = new Orders;

		$ordersList = $ordersListClass->getOrdersList();

		self::$renderData = $ordersList;
		self::$renderName = 'orders';
		self::renderLayout(); 
		// self::$renderData = $ordersList;

		return true;
	}

}

