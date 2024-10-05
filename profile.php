<?php include 'inc/header.php'; ?>
<?php
Session::checkSession();
$userId = Session::get("userId");
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $updatedUser = $usr->updateUserData($userId, $_POST);
    }
?>
<style>
    .profile {
        width: 440px;
        margin: auto;
        border: 1px solid #ddd;
        padding: 30px 50px 50px 138px;
    }
</style>
<div class="main">
    <h1>Your Profile</h1>
    <div class="profile">
        <?php
        if (isset($updatedUser)) {
            echo $updatedUser;
        }
        ?>
    <form action="" method="post">
        <?php
            $fetchData = $usr->getUserData($userId);
            if ($fetchData) {
                $userData = $fetchData->fetch_assoc();
        ?>
        <table class="tbl">
        <tr>
                <td>Name </td>
                <td><input name="name" type="text" value="<?php echo $userData['name']; ?>"/></td>
            </tr>
            <tr>
                <td>Username </td>
                <td><input name="username" type="text" value="<?php echo $userData['username']; ?>"/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input name="email" type="text" value="<?php echo $userData['email']; ?>"/></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" id="updateUser" value="Update">
                </td>
            </tr>
        </table>
        <?php } ?>
    </form>
    </div>
</div>
<?php include 'inc/footer.php'; ?>