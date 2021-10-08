<?php include('server.php') ?>
<?php 
  if (!isset($_SESSION['studentid'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: first.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['studentid']);
    header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 400px;
      font-size: 16px;
      margin-left: auto;
      margin-right: auto;
    }

    td, th {
      border: 0px solid black;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: white;
    }
    p
    {
    	font-family: arial;
    }
    .p
    {
    	font-family: times new roman;
    }
	</style>
	<title>Summon PDF</title>
</head>
<body style="text-align: center;">
<br>
		<picture>
			<img src="uitm.png" alt="UiTM Logo" style="width:auto;" width="200" height="100">
		</picture>
		<br><br>
		<p class="p" style="color: blue;"><?php echo $_SESSION['serialnum'] ?></p>
		<hr>
		<table>
		      <tr>
		        <td>Student ID</td>
		        <td>: <strong><?php echo $_SESSION["studentid"] ?></strong></td>
		      </tr>
		      <tr>
		        <td>Student IC</td>
		        <td>: <strong><?php echo $_SESSION["studentic"] ?></strong></td>
		      </tr>
		      <tr>
		        <td>Student Name</strong></td>
		        <td>: <strong><?php echo $_SESSION["studentName"] ?></strong></td>
		      </tr>
		      <tr>
		        <td>Student Program</strong></td>
		        <td>: <strong><?php echo $_SESSION["studentProgram"] ?></strong></td>
		      </tr>
		</table>

		<?php
			$offenseidtemp = $_SESSION["offenseid"];
			$sql1 = "SELECT typeOfOffense FROM offense WHERE offenseid='$offenseidtemp'";
	        $result1 = $db->query($sql1);
	        $row1 = $result1->fetch_assoc();

	        $_SESSION["typeOfOffense"] = $row1["typeOfOffense"];

	        if ($_SESSION["paid"] == 'No')
	        	{ $_SESSION["temppaid"] = 'UNPAID';}
	        else
	        	{ $_SESSION["temppaid"] = 'PAID';}
		?>
		<br><br>

		<p style="font-size: 15px;">Payment Status</p>
		<?php
		
			if ($_SESSION["temppaid"] == 'PAID')
		 		{echo "<p style='font-size: 20px; color:rgb(0, 205, 0);'><strong>" . $_SESSION["temppaid"] . "</strong></p>";}
		 	else
		 		{echo "<p style='font-size: 20px; color:red;'><strong>" . $_SESSION["temppaid"] . "</strong></p>";}
		 ?>

		<br>

		<p style="font-size: 15px;">Offense ID</p>
		<p style="font-size: 17px;"><strong><?php echo $_SESSION["offenseid"] ?></strong></p>
		<p style="font-size: 17px;"><strong><?php echo $_SESSION["typeOfOffense"] ?></strong></p>

		<br>

		<p style="font-size: 15px;">Date Issue</p>
		<p style="font-size: 17px;"><strong><?php echo $_SESSION["dateissue"] ?></strong></p>

		<br>

		<p style="font-size: 15px;">Location</p>
		<p style="font-size: 17px;"><strong><?php echo $_SESSION["location"] ?></strong></p>

		<br><br><br><br><br>
		<hr>
		<button style="display: inline;" onclick="location.href='index.php'">Back</button>
		<button style="display: inline;" onclick="window.print()">Print</button>
		

</body>
</html>