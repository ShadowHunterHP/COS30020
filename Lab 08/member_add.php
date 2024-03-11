<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (
        isset($_POST["fname"], $_POST["lname"], $_POST["gender"], $_POST["email"], $_POST["phonenum"])
        && $_POST["fname"] && $_POST["lname"] && $_POST["gender"] && $_POST["email"] && $_POST["phonenum"] !== ""
    ) {
        $fname = sanitise_input($_POST["fname"]);
        $lname = sanitise_input($_POST["lname"]);
        $gender = sanitise_input($_POST["gender"]);
        $email = sanitise_input($_POST["email"]);
        $phonenum = sanitise_input($_POST["phonenum"]);

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
            $create_query = "CREATE TABLE IF NOT EXISTS `vipmembers` (
								member_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
								fname VARCHAR(40) NOT NULL,
								lname VARCHAR(40) NOT NULL,
								gender VARCHAR(10) NOT NULL,
								email VARCHAR(40) NOT NULL,
								phonenum VARCHAR(20) NOT NULL
								);";
            $table = mysqli_query($conn, $create_query);
            $sql_table = "vipmembers";
            $query = "insert into $sql_table (fname, lname, gender, email, phonenum) values ('$fname', '$lname', '$gender', '$email', '$phonenum')";
            $result = mysqli_query($conn, $query);
            if (!$result) {
                echo "<p>Something is wrong with ", $query, "</p>";
            } else {
                echo "<p>A new VIP member is saved.</p>";
                echo "<hr>";
                echo "<a href='member_add_form.php'>Add New Member Form</a><br>";
                echo "<a href='member_display.php'>Display All Members Page</a><br>";
                echo "<a href='member_search.php'>Search Member Page</a>";
            }
            mysqli_close($conn);
        }
    } else {
        echo "<p>Please Enter Valid Information >.<</p>";
    }
    ?>
</body>

</html>