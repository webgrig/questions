<?php
header('Content-Type: text/html;charset="UTF-8"');
require_once 'config.php';

function __autoload($className){
	if(file_exists('./app/controllers/' . $className . '.php'))
		require_once './app/controllers/' . $className . '.php';
	else
		require_once './app/models/' . $className . '.php';
}

if (isset($_GET['controller'])) {
	$controller = strip_tags($_GET['controller']);

	switch ($controller) {
		case 'view':
			$init = new View();
			break;

		default:
			$init = new Index();
			break;
	}
}
else
	$init = new Index();

echo $init->getBody();