<?php
    include("../server/server.php");
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/styleLogin.css">
</head>

<body>
    <div class="container">
        <div class="boxTitle">
            <span>Login</span>
        </div>
        <form class="boxForm" action="../server/login_db.php" method="POST">
            <div class="boxInput">
                <span class="labelInput">Username</span>
                <input type="text" name="username" required placeholder="ชื่อผู้ใช้งาน">
            </div>
            <div class="boxInput">
                <span class="labelInput">Password</span>
                <input type="password" name="password" required placeholder="รหัสผ่าน">
            </div>
            <?php include("../server/error.php"); ?>
            <?php if (isset($_SESSION['error'])) : ?>
                <div style="color: red;">
                    <span style="font-size: 12px;">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </span>
                </div>
            <?php endif; ?>
            <div class="boxInput">
                <button class="btn" type="submit" name="login_user">Login</button>
            </div>
            <div class="boxLink">
                <p>Not yet member ? <a href="register.php">Sign up</a></p>
            </div>
        </form>
    </div>
</body>

</html>