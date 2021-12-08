<?php
require "../private/autoload.php";
$Error = "";


if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($Error == "") {
        $arr['password'] = $password;
        $arr['email'] = $email;

        $query = "SELECT * FROM users WHERE email = :email && password = :password limit 1";
        $stm = $connection->prepare($query);
        $check = $stm->execute($arr);

        if ($check) {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            //is data in array
            if (is_array($data) && count($data) > 0) {
                $data = $data[0];
                $_SESSION['username'] = $data->username;
                $_SESSION['url_address'] = $data->url_address;
                header("Location: index.php");
                die;
            }
        }
    }
    $Error = "Wrong email or password";
}


?>


<html lang="en">

<head>
    <div><?php
            if (isset($Error) && $Error != "") {
                echo $Error;
            }
            ?></div>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        <div id="title">Login</div>
        <!-- <input id="textbox" type="text" name="username" required><br> -->
        <input id="textbox" type="email" name="email" required><br>
        <input id="textbox" type="password" name="password" required><br><br>
        <input type="submit" name="Signup">
        <a href="signup.php">Register</a>
    </form>
</body>

</html>