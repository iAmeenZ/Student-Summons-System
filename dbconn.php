<?php

	$db = mysqli_connect('localhost', 'root', '', 'db2');

	if ($db -> connect_errno) {
	  echo "Failed to connect to database: " . $db -> connect_error;
	  exit();
	}

?>