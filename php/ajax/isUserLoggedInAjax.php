<?php
session_start();
$response = array();

if ($_SESSION["loggedIn"] == "yes") {
	
	$response["loggedIn"] = "yes";

} else if ($_SESSION["loggedIn"] == "no") {
	
	$response["loggedIn"] = "no";
}

header("Content-type: application/json");
echo json_encode($response);
?>