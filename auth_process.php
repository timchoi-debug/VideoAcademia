<?php
include('configuration.php');
$username = $_POST['uname'];
$password = $_POST['pass'];

$username = stripcslashes($username);
$username = mysql_real_escape_string($connection, $username);
$username = stripcslashes($password);
$username = mysql_real_escape_string($connection, $password);
$cmd = "select *from login_accounts where username = '$username' and password = '$password'";
$res = mysqli_query($con, $cmd);
$row = mysqli_fetch_array($res, MYSQL_ASSOC);

if (mysqli_num_rows($res) != 0 && mysqli_num_rows($res) == 1) {
    header('Location: homepage_post_login.html'); 
}
else {
    echo "ERROR! Username and Password not found!";
}
?>