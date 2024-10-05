<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/header.php';
include_once $filepath . '/../classes/Exam.php';

$exm = new Exam();
?>
<style>
  .adminPanel {
    width: 500px;
    color: #999;
    margin: 20px auto;
    padding: 10px;
    border: 1px solid;
  }
</style>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $addQues = $exm->addQuestion($_POST);
}

$lastQuesNo = $exm->getLastQuesNo();
$newQuesNo  = $lastQuesNo + 1;
?>
<div class="main">
  <h1>Admin Panel - Add Question</h1>
  <?php
  if (isset($addQues)) {
    echo $addQues;
  }
  ?>
  <div class="adminPanel">
    <form action="" method="post">
      <table>
        <tr>
          <td>Ques No</td>
          <td>:</td>
          <td><input type="number" name="quesNo" required readonly value="<?php
if (isset($newQuesNo)) {
  echo $newQuesNo;
}
?>" /></td>
        </tr>
        <tr>
          <td>Question</td>
          <td>:</td>
          <td><input type="text" name="ques" placeholder="Question" /></td>
        </tr>
        <tr>
          <td>Choice One</td>
          <td>:</td>
          <td><input type="text" name="ans1" placeholder="Enter Choice One" required /></td>
        </tr>
        <tr></tr>
        <td>Choice Two</td>
        <td>:</td>
        <td><input type="text" name="ans2" placeholder="Enter Choice Two" required /></td>
        </tr>
        <tr>
          <td>Choice Three</td>
          <td>:</td>
          <td><input type="text" name="ans3" placeholder="Enter Choice Three" required /></td>
        </tr>
        <tr>
          <td>Choice Four</td>
          <td>:</td>
          <td><input type="text" name="ans4" placeholder="Enter Choice Four" required /></td>
        </tr>
        <tr>
          <td>Correct An</td>
          <td>:</td>
          <td><input type="number" name="rightAns"/></td>
        </tr>
        <tr>
          <td colspan="3" align="center">
            <input type="submit" value="Add a question" />
          </td>
        </tr>
      </table>
    </form>
  </div>
</div>
<?php include 'inc/footer.php';?>