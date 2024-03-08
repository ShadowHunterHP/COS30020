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
    <h1>Web Programming - Lab 08</h1>
    <?php
    require_once("settings.php");
    $conn = mysqli_connect($host, $user, $pswd, $dbnm);
    if (!$conn) {
        echo "<p>Database connection failure</p>";
    } else {

        $sql_table = "cars";

        $query = "select make, model, price FROM cars ORDER BY make, model";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo "<p>Something is wrong with ", $query, "</p>";
        } else {
            echo "<table border=\"1\">\n";

            echo "<tr>\n "
                . "<th scope=\"col\">Make</th>\n "
                . "<th scope=\"col\">Model</th>\n "
                . "<th scope=\"col\">Price</th>\n "
                . "</tr>\n ";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>\n ";
                echo "<td>", $row["make"], "</td>\n";
                echo "<td>", $row["model"], "</td>\n";
                echo "<td>", $row["price"], "</td>\n";
                echo "<tr>\n ";
            }
            echo "</table>\n";

            mysqli_free_result($result);
        }

        mysqli_close($conn);
    }

    ?>
</body>

</html>
