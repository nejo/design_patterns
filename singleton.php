<?php

class DB_Adapter_Mysql {

	protected $_adapter = '';

	public function __construct() {

		$this->_adapter = 'MYSQL';
	}

}

class DB {

	public static function Connect($param1, $param2) {

		return new DB_Adapter_Mysql();
	}

}

class DatabaseConnection {

	static $instance = null;
	private $_handle = null;

	public static function getInstance() {

		if (!isset(self::$instance)) {

			$className = __CLASS__;
			self::$instance = new $className;
		}
		
		return self::$instance;
	}

	private function __construct() {

		$dsn = 'mysql://root:password@localhost/photos';
		$this->_handle = & DB::Connect($dsn, array());
	}

	public function handle() {
		
		return $this->_handle;
	}

    public function __clone() {

		trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup() {

        trigger_error('Unserializing is not allowed.', E_USER_ERROR);
    }

}

var_dump(DatabaseConnection::getInstance()->handle());
var_dump(DatabaseConnection::getInstance()->handle());
?>