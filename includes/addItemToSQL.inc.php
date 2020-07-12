<?php
require_once("DBConnection.inc.php");

function prepareTechParams($tech) {
	// Will prepare the correct query statement for the tech parameters and return it. techs not used = 0 tech used = 1;

	// array with every tech in it and all set to 0 (not used) by default
	$techUsed = [
		"python" => 0,
		"html" => 0,
		"css" => 0,
		"mysql" => 0,
		"javascript" => 0,
		"php" => 0
	];

	// Looping thru all the element in the tech array
	for ($i = 0; $i < count($tech); $i++) {

		// All the tech in tech array are in capital letters
		// So we use the to lower letter converted value of the current index in the tech array to set this element in the tech used array to 1 (used)
		// second explaination: In the $tech array we got the used techs. So we set the value of those in the $techUsed to 1 (used)
		$techUsed[strtolower($tech[$i])] = 1;
	}

	return $techUsed;
}
function addItemToSQL($pageName, $imagesFromCookie, $id, $title, $url, $dateCreation, $dateUpload, $description, $comment, $filePaths, $tech) {

	if ($pageName == "addItem.php") {

		// Opening new connection to db
		$conn = openConnection();
		$images = "";

		// Puttin all the elements of the filePaths (image paths) array in one string seperated by comma's.
		$images = implode(",", $filePaths);
			
		// Preparing the query and binding the parameters
		$stmt = $conn->prepare("INSERT INTO portfolio (title, url, dateCreation, dateUpload, description, comment, images) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("sssssss", $title, $url, $dateCreation, $dateUpload, $description, $comment, $images);

		// Executing the statement and closing the statement
		$stmt->execute();
		$stmt->close();

		// Preparing and getting the correct tech params
		$techParams = prepareTechParams($tech);

		// Preparing the query and binding the params
		$stmt = $conn->prepare("INSERT INTO tech (python, html, css, mysql, javascript, php) VALUES (?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("iiiiii", $techParams["python"], $techParams["html"], $techParams["css"], $techParams["mysql"], $techParams["javascript"], $techParams["php"]);

		// Executing the statement and closing the statement
		$stmt->execute();
		$stmt->close();

		// Closing the connection
		closeConnection($conn);

	} else if ($pageName == "editItem.php") {

		// Opening new connection to db
		$conn = openConnection();
		$images = "";

		// Putting all the elements of the filePaths (image paths) array in one string seperated by comma's.
		$images = implode(",", $filePaths);
			
		// Checking if the last char of the string is a commma and adding one if not so.
		if (strlen($imagesFromCookie) != 0) {

			$lastCharIndex = strlen($imagesFromCookie) - 1;
			if ($imagesFromCookie[$lastCharIndex] != ",") {

				$imagesFromCookie .= ",";
			}

			// Pasting the two togheter
			$images = $imagesFromCookie . $images;

		}

		// Preparing the query and binding the parameters
		$stmt = $conn->prepare("UPDATE portfolio SET title = (?), url = (?), dateCreation = (?), dateUpload = (?), description = (?), comment = (?), images = (?) WHERE id = (?)");
		$stmt->bind_param("sssssssi", $title, $url, $dateCreation, $dateUpload, $description, $comment, $images, $id);

		// Executing the statement and closing the statement
		$stmt->execute();
		$stmt->close();

		// Preparing and getting the correct tech params
		$techParams = prepareTechParams($tech);

		// Preparing the query and binding the params
		$stmt = $conn->prepare("UPDATE tech SET python = (?), html = (?), css = (?), mysql = (?), javascript = (?), php = (?) WHERE id = (?)");
		$stmt->bind_param("iiiiiii", $techParams["python"], $techParams["html"], $techParams["css"], $techParams["mysql"], $techParams["javascript"], $techParams["php"], $id);

		// Executing the statement and closing the statement
		$stmt->execute();
		$stmt->close();

		// Closing the connection
		closeConnection($conn);
	}
}

?>