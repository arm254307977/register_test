<?php
    session_start();
    include("../server/server.php");
    $user_id = intval($_GET['id']);
    date_default_timezone_set('Asia/Bangkok');

    $f_name = mysqli_real_escape_string($connect, $_POST['f_name']);
    $l_name = mysqli_real_escape_string($connect, $_POST['l_name']);
    $tel = mysqli_real_escape_string($connect, $_POST['tel']);
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $remark = mysqli_real_escape_string($connect, $_POST['remark']);
    $date = mysqli_real_escape_string($connect, date("Y-m-d H:i:s"));
    if ($_POST['user_level'] !== "") {
        $user_level = intval($_POST['user_level']);
        $queryUpdateUser = "UPDATE member SET fname = '$f_name', lname = '$l_name', tel = '$tel', address = '$address', last_update = '$date', remark = '$remark', user_level = '$user_level' WHERE id = $user_id";
        $update_result = mysqli_query($connect, $queryUpdateUser);
        if ($update_result) {
            $_SESSION['success'] = "edit data success.";
            header("location: ../index.php");
        } else {
            $_SESSION['error'] = "edit data fail : " . mysqli_error($connect);
            header("location: ../page/editUserForAdmin.php");
        }
    } else {
        $queryUpdateUser = "UPDATE member SET fname = '$f_name', lname = '$l_name', tel = '$tel', address = '$address', last_update = '$date', remark = '$remark' WHERE id = $user_id";
        $update_result = mysqli_query($connect, $queryUpdateUser);
        if ($update_result) {
            $_SESSION['success'] = "edit data success.";
            header("location: ../index.php");
        } else {
            $_SESSION['error'] = "edit data fail : " . mysqli_error($connect);
            header("location: ../page/editUserForAdmin.php");
        }
    }
?>