<?php

	include 'dbconn.php';

	$name = mysqli_real_escape_string($db, $_POST['name']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$supervisor = mysqli_real_escape_string($db, $_POST['supervisor']);
	$department = mysqli_real_escape_string($db, $_POST['department']);

	$query = "INSERT INTO orgdetails (name, address, phone, supervisor, departmentAssigned) VALUES ('$name', '$address', '$phone', '$supervisor', '$department')";
	mysqli_query($db, $query);

	header('location: result.php')

?>