<?php
if(NULL !== $_POST['updateQ']) {
	//$dsn = 'mysql:host=127.0.0.1;dbname=questions;charset=UTF8';
	$dsn = 'sqlite:questions.db';
	$user = 'root';
	$password = '';

	try {
	    $conn = new PDO($dsn);
	} catch (PDOException $e) {
	    echo 'Подключение не удалось: ' . $e->getMessage();
	}
	$sql= "SELECT * FROM `questions` JOIN `parts` ON `questions`.`part_id` = `parts`.`id` AND `questions`.`part_id` = '{$_POST['updatePart']}' AND `questions`.`id`!={$_POST['updateQ']} ORDER BY RANDOM() LIMIT 1";
	foreach ($conn->query($sql) as $row) {
		echo "<h2>". $row['title'] ."</h2>" ."<h4>".$row['question'] ."<h4>";
        echo "<button class='newQuestion' data-part='". $row['id'] ."' data-q='". $row['id'] ."'>Другой вопрос</button><br><br>";
		echo "<a href='#' class='readMore'>Ответ</a>";
		echo "<div style='display: none'>";
		echo $row['answer'];
		echo "</div>";
	}
}