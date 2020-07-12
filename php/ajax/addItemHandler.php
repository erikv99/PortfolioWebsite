<?php
// This files handles everything when a user submits an item they want to add.

function hasUploadedImage () {
	// Will check if the user has actually uploaded a image. returns true or false

	// In order to be sure a image has been uploaded we check if all error codes are 0
	$allErrorCodesAreZero = True;
	
	$errorCodes = $_FILES["images"]["error"];

	for ($i = 0; $i < count($errorCodes); $i++) {

		if ($_FILES["images"]["error"][$i] != 0) {

			$allErrorCodesAreZero = False;
		}
	}
	return $allErrorCodesAreZero;
}

function checkFileType ($targetFile) {
	// Will return true if file type is allowed, returns error msg if not.

	$imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));

	// If file type is not one of the following
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

		return "Error: filetype must be one of the following: jpg, png, jpeg or gif";
	}
	return "true";
}

function checkFileSize ($i) {
	// Will return true if size is correct size, returns error msg if not

	if ($_FILES["images"]["size"][$i] > 1000000) {

		return "Error: image size is more then 1MB";
	}
	return "true";
}

function moveUploadedFiles() {
	// Will return  a array of the new filepaths of the images if moving was successfull, returns correct error msg otherwise

	$targetDir = "../../uploads/";
	$filePaths = [];
	// Getting the amount of uploaded files
	$fileCount = count($_FILES["images"]["name"]);

	// Looping thru all each file
	for ($i = 0; $i < $fileCount; $i++) {

		$targetFile = $targetDir . basename($_FILES["images"]["name"][$i]);

		// Checking for any other error
		if ($_FILES["images"]["error"][$i] != 0) {

			return "Error: img at index " . $i . " contains error code " . $_FILES["images"]["error"][$i];
			
		}
		
		// Check if file already exists
		if (file_exists($targetFile)) {

			return "Error: file already exists [index: " . $i . "]";
		}

		// Checking if file type is allowed (returning result if not (result == error msg in this case))
		$result = checkFileType($targetFile);
		if ($result != "true") {

			return $result;
		}	

		// Checking if file is not bigger then 1MB
		$result = checkFileSize($i);
		if ($result != "true") {

			return $result;
		}

		// Getting the temp file path
		$tmpFilePath = $_FILES["images"]["tmp_name"][$i];

		// Making sure we have the file path
		if ($tmpFilePath == "") {

			return "Error: tmp_name cannot be empty [index: " . $i . "]";

		} else {

			// Setting up a new file path to the uploads folder
			$newFilePath = $targetDir . $_FILES["images"]["name"][$i];
			
			// Moving the file to the new path and setting moveSuccess to false if the move returns false
			if (!move_uploaded_file($tmpFilePath, $newFilePath)) {
				
				return "Error: moving from tmpFilePath to newFilePath failed for image at index " . $i . ", line 82";
			
			} else {

				// If the transfer of this file was successfull we add the path to our list of paths
				array_push($filePaths, $newFilePath);
			}			
		}
	}
	// If we made it this far without returning an error we will return the array of paths.
	return $filePaths;
}

function handleFormData () {

	require_once("../../includes/addItemToSQL.inc.php");

	// Making the response array and setting error to false as default
	$response = array();
	$response["error"] = "false";
	$filePaths = [];

	// Checking if the user uploaded anything. If so we will try moving the images to the server
	if (hasUploadedImage()) {

		// The moveUploadedFiles will return a string containing a error msg if something went wrong so we check if it is a string.
		$result = moveUploadedFiles();

		if (is_string($result)) {

			$response["error"] = $result;
			echo json_encode($response);
			exit();
		
		// If the result is not a string it can only be our array of file paths.
		} else {

			$filePaths = $result;
		}	
	}

	// Down here we handle te rest of the form
	$title = $_POST["title"];
	$url = $_POST["url"];
	$dateCreation = $_POST["dateCreation"];
	$dateUpload = date("Y-m-d");
	$description = $_POST["description"];
	$comment = $_POST["comment"];
	$pageName = $_POST["pageName"];
	$imagesFromCookie = $_POST["allImages"];
	$id = $_POST["id"];
	
	$tech = [];
	// Getting the selected values from the tech checkbox if atleast one of them has been set
	if (isset($_POST["tech"])) {

		$tech = $_POST["tech"];
	}

	// Adding the item to the database
	addItemToSQL($pageName, $imagesFromCookie, $id, $title, $url, $dateCreation, $dateUpload, $description, $comment, $filePaths, $tech);

	echo json_encode($response);
}

handleFormData();
 ?>
