function deleteImage(id, fileName) {

	// getting our allImages cookie and splitting it into a array
	var allImages = getCookie("allImages");	
	imagesInArr = allImages.split(",");

	// Getting the index of the element that needs to be removed
	var index = imagesInArr.indexOf("../../uploads/" + fileName);

	// Removing the right image from the array
	imagesInArr.splice(index, 1);

	// Making the new cookie string by joining
	var newAllImages = imagesInArr.join();

	// Setting the cookie back.
	document.cookie = "allImages=" + newAllImages;
	
	// Showing all items again
	displayAllImages();

	// Making a newAllImagesPaths (which will be the same as newAllImages but will include ../../ (full path))
	var newAllImagesPaths = imagesInArr.join();

	// Ajax request to php file which will remove the image from the server and change the sql.
	$.ajax({
		type: "POST",
		data: {
			"fileName" : fileName,
			"id" : id,
			"allImages" : newAllImagesPaths
		},
		url: "../php/ajax/deleteImage.php",
		success: function() {

		},
		error: function(xhr, textStatus, errorThrown) {

			alert("Error:\nxhr: " + xhr + "\ntextStatus: " + textStatus + "\nerrorThrown: " + errorThrown);
		}
	});
}




