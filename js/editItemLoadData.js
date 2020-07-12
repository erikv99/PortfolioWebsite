// This file will load all the data for the item the user want to edit and places it in the fields.

function loadAllImagesIntoCookie(data) {

	// Splitting each image apart from each other
	var images = data["images"].split(",");
	var imageNamesOnly = [];

	// Looping thru each image path and splitting the path at the slash
	for (var i = 0; i < images.length; i++){

		imageNamesOnly.push(images[i]);
	}

	// All image names only separated by commas
	var allImages = imageNamesOnly.join();

	// Setting the cookie
	document.cookie = "allImages=" + allImages;
}


function displayAllImages() {

	// Getting all the images names from the cookie and splitting it
	var allImages = getCookie("allImages");	
	var id = getCookie("id");
	var imagesInArr = allImages.split(",");
	var htmlStringArr = [];

	// Checking if array isnt empty (are there images left?)
	if (imagesInArr[0] != "") {

		// Looping thru all image names
		for (var i = 0; i < imagesInArr.length; i++) {
			
			if (imagesInArr[i] == "") {
				continue;
			}

			var temp = imagesInArr[i].split("/");
			var imageName = temp[3];
			// Making the current line
			var currentLine = imageName + "<button onclick=\"return deleteImage('" + id + "','" + imageName + "')\" class=\"effects removeButton\"><i class=\"fas fa-times-circle\"></i></button><br>";
			// putting it in the array
			htmlStringArr.push(currentLine);
			// joining our htmlStringArr in to a single html string
			var htmlString = htmlStringArr.join(" ");

		}
	// If there are no more images left to displays
	} else {

		htmlString = "No images available!";
	}

	// Putting all the image names in to the right paragraphw
	$("#currentlyUploadedImages").html(htmlString);
}

function setTechValues(data) {
	// Will check the correct checkboxes.
	if (data["python"] == "1") {
		$("input[value='PYTHON']").prop("checked", true);
	}
	if (data["html"] == "1") {
		$("input[value='HTML']").prop("checked", true)
	}
	if (data["css"] == "1") {
		$("input[value='CSS']").prop("checked", true)
	}
	if (data["mysql"] == "1") {
		$("input[value='MYSQL']").prop("checked", true)
	}
	if (data["javascript"] == "1") {
		$("input[value='JAVASCRIPT']").prop("checked", true)
	}
	if (data["php"] == "1") {
		$("input[value='PHP']").prop("checked", true)
	}
}

// Will fill the inputs of the form with the current data
function fillFormValues(data) {

	// Will add all the current images to a cookie (needed later)
	loadAllImagesIntoCookie(data);

	// Will display all currently used images on the edit page
	displayAllImages();

	// Setting the tech checkbox values
	setTechValues(data);

	// Changing the field values
	$("input[name='title']").val(data["title"]);
	$("input[name='url']").val(data["url"]);
	$("input[name='dateCreation']").val(data["dateCreation"]);
	$("textarea[name='description']").val(data["description"]);
	$("textarea[name='comment']").val(data["comment"]);

}
function editItem(id) {

	// Need to get the current info for this item from the database using ajax request.
	$.ajax({
		fileType: "json",
		type: "POST",
		data: {
			"id" : id
		},
		url: "../php/ajax/getItemDataByID.php",
		success: function(data) {

			// Parsing the json into a data object
			var dataObj = JSON.parse(data);
			// Filling the form
			fillFormValues(dataObj);

		},
		error: function(xhr, textStatus, errorThrown) {

			alert("Error:\nxhr: " + xhr + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
		}
	});
}

$(document).ready( function() {

	var id = parseInt(getCookie("id"));
	editItem(id);
});