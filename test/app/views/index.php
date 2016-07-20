<!DOCTYPE html>
<html lang="en-US">
<head>
    <title>Модная платформа для жительниц мегаполиса, ценящих время, но обожающих шопинг.</title>
    <meta charset="UTF-8">
</head>
<body>
	<h2>HEADER</h2>
	<hr>
	<?php foreach($text as $item): ?>
	<h2>
		<a href="/test/index.php?controller=view&id=<?=$item['id']?>"><?=$item['title']?></a>
	</h2>
	<p>
		<?=$item['full_text']?>
	</p>

	<?php endforeach; ?>
	<hr>
	<h2>FOOTER</h2>

</body>
</html>