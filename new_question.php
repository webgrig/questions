<?php
session_start();
if (!isset($_SESSION['stopQuestionId'])) {
	$_SESSION['stopQuestionId'] = [];
}
if(NULL !== $_POST['updatePart']) {
	$dsn = 'mysql:host=127.0.0.1;dbname=questions;charset=UTF8';
	$dsn = 'sqlite:questions.sqlite';
	$user = 'root';
	$password = '';

	try {
	    $conn = new PDO($dsn, $user, $password);
	} catch (PDOException $e) {
	    echo 'Подключение не удалось: ' . $e->getMessage();
	}
	$RANDOMFUNC = 'RAND()';
	$RANDOMFUNC = 'RANDOM()';
	if (!in_array($_POST['updateQ'], $_SESSION['stopQuestionId'][$_POST['updatePart']])) {
		$_SESSION['stopQuestionId'][$_POST['updatePart']][] = $_POST['updateQ'];
	}
	$stopQuestionId = implode(', ', $_SESSION['stopQuestionId'][$_POST['updatePart']]);
	$sql= "SELECT `questions`.id AS id1, * FROM `questions` JOIN `parts` ON `questions`.`part_id` = `parts`.`id` AND `questions`.`part_id` = '{$_POST['updatePart']}' AND `questions`.`id` NOT IN ({$stopQuestionId}) ORDER BY {$RANDOMFUNC} LIMIT 1";
	$sqlCount= "SELECT COUNT(*) AS count FROM `questions` JOIN `parts` ON `questions`.`part_id` = `parts`.`id` AND `questions`.`part_id` = '{$_POST['updatePart']}' AND `questions`.`id` NOT IN ({$stopQuestionId})";
	foreach ($conn->query($sqlCount) as $rowCount) {
		$countAll = $rowCount['count'];
	}
	foreach ($conn->query($sql) as $row) {
		if (!array_key_exists($_POST['updatePart'], $_SESSION['stopQuestionId'])) {
			$_SESSION['stopQuestionId'][$_POST['updatePart']] = [];
		}
		if ($countAll == 1) {
			$_SESSION['stopQuestionId'][$_POST['updatePart']] = [];
		}
		$question = htmlspecialchars($row['question'], ENT_NOQUOTES);
		echo "<h2>". $row['title'] ."</h2>" ."<h4>". preg_replace("/\&lt\;(img.*)\&gt\;/mi", "<$1>", $question) ."</h4>";
        echo "<button class='newQuestion' data-part='". $row['id'] ."' data-q='". $row['id1'] ."'>Другой вопрос</button><br><br>";
		echo "<a href='#' class='readMore'>Ответ</a>";
		echo "<div style='display: none'>";
		$answer = htmlspecialchars($row['answer'], ENT_NOQUOTES);
		echo preg_replace("/\&lt\;(img.*)\&gt\;/mi", "<$1>", $answer);
		echo "</div>";
	}
}