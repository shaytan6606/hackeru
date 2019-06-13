<?php


class Orders extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	// Один заказ

	public function getOrdersItemByID($id)
	{
		$id = intval($id);

		if ($id) {

			$result = self::$db->query('SELECT * FROM orders WHERE id=' . $id);

			$result->setFetchMode(PDO::FETCH_ASSOC);

			$ordersItem = $result->fetch();

			return $ordersItem;
		}

	}

	// список заказов
	public function getOrdersList() {
		

		$ordersList = array();

		$result = self::$db->query('SELECT id, customerName, cost, receiving, issue, userid FROM orders ORDER BY id');

		$i = 0;

		while($row = $result->fetch()) {
			
			$ordersList[$i]['id'] = $row['id'];
			$ordersList[$i]['customerName'] = $row['customerName'];
			$ordersList[$i]['cost'] = $row['cost'];
			$ordersList[$i]['receiving'] = $row['receiving'];
			$ordersList[$i]['issue'] = $row['issue'];
			$ordersList[$i]['userid'] = $row['userid'];
			$i++;
		}

		return $ordersList;
	
}

}