<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Using the sessions to get the value in the thankyou page
    session_start();

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $verify = trim($_POST['verify']);
    $phone = trim($_POST['phone']);

    /* REGEX VARIABLES */
    #123-456-7890
    $p1 = '/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/';

    #(123)4567890
    $p2 = '/^\({1}[0-9]{3}\){1}[0-9]{7}$/';

    #1231234 and 6041231234
    $p3 = '/^(?:[0-9]{7}|[0-9]{10})+$/i';

    #(604) 123 1234
    $p4 = '/^\({1}[0-9]{3}\){1} [0-9]{3} [0-9]{4}$/';

    #604 123 1234
    $p5 = '/^\[0-9]{3} [0-9]{3} [0-9]{4}$/';

    // Using REGEX to validate the user input to regist as was required
    if (!preg_match('/^[a-z]([a-z]|[0-9]){6}([a-z]|[0-9])*[0-9]+$/i', $username)) {
        $erroruser = "Your username is not following the rules!";
    } else if (!preg_match('/((?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[,.\/\?\*!])){8}/', $password)) {
        $errorpass = "Your password is not following the rules!";
    } else if ($password != $verify) {
        $errorver = "Your passoword does not match!";
    } else if (
        !preg_match($p1, $phone) && !preg_match($p2, $phone) && !preg_match($p3, $phone)
        && !preg_match($p4, $phone) && !preg_match($p5, $phone)
    ) {
        $errorpho = "Your phone is not following the rules!";
    }
    // If all forms went filled correctly, open a new file called users.txt and start to write inside
    else {
        $fp = fopen('users.txt', 'a+');

        $users = file('users.txt');

        $phone = preg_replace("/[^\d]/", "", $phone);

        fwrite($fp, $username . " | " . md5($verify) . " | " . $phone . PHP_EOL);
        $_SESSION['signupname'] = $username;
        fclose($fp);

    // after create a file and wrote inside, redirect to the thankyou page
        header("Location: thankyou.php");

        
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIGN UP PAGE - PHP ASS1</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="landing-page">
    </div>
    <form class="box" action="signup.php" method="POST">
        <h1>SIGN UP</h1>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="verify" placeholder="Verify Password" required>
        <input type="tel" name="phone" placeholder="Phone" required>
        <input type="submit" value="Sign UP">

        <?php
        if (isset($erroruser)) {
            ?>
            <p class="errorregister"> <?php echo $erroruser ?></p>
        <?php } ?>
        <?php
        if (isset($errorpass)) {
            ?>
            <p class="errorregister"> <?php echo $errorpass ?></p>
        <?php } ?>
        <?php
        if (isset($errorver)) {
            ?>
            <p class="errorregister"> <?php echo $errorver ?></p>
        <?php } ?>
        <?php
        if (isset($errorpho)) {
            ?>
            <p class="errorregister"> <?php echo $errorpho ?></p>
        <?php } ?>
    </form>
</body>

</html>