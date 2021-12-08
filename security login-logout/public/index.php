<?php

require "../private/autoload.php";
$user_data = check_login($connection);
$username = "";
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <div id="header">
        <?php if ($username != "") : ?>
            <div>Hi <?= $_SESSION['username']; ?></div>
        <?php
        endif; ?>
        <div style="float: right;"><a href="login.php">Loguot</a></div>
    </div>
    This is a home page
</body>

</html>