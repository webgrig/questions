<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
	<link rel="stylesheet" href="style.css">
	<!--meta http-equiv="refresh" content="3;url=/"-->
</head>
<body style="margin: 0;">

<div style="width: 50%; float: left; box-sizing: border-box; padding:5px;">
<button class="refresh">Обновить все вопросы</button>
<hr>
<pre>
<?php
//$dsn = 'mysql:host=127.0.0.1;dbname=questions;charset=UTF8';
$dsn = 'sqlite:questions.db';
$user = 'root';
$password = '';

try {
    $conn = new PDO($dsn);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
$sql= "SELECT `id`, `title` FROM `parts` ORDER BY `sort` ASC";
foreach ($conn->query($sql) as $row) {
	$partSql= "SELECT * FROM `questions` WHERE `part_id` = '{$row['id']}' /*AND `id`=233*/ ORDER BY RANDOM() LIMIT 1";
	foreach ($conn->query($partSql) as $partRow) {
		echo "<div id='question_". $row['id'] ."'>";
        echo "<h2>". $row['title'] ."</h2>" ."<h4>".$partRow['question'] ."<h4>";
        echo "<button class='newQuestion' data-part='". $row['id'] ."' data-q='". $partRow['id'] ."'>Другой вопрос</button><br><br>";
		echo "<a href='#' class='readMore'>Ответ</a>";
		echo "<div style='display: none'>";
		echo $partRow['answer'];
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
			echo "<h2>". $row['title'] ."</h2>" ."<h4>". $row['question'] ."<h4>";
			echo "#{$row['id']}\r\n";
			echo "<a href='#' class='readMore'>Ответ</a>";
			echo "<div style='display: none'>";
			echo $row['answer'];
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