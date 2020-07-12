// Will load all the divs from the database and create the itemContainers necessary

function createDiv (dataObject) {
	// Will use the json dataobject to build the div for that info dynamically.

	var techUsedString = getTechUsedString(dataObject);

	var htmlArray = [
		"<div class=\"itemContainer\">",
		"<h1>" + dataObject["title"] + "</h1>",
		"<div class=\"itemContainerOptions\">",
		"<button onclick=\"redirectToEditItem(" + dataObject["id"] +")\" class=\"adminItemBut hiddenByDefault\"><i class=\"fa fa-edit right effects itemIcon\"></i></button>",
		"<button onclick=\"deleteItem(" + dataObject["id"] +")\" class=\"adminItemBut hiddenByDefault\"><i class=\"fas fa-trash-alt right effects itemIcon\"></i></button>",
		"</div>",
		"<p>" + dataObject["description"] + "</p>",
		"<p class=\"techUsed\">Tech used: "+ techUsedString + "</p>",
		"<div class=\"textAlignCenter\">",
		"<button onclick=\"redirectToItemPage(" + dataObject["id"] + ")\" class=\"showItemButton effects\">Visit Item Page</button>",
		"</div>",
		"<div class=\"itemContainerDates\">",
		"<p class=\"left\">Date Of Creation: " + dataObject["dateCreation"] + "</p>",
		"<p class=\"right\">Date Of Upload: " + dataObject["dateUpload"] + "</p>",
		"</div>",
		"</div>"
	];

	// Turning the array in to a single html string and returning it
	var htmlString = htmlArray.join("");
	return htmlString
}

function createDivs (data) {

	var allDivsArray = [];

	// Looping thru all the items.
	for (var key in data) {

		// Getting the object containing the current item
		var currentDivObj = data[key];

		// Getting this whole item in one html string
		var divString = createDiv(currentDivObj);

		// Adding the html string to the array containing all div html strings
		allDivsArray.push(divString);
	}

	// Making all the divs into a single html string
	htmlString = allDivsArray.join("");

	// Adding the item divs to our mainContainer
	$(".mainContainer").html(htmlString);
}

$(document).ready( function() {

	// Make ajax call to the getItemData.php (ajax only) which will return all the data for all the items in the database
	$.ajax({
		dataType: "json",
		type: "GET",
		url: "../php/ajax/getItemData.php",
		success: function(data) {
			
			createDivs(data);

		},
		error: function(xhr, textStatus, errorThrown) {

			alert("Error:\nxhr: " + xhr + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
		}
	});

});