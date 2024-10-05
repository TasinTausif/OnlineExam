<?php include 'inc/header.php'; ?>
<?php
	Session::checkLogin();
?>
<div class="main">
<h1>Online Exam System - User Login</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/test.png"/>
	</div>
	<div class="segment">
	<form action="" method="post">
		<table class="tbl">    
			 <tr>
			   <td>Email</td>
			   <td><input name="email" type="text" id="email"></td>
			 </tr>
			 <tr>
			   <td>Password </td>
			   <td><input name="password" type="password" id="password"></td>
			 </tr>
			 
			  <tr>
			  <td></td>
			   <td><input type="submit" id="userLogin" value="Login">
			   </td>
			 </tr>
       </table>
	   </form>
	   <p>New User ? <a href="register.php">Signup</a> Free</p>
	   <div>
	   		<span class="empty" style="display: none;">Field can not be emplty!</span>
	   		<span class="invalid" style="display: none;">Email is invalid!</span>
	   		<span class="disable" style="display: none;">User is disabled!</span>
	   		<span class="error" style="display: none;">Wrong credentials!</span>
	   </div>
	</div>
	
</div>
<?php include 'inc/footer.php'; ?>