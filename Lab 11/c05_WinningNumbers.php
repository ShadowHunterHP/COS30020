<!DOCTYPE html>
<html>
<head>
<title>Winning Numbers</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
<h1>Winning Numbers</h1>
<hr />
<?php
$PossibleNumbers = array();
// Wrong loop syntax, should be for (condition1; condition2) {
for ($i=1; $i<100; ++$i) {
	$PossibleNumbers[] = $i;
}
shuffle($PossibleNumbers);
$WinningNumbers = array_slice($PossibleNumbers, 0, 5);
//Wrong syntax. As, not at
foreach ($WinningNumbers as $Number) {
	echo "$Number<br />";
}

?>
</body>
</html>
