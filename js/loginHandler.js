// This file will handle everything for logging in except for the visibility toggle on elements, widgetManager.js takes care of that

function proccessInput() {

	// Serializing our form data, putting it in a object so we can use it like a key value object
	var loginCredentials = $("#loginForm").serializeArray();
	var keyValObj = {};

	// Looping thru all the data and putting it in our object
	$.each(loginCredentials, function(i, field) {

		// Adding a new key (field name) and adding a value to it (field value)
		keyValObj[field.name] = field.value;
	});

	// Making a request using ajax to send (login info) and recieve (loginSuccess)
	$.ajax({
		dataType: "json",
		type: "POST",
		url: "../php/ajax/login.php",
		data: {
			'user' : keyValObj['username'],
			'pass' : keyValObj['password']
		},
		success: function(data) {

			// Here we proccess the data we get back from the login.php file
			if (data["loginSuccessfull"] == "yes") {

				// calling the functions which handle fading in / out certain elements
				// See widgetManager.js for a desc of the loginSuccessfull and handleWidgetsOnLogin functions.
				loginSuccessfull();
				handleWidgetsOnLogin(true);

				// Reseting the form
				$("#loginForm")[0].reset();

			} else {

				// Calling the functtion which will display the login failed alert box / msg 
				loginFailed();
			}
		},
		error: function(xhr, textStatus, errorThrown) {

			alert("Error:\nxhr: " + xhr + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
		}
	});

	// Returning false to prevent auto commit of the form
	return false;
}