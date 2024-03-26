<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="description" content="Web application development" />
	<meta name="keywords" content="PHP" />
	<meta name="author" content="Nguyen Anh Vu" />
	<title>Lab10 - Task 2</title>
</head>
<body>
	<h1>Task 2 - Web Programming - Lab10</h1>
	<form method="post" action="setup.php">
		<label for="user">Username:</label>
		<input type="text" id="user" name="user"><br>

		<label for="pass">Password:</label>
		<input type="text" id="pass" name="pass"><br>

		<label for="dbname">Database Name:</label>
		<input type="text" id="dbname" name="dbname"><br>

		<input type="submit" value="Set Up">
	</form>
	
<?php
	$host = "feenix-mariadb.swin.edu.au";
	$tbnm = "hitcounter";
	//$user = "s103806007";
	//$pswd = "221103";
	//$dbnm = "s103806007_db";

	$dir = "../../data/Lab 10";
	if (!is_dir($dir)) {
		umask(0007);
		$dir = "../../data/Lab 10";
		mkdir($dir, 02770);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (!empty($_POST["user"]) && !empty($_POST["pass"]) && !empty($_POST["dbname"])) {
			$user = $_POST["user"];
			$pswd = $_POST["pass"];
			$dbnm = $_POST["dbname"];
			$filename = "../../data/Lab 10/mykeys.inc.php";
			echo "<p>Initializing...</p>";
			$value1 = var_export($host, true);
			$value2 = var_export($user, true);
			$value3 = var_export($pswd, true);
			$value4 = var_export($dbnm, true);
			$value5 = var_export($tbnm, true);
			$val = "<?php\n\$host = $value1;\n\$user = $value2;\n\$pswd = $value3;\n\$dbnm = $value4;\n\$tbnm = $value5;\n?>";
			file_put_contents($filename, $val);
			
			$conn = @mysqli_connect($host, $user, $pswd, $dbnm);
			if (!$conn) {
				echo "<h2>The database is not working as intended :< </h2>";
			} else {
				$create = "CREATE TABLE IF NOT EXISTS `hitcounter` (`id` SMALLINT NOT NULL PRIMARY KEY, 
																	  `hits` SMALLINT NOT NULL);";
				$hit_table = mysqli_query($conn, $create);
				$insert = "INSERT INTO `hitcounter` VALUES (1,0);";
				$hit_insert = mysqli_query($conn, $insert);
				echo "<p><a href=\"countvisits.php\">Hit The Page!</a></p>";
			}
		} else {
			echo "<p>Nothing should ever be left blank</p>";
		}
	}
?>

</body>
</html>

