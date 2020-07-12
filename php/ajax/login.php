<?php  
session_start();
require_once("../../includes/DBConnection.inc.php");

// This function compares the given username and pass against the ones in the database and will return true or false based on if they are identical
function isLoginSuccesfull($username, $password) {

	// Opening the connection
	$conn = openConnection();

	// Preparing and executing the statement
	$sqlQuery = "SELECT username, password FROM login";
	$result = $conn->query($sqlQuery);

	// Closing the connection
	closeConnection($conn);

	// If there is at least 1 row (which it should since there is only 1 row in the login table)
	if ($result->num_rows > 0) {

		// Saving the data from the first row (only row) in to this row variable
		$row = $result->fetch_assoc();

		// Returning true or false based on if the given pass/name matches the ones in the database (using trenary operator. Yes yes very fancy)
		$returnVal = $row["username"] == $username && $row["password"] == $password ? True : False;
		return $returnVal;

	} else { return False; }
}

// Checking if a variable has been set (given by our ajax request from loginHandler.js)
if (isset($_POST["user"])) {

	$response = array();
	$username = $_POST["user"];
	$password = $_POST["pass"];
	$loginSuccessfull = False;

	// Checking if the login was successfull
	$loginSuccessfull = isLoginSuccesfull($username, $password);

	// Returning the right response value to our loginHandler.js who originally made the request to this file.
	if ($loginSuccessfull == True) {

		$response["loginSuccessfull"] = "yes";
		$_SESSION["loggedIn"] = "yes";
 	
 	} else {

 		$response["loginSuccessfull"] = "no";	
 	} 

 	echo json_encode($response);
}
?>