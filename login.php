<?php
    require_once("includes/classes/formatString.php");
    require_once("includes/classes/account.php");
    require_once("includes/classes/constants.php");
    require_once("includes/config.php");
    $account = new Account($con);
    if(isset($_POST["submitButton"])){
        $userName =($_POST["userName"]);
        $password = FormatString::formatPassword($_POST["password"]);
        $success=$account->login($userName,$password);
        if($success){
            $_SESSION["userLoggedIn"]=$userName;//sotre in sesion
            header("Location:index.php"); // redirect to index.php 
        }
    }
    function getInputValues($val){
        if(isset($_POST[$val])){
            echo $_POST[$val];
        }
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
            <span style="color:red;font-size: small;"><?php echo $account->getError(Constants::$loginFailed); ?></span>
                <input type="text" name="userName" placeholder="User Name" value="<?php getInputValues("userName")?>" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="submitButton" value="SUBMIT">
            </form>
            <a href="register.php" class="loginInMessage">Don't have an account? Sign up now here!</a>
        </div>
    </div>
</body>
</html>