<?php
    session_start();
    include("../server/server.php");

    if (isset($_GET['id'])) {
        $user_id = intval($_GET['id']);
        $queryDeleteUser = "DELETE FROM member WHERE id = $user_id";
        $delete_result = mysqli_query($connect, $queryDeleteUser);

        if ($delete_result) {
            $_SESSION['success'] = "delete success.";
        } else {
            $_SESSION['error'] = "delete fail. : " . mysqli_error($connect);
        }
    } else {
        $_SESSION['error'] = "No data.";
    }

    header("location: ../index.php");
?>