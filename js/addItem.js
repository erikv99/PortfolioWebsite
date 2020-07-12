// File will handle the input from the addItem.php page.

$("#addItemForm").submit(function(event) {
	
	// Note if input == good we continue to do the other php stuff we need to do (add to database etc etc)
	// if input == bad we send back a error msg

	// Preventing default form submittion
	event.preventDefault();

	// Making a formdata object
	var formData = new FormData(document.getElementById("addItemForm"));

	// Getting the name of the page where it comes from (needed later)
	var currentPageName = window.location.pathname;
	var currentPageName = currentPageName.substring(currentPageName.lastIndexOf('/') + 1);

	// Adding the page name to the formdata 
	formData.append("pageName", currentPageName);

	if (currentPageName == "editItem.php") {

		formData.append("id", getCookie("id"));

	} else { 

		formData.append("id", "none"); 
	}

	// Adding the allImages cookie to the formdata (needed if currentPage = editItem.php)
	formData.append("allImages", getCookie("allImages"));

	// Make a request to the php validation file.
	$.ajax({
		type: "POST",
		url: "../php/ajax/addItemHandler.php",
		data: formData,
		contentType: false,
		processData: false,
		success: function(data) {

			// Parsing the response to JSON
			var response = JSON.parse(data);
			// If there was a error in the handling of the data in the php file
			if (response["error"] != "false") {

				// Hiding success alert since there is a chance it was still being displayed
				$("#addItemSuccess").hide(300);

				// Changing the text of the alert to the error msg and fading the error alert in.
				$("#addItemFailed").text(response["error"]);
				$("#addItemFailed").fadeIn(300);
			
			} else {

				// Hiding failed alert incase they had failure before success
				$("#addItemFailed").hide(300);
				// Showing success alert
				$("#addItemSuccess").fadeIn(300);

				// Redirecting to homepage after 1.5 second
				setTimeout( function() {

					window.location.replace("../php/homePage.php");

				}, 1500);
			}
		},
		error: function(xhr, textStatus, errorThrown) {

			alert("Error:\nxhr: " + xhr + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
		}
	});
	
})