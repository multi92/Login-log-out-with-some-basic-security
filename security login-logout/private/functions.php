<?php
function get_random_string($length)
{

    $text = "";
    if ($length < 5) {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {


        $text .= rand(0, 9);
    }

    return $text;
}


function esc($word)
{
    return addslashes($word);
}

// function query($query)
// {
//     global $connection;
//     return mysqli_query($connection, $query);
// }

// function user_login($email, $password)
// {
//     $password = filter_var($password, FILTER_SANITIZE_STRING);
//     $email = filter_var($email, FILTER_SANITIZE_EMAIL);

//     $query = "SELECT * FROM users WHERE email='$email'";
//     $result = query($query);

//     if ($result->num_rows == 1) {
//         $data = $result->fetch_assoc();
//         if (password_verify($password, $data['password'])) {
//             $_SESSION['email'] = $email;
//             return true;

//         } else {
//             return false;
//         }
//     } else {
//         return false;
//     }
// }

// function login_check_pages()
// {
//     if (isset($_SESSION['email'])) {
//         header('index.php');
//     }
// }

function check_login($connection)
{     //if user login 
    if (isset($_SESSION['url_address'])) {
        $arr['url_address'] = $_SESSION['url_address'];


        $query = "SELECT * FROM users WHERE url_address = :url_address  limit 1";
        $stm = $connection->prepare($query);
        $check = $stm->execute($arr);

        if ($check) {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($data) && count($data) > 0) {
                return $data = $data[0];
            }
        }
    }
    header("Location: login.php");
    die;
}
