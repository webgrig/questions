<?php
abstract class AController{
	abstract function getBody();

	protected function render($file, array $params){
		extract($params);
		ob_start();
		require_once './app/views/' . $file . '.php';
		return ob_get_clean();
	}
}