<!DOCTYPE html>
<html>
<head>
	<title>Summons Check</title>
	<style>
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
</style>
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<br><br><br><br><br><br>
	<div class="headerfirst">
	<h2>Summons Check</h2>
</div>
<div class="content" style="text-align: center;">
	<p style="font-family: arial; font-size: 18px;">Login as :</p><br>
  	<button class="button" onclick="location.href = 'login.php'">Student</button>
  	<button class="button" onclick="location.href = 'adminlogin.php'">Admin</button>
</div>

</body>
</html>