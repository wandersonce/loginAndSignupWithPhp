<?php
// open the session to get the values from the login or signup page.
session_start();

//check if the session exists 
if (isset($_SESSION['signupname']) || isset($_SESSION['loginok'])) {

    //Here we are using the if condition to set from where the session came from
    if (isset($_SESSION['signupname'])) {
        $username =  $_SESSION['signupname'];
    }
    if (isset($_SESSION['loginok'])) {
        $loginuser = $_SESSION['loginok'];
    }
    session_destroy();
    //if the session was doesn't not exist, send back to index page
} else (!isset($_SESSION['signupname']) || !isset($_SESSION['loginok'])){
    header("Location: index.php")}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank You - PHP Class</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="landing-page">
        <div class="page-content">
            <!-- Here we are using the variables that were created above to say the message to username -->
            <h1>YOU ARE ALWAYS WELCOME TO BACK!</h1>
            <?php
            if (!empty($username)) {
                ?>
                <p>
                    <?php echo 'Thanks ' . $username . ' for your registration!'; ?>
                </p>
            <?php } ?>


            <?php
            if (!empty($loginuser)) {
                ?>
                <p>
                    <?php echo 'Thanks ' . $loginuser . ' for your login!'; ?>
                </p>
            <?php } ?>

            <a href="index.php">HOME</a>
        </div>
    </div>
</body>

</html>