<!DOCTYPE html>
<html>
<head>
	<title>Паттерны проектирования</title>
	<link rel="stylesheet" href="style.css">
	<!--meta http-equiv="refresh" content="3;url=/"-->
</head>
<body>
<?php

?>
<script type="text/javascript" src="jquery-1.11.3.min.js"></script>
<script type="text/javascript">
	$(".readMore").on('click', function(e){
		e.preventDefault();
		$(this).next().toggle('slow');
	});
	$(".refresh").on('click', function(e){
		e.preventDefault();
		window.location.href = '/';
	});
</script>
</body>
</html>