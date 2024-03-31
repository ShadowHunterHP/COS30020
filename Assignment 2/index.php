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
<?php
	$db_message = "";

	// Create and populate data if not exists
	$create_query1 = "CREATE TABLE IF NOT EXISTS friends (
						friend_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
						friend_email VARCHAR(50) NOT NULL,
						password VARCHAR(20) NOT NULL,
						profile_name VARCHAR(30) NOT NULL,
						date_started date NOT NULL,
						num_of_friends INT UNSIGNED
						);";

	$create_query2 = "CREATE TABLE IF NOT EXISTS myfriends (
						friend_id1 INT NOT NULL,
						friend_id2 INT NOT NULL
						);";

	$insert_query1 = "INSERT IGNORE INTO friends
						(friend_id, friend_email, password, profile_name, date_started, num_of_friends)
					VALUES
                        (1, 'fknight0@constantcontact.com', 'eQ3dpe1', 'Federico', '2023-02-24', 3),
                        (2, 'hkobierzycki1@archive.org', 'oS8otOqW', 'Hanni', '2023-01-31', 3),
                        (3, 'bspurret2@whitehouse.gov', 'tD6oS7DW', 'Boniface', '2023-10-21', 4),
                        (4, 'pedgett3@salon.com', 'eN8N5pkG', 'Portie', '2023-10-24', 5),
                        (5, 'aheaney4@state.tx.us', 'fQ67lTeC', 'Artair', '2023-05-25', 1),
                        (6, 'cdoblin5@vistaprint.com', 'aX8mT4qLm', 'Chet', '2023-08-23', 1),
                        (7, 'ggiral6@constantcontact.com', 'cF0XDfIg3', 'Gasper', '2023-12-19', 3),
                        (8, 'dlerwill7@ifeng.com', 'vU3PvcRi', 'Dosi', '2023-08-31', 1),
                        (9, 'mshropshire8@taobao.com', 'fR80yxwg', 'Marietta', '2023-01-07', 2),
                        (10, 'ebroxton9@fc2.com', 'hN2zZDyf', 'Ervin', '2023-04-20', 3)";

	$insert_query2 = "INSERT INTO myfriends
						(friend_id1, friend_id2)
					VALUES
						('1','3'),
						('1','4'),
						('1','5'),
						('3','1'),
						('4','1'),
						('5','1'),
						('2','4'),
						('2','5'),
						('2','6'),
						('4','2');";

	//connect to the database
	require_once ("db_connect.php");
	$conn = @mysqli_connect($host, $user, $pswd, $dbnm);
	if (!$conn) {
		$db_message = "<p>Database connection error.. Please try again later!</p>";
	} else {
		$result1 = mysqli_query($conn, $create_query1);
		$result2 = mysqli_query($conn, $create_query2);
		if ($result1 && $result2) {
			$result3 = mysqli_query($conn, $insert_query1);
			$myfriends_query = mysqli_query($conn, "SELECT * FROM myfriends");
			$rows = mysqli_num_rows($myfriends_query);
			if ($rows == 0) {
				$result4 = mysqli_query($conn, $insert_query2);
				$rows += 20;
			}
			if ($result3 && $rows > 0) {
				$db_message = "<p>Tables successfully created and populated!</p>";
			} else {
				$db_message = "<p>Data inserted unsuccessfully!</p>";
			}
		} else {
			$db_message = "<p>Table cannot be created!</p>";
		}
		mysqli_close($conn);
	}
	?>

    <div class="real-body">
        <h1>My Friend System</h1>

        <dl>
            <dt>Name</dt>
            <dd>Nguyen Anh Vu</dd>
            <dt>Student ID</dt>
            <dd>10380607</dd>
            <dt>Email</dt>
            <dd>103806007@student.swin.edu.au</dd>
        </dl>

        <p>I declare that this assignment is my individual work.
            I have not worked collaboratively nor have I copied from any other student's work or from any other source.
        </p>

        <div class="container">
            <a href="signup.php">Sign Up Page</a>
            <a href="login.php">Log In Page</a>
            <a href="about.php">About Me</a>
        </div>

        <div class="container">
			<?php echo $db_message; ?>
		</div>
    </div>
</body>

</html>