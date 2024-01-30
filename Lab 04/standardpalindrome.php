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
    <h1>Lab04 Task 3 - Standard Palindrome</h1>
    <?php
        if (isset ($_POST["string"])) {
            $str = $_POST["string"];
            $pattern = "/^[A-Za-z\p{P} ]+$/";
            if (preg_match($pattern, $str)) {
                $strnopunc = str_replace('\p{P}',"", $str);
                $str1 = strtolower($strnopunc);
                $str2 = strrev($str1);
                if ($str2 == $str1) {
                    echo "<p>The text you entered '", $str, "' is a standard palindrome!";
                } else {
                    echo "<p>The text you entered '", $str, "' is not a standard palindrome!";
                }
            } else {
                echo "<p>Please enter a string that don't have a number.</p>";
            }
        } else {
            echo "<p>Please enter string from the input form.</p>";
        }
    ?>
</body>
</html>