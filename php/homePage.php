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
	<title>Portfolio: Home</title>
</head>
<body>
	<!-- Container containing a add item button. (Admin Only) -->
	<div id="addItemContainerWithSort" class="hiddenByDefault left">
		<a href="addItem.php" id="addItemBut" class="headerStyle effects left">Add New Item</a>
		<form id="sortForm" class="right">
			<label class="headerStyle" for="sortOption">Sort:</label>
			<select name="sortOption" id="techSortSelect">
				<option value="" selected disabled hidden>--NONE--</option>
				<option value="PYTHON">PYTHON</option>
				<option value="HTML">HTML</option>
				<option value="CSS">CSS</option>
				<option value="MYSQL">MYSQL</option>
				<option value="JAVASCRIPT">JAVASCRIPT</option>
				<option value="PHP">PHP</option>
			</select>
			<input class="headerStyle effects" type="Submit" name="submit" value="OK">
		</form>

	</div>
	<!-- Main container which will hold all item containers (which are made dynamically) -->
	<div class="mainContainer"></div>

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
	<script type="text/javascript" src="../js/loadItemsOnPageEnter.js"></script>
	<script type="text/javascript" src="../js/widgetManager.js"></script>
	<script type="text/javascript" src="../js/loginHandler.js"></script>
	<script type="text/javascript" src="../js/logoutHandler.js"></script>
	<script type="text/javascript" src="../js/checkIfLoggedInOnPageEnter.js"></script>
	<script type="text/javascript" src="../js/deleteItem.js"></script>
	<script type="text/javascript" src="../js/redirectToEditItem.js"></script>
	<script type="text/javascript" src="../js/redirectToItemPage.js"></script>
	<script type="text/javascript" src="../js/sortByTech.js"></script>
	<script type="text/javascript" src="../js/generalFunctions.js"></script>
</body>
</html>
<?php
	include_once("../includes/footer.inc.php");
?>