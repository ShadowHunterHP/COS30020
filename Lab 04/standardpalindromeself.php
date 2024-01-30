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
            $pattern = "/^[\p{P}A-Za-z ]+$/";
            if (preg_match($pattern, $str)) {
                $strnopunc = str_replace(["?","!",",",";","'"], '', $str);
                $trimstr = str_replace(' ', '', $strnopunc);;
                $str1 = strtolower($trimstr);
                $str2 = strrev($str1);
                if ($str2 == $str1) {
                    echo "<p>The text you entered '", $str, "' is a standard palindrome!";
                } else {
                    echo "<p>The text you entered '", $str, "' is not a standard palindrome!";
                }
            } else {
                echo "<p>Please enter a string that don't have a number.</p>";
            }
        }
    ?>
    <form action="standardpalindromeself.php" method="post">
        String: <input type="text" name="string"><br>
        <input type="submit" value="Check for Standard Palindrome">
    </form>
</body>
</html>