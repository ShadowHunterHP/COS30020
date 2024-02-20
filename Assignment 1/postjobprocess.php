<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="description" content="A Job Posting System" />
		<meta name="keywords" content="HTML, CSS, PHP" />
		<meta name="author" content="A Normal Normie"  />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"  />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet"  />
        <link href="styles/style.css" rel="stylesheet"  />
        <title>Process Post Job</title>
	</head>
	<body>
	
<?php

function sanitise($x) {
	$data = trim($x);
	$data = stripslashes($x);
	$data = htmlspecialchars($x);
	return $x;
}

$_SESSION["posid"] = "";
$_SESSION["posidError"] = "";
$_SESSION["title"] = "";
$_SESSION["titleError"] = "";
$_SESSION["des"] = "";
$_SESSION["desError"] = "";
$_SESSION["cdate"] = "";
$_SESSION["cdateError"] = "";
$_SESSION["position"] = "";
$_SESSION["positionError"] = "";
$_SESSION["contract"] = "";
$_SESSION["contractError"] = "";
$_SESSION["appli1"] = "";
$_SESSION["appli2"] = "";
$_SESSION["appliError"] = "";
$_SESSION["loca"] = "";
$_SESSION["locaError"] = "";

//regular expressions for input validation
$posid_regex = "/^P\d{4}$/";
$title_regex = "/^[A-Za-z0-9 ,.!]{1,20}$/";
$des_regex = "/^.{1,260}$/";
$cdate_regex = "/^(0[1-9]|[1-2][0-9]|3[0-1])[- \/.](0?[1-9]|1[0-2])[- \/.]\d{2}$/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$_SESSION["fix"] = TRUE;
	$errors = [];

	if (empty($_POST["posid"])) {
		$_SESSION["posidError"] = "*Position ID is required";
	} else {
		$_SESSION["posid"] = sanitise($_POST["posid"]);
		if (!preg_match($posid_regex,$_SESSION["posid"])) {
			$_SESSION["posidError"] = "*Position ID should be P0001 for example";
		}
	}
	
	if (empty($_POST["title"])) {
		$_SESSION["titleError"] = "*Title is required";
	} else {
		$_SESSION["title"] = sanitise($_POST["title"]);
		if (!preg_match($title_regex,$_SESSION["title"])) {
			$_SESSION["titleError"] = "*Title can only have 20 characters including spaces, comma, period (full stop), and exclamation point are allowed";
		}
	}
	
	if (empty($_POST["des"])) {
		$_SESSION["desError"] = "*Description is required";
	} else {
		$_SESSION["des"] = sanitise($_POST["des"]);
		if (!preg_match($des_regex,$_SESSION["des"])) {
			$_SESSION["desError"] = "*Description can only have 260 characters are allowed";
		}
	}

	if (empty($_POST["cdate"])) {
		$_SESSION["cdateError"] = "*Closing Date is required";
	} else {
		$_SESSION["cdate"] = sanitise($_POST["cdate"]);
		if (!preg_match($cdate_regex,$_SESSION["cdate"])) {
			$_SESSION["cdateError"] = "*Closing Date should be in dd/mm/yy format like 26/08/13 or 26/8/13";
		}
	}

	if (empty($_POST["position"])) {
		$_SESSION["positionError"] = "*Position is required";
	} else {
		$_SESSION["position"] = sanitise($_POST["position"]);
	}

	if (empty($_POST["contract"])) {
		$_SESSION["contractError"] = "*Contract is required";
	} else {
		$_SESSION["contract"] = sanitise($_POST["contract"]);
	}

	if (empty($_POST["appli1"]) && empty($_POST["appli2"])) {
		$_SESSION["appliError"] = "*Application Method is required";
	} else {
		if (isset($_POST["appli1"])) {
			$_SESSION["appli1"] = $_POST["appli1"];
		} else {
			$_SESSION["appli1"] = " ";
		}
		if (isset($_POST["appli2"])) {
			$_SESSION["appli2"] = $_POST["appli2"];
		} else {
			$_SESSION["appli2"] = " ";
		}
		$appli = $_SESSION["appli1"] . "\t" . $_SESSION["appli2"];
	}

	if (empty($_POST["loca"])) {
		$_SESSION["locaError"] = "*Location is required";
	} else {
		$_SESSION["loca"] = sanitise($_POST["loca"]);
	}

	array_push($errors,$_SESSION["posidError"],$_SESSION["titleError"],$_SESSION["desError"],
	$_SESSION["cdateError"],$_SESSION["positionError"],$_SESSION["contractError"],
	$_SESSION["appliError"],$_SESSION["locaError"]);

	//display the errors of user input
	if (count(array_filter($errors)) > 0) {
			echo "<div class=\"error_box\">\n";
		foreach ($errors as $error) {
				echo "<p>" . $error . "</p>";
        }
		echo "<div class=\"container\">";
			echo "<span class=\"scissors\">&#9986;</span>";
			echo "<hr class=\"line\">";
		echo "</div>";
		
		echo "<div class=\"container\">";
			echo "<p><a href='postjobform.php'>Return to Job Vacancy Form</a></p>";
			echo "<p><a href='index.php'>Return to Home Page</a></p>";
		echo "</div>";
		
		echo "<div class=\"container\">";
			echo "<span class=\"scissors\">&#9986;</span>";
			echo "<hr class=\"line\">";
		echo "</div>";
			echo "</div>";
	} else {
		$posid = $_SESSION["posid"];
		$title = $_SESSION["title"];
		$des = $_SESSION["des"];
		$cdate = $_SESSION["cdate"];
		$position = $_SESSION["position"];
		$contract = $_SESSION["contract"];
		$appli1 = $_SESSION["appli1"];
		$appli2 = $_SESSION["appli2"];
		$loca = $_SESSION["loca"];
		
		$dir = "../../data/jobposts";
		if (!is_dir($dir)) {
			umask(0007);
			mkdir($dir, 02770);
		}
		
		$new_record = [
			$posid,
			$title,
			$des,
			$cdate,
			$position,
			$contract,
			$appli,
			$loca
		];
		
		$filename = "../../data/jobposts/jobs.txt";	
		$handle = fopen($filename, "a");
		if ($handle !== FALSE) {
			$err = 0;
			$saved_records = file($filename);
			foreach ($saved_records as $record) {
				$field = explode("\t", $record);
				if ($field[0] == $new_record["0"]) {
					$err++;
				}
			}
			if ($err == 0) {
				$add_record = implode("\t", $new_record) . "\n";
				fwrite($handle, $add_record);
				fclose($handle);
				echo "<div class=\"card\">\n";
					echo "<p>The job vacancy record is now stored!</p>";
					echo "<div class=\"container\">";
						echo "<span class=\"scissors\">&#9986;</span>";
						echo "<hr class=\"line\">";
					echo "</div>";
						
					echo "<div class=\"container\">";
						echo "<p><a href='postjobform.php'>Return to Job Vacancy Form</a></p>";
						echo "<p><a href='index.php'>Return to Home Page</a></p>";
					echo "</div>";
					
					echo "<div class=\"container\">";
						echo "<span class=\"scissors\">&#9986;</span>";
						echo "<hr class=\"line\">";
					echo "</div>";
				echo "</div>";
			} else {
					echo "<div class=\"error_box\">\n";
						echo "<p>This Position ID already exists, please enter a new one!</p>";
						echo "<div class=\"container\">";
							echo "<span class=\"scissors\">&#9986;</span>";
							echo "<hr class=\"line\">";
						echo "</div>";
						
						echo "<div class=\"container\">";
							echo "<p><a href='postjobform.php'>Return to Job Vacancy Form</a></p>";
							echo "<p><a href='index.php'>Return to Home Page</a></p>";
						echo "</div>";
						
						echo "<div class=\"container\">";
							echo "<span class=\"scissors\">&#9986;</span>";
							echo "<hr class=\"line\">";
						echo "</div>";
					echo "</div>";
					fclose($handle);
			}
		} else {
			echo "<div class=\"error_box\">\n";
				echo "<p>The file cannot be opened!</p>";
				echo "<div class=\"container\">";
					echo "<span class=\"scissors\">&#9986;</span>";
					echo "<hr class=\"line\">";
				echo "</div>";
					
				echo "<div class=\"container\">";
					echo "<p><a href='postjobform.php'>Return to Job Vacancy Form</a></p>";
					echo "<p><a href='index.php'>Return to Home Page</a></p>";
				echo "</div>";
				
				echo "<div class=\"container\">";
					echo "<span class=\"scissors\">&#9986;</span>";
					echo "<hr class=\"line\">";
				echo "</div>";
			echo "</div>";
		}
	}
} else {
	//prevent the user from directly accessing this page without completing the form first
	header ("location: postjobform.php");
}
?>	
	</body>
</html>