<?php include 'inc/header.php'; ?>
<?php
Session::checkSession();

$questions = $exm->getQues();
$totalQues = $exm->totalQues();
?>
<div class="main">
    <h1>Welcome to Online Exam</h1>
    <div class="starttest">
        <h2>Test Your Knowledge</h2>
        <ul>
            <li><strong>Number of Questions:</strong> <?= $totalQues; ?></li>
            <li><strong>Question type:</strong> Multiple Choice</li>
        </ul>
        <a href="test.php?q=<?php echo $questions['quesNo']; ?>">Start Test</a>
    </div>
</div>
<?php include 'inc/footer.php'; ?>