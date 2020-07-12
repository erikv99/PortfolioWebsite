// This file dynamically makes the itempage.php

function createItemPage(dataObj) {

	// Getting the tech used string
	techUsedString = getTechUsedString(dataObj);

	var htmlArray = [
		"<h1 class=\"textAlignCenter\">" + dataObj["title"] + "</h1>",
		"<div class=\"itemContainerOptions\"><button onclick=\"redirectToEditItem(" + dataObj["id"] + ")\" class=\"adminItemBut hiddenByDefault\"><i class=\"fa fa-edit right effects itemIcon\"></i></button><button onclick=\"deleteItem(" + dataObj["id"] + ")\" class=\"adminItemBut hiddenByDefault\"><i class=\"fas fa-trash-alt right effects itemIcon\"></i></button></div>",
		"<div class=\"textAlignCenter\" id=\"urlLink\"><a href=\"" + dataObj["url"] + "\">" + dataObj["url"] + "</a></div>",
		"<p class=\"techUsed textAlignCenter\" id=\"techUsedItemPage\">Tech used: " + techUsedString + "</p>",
		"<div class=\"itemContainerDates\"><p class=\"left\">Date Of Creation: "  + dataObj["dateCreation"] + "</p><p class=\"right\">Date Of Upload: " + dataObj["dateUpload"] + "</p></div>",
		"<p class=\"textAlignCenter\">" + dataObj["description"] + "</p>",
		"<table id=\"imageTable\">"
	];

	// Splitting on comma
	var imagesArr = dataObj["images"].split(",")

	// If arr isnt empty and first index isnt empty
	if (imagesArr.length != 0 && imagesArr[0] != "") {

		// looping thru all the images
		for (var i = 0; i < imagesArr.length; i++) {

			// Splitting at the / 
			temp = imagesArr[i].split("/");

			if (typeof temp[3] == "undefined") { continue; }

			currentImage = "../uploads/" + temp[3];

			// Adding the current image in the right html line to the htmlArray
			htmlArray.push("<tr><td><img src=\"" + currentImage + "\"></td></tr>");
		}
	}

	// Adding back the last three required lines
	htmlArray.push("</table>");
	htmlArray.push("<h6 class=\"textAlignCenter\">My thoughs on the project:</h6>");
	htmlArray.push("<p id=\"comment\" class=\"textAlignCenter\">" + dataObj["comment"] + "</p>");

	// Joining the html array into one big html string
	htmlArray.join("")

	// Adding the html string to our itemContainer
	$(".itemContainer").html(htmlArray);
}

$( document ).ready( function() {

	var id = parseInt(getCookie("itemId"));

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
			try {

				var dataObj = JSON.parse(data);
			
			} catch (e) {

				return;
			} 

			createItemPage(dataObj);

		},
		error: function(xhr, textStatus, errorThrown) {

			alert("Error:\nxhr: " + xhr + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
		}
	});
});