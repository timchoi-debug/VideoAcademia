<?php
session_start();
include('configuration.php');

if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
    header('Location: /login.html');
}

if (empty($_POST) == false) {
    $new_password = $_POST['password'];
    $new_password_again = $_POST['NewPassword'];

    if ($new_password == "" || $new_password_again == "") {
        echo 'Error!';
    }
    else {
        $new_con = mysqli_connect('localhost', 'root', 'password', 'login_accounts');
        if (!$new_con) {
         die("Error!");
        }
        if (count($_POST) != 0) {
            $query = mysqli_query($new_con, "SELECT * from users WHERE username=' " . $_SESSION["username"] . "'");
            $extract_row = mysqli_fetch_array($query);
            if ($_POST["NewPassword"] == $row["password"]) {
                mysqli_query($new_con, "UPDATE login_accounts set password=' " . $_POST["NewPassword"] . "' WHERE username='" . $_SESSION["username"] . "'");
                header('Location: /homepage_post_login.html');
                echo "Password Changed!";
            }
            else {
                die("ERROR!");
            }
        }
    }
    $new_con.close();
}
?>
