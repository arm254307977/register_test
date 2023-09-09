<?php
session_start();
include("../server/server.php");
include("../server/error.php");
date_default_timezone_set('Asia/Bangkok');
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required.");
    }
    if (empty($password)) {
        array_push($errors, "Password is required.");
    }

    if (count($errors) === 0) {
        $password = md5($password);
        $query = "SELECT * FROM member WHERE username='$username' AND password = '$password'";
        $result = mysqli_query($connect, $query);
        $objResult = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['level'] = $objResult['user_level'];
            $_SESSION['success'] = "You are now logged in.";
            $login_status = 0;
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $current_datetime = date('Y-m-d H:i:s');
            $query = "INSERT INTO login_log (username, login_flag, ip_address, last_update) 
            VALUES ('$username', '$login_status', '$ip_address', '$current_datetime')";
            mysqli_query($connect, $query);
            header('location: ../index.php');
        } else {
            array_push($errors, "Wrong username/password combination.");
            $_SESSION['error'] = "Wrong username/password combination.";
            $login_status = 1;
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $current_datetime = date('Y-m-d H:i:s');
            $query = "INSERT INTO login_log (username, login_flag, ip_address, last_update) 
            VALUES ('$username', '$login_status', '$ip_address', '$current_datetime')";
            mysqli_query($connect, $query);
            header('location: ../page/login.php');
        }
    } else {
        $_SESSION['error'] = implode("<br>", $errors);
        header('location: ../page/login.php');
    }
}
