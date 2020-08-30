<?php
session_start();

$username = "";
$password = "";
$email = "";
$mistakes = array();

$db_con = mysqli_connect('localhost', 'root', '', 'registration');

if (isset($_POST['reg'])) {
    $username = mysqli_real_escape_string($db_con, $_POST['uname']);
    $password = mysqli_real_escape_string($db_con, $_POST['pass']);
    $email = mysqli_real_escape_string($db_con, $_POST['email']);

    if (empty($username) == true) {
        array_push($mistakes, "Username is required");
    }
    else if (empty($password) == true) {
        array_push($mistakes, "Password is required");
    } 
    else if (empty($email) == true) {
        array_push($mistakes, "Email is required");
    }

    $duplicate = mysqli_query($db_con, "SELECT * FROM users WHERE username='$username' OR email='$email'");
    $res = mysqli_fetch_assoc($duplicate);

    if ($res == true && $res['username'] == $username) {
        array_push($mistakes, "Username is required");
    }
    else if ($res == true && $res['email'] == $email) {
        array_push($mistakes, "Email is required");
    }

    if ($mistakes == "") {
        mysqli_query($db_con, "INSERT INTO users (username, password, email) VALUES('$username','$password','$email')");
        $_SESSION['username'] = $username;
        header('location: homepage_post_login.html');
    }
}
