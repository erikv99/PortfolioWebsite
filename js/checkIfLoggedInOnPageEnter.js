// This file will check if the user was still logged in on the beginning of the page. 
// If so this file will call the right other files to hide / show the right widgets.

function makeRequest() {

	// Making a ajax request to isUserLoggedIn.php to see if the user is logged in or not
	$.ajax({
		dataType: "json",
		type: "GET",
		url: "../php/ajax/isUserLoggedInAjax.php",
		success: function(data) {

			// If the user was already logged in
			if (data["loggedIn"] == "yes") {
	
				handleWidgetsOnLogin(false);
				
			}
		},
		error: function(xhr, textStatus, errorThrown) {

			alert("Error:\nxhr: " + xhr + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
		}
	});
}

$(document).ready( function() {


	// We have to wait a little other wise the dynamic divs aren't loaded in yet.
	setTimeout(function() {

		makeRequest();

	}, 20);

});