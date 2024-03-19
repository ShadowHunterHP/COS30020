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
    <?php
        echo "<p>The hidden number was: " . $_SESSION["random"] .".</p>";
    ?>
    <a href="startover.php">Start Over</a>
</body>
</html>
