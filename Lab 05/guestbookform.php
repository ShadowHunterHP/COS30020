<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lab 05 Task 2 - Guest Book</h1>
    <hr>
    <form action="guestbooksave.php" method="post">
        <fieldset>
            <legend><strong>Enter your details to sign our guest book</strong></legend>
            First Name <input type="text" name="fname" value="Freddy"><br><br>
            Last Name <input type="text" name="lname" value="Bloggs"><br><br>
            <input type="submit" value="Submit">
        </fieldset>
    </form>
    <a href="guestbookshow.php">Show Guest Book</a>
</body>
</html>
