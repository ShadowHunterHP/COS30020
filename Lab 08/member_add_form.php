<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Nguyen Anh Vu" />
    <title>TITLE</title>
</head>

<body>
    <h1>Web Programming - Lab 08</h1>
    <h2>Add New Member</h2>
    <form action="member_add.php" method="post">
        <fieldset>
            <legend><strong>Enter the new member details</strong></legend>
            First Name <input type="text" name="fname"><br><br>
            Last Name <input type="text" name="lname"><br><br>
            Gender <input type="radio" name="gender" value="M">
            <label for="male">Male</label>
            <input type="radio" id="css" name="gender" value="F">
            <label for="female">Female</label><br><br>
            Email <input type="text" name="email"><br><br>
            Phone <input type="text" name="phonenum"><br><br>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset Form">
        </fieldset>
    </form>
</body>

</html>
