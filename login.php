<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    $lines = file('users.txt');
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // Using REGEX to validate username and password

    if (
        preg_match('/^[a-z]([a-z]|[0-9]){6}([a-z]|[0-9])*[0-9]+$/i', $username) ||
        preg_match('/^(?:[0-9]{7}|[0-9]{10})+$/i', $username)
    ) {

        // Using a loop to get the lines of the document and using preg_split to ignore "|"
        foreach ($lines as $line) {
            $pieces = preg_split('/ | /', $line);

            // Checking if the username and the password came from the same user line on the document.
            if (($username == trim($pieces[0]) || $username == trim($pieces[4])) && $password == trim($pieces[2])) {
                echo $username;
                $_SESSION['loginok'] = $username;
                header("Location: thankyou.php");;
            } else {
                $errorpass = 'Your username/or password not match, please try again!';
            }
        }
    } else {

        $erroruser = 'Your Username is not valid, please try again!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN PAGE - PHP ASS1</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="landing-page">

    </div>
    <form class="box" action="login.php" method="POST">
        <h1>Login</h1>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
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
    </form>
</body>

</html>