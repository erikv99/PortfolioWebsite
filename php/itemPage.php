<?php
	session_start();
	// Setting the session variable to false if it didnt exist yet.
	// Doing this to prevent accessing undefined variable later on.
	if (!isset($_SESSION["loggedIn"])) {
		$_SESSION["loggedIn"] = "no";
	}
	include_once("../includes/headerHomePage.inc.php");
	include_once("../includes/loginContainer.inc.php");
?>
<!-- 
* * * * *     PLEASE READ ME     * * * * *
// There are 2 security measures in place for admin functions.
// 1. The admin buttons are only visible when the user is logged in.
// 2. Whenever someone presses an admin only button there will be a check if the user is logged in or not at the beginning of the file which handles the function.
-->
<!DOCTYPE html>
<html>
<head>
	<title>Portfolio: Item Page</title>
</head>
<body>
	<div class="mainContainer">
		<div class="itemContainer">
			NO DATA AVAILABLE
		</div>
	</div>

	<!-- Styling related imports, stylesheet, fonts etc. -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,700;1,100&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/969d13854d.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="../css/styleS.css">
	<!-- Bootstrap needs these for certain of their functions. ( i need jquery anyways ) -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<!-- My own js files -->
	<script type="text/javascript" src="../js/createDynamicItemPage.js"></script>
	<script type="text/javascript" src="../js/widgetManager.js"></script>
	<script type="text/javascript" src="../js/deleteItem.js"></script>
	<script type="text/javascript" src="../js/redirectToEditItem.js"></script>
	<script type="text/javascript" src="../js/loginHandler.js"></script>
	<script type="text/javascript" src="../js/logoutHandler.js"></script>
	<script type="text/javascript" src="../js/checkIfLoggedInOnPageEnter.js"></script>
	<script type="text/javascript" src="../js/generalFunctions.js"></script>
</body>
</html>
<?php
	include_once("../includes/footer.inc.php");
?>