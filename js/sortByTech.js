// Will load all the divs from the database sorted and grouped by tech
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

function getTechToSortBy() {
	// Will return the tech the user wants the divs sorted by

	var e = document.getElementById("techSortSelect");
	var result = e.options[e.selectedIndex].value;
	result = result.toLowerCase();

	return result
}

function sortAllObjectsByTech(arrayOfObjects) {

	// Getting the tech to sort by (which will come first)
	var techToSortBy = getTechToSortBy();

	// Some arrays to hold the sorted objects
	var priorityObjects = [];
	var otherObjects = [];

	// Looping thru all the objects
	for (var i = 0; i < arrayOfObjects.length; i++) {

		// Getting the current obj
		var currentObj = arrayOfObjects[i]; 

		// If the current obj contains the tech we sort by we add it to the priorityObjects
		if (currentObj[techToSortBy] == 1) {

			priorityObjects.push(currentObj);
		
		} else {

			otherObjects.push(currentObj);
		}
	}

	// Combining the two arrays again. now the objects containing the tech which the user sorted by will be the first in the array
	var sortedObjects = priorityObjects.concat(otherObjects);
	return sortedObjects;
}

function createOrderedDivs (data) {

	var allObjects = [];

	// Looping thru all the items in the data and adding all item objects to a array
	for (var key in data) {

		// Getting the object containing the current item
		var currentItemObj = data[key];

		// Adding all the objects to a array
		allObjects.push(currentItemObj);
	}

	// Sorting all the objects by tech (will return an array which the objects containing the tech will be first.)
	var allObjectsSorted = sortAllObjectsByTech(allObjects);

	var allHtmlDivStringsArray = [];

	// Looping thru all the sorted items
	for (var i = 0; i < allObjectsSorted.length; i++) {

		// Getting the div in one html string for the current object
		var divHtmlString = createDiv(allObjectsSorted[i]);

		// Pushing the current div (html string) to the array
		allHtmlDivStringsArray.push(divHtmlString);
	}

	// Making all the divs into a single html string
	htmlString = allHtmlDivStringsArray.join("");

	// Adding the item divs to our mainContainer
	$(".mainContainer").html(htmlString);
}

$("#sortForm").submit( function(e) {

	// Preventing default submission
	e.preventDefault();

		// Make ajax call to the getItemData.php (ajax only) which will return all the data for all the items in the database
		$.ajax({
			dataType: "json",
			type: "GET",
			url: "../php/ajax/getItemData.php",
			success: function(data) {

				createOrderedDivs(data);

				// Since the edit / delete icons are hidden again due to the created divs we have to call this function to show them again
				handleWidgetsOnLogin(false);

			},
			error: function(xhr, textStatus, errorThrown) {

				alert("Error:\nxhr: " + xhr + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
			}
		});

});