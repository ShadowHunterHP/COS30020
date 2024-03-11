<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Web Programming - Lab 08</h1>
    <?php
    require_once("settings.php");
    $conn = @mysqli_connect(
        $host,
        $user,
        $pswd,
        $dbnm
    );
    if (!$conn) {
        echo "<p>Database connection failure</p>";
    } else {
        $sql_table = "vipmembers";
        $query = "select member_id, fname, lname FROM $sql_table ORDER BY member_id";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "<p>There are no VIP members at the moment.</p>";
        } else {
            echo "<table>\n";
            echo "<tr>\n "
                . "<th scope=\"col\">Membership Number</th>\n "
                . "<th scope=\"col\">First Name</th>\n "
                . "<th scope=\"col\">Last Name</th>\n "
                . "</tr>\n ";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>\n ";
                echo "<td>", $row["member_id"], "</td>\n ";
                echo "<td>", $row["fname"], "</td>\n ";
                echo "<td>", $row["lname"], "</td>\n ";
                echo "</tr>\n ";
            }
            echo "</table>\n ";
            mysqli_free_result($result);
        }
        mysqli_close($conn);
    }
    ?>
</body>

</html>