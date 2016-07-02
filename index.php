<?php
session_start();
if (!isset($_SESSION['stopQuestionId'])) {
	$_SESSION['stopQuestionId'] = [];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="style.css">
</head>
<body style="margin: 0;">

<pre>

<?php
?>
</pre>
<div style="width: 50%; float: left; box-sizing: border-box; padding:5px;">
<button class="refresh">Обновить все вопросы</button>
<hr>
<pre>
<?php
//$dsn = 'mysql:host=127.0.0.1;dbname=questions;charset=UTF8';
$dsn = 'sqlite:questions.sqlite';
$user = 'root';
$password = '';

try {
    $conn = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
//$RANDOMFUNC = "RAND(\"{time()}\")";
$RANDOMFUNC = "RANDOM()";
$sql= "SELECT `id`, `title` FROM `parts` ORDER BY `sort` ASC";
foreach ($conn->query($sql) as $row) {
	if (!array_key_exists($row['id'], $_SESSION['stopQuestionId'])) {
		$_SESSION['stopQuestionId'][$row['id']] = [];
	}
	$stopQuestionId = implode(', ', $_SESSION['stopQuestionId'][$row['id']]);
	$partSql= "SELECT * FROM `questions` WHERE `part_id` = '{$row['id']}' AND `questions`.`id` NOT IN ({$stopQuestionId}) ORDER BY {$RANDOMFUNC} LIMIT 1";
	$sqlCount= "SELECT COUNT(*) AS count FROM `questions` WHERE `part_id` = '{$row['id']}' AND `questions`.`id` NOT IN ({$stopQuestionId})";
	foreach ($conn->query($sqlCount) as $rowCount) {
		$countAll = $rowCount['count'];
	}
	foreach ($conn->query($partSql) as $partRow) {
		if ($countAll == 1) {
			$_SESSION['stopQuestionId'][$row['id']] = [];
		}
		if (!in_array($partRow['id'], $_SESSION['stopQuestionId'][$row['id']])) {
			$_SESSION['stopQuestionId'][$row['id']][] = $partRow['id'];
		}
		echo "<div id='question_". $row['id'] ."'>";
        echo "<h2>". $row['title'] ."</h2>" ."<h4>".htmlspecialchars($partRow['question']) ."<h4>";
        echo "<button class='newQuestion' data-part='". $row['id'] ."' data-q='". $partRow['id'] ."'>Другой вопрос</button><br><br>";
		echo "<a href='#' class='readMore'>Ответ</a>";
		echo "<div style='display: none'>";
		echo htmlspecialchars($partRow['answer']);
		echo "</div>";
		echo "</div><hr>";
	}
}
?>
<button class="refresh">Обновить все вопросы</button>
<hr>
</pre>
</div>
<div style="width: 50%; float: right; box-sizing: border-box; border-left: 1px solid #ccc; padding:5px;">
<h3>Поиск вопросов по базе</h3>
<form action="/" method="post">
	<input type="text" name="search" value="<?php if(isset($_POST['search'])) echo $_POST['search']; ?>">
	<input type="submit" value="GO">
</form>
<hr>
<pre>
<?php
	if (isset($_POST['search'])) {
		$sql= "SELECT `questions`.id, `questions`.question, `questions`.answer, `parts`.`title`  FROM `questions` JOIN `parts`  ON `questions`.part_id = `parts`.id AND (`question` LIKE '%{$_POST['search']}%' OR `answer` LIKE '%{$_POST['search']}%' OR `parts`.`title` LIKE '%{$_POST['search']}%') ORDER BY `parts`.`sort` ASC";
		foreach ($conn->query($sql) as $row) {
			echo "<h2>". $row['title'] ."</h2>" ."<h4>". htmlspecialchars($row['question']) ."<h4>";
			echo "#{$row['id']}\r\n";
			echo "<a href='#' class='readMore'>Ответ</a>";
			echo "<div style='display: none'>";
			echo htmlspecialchars($row['answer']);
			echo "</div><hr>";
		}
	}
?>
</pre>
</div>
<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="/main.js"></script>
</body>
</html>