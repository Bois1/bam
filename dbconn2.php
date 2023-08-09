<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "project";
		
		// Create connection
		$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	// Create database if not exists
	$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
	// if ($conn->query($sql) === TRUE) {
	//   //  echo "Database created successfully<br>";
	// } else {
	//   //  echo "Error creating database: " . $conn->error . "<br>";
	// }
	
	//$conn = mysqli_connect("localhost", "root", "", "e-voting");
	
	// Select the database
	$conn->select_db($dbname);
	
	// Create table if not exists
	$tableName = "users";
	$sql1 = "CREATE TABLE IF NOT EXISTS $tableName (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		devid VARCHAR(255) NOT NULL,
		nid INT(11) NOT NULL,
		name VARCHAR(255) NOT NULL,
		age INT(11) NOT NULL,
		address VARCHAR(255) NOT NULL,
		mobile VARCHAR(255) NOT NULL,
		email VARCHAR(255) NOT NULL,
		dept VARCHAR(255) NOT NULL
	
	)";
	
	if ($conn->query($sql1) === TRUE) {
	  //  echo "Table created successfully<br>";
	} else {
		//echo "Error creating table: " . $conn->error . "<br>";
	}
	
	 
	

	// Create table if not exists
	$tableAdmin = "admins";
	$sql2 = "CREATE TABLE IF NOT EXISTS $tableAdmin (
		id INT(11) AUTO_INCREMENT PRIMARY KEY,
		username VARCHAR(255) NOT NULL,		 
		password VARCHAR(255) NOT NULL
	
	)";
	
	$con = new mysqli($servername, $username, $password, $dbname);
	// Data for the new record
$newUsername = "admin";
$newPass = "admin";

// Check if the record already exists
$query = "SELECT * FROM admins WHERE username = '$newUsername'";
$result = $con->query($query);

if ($result->num_rows == 0) {
    // Record doesn't exist, so insert it
    $insertQuery = "INSERT INTO users (username, password) VALUES ('$newUsername', '$newPass')";
    $con->query($insertQuery);
    // if ($conn->query($insertQuery) === TRUE) {
    //   //  echo "New record inserted successfully.";
    // } else {
    //     echo "Error inserting record: " . $conn->error;
    // }
 }
// else {
//     echo "Record already exists.";
// }
	// if ($conn->query($sql2) === TRUE) {
	//   //  echo "Table created successfully<br>";
	// } else {
	// 	//echo "Error creating table: " . $conn->error . "<br>";
	// }
	
	// $conn->close();
?>