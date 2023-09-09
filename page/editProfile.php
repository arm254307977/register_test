<?php
session_start();
include("../server/server.php");
if ($_SESSION["level"] == '') {
    $_SESSION["msg"] = "You must login first";
    header("location: ./page/login.php");
}
if ($_SESSION["username"] == '') {
    $_SESSION["msg"] = "You must login first";
    header("location: ./page/login.php");
}

$query = "SELECT * FROM member WHERE username ='" . $_SESSION['username'] . "'";
$result = mysqli_query($connect, $query);
$objResult = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>edit profile</title>
    <link rel="stylesheet" href="../style/styleRegister.css">
</head>

<body>
    <div class="contianerRegister">
        <div class="boxTitle">
            <h1>Edit Profile</h1>
        </div>

        <form class="formStyle" action="../server/editProfile_db.php" method="post">
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
                <input type="text" name="f_name" required placeholder="ชื่อ" value="<?php echo $objResult["fname"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="l_name">Last Name</span>
                <input type="text" name="l_name" required placeholder="นามสกุล" value="<?php echo $objResult["lname"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="tel">Phone</span>
                <input type="tel" name="tel" required placeholder="เบอร์โทรศัพท์" value="<?php echo $objResult["tel"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="email">Email</span>
                <input type="email" name="email" readonly required placeholder="อีเมลล์" value="<?php echo $objResult["email"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="address">Address</span>
                <input type="text" name="address" required placeholder="ที่อยู่" value="<?php echo $objResult["address"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="username">Username</span>
                <input type="text" name="username" readonly required placeholder="ชื่อผู้ใช้งาน" value="<?php echo $objResult["username"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="password">New Password</span>
                <input type="password" name="password" placeholder="รหัสผ่านใหม่">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="password2">Confirm New Password</span>
                <input type="password" name="password2" placeholder="ยืนยันรหัสผ่านใหม่">
            </div>
            <button class="btn" type="submit" name="edit_user">save</button>
            <a href="../index.php">cancel</a>
        </form>
    </div>
</body>

</html>