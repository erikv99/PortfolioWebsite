<?php 
// Gets a ID from an ajax request and returns the item data for only that id. That is pretty much the major difference with getItemData.php
require_once("../../includes/DBConnection.inc.php");

function addDataFromDatabase($id, $dbConnection) {
	// Will add all the data for this id to a array and return it

	// Making the query
	$query = "SELECT p.id, p.title, p.url, p.dateCreation, p.dateUpload, p.description, p.comment, p.images, t.python, t.html, t.css, t.mysql, t.javascript, t.php FROM portfolio p INNER JOIN tech t ON p.id = t.id WHERE p.id = (?)";
	// preparing our stmt
	$stmt = $dbConnection->prepare($query);
	// Binding the parameters for our statement
	$stmt->bind_param("i", intval($id));
	// Executing the statement
	$stmt->execute();
	// Getting the result of the stmt
	$result = $stmt->get_result();

	$row = mysqli_fetch_array($result);

		// Making a array to hold all the values of this item (row)
		$itemArray = array();

		// Adding all the db values to this array
		$itemArray["id"] = $row["id"];
		$itemArray["title"] = $row["title"];
		$itemArray["url"] = $row["url"];
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

		return $itemArray;
}

function getDataFromDatabase($id) {
	// Will return an array containing an array for each item (id) and it will have all the values of that item.
	$arrayOfArrays = [];

	// Opening the connection
	$conn = openConnection();

	// Getting all the data from the portfolio and tech tables
	$itemInfoArray = addDataFromDatabase($id, $conn);

	// Closing the connection
	closeConnection($conn);

	// Returning the arrayOfArrays which contains each item as a seperate array
	return $itemInfoArray;
}

if (isset($_POST["id"])) {

	$response = getDataFromDatabase($_POST["id"]);
	echo json_encode($response);
}

?>