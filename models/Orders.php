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
// customerName cost receiving issue
	public function addorder($customerName, $cost, $receiving, $issue) {

	$sql = "INSERT INTO `orders` (`id`, `customerName`, `cost`, `receiving`, `issue`, `userid`) 
	VALUES (:id, :customerName, :cost, :receiving, :issue, :userid)";

	$addOrderToBase = self::$db->prepare($sql);
	$addOrderToBase->execute(array('id' => NULL,
						'customerName' => $customerName,
						'cost' => $cost,
						'receiving'=> $receiving,
						'issue' => $issue,
						'userid' => $_SESSION['id']));
	
    
		var_dump($customerName);
		var_dump($cost);
		var_dump($receiving);
		var_dump($issue);

	}
	public function deleteorder($id){
		$sql = "DELETE FROM `orders` WHERE `orders`.`id` = :id";
		$deleteOrderInBase = self::$db->prepare($sql);
		$deleteOrderInBase->execute(array('id' => $id));
	}

}