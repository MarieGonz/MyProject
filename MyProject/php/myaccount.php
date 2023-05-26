
<?php

include "setup.php";

use MyProject\php\cat\Validate;
use MyProject\php\cat\Mysql;

error_reporting(E_ALL);
ini_set("display_errors", 1);

$validate = new Validate(); // Initialize the validation object


if (!empty($_POST)) {
    // Validate input fields
    $validate->isFilled($_POST["username"], "Username");
    $validate->isFilled($_POST["password"], "Password");

    if (!$validate->hasErrors()) {
        // Proceed with the login
        $db = Mysql::getInstance();
        $sqlUsername = $db->escape($_POST["username"]);

        $result = $db->query("SELECT * FROM user WHERE username='{$sqlUsername}'");
        $user = $result->fetch_assoc();

        if (empty($user) || !password_verify( $_POST["password"], $user["password"] )) {
            // Error: User does not exist.

            $validate->addError("Invalid username or password.");

        } else {
            // Login successful -> Save user data in session
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $user["username"];
            $_SESSION["id"] = $user["id"];

            // Redirect to admin system
            header("Location: index.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in Administration</title>
</head>
<body>
<header id="myheader">

<div id="headers">
    <img src="/photos/mylogo/mylogo.png" alt="Logo of C.R.E. by MG" id="mylogo" >
</div>
<div>
    <a href="index.html">To eat</a>
    <a href="myaccount.php">Account</a>
</div>

</header>

<h1>Products Administration</h1>
    <?php
        /* Output errors, if any
        if (!empty($validate)) {
            echo $validate->errorHtml();
        } */
        if ($validate->hasErrors()) {
            echo $validate->errorHtml();
        }

    ?>
    <form method="post">
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <button type="submit" id="submit" >Log-in</button>
        </div>
    </form>

    <footer class="myfooter">

        <p> &copy; the Coolest Restaurant Ever by Marie G. - All rights reserved. </p>

    </footer>


</body>
</html>
