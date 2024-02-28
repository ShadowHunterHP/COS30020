<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lab 06 Task 2 - Guest Book</h1>
    <hr>
    <form action="guestbooksave.php" method="post">
        <fieldset>
            <legend><strong>Enter your details to sign our guest book</strong></legend>
            Name <input type="text" name="name"><br><br>
            Email <input type="text" name="email"><br><br>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset Form">
        </fieldset>
    </form>
    <a href="guestbookshow.php">Show Guest Book</a>
</body>
</html>
