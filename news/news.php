<?php
spl_autoload_register(function($class_name){
		require_once './classes/'. $class_name.'.class.php';
});
//include 'NewsDB.class.php';
$news = new NewsDB;
$errMsg = '';
if($_SERVER['REQUEST_METHOD']=='POST')
	include 'save_news.inc.php';
if(isset($_GET['del']) && is_numeric($_GET['del'])){
	include "delete_news.inc.php";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<title>Новостная лента</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<h1>Последние новости</h1>
<?php
if($errMsg)
	echo $errMsg;
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

Заголовок новости:<br />
<input type="text" name="title" /><br />
Выберите категорию:<br />
<select name="category">
	<?php
	foreach ($news as $v => $n) {
		echo "<option value='$v'>$n</option>";
	}
	?>
</select>
<br />
Текст новости:<br />
<textarea name="description" cols="50" rows="5"></textarea><br />
Источник:<br />
<input type="text" name="source" /><br />
<br />
<input type="submit" value="Добавить!" />

</form>

<?php
require_once "get_news.inc.php";
?>

</body>
</html>