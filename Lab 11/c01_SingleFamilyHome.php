<!DOCTYPE html>
<html>
<head>
<title>Output Directive</title>
</head>
<body>
<?php
$SingleFamilyHome = 399500;
// Wrong variable name
$SingleFamilyHome_Print = number_format($SingleFamilyHome);
echo "<p>The current median price of a single family home in Pleasanton, CA is $$SingleFamilyHome_Print.</p>";
?>
</body>
</html>
