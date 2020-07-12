<?php
require_once("../../includes/DBConnection.inc.php");

function deleteFromDatabase ($fileName, $id, $allImages) {
	// Will delete the given filename from the database

	$conn = openConnection();
	$intId = intval($id);
	$query = "UPDATE portfolio SET images = (?) WHERE id = (?)";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("si", $allImages, $intId);
	$stmt->execute();
	closeConnection($conn);
}

function deleteFromServer ($fileName) {
	// Will delete the given filename from the server

	// Save the current directory
	$old = getcwd(); 
    // Changing to correct dir
    chdir("../../uploads"); 
    // Removing file
    unlink($fileName);
    // Restore the old working directory  
    chdir($old); 
}
if (isset($_POST["fileName"]) and isset($_POST["id"]) and isset($_POST["allImages"])) {

	$fileName = $_POST["fileName"];
	$id = $_POST["id"];
	$allImages = $_POST["allImages"];
	
	deleteFromDatabase($fileName, $id, $allImages);
	deleteFromServer($fileName);
}
?>