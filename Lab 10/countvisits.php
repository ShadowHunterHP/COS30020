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

	echo "<h1>Hit Counter</h1>";
	
	$Counter->setHits();
	
	$num = $Counter->getHits();
	echo "<p>" . $num . "</p>";

	$num_hit = explode(" ",$num);
	if ($num_hit[4] >= 3) {
		echo "<p><strong>How cruel and violent...</strong></p><br>";
	}

	$Counter->closeConnection();

	echo "<p>I know you would want to refresh this page to hit it more .-. </p>";
	echo "<p><a href=\"startover.php\">or maybe reset the number of hits to show that we are not violent at all ‿︵‿︵‿︵‿ヽ(°□° )ノ︵‿︵‿︵‿︵ </a></p>";
?>
</body>
</html>
