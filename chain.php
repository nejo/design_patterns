<?php

interface ICommand {

	function onCommand($name, $args);
}

abstract class Command_Abstract implements ICommand {

	public function onCommand($name, $args) {

		if ( !method_exists($this, $name) ) {

			return false;
		}

		$this->$name();

		echo( __CLASS__." handling '$name'\n" );

		return true;
	}
}

class CommandChain {

	private $_commands = array();

	public function addCommand($cmd) {

		$this->_commands [] = $cmd;
	}

	public function runCommand($name, $args) {
		
		foreach ($this->_commands as $cmd) {

			if ($cmd->onCommand($name, $args)) {

				// done!
				// could log event into an observer
			}
		}
	}

}

class UserCommand extends Command_Abstract {

	public function addUser() {

	}

	public function restore() {

	}
}

class MailCommand extends Command_Abstract {	

	public function mail() {

	}

	public function restore() {

	}
}

$cc = new CommandChain();

$cc->addCommand(new UserCommand());
$cc->addCommand(new MailCommand());

$cc->runCommand('addUser', null);
$cc->runCommand('mail', null);
$cc->runCommand('restore', null);
?>