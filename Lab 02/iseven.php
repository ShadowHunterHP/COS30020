<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $value = $_GET['text'];
        //$value = (4);
        ($number = (is_numeric($value)))?
            $number = $value : $result = "is not a number";
        ($result = ($number %2 == 0))?
            $result = "is an even number" : $result = "is an odd number";
        echo"<p>$value $result.</p>";
    ?>
</body>
</html>
