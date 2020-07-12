// This function will handle everything for the logout except for the visibility toggle on elements since widgetManager.js takes care of that
function logout() {

	$.ajax({
		type: "GET",
		url: "../php/ajax/logout.php",	
		success: function(data) {

			handleWidgetsOnLogout();
		},
		error: function(xhr, textStatus, errorThrown) {

			alert("Error:\nxhr: " + xhr + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
		}
	});
}