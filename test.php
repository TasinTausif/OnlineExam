<?php include 'inc/header.php'; ?>
<?php
Session::checkSession();
if (isset($_GET['q'])) {
	$number = (int)$_GET['q'];
} else {
	header("Location:exam.php");
}

$totalQues = $exm->totalQues();
$question = $exm->getQuesByNo($number);
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$process = $pro->processData($_POST);
}
?>
<div class="main">
	<h1>Question <?= $question['quesNo']; ?> of <?= $totalQues; ?></h1>
	<div class="test">
		<form method="post" action="">
			<table>
				<tr>
					<td colspan="2">
						<h3>Ques <?= $question['quesNo']; ?>: <?= $question['ques']; ?></h3>
					</td>
				</tr>

				<?php
				$answer = $exm->getAnswer($number);

				if ($answer) {
					while ($row = $answer->fetch_assoc()) {
				?>
						<tr>
							<td>
								<input type="radio" name="ans" value="<?= $row['id']; ?>" /><?= $row['ans']; ?>
							</td>
						</tr>
				<?php }
				} ?>
				<tr>
					<td>
						<input type="hidden" name="number" value="<?= $question['quesNo']; ?>" />
						<input type="submit" name="submit" value="Next Question" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php include 'inc/footer.php'; ?>