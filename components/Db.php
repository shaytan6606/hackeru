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
	public function query($sql, $params = []) {// дописать метод
		return $this->db->query($sql);
	}
	public function querySelect($sql){
		
	}
	public function prepare($sql) {
		return $this->db->prepare($sql);
	}
	
}
