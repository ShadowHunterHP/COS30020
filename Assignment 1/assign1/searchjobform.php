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
        <title>Search Job Vacancy</title>
	</head>
	<body>
		<div>
			<h1>Job Vacancy Posting System</h1>
			<form method="get" action="searchjobprocess.php">
			<fieldset><legend>Search Job Vacancy</legend>
				<p>	<label for="jobt">Job Title: </label>
					<input type="text" name="jobt" id="jobt" /></p>
				
				<p>Position: <br>
				<label for="pos1">Full Time</label>
				<input type="radio" id="pos1" name="pos" value="Full Time">
				<label for="pos2">Part Time</label>
				<input type="radio" id="pos2" name="pos" value="Part Time">
				</p>
				
				<p>Contract: <br>
				<label for="con1">On-going</label>
				<input type="radio" id="con1" name="con" value="On-going">
				<label for="con2">Fixed Term</label>
				<input type="radio" id="con2" name="con" value="Fixed Term">
				</p>
				
				<p>Application by:<br>
				<label for="app1">
				<input type="checkbox" id="app1" name="app1" value="Post"/>Post</label>
				<label for="app2">
				<input type="checkbox" id="app2" name="app2" value="Mail"/>Mail</label>
				</p>
				
				<p>
				<label for="loca">Location:</label>
				<select name="loca" id="loca">
				<option value = "">---</option>
				<option value = "ACT">ACT</option>
				<option value = "NSW">NSW</option>
				<option value = "NT">NT</option>
				<option value = "QLD">QLD</option>
				<option value = "SA">SA</option>
				<option value = "TAS">TAS</option>
				<option value = "VIC">VIC</option>
				<option value = "WA">WA</option>
				</select>
				</p>
				
				<input type="submit" value="Search" />
			</fieldset>
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