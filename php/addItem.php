<?php
	require_once("../includes/isUserLoggedIn.inc.php");
	// Will either be True or False
	$loggedIn = isUserLoggedIn(); 
	
	// Rederecting user to the access denied page if the're not logged in.
	if ($loggedIn == False) {
		header("Location: accessDenied.php");
	}

	include_once("../includes/header.inc.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>PortFolio: Add Item</title>
</head>
<body>
	<div class="mainContainer">
		<div class="itemContainer widthAuto">
			<form id="addItemForm" enctype="multipart/form-data">
				<div id="leftSideContainer" class="left">
					<label for="title">Title:</label><br>
					<label for="url">Url:</label><br>
					<label for="date">Creation Date:</label><br>
					<label>Tech used: </label>
				</div>
				<div id="rightSideContainer" class="left">
					<input type="text" name="title" placeholder="Title" maxlength="255" required><br>
					<input type="text" name="url" maxlength="255" placeholder="https://github.com/"><br>
					<input type="date" name="dateCreation" maxlength="255" required><br>
					<div id="checkBox">
						<input type="checkbox" name="tech[]" value="PYTHON">
						<label for="PYTHON">PYTHON</label><br>
						<input type="checkbox" name="tech[]" value="HTML">
						<label for="HTML">HTML</label><br>
						<input type="checkbox" name="tech[]" value="CSS">
						<label for="CSS">CSS</label><br>
						<input type="checkbox" name="tech[]" value="MYSQL">
						<label for="MYSQL">MYSQL</label><br>
						<input type="checkbox" name="tech[]" value="JAVASCRIPT">
						<label for="JAVASCRIPT">JAVASCRIPT</label><br>
						<input type="checkbox" name="tech[]" value="PHP">
						<label for="PHP">PHP</label><br>
					</div>
				</div>
				<div id="textAreas" class="left">
					<label for="description" class="textAlignCenter">Description:</label><br>
					<textarea name="description" rows="6"  maxlength="255" placeholder="Description of the project" required></textarea><br>
					<label for="comment" class="textAlignCenter">Comment:</label><br>
					<textarea name="comment" maxlength="255" placeholder="Comment about your experience on working on this project"></textarea><br>
				</div>
				<div id="imagesInput">
					<label for="images">Images:</label><br>
					<input type="file" name="images[]" accept="image/*" multiple><br>
					<input type="submit" name="submit" id="submitBut">
				</div>
				<div id="addItemSuccess" class="alert alert-success bAlert textAlignCenter hiddenByDefault" role="alert">Item added successfully!</div>
				<div id="addItemFailed" class="alert alert-danger bAlert textAlignCenter hiddenByDefault" role="alert"></div>
			</form>
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
	<script type="text/javascript" src="../js/addItem.js"></script>
	<script type="text/javascript" src="../js/generalFunctions.js"></script>
</body>
</html>
<?php  
	include("../includes/footer.inc.php");
?>