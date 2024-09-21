<?php
  $filepath = realpath( dirname( __FILE__ ) );
  include_once $filepath . '/inc/header.php';
?>
<style>
  .adminPanel{width: 500px; color: #999; margin: 30px auto; padding: 50px; border: 1px solid;}
</style>
<div class="main">
  <h1>Admin Panel</h1>
  <div class="adminPanel">
    <h2>Welcome to control panel for admins</h2>
    <p>
      You can manage your users and exams from here!
    </p>
  </div>
</div>
<?php include 'inc/footer.php';?>