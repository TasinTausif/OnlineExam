<?php include 'inc/header.php'; ?>
<?php 
	Session::checkSession();
?>
<div class="main">
<h1>Exam Finished</h1>
	<div class="starttest">
		<p>You have successfully completed the test</p>
		<p>Your Score: 
			<?php
				if (isset($_SESSION['score'])) {
					echo $_SESSION['score'];
					unset ($_SESSION['score']);
				}
			?>
		</p>

		<a href="viewResult.php">View Result</a>
		<a href="starttest.php">Start Again</a>
	</div>
	
<?php include 'inc/footer.php'; ?>