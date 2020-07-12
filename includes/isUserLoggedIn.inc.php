<!--
File with a function that will return true of false based on if the user is logged in or not.
-->

<?php
session_start();

function isUserLoggedIn() {

	if ($_SESSION["loggedIn"] == "yes") {
		
		return True;

	} else if ($_SESSION["loggedIn"] == "no") {
		
		return False;
	}
}
?>