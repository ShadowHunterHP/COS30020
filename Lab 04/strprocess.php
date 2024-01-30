<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Your Name" />
<title>TITLE</title>
</head>
<body>
    <h1>Web Programming - Lab 4</h1>
    <?php
        if (isset ($_POST["strform.php"])) {
            $str = $_POST["strform.php"];
            $pattern = "/^[A-Za-z ]+$/";
        if (_______(3)________) {
            $ans = "";
            $len = _____(4)________;
        for ($i = 0; $i < $len; $i++) {
            $letter = substr ($str, (5), 1);
            if ((strpos ("AEIOUaeiou", (6))) === false){
                $ans = $ans . $letter;
            }
        }
            echo "<p>The word with no vowels is ", $ans, ".</p>";
        } else {
            echo "<p>Please enter a string containing only letters or space.</p>";
        }
        } else {
            echo "<p>Please enter string from the input form.</p>";
        }
    ?>
</body>
</html>