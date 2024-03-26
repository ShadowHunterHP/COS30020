<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Web application development" />
	<meta name="keywords" content="PHP" />
	<meta name="author" content="Nguyen Anh Vu" />
	<title>Lab10 - Task 2</title>
</head>
<body>
<?php
	require_once (__DIR__."/../../data/Lab 10/mykeys.inc.php");
	require_once ("hitcounter.php");

	$Counter = new Counter($host, $user, $pswd, $dbnm, $tbnm);

	$Counter->startOver();

	$Counter->closeConnection();

	echo "<p>Hit Count Reseted</p>";
	echo "<p><a href=\"countvisits.php\">Hit The Page!</a></p>";
?>
</body>
</html>