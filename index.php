<?php
session_start();
include("./server/server.php");
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

$queryAll = "SELECT * FROM member";
$resultAll = mysqli_query($connect, $queryAll);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <div class="boxTitle">
            <span>Home Page</span>
        </div>
        <div class="conMsg">
            <div class="boxMsg">
                <p>Welcome <strong><?php echo $objResult["fname"]; ?></strong></p>
            </div>
            <div class="boxMsg">
                <p>Your Level: <?php
                                if ($objResult["user_level"] == 0) {
                                    echo "owner";
                                } else if ($objResult["user_level"] == 1) {
                                    echo "admin";
                                } else {
                                    echo "user";
                                }
                                ?></p>
            </div>
        </div>
        <div class="boxLink">
            <div class="btnProfile">
                <p><a class="edit-button" href="./page/editProfile.php">My Profile</a></p>
            </div>
            <div class="btnLoguot">
                <p><a class="logout-button" href="./server/loguot.php">Logout</a></p>
            </div>
        </div>
        <?php if (isset($_SESSION["username"])) : ?>
            <?php if ($objResult["user_level"] == 0) : ?>
                <div class="headTable">
                    <span>Data User For Owner</span>
                </div>
                <table width="100%" border="1">
                    <tr>
                        <th>Level</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>ref code</th>
                        <th>ref remark</th>
                        <th>remark</th>
                        <th>Last update</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($resultAll)) : ?>
                        <?php
                        $userLevel = $row['user_level'];
                        if ($userLevel < 1) {
                            continue;
                        }
                        ?>
                        <tr>
                            <td>
                                <?php
                                if ($row['user_level'] == 0) {
                                    echo "owner";
                                } else if ($row['user_level'] == 1) {
                                    echo "admin";
                                } else {
                                    echo "user";
                                }
                                ?>
                            </td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['lname']; ?></td>
                            <td><?php echo $row['tel']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['ref_code']; ?></td>
                            <td><?php echo $row['ref_remark']; ?></td>
                            <td><?php echo $row['remark']; ?></td>
                            <td><?php echo $row['last_update']; ?></td>
                            <td>
                                <a class="btn-editUser" href="./page/editUserForAdmin.php?id=<?php echo $row['id']; ?>">edit</a>
                                <a class="btn-deleteUser" href="./server/deleteUser_db.php?id=<?php echo $row['id']; ?>">delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php elseif ($objResult["user_level"] == 1) : ?>
                <div class="headTable">
                    <span>Data User For Admin</span>
                </div>
                <table width="100%" border="1">
                    <tr>
                        <th>Level</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>ref code</th>
                        <th>ref remark</th>
                        <th>remark</th>
                        <th>Last update</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($row = mysqli_fetch_assoc($resultAll)) : ?>
                        <?php
                        $userLevel = $row['user_level'];
                        if ($userLevel <= 1) {
                            continue;
                        }
                        ?>
                        <tr>
                            <td>
                                <?php
                                if ($row['user_level'] == 0) {
                                    echo "owner";
                                } else if ($row['user_level'] == 1) {
                                    echo "admin";
                                } else {
                                    echo "user";
                                }
                                ?>
                            </td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['lname']; ?></td>
                            <td><?php echo $row['tel']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['ref_code']; ?></td>
                            <td><?php echo $row['ref_remark']; ?></td>
                            <td><?php echo $row['remark']; ?></td>
                            <td><?php echo $row['last_update']; ?></td>
                            <td>
                                <a class="btn-editUser" href="./page/editUserForAdmin.php?id=<?php echo $row['id']; ?>">edit</a>
                                <a class="btn-deleteUser" href="./server/deleteUser_db.php?id=<?php echo $row['id']; ?>">delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php elseif ($objResult["user_level"] == 2) : ?>
                <div class="headTable">
                    <span>Your Data</span>
                </div>
                <table width="100%" border="1">
                    <tr>
                        <th>Level</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>ref code</th>
                        <th>ref remark</th>
                        <th>remark</th>
                        <th>Last update</th>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if ($objResult['user_level'] == 0) {
                                echo "owner";
                            } else if ($objResult['user_level'] == 1) {
                                echo "admin";
                            } else {
                                echo "user";
                            }
                            ?>
                        </td>
                        <td><?php echo $objResult['username']; ?></td>
                        <td><?php echo $objResult['email']; ?></td>
                        <td><?php echo $objResult['fname']; ?></td>
                        <td><?php echo $objResult['lname']; ?></td>
                        <td><?php echo $objResult['tel']; ?></td>
                        <td><?php echo $objResult['address']; ?></td>
                        <td><?php echo $objResult['ref_code']; ?></td>
                        <td><?php echo $objResult['ref_remark']; ?></td>
                        <td><?php echo $objResult['remark']; ?></td>
                        <td><?php echo $objResult['last_update']; ?></td>
                    </tr>
                </table>
            <?php endif; ?>
        <?php endif ?>
    </div>
</body>

</html>