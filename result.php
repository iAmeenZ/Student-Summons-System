<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<table>
		<tr>
			<td>ID</td>
			<td>Organization Name</td>
			<td>Address</td>
			<td>Phone</td>
			<td>Supervisor</td>
			<td>Department</td>
		</tr>
	<?php
		include 'dbconn.php';

		$query = "SELECT * FROM orgdetails";
		$result = mysqli_query($db, $query);

		while($row = $result->fetch_assoc()) {
		  	echo "
		  		<tr>
		  			<td> ". $row['organizationID'] . "</td>
		  			<td> ". $row['name'] . "</td>
		  			<td> ". $row['address'] . "</td>
		  			<td> ". $row['phone'] . "</td>
		  			<td> ". $row['supervisor'] . "</td>
		  			<td> ". $row['departmentAssigned'] . "</td>
		  		</tr>
		  	";
		}
	?>
	</table>
</body>
</html>