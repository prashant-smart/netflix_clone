<?php
    if(isset($_POST["submitButton"])){
        echo "Form was submitted";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Netflix</title>
    <link rel="stylesheet" href="assets/style/style.css">
</head>
<body>
    <div class="signInContainer">
        <div class="column">

            <div class="header">
                <img src="assets/images/netflix-logo.png" alt="NETFLIX" title="LOGO" width="100px" height="50px">
                <h3>Login Here</h3>
                <span>to continue to Netflix</span>

            </div>
            <!-- form for user credentials related to account -->
            <form method="POST">
                <input type="text" name="userName" placeholder="User Name" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="submitButton" value="SUBMIT">
            </form>
            <a href="register.php" class="loginInMessage">Don't have an account? Sign up now here!</a>
        </div>
    </div>
</body>
</html>