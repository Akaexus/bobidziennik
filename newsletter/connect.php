<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$dbName = "cms";

	$connect = mysqli_connect($host, $user, $password, $dbName);
	if (mysqli_connect_errno()) {
		echo "Error!!" . mysqli_connect_error();
		$connect -> query ('SET NAMES utf8');
		$connect -> set_charset ('utf8');
		mysqli_set_charset($con,"utf8");
	}
?>