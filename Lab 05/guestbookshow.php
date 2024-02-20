<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lab 05 Task 2 - Guest Book</h1>
    <hr>
    <?php
    $filename = "../../data/lab05/guestbook.txt";
    $dir = "../../data/lab05";
    if (file_exists($dir) && is_readable($filename)) {
        $handle = fopen($filename, "r");
        $data = file_get_contents($filename);
        $data = stripslashes($data);
        echo "<pre>$data</pre>";
        fclose($handle);
    } else {
        echo "<p>File is unreadable or does not exist</p>";
    }
    ?>
</body>
</html>