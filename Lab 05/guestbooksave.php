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
        if ((isset($_POST["fname"])) && (isset($_POST["lname"]))) {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $filename = "../../data/guestbook.txt";
            umask(0007);
            $dir = "../../data/lab05";
        if (!file_exists($dir)) {
            mkdir($dir, 02770);
        }
        $handle = fopen($filename, "a");
        if (is_writable($filename)) {
            $fname = addslashes($fname);
            $lname = addslashes($lname);
            $data = $fname . "," . $lname . "\r\n";
            if (fwrite($handle, $data) === false) {
                echo"<p>Cannot add your name to the Guest book</p>";
            } else {
                echo"<p>Thank you for signing the Guest book</p>";
            }
            fclose($handle);
        } else {
            echo"<p>Cannot add your name to the Guest book</p>";
            fclose($handle);
        }
        } else {
            echo "<p>You must enter your first and last name!</p>";
            echo "<p>Use the Browser's 'Go Back' button to return to the Guestbook form.</p>";
        }
    ?>
    <a href="guestbookshow.php">Show Guest Book</a>
</body>
</html>