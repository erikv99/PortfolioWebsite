<?php
require_once("../../includes/DBConnection.inc.php");

function addDataFromDatabase($arrayOfArrays, $dbConnection) {
	// Will add all the data from the portfolio and tech tables to the right array in our arrayOfArrays

	// Making and executing the statement
	$stmt = "SELECT p.id, p.title, p.dateCreation, p.dateUpload, p.description, p.comment, p.images, t.python, t.html, t.css, t.mysql, t.javascript, t.php FROM portfolio p INNER JOIN tech t ON p.id = t.id";
	$result = $dbConnection->query($stmt);

	while($row = mysqli_fetch_assoc($result)) {

		// Making a array to hold all the values of this item (row)
		$itemArray = array();

		// Adding all the db values to this array
		$itemArray["id"] = $row["id"];
		$itemArray["title"] = $row["title"];
		$itemArray["dateCreation"] = $row["dateCreation"];
		$itemArray["dateUpload"] = $row["dateUpload"];
		$itemArray["description"] = $row["description"];
		$itemArray["comment"] = $row["comment"];
		$itemArray["images"] = $row["images"];
		$itemArray["python"] = $row["python"];
		$itemArray["html"] = $row["html"];
		$itemArray["css"] = $row["css"];
		$itemArray["mysql"] = $row["mysql"];
		$itemArray["javascript"] = $row["javascript"];
		$itemArray["php"] = $row["php"];

		// Getting the id of this item
		$currentID = $row["id"];
		
		// Making a new array inside the arrayOfArrays for this id
		$arrayOfArrays[$currentID] = $itemArray;
	}

	$arrayOfArrays = array_reverse($arrayOfArrays);
	return $arrayOfArrays;
}

function getDataFromDatabase() {
	// Will return an array containing an array for each item (id) and it will have all the values of that item.
	$arrayOfArrays = [];

	// Opening the connection
	$conn = openConnection();

	// Getting all the data from the portfolio and tech tables
	$arrayOfArrays = addDataFromDatabase($arrayOfArrays, $conn);

	// Closing the connection
	closeConnection($conn);

	// Returning the arrayOfArrays which contains each item as a seperate array
	return $arrayOfArrays;
}

// Sending back a array containing a seperate array for each item which holds all the info 
$response = getDataFromDatabase();
echo json_encode($response);
?>