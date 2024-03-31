<?php
function sanitise($x)
{
    $data = trim($x);
    $data = stripslashes($x);
    $data = htmlspecialchars($x);
    return $x;
}

$_SESSION["login_status"] = FALSE;
$_SESSION["profile_name"] = $_SESSION["friend_id"] = "";
$email = $profile = $pass = $repass = $email_error = $profile_error = $pass_error = $repass_error = $db_error = "";
$profile_regex = "/^[a-zA-Z]+$/";
$pass_regex = "/^[a-zA-Z0-9]+$/";

//Validate user input
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

    if (empty($_POST["profile"])) {
        $profile_error = "*Profile Name is required";
        $errors += 1;
    } else {
        $profile = sanitise($_POST["profile"]);
        if (!preg_match($profile_regex, $profile)) {
            $profile_error = "*Profile Name can only contain letters";
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

    if (empty($_POST["repass"])) {
        $repass_error = "*Password confirmation is required";
        $errors += 1;
    } else {
        $repass = sanitise($_POST["repass"]);
        if (strcmp($pass, $repass) != 0) {
            $repass_error = "*Password confirmation does not match";
            $errors += 1;
        }
    }

    //Connect to the database
    require_once ("db_connect.php");
    $conn = @mysqli_connect($host, $user, $pswd, $dbnm);
    if (!$conn) {
        $db_error = "<p>Unable to connect to the database. Please try again later!</p>";
    } else {
        $query_mail = "SELECT friend_email FROM friends WHERE friend_email = '$email';";
        $result = mysqli_query($conn, $query_mail);
        $num_rows = mysqli_num_rows($result);
        if ($num_rows > 0) {
            $email_error = "*This email is already registered";
            $errors += 1;
        }
        mysqli_free_result($result);
        if ($errors == 0) {
            //Insert when there are no errors
            $insert_query = "INSERT INTO friends 
									(friend_id, friend_email, password, profile_name, date_started, num_of_friends)
								VALUES
									(NULL, '$email', '$pass', '$profile', NOW(), '0');";
            $add_account = mysqli_query($conn, $insert_query);
            if ($add_account) {
                //Set up the session variables
                $_SESSION["profile_name"] = $profile;
                $_SESSION["friend_id"] = mysqli_insert_id($conn);
                $_SESSION["num_of_friends"] = 0;
                $_SESSION["login_status"] = TRUE;
                header("location: friendadd.php");
            } else {
                $db_error = "<p>We are presently experiencing database difficulties. Please try again later!</p>";
            }
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
        <h1>My Friend System - Registeration Page</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate="novalidate">

            <p>
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo $email; ?>" />
                <span class="error">
                    <?php echo $email_error; ?>
                </span>
            </p>

            <p>
                <label for="profile">Profile Name:</label>
                <input type="text" id="profile" name="profile" value="<?php echo $profile; ?>" />
                <span class="error">
                    <?php echo $profile_error; ?>
                </span>
            </p>

            <p>
                <label for="pass">Password:</label>
                <input type="text" id="pass" name="pass" />
                <span class="error">
                    <?php echo $pass_error; ?>
                </span>
            </p>

            <p>
                <label for="repass">Confirm Password:</label>
                <input type="text" id="repass" name="repass" />
                <span class="error">
                    <?php echo $repass_error; ?>
                </span>
            </p>

            <input type="submit" value="Register" id="register-button">
            <br>
            <hr>
            <div class="container">
                <a href="index.php">Back to the Home Page</a>
            </div>
        </form>
    </div>
</body>

</html>