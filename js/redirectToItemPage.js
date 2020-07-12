function redirectToItemPage(id) {

	window.location.replace("../php/itemPage.php");
	document.cookie = "itemId=" + id;

}