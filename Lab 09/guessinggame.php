<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Nguyen Anh Vu" />
    <title>TITLE</title>
</head>

<body>
    <h1>Web Programming - Lab 09</h1>
    <h2>Guessing Game</h2>
    <p>Enter a number between 1 and 100, then press the guess button.</p>
    <form action="guessinggame.php" method="post">
        <input type="text" name="guessnumber">
        <input type="submit" value="Guess">
    </form>
    <a href="giveup.php">Give Up</a>
    <a href="startover.php">Start Over</a>
<?php
if (!isset($_SESSION["random"], $_SESSION["count"])) {
    $_SESSION["random"] = rand(1, 100);
    $_SESSION["count"] = 0;
}

if (isset($_POST["guessnumber"])) {
    $num = $_POST["guessnumber"];
    if ($num !== "" && is_numeric($num) && $num >= 1 && $num <= 100) {
        $_SESSION["count"]++;
        if ($num > $_SESSION["random"]) {
            echo "<p>Your number is higher than the hidden number.</p>";
        } elseif ($num < $_SESSION["random"]) {
            echo "<p>Your number is lower than the hidden number.</p>";
        } else {
            echo "<p>Congratulations! You guessed the hidden number.</p>"
                . "<p> Number of guesses: " . $_SESSION['count'] . ".</p>";
        }
    } else {
        echo "<p>Please enter a number between 1 and 100 >.<</p>";
    }
}
?>
</body>

</html>
