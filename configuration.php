<?php 
define($host, "localhost");
define($user, "root");
define($password, "");
define($db, "login_accounts");

$connection = mysqli_connect($host, $user, $password, $db);
if (!$connection) {
    die("Error!");
}
else {
    printf("Success!");
}