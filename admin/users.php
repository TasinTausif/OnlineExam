<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath . '/inc/header.php';
    include_once $filepath . '/../classes/User.php';

    $user =  new User();
?>
<div class="main">
    <div class="manageusers">
        <table class="tblone">
            <thead>
                <tr>
                    <th>Sl. No</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $getUsers = $user->getUsers();
                if($getUsers){
                    $i = 0;
                    while($row = $getUsers->fetch_assoc()){
                        $i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <a onclick="return confirm('Are you sure to disable user?');" href="?dis=<?php echo $row['id']; ?>" >Disable</a> |
                        <a onclick="return confirm('Are you sure to eanable?');" href="?ena=<?php echo $row['id']; ?>" >Enable</a> |
                        <a onclick="return confirm('Are you sure to remove?');" href="?del=<?php echo $row['id']; ?>" >Remove</a>
                    </td>
                </tr>
            </tbody>
            <?php
                    }
                }
            ?>
        </table>
    </div>
</div>
<?php include 'inc/footer.php';?>