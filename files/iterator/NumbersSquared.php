<?php
class NumbersSquared implements Iterator{
	private $start;
	private $end;
	private $current;
	function __construct($a, $b){
		$this->start = $a;
		$this->end = $b;
	}
	function rewind(){
		$this->current = $this->start;
	}
	function valid(){
		return ($this->current > $this->end)? false : true;
	}
	function next(){
		++$this->current;
	}
	function key(){
		return $this->current;
	}
	function current(){
		return pow($this->current, 2);
	}
}

$iter = new NumbersSquared(3, 7);

foreach ($iter as $num=>$square) {
	echo "Квадрат числа $num = $square" . PHP_EOL;
}
