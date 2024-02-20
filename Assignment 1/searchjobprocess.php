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
        <title>Search Job Vacancy</title>
	</head>
	<body>
		<h1>Job Vacancy Information</h1>
		
<?php
function sanitise($x) {
	$data = trim($x);
	$data = stripslashes($x);
	$data = htmlspecialchars($x);
	return $x;
}

//convert date format
function date_convert($y) {
	$date_split = explode("/", $y);
	$date_convert = strtotime($date_split[2]."-".$date_split[1]."-".$date_split[0]);
	$date_format = date("m/d/y", $date_convert);
	return $date_format;
}

//compare two values from the key "cdate" (closing date) of 2 arrays to make use of usort to sort the multidimensional array
function date_compare($a, $b) {	
	$date1 = date_convert($a["cdate"]);
	$date2 = date_convert($b["cdate"]);
    $d1 = strtotime($date1);
    $d2 = strtotime($date2);
    return $d2 - $d1;
}

//create a multidimensional array
function list_info($list) {
	$all = [];
	$all2 = [];
	$all_keys = [
		"posid",
		"title",
		"des",
		"cdate",
		"pos",
		"con",
		"app1",
		"app2",
		"loca"
	];
	foreach ($list as $record) {
		$all[] = explode("\t",$record);
	}
	foreach ($all as $line) {
		$lines = array_combine($all_keys, array_values($line));
		array_push($all2, $lines);
	}
	return $all2;
}

	if ($_SERVER["REQUEST_METHOD"] == "GET") {
		$filename = "../../data/jobposts/jobs.txt";	
		if (!file_exists($filename)) {
			echo "<div class=\"error_box\">\n";
				echo "<p>There is a problem with the stored data. Please try again later!</p>";
				echo "<div class=\"container\">";
					echo "<span class=\"scissors\">&#9986;</span>";
					echo "<hr class=\"line\">";
				echo "</div>";
				
				echo "<div class=\"container\">";
					echo "<p><a href='searchjobform.php'>Return to Search Job Vacancy Form</a></p>";
					echo "<p><a href='index.php'>Return to Home Page</a></p>";
				echo "</div>";
				
				echo "<div class=\"container\">";
					echo "<span class=\"scissors\">&#9986;</span>";
					echo "<hr class=\"line\">";
				echo "</div>";
			echo "</div>";
		} else {
		
			$handle = file($filename, FILE_SKIP_EMPTY_LINES);
			//store all the content of the file in a multidimensional array
			$job_info = list_info($handle);
			
			if (empty($_GET["jobt"]) && empty($_GET["pos"]) && empty($_GET["con"]) 
				&& empty($_GET["app1"]) && empty($_GET["app2"]) && empty($_GET["loca"])) {
					
				//sort the multidimensional array which stores all the records in the file
				usort($job_info, "date_compare");
				
				//display everything because no criteria were selected
				for ($x = 0; $x < count($job_info); $x++) {
					echo "<div class=\"card\">\n";
						echo "<p><span>Job Title:</span> " . $job_info[$x]["title"] . "</p>\n";
						echo "<p><span>Description:</span> " . $job_info[$x]["des"] . "</p>\n";
						echo "<p><span>Closing Date:</span> " . $job_info[$x]["cdate"] . "</p>\n";
						echo "<p><span>Position:</span> " . $job_info[$x]["con"] . " - " . $job_info[$x]["pos"] . "</p>\n";
						echo "<p><span>Application by:</span> " . $job_info[$x]["app1"] . " - " . $job_info[$x]["app2"] . "</p>\n";
						echo "<p><span>Location:</span> " . $job_info[$x]["loca"] . "</p>\n";
					echo "</div>\n";
				}
					echo "<div class=\"card\">\n";
						echo "<div class=\"container\">";
							echo "<span class=\"scissors\">&#9986;</span>";
							echo "<hr class=\"line\">";
						echo "</div>";
						
						echo "<div class=\"container\">";
							echo "<p><a href='searchjobform.php'>Return to Search Job Vacancy Form</a></p>";
							echo "<p><a href='index.php'>Return to Home Page</a></p>";
						echo "</div>";
						
						echo "<div class=\"container\">";
							echo "<span class=\"scissors\">&#9986;</span>";
							echo "<hr class=\"line\">";
						echo "</div>";
					echo "</div>\n";
			} else {
				if (empty($_GET["jobt"])) {
					$jobt = "";
				} else {
					$jobt = sanitise($_GET["jobt"]);
				}
				if (empty($_GET["pos"])) {
					$pos = "";
				} else {
					$pos = sanitise($_GET["pos"]);
				}
				if (empty($_GET["con"])) {
					$con = "";
				} else {
					$con = sanitise($_GET["con"]);
				}
				if (empty($_GET["app1"])) {
					$app1 = "";
				} else {
					$app1 = sanitise($_GET["app1"]);
				}
				if (empty($_GET["app2"])) {
					$app2 = "";
				} else {
					$app2 = sanitise($_GET["app2"]);
				}
				if (empty($_GET["loca"])) {
					$loca = "";
				} else {
					$loca = sanitise($_GET["loca"]);
				}

				$s1 = ["title" => $jobt];
				$s2 = ["pos" => $pos];
				$s3 = ["con" => $con];
				$s4 = ["app1" => $app1];
				$s5 = ["app2" => $app2];
				$s6 = ["loca" => $loca];
				$search = array_merge($s1,$s2,$s3,$s4,$s5,$s6);
				$search = array_filter($search);
				$found = [];
				
				foreach ($handle as $line) {
					$match_count = 0;
					foreach ($search as $value) {
						if (strpos(strtoupper($line), strtoupper($value)) !== false) {
							$match_count++;
						}
					}
					if ($match_count === count($search)) {
						array_push($found, $line);
					}
				}
				if (count($found) !== 0) {
					$finding = list_info($found);
					usort($finding, "date_compare");
					for ($x = 0; $x < count($finding); $x++) {
						echo "<div class=\"card\">\n";
								echo "<p><span>Job Title:</span> " . $finding[$x]["title"] . "</p>\n";
								echo "<p><span>Description:</span> " . $finding[$x]["des"] . "</p>\n";
								echo "<p><span>Closing Date:</span> " . $finding[$x]["cdate"] . "</p>\n";
								echo "<p><span>Position:</span> " . $finding[$x]["con"] . " - " . $finding[$x]["pos"] . "</p>\n";
								echo "<p><span>Application by:</span> " . $finding[$x]["app1"] . " - " . $finding[$x]["app2"] . "</p>\n";
								echo "<p><span>Location:</span> " . $finding[$x]["loca"] . "</p>\n";
						echo "</div>\n";
					}
					echo "<div class=\"card\">\n";
						echo "<div class=\"container\">";
							echo "<span class=\"scissors\">&#9986;</span>";
							echo "<hr class=\"line\">";
						echo "</div>";
						
						echo "<div class=\"container\">";
							echo "<p><a href='searchjobform.php'>Return to Search Job Vacancy Form</a></p>";
							echo "<p><a href='index.php'>Return to Home Page</a></p>";
						echo "</div>";
						
						echo "<div class=\"container\">";
							echo "<span class=\"scissors\">&#9986;</span>";
							echo "<hr class=\"line\">";
						echo "</div>";
					echo "</div>\n";
				} else {
					echo "<div class=\"error_box\">\n";
						echo "<p>We cannot find the record that you looked for. Please try again with another one!</p>";
						echo "<div class=\"container\">";
							echo "<span class=\"scissors\">&#9986;</span>";
							echo "<hr class=\"line\">";
						echo "</div>";
						
						echo "<div class=\"container\">";
							echo "<p><a href='searchjobform.php'>Return to Search Job Vacancy Form</a></p>";
							echo "<p><a href='index.php'>Return to Home Page</a></p>";
						echo "</div>";
						
						echo "<div class=\"container\">";
							echo "<span class=\"scissors\">&#9986;</span>";
							echo "<hr class=\"line\">";
						echo "</div>";
					echo "</div>";
				}
			}
		}
	} else {
		header ("location: searchjobform.php");
	}
?>		
	</body>
</html>