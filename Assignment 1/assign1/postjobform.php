<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
		<meta name="description" content="A Sorrowful Job Posting System" />
		<meta name="keywords" content="HTML, CSS, PHP" />
		<meta name="author" content="An Average Man From The Earth"  />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"  />
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet"  />
        <link href="styles/style.css" rel="stylesheet"  />
        <title>Job Vacancy Posting Form</title>
	</head>
	<body>

<?php
	
	if (isset($_SESSION["fix"]) && $_SESSION["fix"] == TRUE) {
		$posid = $_SESSION["posid"];
		$title = $_SESSION["title"];
		$des = $_SESSION["des"];
		$position = $_SESSION["position"];
		$contract = $_SESSION["contract"];
		$appli1 = $_SESSION["appli1"];
		$appli2 = $_SESSION["appli2"];
		$loca = $_SESSION["loca"];
		$posidError = $_SESSION["posidError"];
		$titleError = $_SESSION["titleError"];
		$desError = $_SESSION["desError"];
		$cdateError = $_SESSION["cdateError"];
		$positionError = $_SESSION["positionError"];
		$contractError = $_SESSION["contractError"];
		$appliError = $_SESSION["appliError"];
		$locaError = $_SESSION["locaError"];
	} else {
		$_SESSION["fix"] = FALSE;
		$posid = "";
		$posidError = "";
		$title = "";
		$titleError = "";
		$des = "";
		$desError = "";
		$cdate = "";
		$cdateError = "";
		$position = "";
		$positionError = "";
		$contract = "";
		$contractError = "";
		$appli1 = "";
		$appli2 = "";
		$appliError = "";
		$loca = "";
		$locaError = "";
	}
?>

		<div>
			<h1>Job Vacancy Posting System</h1>
			<form method="post" action="postjobprocess.php" novalidate="novalidate">
			
			<p>
			<label for="posid">Position ID:</label>
			<input type="text" id="posid" name="posid" value="<?php echo $posid;?>"/>
			<span class="error"> <?php echo $posidError;?></span>
			</p>

			<p>
			<label for="title">Title:</label>
			<input type="text" id="title" name="title" value="<?php echo $title;?>"/>
			<span class="error"> <?php echo $titleError;?></span>
			</p>

			<p>
			<label for="des">Description:</label>
			<textarea id="des" name="des"><?php echo $des;?></textarea>
			<span class="error"> <?php echo $desError;?></span>
			</p>

			<p>
			<label for="cdate">Closing Date:</label>
			<input type="text" id="cdate" name="cdate" value="<?php echo date("d/m/y");?>"/>
			<span class="error"> <?php echo $cdateError;?></span>
			</p>

			<p>Position: <br>
			<label for="position1">Full Time</label>
			<input type="radio" id="position1" name="position" value="Full Time" <?php if (isset($position) && $position=="Full Time") echo "checked";?>>
			<label for="position2">Part Time</label>
			<input type="radio" id="position2" name="position" value="Part Time" <?php if (isset($position) && $position=="Part Time") echo "checked";?>>
			<span class="error"> <?php echo $positionError;?></span>
			</p>
			
			<p>Contract: <br>
			<label for="contract1">On-going</label>
			<input type="radio" id="contract1" name="contract" value="On-going" <?php if (isset($contract) && $contract=="On-going") echo "checked";?>>
			<label for="contract2">Fixed Term</label>
			<input type="radio" id="contract2" name="contract" value="Fixed Term" <?php if (isset($contract) && $contract=="Fixed Term") echo "checked";?>>
			<span class="error"> <?php echo $contractError;?></span>
			</p>
			
			<p>Application by:<br>
			<label for="appli1">
			<input type="checkbox" id="appli1" name="appli1" value="Post" <?php if (isset($appli1) && $appli1=="Post") echo "checked";?>/>Post</label>
			<label for="appli2">
			<input type="checkbox" id="appli2" name="appli2" value="Mail" <?php if (isset($appli2) && $appli2=="Mail") echo "checked";?>/>Mail</label>
			<span class="error"> <?php echo $appliError;?></span>
			</p>

			<p>
			<label for="loca">Location:</label>
			<select name="loca" id="loca">
			<option value = "">---</option>
			<option value = "ACT" <?php if (isset($loca) && $loca=="ACT") echo "selected";?>>ACT</option>
			<option value = "NSW" <?php if (isset($loca) && $loca=="NSW") echo "selected";?>>NSW</option>
			<option value = "NT" <?php if (isset($loca) && $loca=="NT") echo "selected";?>>NT</option>
			<option value = "QLD" <?php if (isset($loca) && $loca=="QLD") echo "selected";?>>QLD</option>
			<option value = "SA" <?php if (isset($loca) && $loca=="SA") echo "selected";?>>SA</option>
			<option value = "TAS" <?php if (isset($loca) && $loca=="TAS") echo "selected";?>>TAS</option>
			<option value = "VIC" <?php if (isset($loca) && $loca=="VIC") echo "selected";?>>VIC</option>
			<option value = "WA" <?php if (isset($loca) && $loca=="WA") echo "selected";?>>WA</option>
			</select>
			<span class="error"> <?php echo $locaError;?></span>
			</p>

			<input type= "submit" value="Post">
			<input type= "reset" value="Reset">
			<br>
			
			<div class="container">
				<span class="scissors">&#9986;</span>
				<hr class="line">
			</div>
			
			<div class="container">
				<a href="index.php">Return to Home Page</a>
			</div>
			
			<div class="container">
				<span class="scissors">&#9986;</span>
				<hr class="line">
			</div>
			
			</form>
		</div>
	</body>
</html>