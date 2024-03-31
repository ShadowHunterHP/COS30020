<?php
session_start();

function sanitise($x)
{
    $data = trim($x);
    $data = stripslashes($x);
    $data = htmlspecialchars($x);
    return $x;
}

$_SESSION["login_status"] = FALSE;
$_SESSION["profile_name"] = $_SESSION["friend_id"] = "";
$email = $pass = $email_error = $pass_error = $db_error = "";
$pass_regex = "/^[a-zA-Z0-9]+$/";

//Validate user account
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = 0;
    if (empty($_POST["email"])) {
        $email_error = "* Email address is required";
        $errors += 1;
    } else {
        $email = sanitise($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_error = "* Please enter a valid email";
            $errors += 1;
        }
    }

    if (empty($_POST["pass"])) {
        $pass_error = "*Password is required";
        $errors += 1;
    } else {
        $pass = sanitise($_POST["pass"]);
        if (!preg_match($pass_regex, $pass)) {
            $pass_error = "*Password can only contain letters and numbers";
            $errors += 1;
        }
    }

    //Connect to the database
    require_once ("db_connect.php");
    $conn = @mysqli_connect($host, $user, $pswd, $dbnm);
    if (!$conn) {
        $db_error = "<p>Unable to connect to the database. Please try again later! <p>";
    } else {
        $query_mail = "SELECT * FROM friends WHERE friend_email = '$email' AND password = '$pass';";
        $result = mysqli_query($conn, $query_mail);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows == 0) {
            //when we don't have any email or password match
            $db_error = "<p>This account does not exist!</p>";
            $errors += 1;
        }
        if ($errors == 0) {
            //set up the session variables
            $row = mysqli_fetch_assoc($result);
            $_SESSION["profile_name"] = $row["profile_name"];
            $_SESSION["friend_id"] = $row["friend_id"];
            $_SESSION["num_of_friends"] = $row["num_of_friends"];
            $_SESSION["login_status"] = TRUE;
            mysqli_free_result($result);
            header("location: friendlist.php");
        }
        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Definitely A Facebook Look-a-like</title>
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/de2fd42e42.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="real-body">
        <h1>My Friend System - Login Page</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate="novalidate">

            <p>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>" />
                <span class="error">
                    <?php echo $email_error; ?>
                </span>
            </p>

            <p>
                <label for="pass">Password:</label>
                <input type="text" id="pass" name="pass" />
                <span class="error">
                    <?php echo $pass_error; ?>
                </span>
            </p>

            <input type="submit" value="Log In">
            <br>
            <hr>

            <div class="container">
                <?php echo $db_error; ?>
            </div>

            <div class="container">
                <a href="index.php">Return to Home Page</a>
            </div>

        </form>
    </div>
</body>

</html>