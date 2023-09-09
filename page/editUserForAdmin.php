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

if (isset($_GET['id'])) {
    $user_id = intval($_GET['id']);
    $query = "SELECT * FROM member WHERE id = $user_id";
    $result = mysqli_query($connect, $query);
    $userData = mysqli_fetch_assoc($result);
    if (!$userData) {
        echo "User not found!";
        exit;
    }
} else {
    echo "Invalid user ID!";
    exit;
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
    <title>edit user account</title>
    <link rel="stylesheet" href="../style/styleRegister.css">
</head>

<body>
    <div class="contianerRegister">
        <div class="boxTitle">
            <h1>Edit User Account : <?php echo $userData['username']; ?></h1>
        </div>

        <form class="formStyle" action="../server/editUserForAdmin_db.php?id=<?php echo $user_id ?>" method="post">
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
                <input type="text" name="f_name" required placeholder="ชื่อ" value="<?php echo $userData["fname"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="l_name">Last Name</span>
                <input type="text" name="l_name" required placeholder="นามสกุล" value="<?php echo $userData["lname"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="tel">Phone</span>
                <input type="tel" name="tel" required placeholder="เบอร์โทรศัพท์" value="<?php echo $userData["tel"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="email">Email</span>
                <input type="email" name="email" readonly placeholder="อีเมลล์" value="<?php echo $userData["email"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="address">Address</span>
                <input type="text" name="address" required placeholder="ที่อยู่" value="<?php echo $userData["address"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="username">Username</span>
                <input type="text" name="username" readonly placeholder="ชื่อผู้ใช้งาน" value="<?php echo $userData["username"]; ?>">
            </div>
            <div class="boxInput">
                <span class="labelInput" for="remark">Remark</span>
                <input type="text" name="remark" placeholder="หมายเหตุทั่วไป (สำหรับ admin)" value="<?php echo $userData["remark"]; ?>">
            </div>
            <?php if ($objResult['user_level'] == 0) : ?>
                <div class="boxInput">
                    <span class="labelInput" for="user_level">Level User</span>
                    <select name="user_level" required>
                        <option value="">---</option>
                        <option value="0" <?php if ($userData["user_level"] == 0) echo 'selected'; ?>>owner</option>
                        <option value="1" <?php if ($userData["user_level"] == 1) echo 'selected'; ?>>admin</option>
                        <option value="2" <?php if ($userData["user_level"] == 2) echo 'selected'; ?>>user</option>
                    </select>
                </div>
            <?php endif; ?>
            <button class="btn" type="submit" name="edit_user">save</button>
            <a href="../index.php">cancel</a>
        </form>
    </div>
</body>

</html>