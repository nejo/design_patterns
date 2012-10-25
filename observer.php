<?php

interface IObserver {

	function onChanged($sender, $args, $action);
}

interface IObservable {

	function addObserver($observer);
}

class UserList implements IObservable {

	private $_observers = array();
	private $_customers = array();

	public function addCustomer($name) {

		$this->_customers[$name] = array();

		$this->_notifyObservers($name, 'ADD');
	}

	public function deleteCustomer($name) {

		if( !isset($this->_customers[$name]) ) {

			echo ("Customer Not Found ($name)\n");
		} else {
			
			unset($this->_customers[$name]);
			$this->_notifyObservers($name, 'DELETE');
		}
	}

	public function addObserver($observer) {

		$this->_observers [] = $observer;
	}

	private function _notifyObservers($name, $action) {

		foreach( $this->_observers as $obs ) {

			$obs->onChanged( $this, $name, $action );
		}
	}

}

class UserListLogger implements IObserver {

	public function onChanged($sender, $args, $action) {
		
		echo( "$action '$args' to user list\n" );
	}

}

$ul = new UserList();

$ul->addObserver(new UserListLogger());

$ul->addCustomer("Jack");
$ul->addCustomer("Bob");
$ul->deleteCustomer("Alice");
$ul->deleteCustomer("Bob");
?>