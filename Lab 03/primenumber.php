<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lab 03 Task 3 - Prime Number</h1>
    <hr class="dashed">
    <?php
    if(isset($_GET["num"]) and is_numeric($_GET["num"])) {
        $num = $_GET["num"];
        if ((0 < $num) and ($num < 1000)) {
            is_prime($num);
        } else {
            echo "<p>Please enter a number between 1 and 999.</p>";
        }
    } else {
        echo "<p>Please enter a number between 1 and 999.</p>";
    }
    function is_prime($num) {
        $prime = true;
        if ($num > 1) {
            for ($i = 2; $i < 8; $i++) {
                if ($num % $i == 0) {
                    $prime = false;
                    echo"<p>The number you entered ", $num, " is not a prime number.</p>";
                    break;
                }
            }
            if (($prime = true) and ($i == 8)) {
                echo"<p>The number you entered ", $num, " is a prime number.</p>";
            }
        } else {
            echo"<p>The number you entered ", $num, " is a prime number.</p>";
        }
    }
    ?>
</body>
</html>
