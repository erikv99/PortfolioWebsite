// called when someone clicks a delete button

function deleteItem(id) {

	$.ajax({
		dataType: "json",
		type: "POST",
		data: {
			"id" : id
		},
		url: "../php/ajax/deleteItem.php",
		success: function(data) {

			if (data["success"] == "yes") {

				// Getting the name of the page where it comes from 
				var currentPageName = window.location.pathname;
				var currentPageName = currentPageName.substring(currentPageName.lastIndexOf('/') + 1);

				// If we delete the item on the itemPage we want a redirect back to the home page.
				if (currentPageName == "itemPage.php") {

					window.location.replace("../php/homePage.php");
				
				} else {

					// Refreshing the page so the deleted div gets removed from the page
					window.location.reload(false);
				}
			}
		},
		error: function(xhr, textStatus, errorThrown) {

			alert("Error:\nxhr: " + xhr + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
		}
	});
}
