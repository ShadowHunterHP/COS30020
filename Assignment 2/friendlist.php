<?php
session_start();

if ($_SESSION["login_status"] == FALSE) {
    header("location: index.php");
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
    <nav class="navbar" id="navigationBar">
        <?php
        if (isset ($_SESSION['profile_name'])) {
            echo '<div>';
            echo 'Hello, ' . $_SESSION['profile_name'];
            echo '</div>';
        }
        ?>
    </nav>
    <div class="real-body">
        <h1>My Friend System</h1>
        <p><?php echo $_SESSION["profile_name"]; ?>'s Add Friend Page</p>
        <p>Total number of friends is <?php echo $_SESSION["num_of_friends"]; ?></p>
        <?php

        $error_message = "";
        $fid = $_SESSION["friend_id"];

            //Connect to the database
            require_once ("db_connect.php");
            $conn = @mysqli_connect($host, $user, $pswd, $dbnm);
            if (!$conn) {
                $error_message = "<p>Unable to connect to the database. Please try again later! <p>";
            } else {
                $query_allfriends = "SELECT *
								FROM friends f
								JOIN myfriends m ON m.friend_id1 = '$fid'
								WHERE f.friend_id = m.friend_id2
								ORDER BY f.profile_name;";
                $display_friends = mysqli_query($conn, $query_allfriends);
                $count = mysqli_num_rows($display_friends);
                if ($count > 0) {
                    if ($display_friends) {
                        //only generate the table when there are records
                        echo "<div class=\"container\">\n";
                        echo "<table>\n";
                        while ($info = mysqli_fetch_assoc($display_friends)) {
                            echo "<tr>\n";
                            echo "<td>", $info["profile_name"], "</td>\n";
                            echo "<td><form class=\"form2\" method=\"post\" action=\"friendlist.php\">\n";
                            echo "<input type=\"hidden\" name=\"id1\" value=", $_SESSION["friend_id"], "/>\n";
                            echo "<input type=\"hidden\" name=\"id2\" value=", $info["friend_id"], "/>\n";
                            echo "<button type=\"submit\" name=\"unfriend\">Unfriend</button>\n";
                            echo "</form></td>\n";
                            echo "</tr>\n";
                        }
                        echo "</table>\n";
                        echo "</div>\n";
                        mysqli_free_result($display_friends);
                    } else {
                        //if no records are found
                        $error_message = "<p>The Friend list is not available at the moment.</p>";
                    }
                } else {
                    $error_message = "<p>This user currently does not have any friends. Let's make some friends, shall we??</p>";
                }

                //when the user clicks on the "unfriend" button
                if (isset($_POST["unfriend"])) {
                    $id1 = $_POST["id1"];
                    $id2 = $_POST["id2"];
                    $delete_query1 = "DELETE FROM myfriends
				WHERE friend_id1 = '$id1' AND friend_id2 = '$id2';";
                    $delete_query2 = "DELETE FROM myfriends
				WHERE friend_id1 = '$id2' AND friend_id2 = '$id1';";
                    $num_friends1 = "UPDATE friends SET num_of_friends = num_of_friends - 1 WHERE friend_id = '$id1';";
                    $num_friends2 = "UPDATE friends SET num_of_friends = num_of_friends - 1 WHERE friend_id = '$id2';";
                    $del1 = mysqli_query($conn, $delete_query1);
                    $del2 = mysqli_query($conn, $delete_query2);
                    $update_friends1 = mysqli_query($conn, $num_friends1);
                    $update_friends2 = mysqli_query($conn, $num_friends2);
                    if ($del1 && $del2 && $update_friends1 && $update_friends2) {
                        $_SESSION["num_of_friends"] -= 1;
                        header("location: friendlist.php");
                    } else {
                        $error_message = "<p>You cannot unfriend this user at the moment.</p>";
                    }
                }
                mysqli_close($conn);
            }
        ?>
        <hr>
        <div class="container">
            <?php echo $error_message; ?>
        </div>

        <div class="container">
            <a href="friendadd.php">Add Friends</a>
            <a href="logout.php">Log Out</a>
        </div>
    </div>
</body>

</html>