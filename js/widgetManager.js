// This file is for the management of the visibilty of widgets when user logs in, logs out, or has an incorrect login (alert box)

// Amount of miliseconds it will take to fade in or out the element
var fadeDuration = 300;

// This will get called if someone clicks the login button at the top of the screen (opens login form)
function toggleLoginContainer() {

	$("#loginContainer").fadeToggle(fadeDuration);
}

// Will be called when a user just logged in or enters another page and we see the user is still logged in thanks to the session variable
function handleWidgetsOnLogin(fade) {

	if (fade == true) {
		
		// Hide login button (delay to prevent collision with fadeout of form)
		$("#linBut").delay(300).fadeOut(fadeDuration);
		// Show add item button (delay to prevent text misplacement due to loginform not being fully faded out)
		$("#addItemContainerWithSort").delay(300).fadeIn(fadeDuration);
		// Show edit & delete button
		$(".adminItemBut").fadeIn(fadeDuration);
		// Show logout button (delay to prevent collision with login button) (double delay time since the login but is already delayed itself due to the form.)
		$("#loutBut").delay(600).fadeIn(fadeDuration);

	} else {

		// Hide login button (delay to prevent collision with fadeout of form)
		$("#linBut").hide();
		// Show add item container (delay to prevent text misplacement due to loginform not being fully faded out)
		$("#addItemContainerWithSort").show();
		// Show edit & delete button
		$(".adminItemBut").show();
		// Show logout button (delay to prevent collision with login button) (double delay time since the login but is already delayed itself due to the form.)
		$("#loutBut").show();

	}
}

// Will be called when a user just logged out. 
function handleWidgetsOnLogout() {

	// Hide logout button
	$("#loutBut").fadeOut(fadeDuration);
	// Hide add item button
	$("#addItemContainerWithSort").fadeOut(fadeDuration);
	// Hide edit & delete button
	$(".adminItemBut").fadeOut(fadeDuration);
	// Show login button (delay to prevent collision with logout button)
	$("#linBut").delay(300).fadeIn(fadeDuration);
}

// Will be called when the login using the current name / pass was correct
function loginSuccessfull() {

	// Hide login failure msg (we want to fade this quicker since it doesnt apply in this situation anymore)
	$("#loginFailed").fadeOut(fadeDuration - (fadeDuration / 1.5));
	// Hide login form
	$("#loginContainer").fadeOut(fadeDuration);
}

// Will be called when the login using the current name / pass was incorrect (show failure alert)
function loginFailed() {

	// Show login failure msg
	$("#loginFailed").fadeIn(fadeDuration);
}