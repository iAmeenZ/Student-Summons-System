<?php include('server.php') ?>
<?php 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: adminindex.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: adminlogin.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style type="text/css">
  <style type="text/css">
  </style>
	<title>Summons Check</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="headeradmin">
	<h2>Summons check</h2>
</div>
<div class="content" style="text-align: center;">
  	<!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3 style="font-family: arial;">
          <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
      	</h3>
      </div>
  	<?php endif ?>


    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
    	<p><strong>WELCOME <?php echo $_SESSION['fullname']; ?></strong></p>
    	<p style="font-size: 20px; text-align: right;"> <a href="adminindex.php?logout='1'" style="color: red;">Logout</a> </p>
    <?php endif ?>
    <br><hr><br>
    <!--<p style="font-size: 18px;">Search Student ID :</p>-->
    
    <?php include('errors.php'); ?>
    <form style="background-color: transparent;" action="adminindex.php" method="post" autocomplete="off">
      <div class="well well-lg">
      <input style="width: 50%; height: 30px; text-align: center;" type="text" name="studentid" placeholder=" Search student id.."><br><br>
      <input id="insert" type="radio" name="type" value="insert"><label for="insert" style="font-family: arial; font-size: 16px;"> Insert Summon</label><br>
      <input id="update" type="radio" name="type" value="update"><label for="update" style="font-family: arial; font-size: 16px;"> Update Payment</label>
      <br><br>
      <button style="outline: none;" type="submit" class="btnadmin" name="search_id">Search</button></div>
    </form>
    
</div>
		
</body>
</html>