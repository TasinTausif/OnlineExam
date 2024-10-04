<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/header.php';
include_once $filepath . '/../classes/Exam.php';

$exm =  new Exam();
?>

<?php
    if (isset($_GET['delQues'])) {
        $quesNo = $_GET['delQues'];
        $remQues = $exm->deleteQuestion($quesNo);
    }
?>
<div class="main">
    <h1>Admin Panel - Question List</h1>
    <?php
        if (isset($remQues)) {
            echo $remQues;
        }
    ?>
    <div class="manageusers">
        <table class="tblone">
            <thead>
                <tr>
                    <th width="10%">Sl. No</th>
                    <th width="70%">Question</th>
                    <th width="20%">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $getQues = $exm->getQuesByOrder();
                if ($getQues) {
                    $i = 0;
                    while ($row = $getQues->fetch_assoc()) {
                        $i++;
                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['ques']; ?></td>
                            <td>
                                <a onclick="return confirm('Are you sure to remove?');" href="?delQues=<?php echo $row['quesNo']; ?>">Remove</a>
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
<?php include 'inc/footer.php'; ?>