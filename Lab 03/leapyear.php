<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Lab 03 Task 2 - Leap Year</h1>
<hr class="dashed">
<?php
    if(isset($_GET["year"]) and is_numeric($_GET["year"])) {
        $year = $_GET["year"];
        is_leapyear($year);
    } else {
        echo "<p>Please enter a year.</p>";
    }

    function is_leapyear($year) {
        if(($year %4 == 0) and ($year %100 !== 0)) {
            echo"<p>The year you entered ", $year, " is a leap year.</p>";
        } elseif(($year %100 == 0) and ($year %400 == 0)) {
            echo"<p>The year you entered ", $year, " is a leap year.</p>";
        } else {
            echo"<p>The year you entered ", $year, " is not a leap year.</p>";
        }
    }
?>
</body>
</html>
