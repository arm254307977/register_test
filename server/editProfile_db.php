<?php
session_start();
include("../server/error.php");
include("../server/server.php");
if ($_SESSION["level"] == '') {
    $_SESSION["msg"] = "You must login first";
    header("location: ./page/login.php");
}
if ($_SESSION["username"] == '') {
    $_SESSION["msg"] = "You must login first";
    header("location: ./page/login.php");
}
date_default_timezone_set('Asia/Bangkok');
$query = "SELECT * FROM member WHERE username ='" . $_SESSION['username'] . "'";
$result = mysqli_query($connect, $query);
$objResult = mysqli_fetch_array($result);

$f_name = mysqli_real_escape_string($connect, $_POST['f_name']);
$l_name = mysqli_real_escape_string($connect, $_POST['l_name']);
$tel = mysqli_real_escape_string($connect, $_POST['tel']);
$address = mysqli_real_escape_string($connect, $_POST['address']);
$password = mysqli_real_escape_string($connect, $_POST['password']);
$password2 = mysqli_real_escape_string($connect, $_POST['password2']);
$date = mysqli_real_escape_string($connect, date("Y-m-d H:i:s"));

if (empty($f_name)) {
    array_push($errors, "First name is required.");
}
if (empty($l_name)) {
    array_push($errors, "Last name is required.");
}
if (empty($tel)) {
    array_push($errors, "Phone is required.");
}
if (empty($address)) {
    array_push($errors, "Address is required.");
}
if ($password !== $password2) {
    array_push($errors, "The two passwords do not match.");
}

if (count($errors) === 0) {
    if ($password !== '' || $password2) {
        $username = $_SESSION['username'];
        $password = md5($password);
    
        $strSQL = "UPDATE member SET 
            password = '$password',
            fname = '$f_name',
            lname = '$l_name',
            tel = '$tel',
            address = '$address',
            last_update = '$date'
            WHERE username = '$username' ";
    
        $update_result = mysqli_query($connect, $strSQL);
    
        if ($update_result) {
            $_SESSION['success'] = "Profile updated successfully.";
            header("location: ../index.php");
        } else {
            $_SESSION['error'] = "Profile update failed.";
            header("location: ../page/editProfile.php");
        }
    } else {
        $username = $_SESSION['username'];
        $password = $objResult["password"];
    
        $strSQL = "UPDATE member SET 
            password = '$password',
            fname = '$f_name',
            lname = '$l_name',
            tel = '$tel',
            address = '$address',
            last_update = '$date'
            WHERE username = '$username' ";
    
        $update_result = mysqli_query($connect, $strSQL);
    
        if ($update_result) {
            $_SESSION['success'] = "Profile updated successfully.";
            header("location: ../index.php");
        } else {
            $_SESSION['error'] = "Profile update failed.";
            header("location: ../page/editProfile.php");
        }
    }
} else {
    array_push($errors, "Please fill in complete information.");
    $_SESSION['error'] = "Please fill in complete information.";
    header('location: ../page/editProfile.php');
}
?>