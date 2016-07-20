<?php
class DB{
	private static $_instance = NULL;

	private function __construct(){
		try{
			$dsn = "mysql:host=". HOST . ";dbname=" . DB_NAME . ";charset=UTF8";
			self::$_instance = new PDO($dsn, USER, PASS);
		}
		catch(PDOException $e){
			echo "Подключение не удалось! " . $e->getMessage();
			exit;
		}
	}
	private function __clone(){}
	private function __wakeup(){}

	static function getInstance(){
		if (!is_object(self::$_instance)){
			new self;
		}
		return self::$_instance;
	}
}