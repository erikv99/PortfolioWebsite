<?php
function openConnection(){
 
 	$dbHost = "localhost";
 	$dbUser = "root";
 	$dbPass = "";
 	$db = "portfolio";
 	
 	$conn = new mysqli($dbHost, $dbUser, $dbPass, $db);

 	// If we have a problem connecting
 	if ($conn->connect_error) {

		die("<br>Connection failed: " . $conn->connect_error);
	
	} else {

 		return $conn;
	}
 }
 
function closeConnection($conn){
	
	$conn -> close();
 }
   
?>
