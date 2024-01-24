<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("mathfunctions.php");
    ?>
    <h1>Web Programming - Lab 3</h1>
    <?php
        if(isset($_GET["number"]) and is_numeric($_GET["number"])) {
            $num = $_GET["number"];
            if($num > 0) {
                if($num == round ($num)) {
                    echo "<p>", $num, "! is ", factorial($num), ".</p>";
                } else {
                    echo "<p>Please enter an integer.</p>";
                }
            } else {
                echo "<p>Please enter a positive integer.</p>";
            }
        } else {
            echo "<p>Please enter a positive integer.</p>";
        }
    ?>
</body>
</html>
