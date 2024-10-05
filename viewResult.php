<?php include 'inc/header.php'; ?>
<?php
Session::checkSession();
$totalQues = $exm->totalQues();
?>
<div class="main">
    <h1>Right answers of all <?= $totalQues; ?> Questions</h1>
    <div class="test">
        <table>
            <?php
            $ques = $exm->getQuesByOrder();

            if ($ques) {
                while ($question = $ques->fetch_assoc()) {
            ?>
                    <tr>
                        <td colspan="2">
                            <h3>Ques <?= $question['quesNo']; ?>: <?= $question['ques']; ?></h3>
                        </td>
                    </tr>

                    <?php

                    $number = $question['quesNo'];
                    $answer = $exm->getAnswer($number);

                    if ($answer) {
                        while ($row = $answer->fetch_assoc()) {
                    ?>
                            <tr>
                                <td>
                                    <input type="radio" />
                                    <?php
                                    if ($row['rightAns'] == 1) {
                                        echo "<span class='success'>" . $row['ans'] . "</span>";
                                    } else {
                                        echo $row['ans'];
                                    } ?>
                                </td>
                            </tr>
                    <?php }
                    } ?>

            <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<?php include 'inc/footer.php'; ?>