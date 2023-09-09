<?php
include("../server/server.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../style/styleRegister.css">
</head>

<body>
    <div class="contianerRegister">
        <div class="boxTitle">
            <h1>Register</h1>
        </div>

        <form class="formStyle" action="../server/register_db.php" method="post">
            <?php include("../server/error.php"); ?>
            <?php if (isset($_SESSION['error'])) : ?>
                <div style="color: red;">
                    <h3>
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </h3>
                </div>
            <?php endif; ?>
            <div class="boxInput">
                <span class="labelInput" for="f_name">First Name</span>
                <input type="text" name="f_name" required placeholder="ชื่อ">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="l_name">Last Name</span>
                <input type="text" name="l_name" required placeholder="นามสกุล">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="tel">Phone</span>
                <input type="tel" name="tel" required placeholder="เบอร์โทรศัพท์">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="email">Email</span>
                <input type="email" name="email" required placeholder="อีเมลล์">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="address">Address</span>
                <input type="text" name="address" required placeholder="ที่อยู่">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="username">Username</span>
                <input type="text" name="username" required placeholder="ชื่อผู้ใช้งาน">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="password">Password</span>
                <input type="password" name="password" required placeholder="รหัสผ่าน">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="password2">Confirm Password</span>
                <input type="password" name="password2" required placeholder="ยืนยันรหัสผ่าน">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="ref_code">Referral Code</span>
                <input type="text" name="ref_code" placeholder="รหัสผู้แนะนำ">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="ref_remark">Referral Remark</span>
                <input type="text" name="ref_remark" placeholder="หมายเหตุจากผู้แนะนำ">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="user_level">Level User</span>
                <select name="user_level" required>
                    <option value="">---</option>
                    <option value=0>owner</option>
                    <option value=1>admin</option>
                    <option value=2>user</option>
                </select>
            </div>
            <div>
                <button class="btn" type="submit" name="reg_user">Register</button>
            </div>
            <div class="boxLink">
                <p>Already a member ? <a href="login.php">Sign in</a></p>
            </div>
        </form>
    </div>
</body>

</html>