<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Web Programming - Lab 08</h1>
    <form method="post" action="member_search.php">
        <fieldset>
            <legend>Finding a VIP Member</legend>
            <p> <label for="lname">Last Name: </label>
                <input type="text" name="lname" id="lname" />
            </p>
            <p> <input type="submit" value="Search" /></p>
        </fieldset>
    </form>
    <?php
    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $show_all = "select member_id, fname, lname, email FROM vipmembers";

    if (isset($_POST["lname"]) && $_POST["lname"] !== "") {
        $lname = sanitise_input($_POST["lname"]);
        $query = $show_all . " WHERE lname LIKE '%$lname%'";

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
            $result = mysqli_query($conn, $query);
            if (!$result) {
                echo "<p>This member has not registered yet.</p>";
            } else {
                echo "<table>\n";
                echo "<tr>\n "
                    . "<th scope=\"col\">Membership Number</th>\n "
                    . "<th scope=\"col\">First Name</th>\n "
                    . "<th scope=\"col\">Last Name</th>\n "
                    . "<th scope=\"col\">Email</th>\n "
                    . "</tr>\n ";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>\n ";
                    echo "<td>", $row["member_id"], "</td>\n ";
                    echo "<td>", $row["fname"], "</td>\n ";
                    echo "<td>", $row["lname"], "</td>\n ";
                    echo "<td>", $row["email"], "</td>\n ";
                    echo "</tr>\n ";
                }
                echo "</table>\n ";
                mysqli_free_result($result);
            }
            mysqli_close($conn);
        }
    } else {
        echo "<br><a href='member_add_form.php'>Add New Member Form</a><br>";
        echo "<a href='member_display.php'>Display All Members Page</a><br>";
    }
    ?>
</body>

</html>