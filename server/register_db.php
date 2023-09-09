<?php
session_start();
include("../server/server.php");
include("../server/error.php");
date_default_timezone_set('Asia/Bangkok');

if (isset($_POST['reg_user'])) {
    $f_name = mysqli_real_escape_string($connect, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($connect, $_POST['l_name']);
    $tel = mysqli_real_escape_string($connect, $_POST['tel']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $username = mysqli_real_escape_string($connect, $_POST['username']);
    $password = mysqli_real_escape_string($connect, $_POST['password']);
    $password2 = mysqli_real_escape_string($connect, $_POST['password2']);
    $ref_code = mysqli_real_escape_string($connect, $_POST['ref_code']);
    $ref_remark = mysqli_real_escape_string($connect, $_POST['ref_remark']);
    $date = mysqli_real_escape_string($connect, date("Y-m-d H:i:s"));
    $user_level = intval($_POST['user_level']);

    if (empty($f_name)) {
        array_push($errors, "First name is required.");
    }
    if (empty($l_name)) {
        array_push($errors, "Last name is required.");
    }
    if (empty($tel)) {
        array_push($errors, "Phone is required.");
    }
    if (empty($email)) {
        array_push($errors, "Email is required.");
    }
    if (empty($address)) {
        array_push($errors, "Address is required.");
    }
    if (empty($username)) {
        array_push($errors, "Username is required.");
    }
    if (empty($password)) {
        array_push($errors, "Password is required.");
    }
    if ($password !== $password2) {
        array_push($errors, "The two passwords do not match.");
    }

    $user_check_query = "SELECT * FROM member WHERE username = '$username' OR email = '$email'";
    $query = mysqli_query($connect, $user_check_query);
    $result = mysqli_fetch_assoc($query);

    if ($result) {
        if ($result['username'] === $username) {
            array_push($errors, "Username already exists.");
        }
        if ($result['email'] === $email) {
            array_push($errors, "Email already exists.");
        }
    }

    if (count($errors) === 0) {
        $password = md5($password);

        $sql = "INSERT INTO member (username, password, user_level, fname, lname, tel, email, address, ref_code,ref_remark,last_update)
                VALUES ('$username', '$password', '$user_level', '$f_name', '$l_name', '$tel', '$email', '$address', '$ref_code', '$ref_remark', '$date')";
        mysqli_query($connect, $sql);
        $_SESSION['error'] = implode("<br>", $errors);
        header('location: ../page/login.php');
        exit();
    } else {
        array_push($errors, "Username or Email already exists.");
        $_SESSION['error'] = "Username or Email already exists.";
        header('location: ../page/register.php');
    }
}
