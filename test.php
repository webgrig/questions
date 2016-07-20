<?php
Class One {
	function foo() {

		echo 'Hello from class One!';
	}
	function callMe() {
		$this->foo();
	}
}

Class Two extends One {
	function foo() {
		echo 'Hello from class Two';
	}
}

$Two = new two();
$Two->callMe();