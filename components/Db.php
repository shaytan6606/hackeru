<?php

class Db
{
	private static $_instance = null;
	protected $db = false;

	private function __construct()
	{
		$paramsPath = ROOT . '/config/db_params.php';
		$params = include($paramsPath);

		$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
		$this->db = new PDO($dsn, $params['user'], $params['password']);
	}

	private function __clone () {}
	private function __wakeup () {}
	
	public static function getInstance()
	{
		if (self::$_instance != null) {
			return self::$_instance;
		}
		return self::$_instance = new self;
	}
	public function query($sql, $params = []) {
		return $this->db->query($sql);
	}
	public function prepare($sql) {
		return $this->db->prepare($sql);
	}
}
// $d1 = Db::getInstance();
// $d2 = Db::getInstance()->query('Insert into (col_1) values (:col_val)', [':col_val' => 100]);
// class DB
// {
// 	private static $_instance = null;
	
// 	// для безопасности настройки лучше хранить в файле с конфигом
// 	private static DB_HOST = '';
// 	private static DB_NAME = '';
// 	private static DB_USER = '';
// 	private static DB_PASS = '';

// 	private function __construct () {
		
// 		$this->_instance = new PDO(
// 			'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME,
// 	    	self::DB_USER,
// 	    	self::DB_PASS,
// 	    	[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
// 	    );

// 	}

// 	private function __clone () {}
// 	private function __wakeup () {}

// 	public static function getInstance()
// 	{
// 		if (self::$_instance != null) {
// 			return self::$_instance;
// 		}

// 		return new self;
// 	}
// }

// class Db
// {

// 		public static function getConnection()
// 		{
// 			$paramsPath = ROOT . '/config/db_params.php';
// 			$params = include($paramsPath);

// 			$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
// 			$db = new PDO($dsn, $params['user'], $params['password']);

// 			return $db;
// 		}
// 		// public static function connect()
// 		// {
// 		// 	return $this->getConnection();
// 		// }

// }