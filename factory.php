<?php

interface IUser {

	function getType();
}

class User_Admin implements IUser {

	public function __construct() {

	}

	public function getType() {

		return "Admin";
	}

}

class User_Visitor implements IUser {

	public function __construct() {

	}

	public function getType() {

		return "Visitor";
	}

}

class UserFactory {

	public static function Create($level) {

		$user;

		switch($level) {

			case 1:
				$user = new User_Admin;
				break;

			case 2:
			default:
				$user = new User_Visitor;
				break;
		}

		return new $user;
	}

}

$uo = UserFactory::Create(1);
echo( $uo->getType() . "\n" );
$uo = UserFactory::Create(2);
echo( $uo->getType() . "\n" );
$uo = UserFactory::Create(42);
echo( $uo->getType() . "\n" );
?>