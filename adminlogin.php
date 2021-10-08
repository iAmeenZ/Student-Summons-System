<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <style type="text/css">
    .container{
      text-align: center;
    }
    .button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 15px 40px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 15px;
      cursor: pointer;
      outline: none;
    }
    .button:hover
    {
      background-color: rgb(76, 159, 80);
    }
    .button:active
    {
      background-color: rgb(76, 147, 80);
      transform: translateY(2px);
    }
  </style>
  <title>Summons Check</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <br><br>
  <div style="text-align: center;" class="headeradmin">
  	<h2>Admin Login</h2>
  </div>
	 
  <form style="text-align: center;" method="post" action="adminlogin.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label style="text-align: center; font-family: arial;">Username</label>
  		<input style="width: 40%; text-align: center;" type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label style="text-align: center; font-family: arial;">Password</label>
  		<input style="width: 40%; text-align: center;" type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btnadmin" name="login_admin">Login</button>
  	</div>
  </form>
  <br>
  <div class="container">
  <button class="button" onclick="location.href = 'first.php'">Back</button>
  </div>
</body>
</html>