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
    <h1>Lab04 Task 2 - Perfect Palindrome</h1>
    <?php
        if (isset ($_POST["word"])) {
            $str = $_POST["word"];
            $pattern = "/^[A-Za-z ]+$/";
            if (preg_match($pattern, $str)) {
                $str1 = strtolower($str);
                $str2 = strrev($str1);
                if ($str2 == $str1) {
                    echo "<p>The text you entered '", $str, "' is a perfect palindrome!";
                } else {
                    echo "<p>The text you entered '", $str, "' is not a perfect palindrome!";
                }
            } else {
                echo "<p>Please enter a string containing only letters or space.</p>";
            }
        } else {
            echo "<p>Please enter string from the input form.</p>";
        }
    ?>
</body>
</html>