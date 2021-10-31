<?php
    require_once("includes/classes/formatString.php");
    require_once("includes/classes/account.php");
    require_once("includes/classes/constants.php");
    require_once("includes/config.php");

    $account = new Account($con);


    if(isset($_POST["submitButton"])){
        $firstName = FormatString::formatString($_POST["firstName"]);
        $lastName = FormatString::formatString($_POST["lastName"]);
        $userName =($_POST["userName"]);
        $email = FormatString::formatEmail($_POST["email"]);
        $email2 = FormatString::formatEmail($_POST["email2"]);
        $password = FormatString::formatPassword($_POST["password"]);
        $password2= FormatString::formatPassword($_POST["password"]);
        $account->register($firstName,$lastName,$userName,$email,$email2,$password,$password2);

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
                <h3>Sign Up</h3>
                <span>to continue to Netflix</span>

            </div>
            <!-- form for user credentials related to account -->
            <form method="POST">
                <span style="color:red;font-size: small;"><?php echo $account->getError(Constants::$firstNameCharacter); ?></span>
                <input type="text" name="firstName" placeholder="First Name" required>
                
                <span style="color:red;font-size: small;"><?php echo $account->getError(Constants::$lastNameCharacter); ?></span>
                <input type="text" name="lastName" placeholder="Last Name" required>

                <span style="color:red;font-size: small;"><?php echo $account->getError(Constants::$userNameCharacter); ?></span>
                <span style="color:red;font-size: small;"><?php echo $account->getError(Constants::$userNameTaken); ?></span>
                <input type="text" name="userName" placeholder="User Name" required>
                
                <span style="color:red;font-size: small;"><?php echo $account->getError(Constants::$emailDontMatch); ?></span>
                <span style="color:red;font-size: small;"><?php echo $account->getError(Constants::$emailNotValid); ?></span>
                <span style="color:red;font-size: small;"><?php echo $account->getError(Constants::$emailTaken); ?></span>
                <input type="email" name="email" placeholder="Email" required>
                <input type="email" name="email2" placeholder="Confirm Email" required>
                
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password2" placeholder="Confirm Password" required>
                
                <input type="submit" name="submitButton" value="SUBMIT">

            </form>
            <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>
        </div>
    </div>
</body>
</html>