<?php 
require_once("../../includes/DBConnection.inc.php");

function deleteFromDatabase($id) {

	$conn = openConnection();
	$intId = intval($id);
	$query = "DELETE portfolio, tech FROM portfolio INNER JOIN tech ON portfolio.id = tech.id WHERE portfolio.id = (?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $intId);
	$stmt->execute();
	closeConnection($conn);

}

function deleteImagesFromServer($id) {

	$conn = openConnection();
	$intId = intval($id);
	$query = "SELECT images FROM portfolio WHERE id = (?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("i", $intId);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = mysqli_fetch_array($result);
	closeConnection($conn);	
	
	// Splitting on each comma
	$imagesArr = explode(",", $row["images"]);
	$fileNames = [];

	if ($imagesArr[0] == "") {

		return;
	}

	for ($i = 0; $i < count($imagesArr); $i++) {

		if ($imagesArr[$i] == "") { continue; }
		// Splitting on each slash
		$temp = explode("/", $imagesArr[$i]);
		// Getting the 3rd element which should be only the file name.
		array_push($fileNames, $temp[3]);
	}

	// Save the current directory
	$old = getcwd(); 

    // Changing to correct dir
    chdir("../../uploads"); 

    // Looping thru all the file names and removing each one
    for ($i = 0; $i < count($fileNames); $i++) {
    	
    	// Removing file
    	unlink($fileNames[$i]);

    }
    // Restore the old working directory  
    chdir($old); 
}

if (isset($_POST["id"])) {
	
	// Deleting img's from server
	deleteImagesFromServer($_POST["id"]);
	
	// Deleting everything from database
	deleteFromDatabase($_POST["id"]);
	$response = array();
	$response["success"] = "yes";
	echo json_encode($response);
}
?>