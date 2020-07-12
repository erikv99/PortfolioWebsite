// This file will be called when the edit item button is called, it will redirect to the editItem page and will save the id of the item that is being edited to the cookies for later use

function redirectToEditItem(id) {

	window.location.replace("../php/editItem.php");
	document.cookie = "id=" + id;
} 
