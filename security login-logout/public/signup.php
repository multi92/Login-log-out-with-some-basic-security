<?php

require "../private/autoload.php";
$Error = "";
$email = "";
$username = "";



$Error = "";
// if somebody posted-put in super global variable $_SERVER
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // print_r($_POST);
    $email = $_POST['email'];

    $date = date("Y-m-d H:i:s");
    $url_address = get_random_string(60);


    $username = trim($_POST['username']);
    if (!preg_match("/^[a-zA-Z]+$/", $username)) {
        $Error = 'Please enter a valid username';
    }

    $password = esc($_POST['password']);

    //request for database 
    if ($Error == "") {
        $arr['url_address'] = $url_address;
        $arr['date'] = $date;
        $arr['username'] = $username;
        $arr['password'] = $password;
        $arr['email'] = $email;
        //query 
        $query = "INSERT INTO users(url_address,username,password,email,date) values(:url_address, :username, :password, :email,:date)";
        $stm = $connection->prepare($query);
        $stm->execute($arr);

        header("Location: login.php");
        die;
    }
}


?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>

<body style="font-family: Verdana, Geneva, Tahoma, sans-serif;">
    <style type="text/css">
        form {
            margin: auto;
            border: solid thin #aaa;
            padding: 6px;
            max-width: 250px;
        }

        #title {
            background-color: #f3f3f3;
            padding: 1rem;
            text-align: center;
        }

        #textbox {
            border: solid thin #aaa;
            margin: 4px;
            width: 95%;

        }
    </style>
    <form method="POST">
        <div><?php
                if (isset($Error) && $Error != '') {
                    echo $Error;
                }
                ?></div>
        <div id="title">Signup</div>
        <input id="textbox" type="text" name="username" required><br>
        <input id="textbox" type="email" name="email" required><br>
        <input id="textbox" type="password" name="password" required><br><br>
        <input type="submit" name="Signup">
    </form>
</body>

</html>